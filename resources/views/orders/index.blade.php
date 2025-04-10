<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - DressCafe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="hidden md:flex md:w-64 flex-col border-r border-gray-200 bg-white shadow-sm">
            <div class="h-16 px-6 border-b border-gray-200 flex items-center">
                <h1 class="text-xl font-bold text-primary-600">DressCafe</h1>
            </div>

            <div class="flex-1 px-4 py-4 overflow-y-auto">
                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-600 hover:bg-gray-100 group">
                        <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-3 text-sm rounded-lg text-primary-700 bg-primary-50">
                        <svg class="w-5 h-5 mr-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Orders
                    </a>
                    <a href="{{ route('menus.index') }}" class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-600 hover:bg-gray-100 group">
                        <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Menus
                    </a>
                </nav>
            </div>

            <div class="px-4 py-4 border-t border-gray-200">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm rounded-lg text-red-600 hover:bg-red-50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="sticky top-0 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center justify-between h-16 px-6">
                    <h1 class="text-xl font-semibold text-gray-800">Order Management</h1>
                    <button class="md:hidden p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Notification Alerts -->
                @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="ml-3 text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                <!-- Action Bar -->
                <div class="flex flex-wrap justify-between gap-3 mb-6">
                    <div class="flex gap-2">
                        <!-- New Order Button -->
                        <button onclick="document.getElementById('addOrderModal').classList.remove('hidden')"
                            class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New Order
                        </button>

                        <!-- Export to Excel -->
                        <a href="{{ route('orders.exportExcel') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Excel
                        </a>

                        <!-- Export to PDF -->
                        <a href="{{ route('orders.exportPdf') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            PDF
                        </a>

                        <!-- Clear All Soft Delete -->
                        <form action="{{ route('orders.clearAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to soft delete all orders?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-white bg-yellow-500 hover:bg-yellow-600">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Clear All
                            </button>
                        </form>
                    </div>
                </div>


                <!-- Orders Table -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <!-- Table Header -->
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div class="mb-4 sm:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">Order Summary</h3>
                            <div class="flex flex-wrap gap-4 mt-2">
                                <div class="flex items-center">
                                    <span class="h-3 w-3 rounded-full bg-blue-500 mr-2"></span>
                                    <span class="text-sm text-gray-600">Total: {{ $orders->total() }} orders</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="h-3 w-3 rounded-full bg-yellow-500 mr-2 animate-pulse"></span>
                                    <span class="text-sm text-gray-600">Pending: {{ $pendingCount ?? 0 }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="h-3 w-3 rounded-full bg-green-500 mr-2"></span>
                                    <span class="text-sm text-gray-600">Completed: {{ $completedCount ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <select id="rows-per-page" onchange="updateRowsPerPage(this.value)"
                                class="bg-white border border-gray-300 rounded-md pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 per page</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                            </select>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable('id')">
                                        Order ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable('customer')">
                                        Customer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable('date')">
                                        Date/Time
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Items
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable('total')">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable('status')">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($orders as $order)
                                <tr class="hover:bg-gray-50" data-order-id="{{ $order->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-primary-600 hover:text-primary-800">#{{ $order->id }}</a>
                                            @if($order->is_priority)
                                            <span class="ml-2 px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                                Priority
                                            </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-medium">
                                                {{ substr($order->customer_name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ $order->customer_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $order->customer_phone }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">
                                            {{ $order->created_at->format('d M Y H:i') }}
                                            @if($order->created_at->isToday())
                                            <span class="block px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 mt-1">
                                                Today
                                            </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1 max-w-xs">
                                            @foreach($order->orderItems as $item)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $item->menu->name }} × {{ $item->quantity }}
                                            </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('orders.show', $order->id) }}" class="flex items-center px-3 py-1.5 text-xs rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                                <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>

                                            @if($order->status == 'Pending')
                                            <form action="{{ route('orders.markComplete', $order->id) }}" method="POST" onsubmit="return confirm('Complete this order?')">
                                                @csrf
                                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                                    Complete
                                                </button>
                                            </form>

                                            <form action="{{ route('orders.markCancel', $order->id) }}" method="POST" onsubmit="return confirm('Cancel this order?')">
                                                @csrf
                                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
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
                            <a href="{{ $orders->previousPageUrl() }}" class="px-4 py-2 border text-sm rounded-md text-gray-700 hover:bg-gray-50">
                                Previous
                            </a>
                            @endif

                            @if($orders->hasMorePages())
                            <a href="{{ $orders->nextPageUrl() }}" class="ml-3 px-4 py-2 border text-sm rounded-md text-gray-700 hover:bg-gray-50">
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
                                    <a href="{{ $orders->previousPageUrl() }}" class="px-2 py-2 rounded-l-md border text-gray-500 hover:bg-gray-50">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @endif

                                    @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                    @if($page == $orders->currentPage())
                                    <span class="z-10 bg-primary-50 border-primary-500 text-primary-600 px-4 py-2 border">
                                        {{ $page }}
                                    </span>
                                    @else
                                    <a href="{{ $url }}" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 px-4 py-2 border">
                                        {{ $page }}
                                    </a>
                                    @endif
                                    @endforeach

                                    @if($orders->hasMorePages())
                                    <a href="{{ $orders->nextPageUrl() }}" class="px-2 py-2 rounded-r-md border text-gray-500 hover:bg-gray-50">
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

    <!-- Add Order Modal -->
    <div id="addOrderModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="flex justify-between items-center border-b px-6 py-4">
                <h3 class="text-xl font-bold text-gray-800">Add Order</h3>
                <button onclick="closeModal('addOrderModal')" class="text-2xl text-gray-500 hover:text-red-500">&times;</button>
            </div>

            <form action="{{ route('orders.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Customer</label>
                    <select name="customer_name" class="w-full p-3 border border-gray-300 rounded-lg">
                        @foreach($customers as $customer)
                        <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Menu Items</label>
                    <div id="menu-items" class="space-y-2">
                        <div class="grid grid-cols-4 gap-2">
                            <select name="menu[0][menu_id]" class="col-span-3 p-2 border rounded-lg">
                                @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }} - Rp{{ number_format($menu->price) }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="menu[0][quantity]" value="1" min="1" class="col-span-1 p-2 border rounded-lg text-center">
                        </div>
                    </div>
                    <button type="button" onclick="addMenuItem()" class="mt-2 text-sm text-blue-600 hover:underline">+ Add Item</button>
                </div>

                <div class="flex justify-end gap-2 pt-4 border-t">
                    <button type="button" onclick="closeModal('addOrderModal')" class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white">
                        Save Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simple client-side sorting function
        function sortTable(column) {
            const urlParams = new URLSearchParams(window.location.search);
            const currentSort = urlParams.get('sort');
            const currentDirection = urlParams.get('direction');

            let direction = 'asc';
            if (currentSort === column && currentDirection === 'asc') {
                direction = 'desc';
            }

            urlParams.set('sort', column);
            urlParams.set('direction', direction);
            window.location.search = urlParams.toString();
        }

        // Update rows per page
        function updateRowsPerPage(value) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('per_page', value);
            window.location.search = urlParams.toString();
        }

        // Modal functions
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // Menu items
        let menuIndex = 1;

        function addMenuItem() {
            const menuDiv = document.createElement('div');
            menuDiv.classList.add('grid', 'grid-cols-4', 'gap-2');
            menuDiv.innerHTML = `
                <select name="menu[${menuIndex}][menu_id]" class="col-span-3 p-2 border rounded-lg">
                    @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }} - Rp{{ number_format($menu->price) }}</option>
                    @endforeach
                </select>
                <input type="number" name="menu[${menuIndex}][quantity]" value="1" min="1" class="col-span-1 p-2 border rounded-lg text-center">
            `;
            document.getElementById('menu-items').appendChild(menuDiv);
            menuIndex++;
        }
    </script>
</body>

</html>