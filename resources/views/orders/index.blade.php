<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - DressCafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white h-screen flex flex-col p-5 fixed">
        <h2 class="text-2xl font-bold text-center mb-5">DressCafe</h2>
        <nav class="flex flex-col gap-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-md hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('orders.index') }}" class="px-4 py-2 rounded-md bg-gray-800 hover:bg-gray-700">All Orders</a>
            <a href="{{ route('orders.create', ['status' => 'Pending']) }}" class="px-4 py-2 rounded-md hover:bg-yellow-500">New Orders</a>
            <a href="{{ route('orders.index', ['status' => 'Completed']) }}" class="px-4 py-2 rounded-md hover:bg-green-500">Completed Orders</a>
            <a href="{{ route('orders.index', ['status' => 'Canceled']) }}" class="px-4 py-2 rounded-md hover:bg-red-500">Canceled Orders</a>
            <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-700">Payments</a>
            <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-700">Menus</a>
            <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-700">Settings</a>
            <a href="#" class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 mt-auto text-center">Logout</a>
        </nav>

    </div>

    <!-- Content -->
    <div class="w-full md:ml-64 p-6">
        <h1 class="text-3xl font-semibold mb-6">Orders</h1>

        <div class="bg-white p-5 rounded-lg shadow-md">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 text-left">Order ID</th>
                        <th class="p-3 text-left">Customer Name</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Date</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="border-b">
                        <td class="p-3">{{ $order->id }}</td>
                        <td class="p-3">{{ $order->customer_name }}</td>
                        <td class="p-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 text-white text-sm rounded 
                                    {{ $order->status == 'Pending' ? 'bg-yellow-500' : ($order->status == 'Completed' ? 'bg-green-500' : 'bg-red-500') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="p-3">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('orders.show', $order->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>