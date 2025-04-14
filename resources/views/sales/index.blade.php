<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - DressCafe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-gray-200 bg-white shadow-sm">
                <div class="flex items-center h-16 px-6 border-b border-gray-200">
                    <h1 class="text-xl font-bold text-primary-600">DressCafe</h1>
                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <nav class="flex-1 space-y-1">
                        <a href="{{ route('kasir.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 group transition-colors">
                            <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-primary-700 bg-primary-50 group transition-colors">
                            <svg class="w-5 h-5 mr-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Orders
                        </a>
                        <a href="{{ route('customers.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 group transition-colors">
                            <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Customers
                        </a>
                    </nav>
                </div>
                <div class="px-4 py-4 border-t border-gray-200">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="sticky top-0 z-10 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center justify-between h-16 px-6">
                    <h1 class="text-xl font-semibold text-gray-800">Order Management</h1>
                    <div class="flex items-center space-x-4">
                        <button class="md:hidden p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Notification Alert -->
                @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <ul class="text-sm font-medium text-red-800 space-y-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                    <div class="flex flex-wrap gap-2">
                        <!-- New Order Button -->
                        <button onclick="openModal('addOrderModal')"
                            class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New Order
                        </button>

                        <!-- Export to Excel -->
                        <a href="{{ route('orders.exportExcel') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Excel
                        </a>

                        <!-- Export to PDF -->
                        <a href="{{ route('orders.exportPdf') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 transition-colors">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            PDF
                        </a>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <!-- Table Content -->
                    <div class="overflow-x-auto">
                        <table id="orderTable" class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($orders as $order)
                                <tr class="hover:bg-gray-50 transition-colors" data-order-id="{{ $order->id }}" data-status="{{ strtolower($order->status) }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">#{{ $order->id }}</a>
                                            @if($order->is_priority)
                                            <span class="ml-2 px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800 flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                                Priority
                                            </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                                                {{ substr($order->customer_name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ $order->customer_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $order->customer_phone }}</div>
                                                @if($order->customer->is_member ?? false)
                                                <span class="mt-1 inline-block px-1.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                    Member #{{ $order->customer->member_number }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">
                                            <div>{{ $order->created_at->format('d M Y') }}</div>
                                            <div>{{ $order->created_at->format('H:i') }}</div>
                                            @if($order->created_at->isToday())
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                Today
                                            </span>
                                            @elseif($order->created_at->isYesterday())
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Yesterday
                                            </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1 max-w-xs">
                                            @foreach($order->orderItems as $item)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $item->menu->name }} × {{ $item->quantity }}
                                                <span class="ml-1 text-gray-500">(Rp{{ number_format($item->price, 0, ',', '.') }})</span>
                                            </span>
                                            @endforeach
                                            @if($order->special_notes)
                                            <div class="w-full mt-1">
                                                <button onclick="showNote('{{ $order->special_notes }}')" class="text-xs text-gray-500 flex items-center hover:text-blue-600">
                                                    <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    View Note
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                        @if($order->payment_method)
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ ucfirst($order->payment_method) }}
                                        </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($order->status == 'Pending')
                                        <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 animate-pulse">
                                            Pending
                                        </span>
                                        @elseif($order->status == 'Completed')
                                        <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Completed
                                        </span>
                                        @else
                                        <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Cancelled
                                        </span>
                                        @endif

                                        @if($order->kitchen_status)
                                        <div class="mt-1">
                                            <span class="px-2 py-0.5 text-xs rounded-full bg-blue-100 text-blue-800">
                                                Kitchen: {{ $order->kitchen_status }}
                                            </span>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="flex items-center px-3 py-1.5 text-xs rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors"
                                                title="View Details">
                                                <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>

                                            <a href="{{ route('orders.printReceipt', $order->id) }}" target="_blank"
                                                class="flex items-center px-3 py-1.5 text-xs rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors"
                                                title="Print Receipt">
                                                <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                </svg>
                                                Print
                                            </a>

                                            @if($order->status == 'Pending')
                                            <form action="{{ route('orders.markComplete', $order->id) }}" method="POST" onsubmit="return confirm('Complete this order?')">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1.5 text-xs rounded-md text-white bg-green-500 hover:bg-green-600 transition-colors"
                                                    title="Mark as Complete">
                                                    Complete
                                                </button>
                                            </form>

                                            <form action="{{ route('orders.markCancel', $order->id) }}" method="POST" onsubmit="return confirm('Cancel this order?')">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1.5 text-xs rounded-md text-white bg-red-500 hover:bg-red-600 transition-colors"
                                                    title="Cancel Order">
                                                    Cancel
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No orders found</h3>
                                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new order.</p>
                                        <div class="mt-6">
                                            <button onclick="openModal('addOrderModal')" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                New Order
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($orders->hasPages())
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            @if($orders->onFirstPage())
                            <span class="px-4 py-2 border text-sm rounded-md text-gray-300">Previous</span>
                            @else
                            <a href="{{ $orders->previousPageUrl() }}" class="px-4 py-2 border text-sm rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                                Previous
                            </a>
                            @endif

                            @if($orders->hasMorePages())
                            <a href="{{ $orders->nextPageUrl() }}" class="ml-3 px-4 py-2 border text-sm rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                                Next
                            </a>
                            @else
                            <span class="ml-3 px-4 py-2 border text-sm rounded-md text-gray-300">Next</span>
                            @endif
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing <span class="font-medium">{{ $orders->firstItem() }}</span> to
                                    <span class="font-medium">{{ $orders->lastItem() }}</span> of
                                    <span class="font-medium">{{ $orders->total() }}</span> results
                                </p>
                            </div>
                            <div>
                                <nav class="inline-flex rounded-md shadow-sm">
                                    @if($orders->onFirstPage())
                                    <span class="px-2 py-2 rounded-l-md border text-gray-300">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    @else
                                    <a href="{{ $orders->previousPageUrl() }}" class="px-2 py-2 rounded-l-md border text-gray-500 hover:bg-gray-50 transition-colors">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @endif

                                    @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                    @if($page == $orders->currentPage())
                                    <span class="z-10 bg-blue-50 border-blue-500 text-blue-600 px-4 py-2 border">
                                        {{ $page }}
                                    </span>
                                    @else
                                    <a href="{{ $url }}" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 px-4 py-2 border transition-colors">
                                        {{ $page }}
                                    </a>
                                    @endif
                                    @endforeach

                                    @if($orders->hasMorePages())
                                    <a href="{{ $orders->nextPageUrl() }}" class="px-2 py-2 rounded-r-md border text-gray-500 hover:bg-gray-50 transition-colors">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @else
                                    <span class="px-2 py-2 rounded-r-md border text-gray-300">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Special Note Modal -->
    <div id="noteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="flex justify-between items-center border-b px-6 py-4">
                <h3 class="text-lg font-bold text-gray-800">Special Note</h3>
                <button onclick="closeModal('noteModal')" class="text-2xl text-gray-500 hover:text-red-500 transition-colors">
                    &times;
                </button>
            </div>
            <div class="p-6">
                <p id="noteContent" class="text-gray-700 whitespace-pre-wrap"></p>
            </div>
            <div class="flex justify-end px-6 py-4 border-t">
                <button onclick="closeModal('noteModal')" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Add Order Modal -->
    <div id="addOrderModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="flex justify-between items-center border-b px-6 py-4">
                <h3 class="text-xl font-bold text-gray-800">Add Order</h3>
                <button onclick="closeModal('addOrderModal')" class="text-2xl text-gray-500 hover:text-red-500 transition-colors">
                    &times;
                </button>
            </div>
            <form action="{{ route('orders.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <!-- Customer Selection -->
                <div>
                    <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-1">Customer</label>
                    <select name="customer_name" id="customer_name" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @foreach($customers as $customer)
                        <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Menu Items -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Menu Items</label>
                    <div id="menu-items" class="space-y-2">
                        <div class="grid grid-cols-4 gap-2">
                            <select name="menu[0][menu_id]" required
                                class="col-span-3 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">
                                    {{ $menu->name }} - Rp{{ number_format($menu->price) }}
                                </option>
                                @endforeach
                            </select>
                            <input type="number" name="menu[0][quantity]" value="1" min="1" required
                                class="col-span-1 p-2 border rounded-lg text-center focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    <button type="button" onclick="addMenuItem()" class="mt-2 text-sm text-blue-600 hover:text-blue-800">
                        + Add Item
                    </button>
                </div>

                <!-- Special Notes -->
                <div>
                    <label for="special_notes" class="block text-sm font-semibold text-gray-700 mb-1">Special Notes</label>
                    <textarea name="special_notes" id="special_notes" rows="2"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Allergies, special requests, etc."></textarea>
                </div>

                <!-- Priority Order -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_priority" id="is_priority"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_priority" class="ml-2 block text-sm text-gray-700">
                        Priority Order (Urgent)
                    </label>
                </div>

                <!-- Form Footer -->
                <div class="flex justify-end gap-2 pt-4 border-t">
                    <button type="button" onclick="closeModal('addOrderModal')"
                        class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition-colors">
                        Save Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#orderTable').DataTable({
                responsive: true,
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    },
                    emptyTable: "No data available in table",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                },
                dom: '<"flex justify-between items-center mb-4"<"flex"l><"flex"f>>rt<"flex justify-between items-center mt-4"<"flex"i><"flex"p>>',
                initComplete: function() {
                    $('.dataTables_filter input').addClass('border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500');
                    $('.dataTables_length select').addClass('border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500');
                }
            });
        });

        // Show special note in modal
        function showNote(note) {
            document.getElementById('noteContent').textContent = note;
            document.getElementById('noteModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        // Modal functions
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
                const modals = document.querySelectorAll('.fixed.inset-0');
                modals.forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        modal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            }
        });

        // Menu items
        let menuIndex = 1;

        function addMenuItem() {
            const menuDiv = document.createElement('div');
            menuDiv.classList.add('grid', 'grid-cols-4', 'gap-2', 'mt-2');
            menuDiv.innerHTML = `
                <select name="menu[${menuIndex}][menu_id]" required
                    class="col-span-3 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">
                        {{ $menu->name }} - Rp{{ number_format($menu->price) }}
                    </option>
                    @endforeach
                </select>
                <input type="number" name="menu[${menuIndex}][quantity]" value="1" min="1" required
                    class="col-span-1 p-2 border rounded-lg text-center focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            `;
            document.getElementById('menu-items').appendChild(menuDiv);
            menuIndex++;
        }
    </script>
</body>

</html>