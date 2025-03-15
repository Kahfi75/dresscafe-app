<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail - DressCafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Order Detail</h2>
        
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
        <p><strong>Total Price:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        <p><strong>Status:</strong> 
            <span class="px-2 py-1 text-white rounded 
                {{ $order->status == 'Pending' ? 'bg-yellow-500' : ($order->status == 'Completed' ? 'bg-green-500' : 'bg-red-500') }}">
                {{ $order->status }}
            </span>
        </p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>

        <a href="{{ route('orders.index') }}" class="mt-4 block text-center bg-blue-500 text-white px-4 py-2 rounded-md">Back to Orders</a>
    </div>
</body>

</html>
