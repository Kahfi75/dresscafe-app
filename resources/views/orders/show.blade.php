<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - DressCafe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 group transition-colors">
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
                    <h1 class="text-xl font-semibold text-gray-800">Order Details</h1>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('orders.index') }}" class="flex items-center px-3 py-1.5 text-sm rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Orders
                        </a>
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

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Order Details -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Order Summary -->
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900">Order #{{ $order->id }}</h3>
                                    <div class="flex items-center space-x-2">
                                        @if($order->is_priority)
                                        <span class="px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            Priority
                                        </span>
                                        @endif
                                        
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
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    Created on {{ $order->created_at->format('d M Y, H:i') }}
                                    @if($order->created_at->isToday())
                                    <span class="ml-2 inline-block px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        Today
                                    </span>
                                    @elseif($order->created_at->isYesterday())
                                    <span class="ml-2 inline-block px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Yesterday
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Customer</h4>
                                        <div class="mt-1 flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                                                {{ substr($order->customer_name, 0, 1) }}
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                                                <p class="text-sm text-gray-500">{{ $order->customer_phone }}</p>
                                                @if($order->customer->is_member ?? false)
                                                <span class="mt-1 inline-block px-1.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                    Member #{{ $order->customer->member_number }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Payment</h4>
                                        <div class="mt-1">
                                            <p class="text-sm text-gray-900">
                                                @if($order->payment_method)
                                                    {{ ucfirst($order->payment_method) }}
                                                @else
                                                    Not specified
                                                @endif
                                            </p>
                                            <p class="text-sm text-gray-500 mt-1">
                                                Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($order->special_notes)
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-500">Special Notes</h4>
                                    <p class="mt-1 text-sm text-gray-700 whitespace-pre-wrap">{{ $order->special_notes }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900">Order Items</h3>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @foreach($order->orderItems as $item)
                                <div class="px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="min-w-0 flex-1">
                                                <div class="flex justify-between text-sm">
                                                    <p class="font-medium text-gray-900">
                                                        {{ $item->menu->name }} × {{ $item->quantity }}
                                                    </p>
                                                    <p class="ml-4 text-gray-500">
                                                        Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                                <p class="text-sm text-gray-500">
                                                    Rp{{ number_format($item->price, 0, ',', '.') }} each
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="px-6 py-4 bg-gray-50">
                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                        <p>Total</p>
                                        <p>Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Actions -->
                    <div class="space-y-6">
                        <!-- Status Actions -->
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900">Order Actions</h3>
                            </div>
                            <div class="px-6 py-4 space-y-4">
                                @if($order->status == 'Pending')
                                <form action="{{ route('orders.markComplete', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Mark as Completed
                                    </button>
                                </form>
                                <form action="{{ route('orders.markCancel', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 transition-colors">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Cancel Order
                                    </button>
                                </form>
                                @endif

                                <a href="{{ route('orders.printReceipt', $order->id) }}" target="_blank" class="block w-full flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Print Receipt
                                </a>

                                @if($order->kitchen_status)
                                <div class="pt-4 border-t border-gray-200">
                                    <h4 class="text-sm font-medium text-gray-500">Kitchen Status</h4>
                                    <div class="mt-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $order->kitchen_status }}
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Order Timeline -->
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900">Order Timeline</h3>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flow-root">
                                    <ul class="-mb-8">
                                        <li>
                                            <div class="relative pb-8">
                                                <div class="relative flex items-start space-x-3">
                                                    <div>
                                                        <div class="relative px-1">
                                                            <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1 py-0">
                                                        <div class="text-sm text-gray-500">
                                                            <p>
                                                                Order created
                                                                <span class="text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        @if($order->status == 'Completed')
                                        <li>
                                            <div class="relative pb-8">
                                                <div class="relative flex items-start space-x-3">
                                                    <div>
                                                        <div class="relative px-1">
                                                            <div class="h-8 w-8 bg-green-100 rounded-full flex items-center justify-center">
                                                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1 py-0">
                                                        <div class="text-sm text-gray-500">
                                                            <p>
                                                                Order completed
                                                                <span class="text-xs text-gray-400">{{ $order->updated_at->diffForHumans() }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @elseif($order->status == 'Cancelled')
                                        <li>
                                            <div class="relative pb-8">
                                                <div class="relative flex items-start space-x-3">
                                                    <div>
                                                        <div class="relative px-1">
                                                            <div class="h-8 w-8 bg-red-100 rounded-full flex items-center justify-center">
                                                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1 py-0">
                                                        <div class="text-sm text-gray-500">
                                                            <p>
                                                                Order cancelled
                                                                <span class="text-xs text-gray-400">{{ $order->updated_at->diffForHumans() }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Any additional JavaScript for the show page can go here
    </script>
</body>

</html>