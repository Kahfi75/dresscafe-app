<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order - DressCafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-semibold mb-4 text-center">New Order</h2>

        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Customer Name</label>
                <input type="text" id="customer_name" name="customer_name" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Total Price</label>
                <input type="number" id="total_price" name="total_price" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="w-full p-2 border rounded">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Canceled">Canceled</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Submit</button>

            <!-- Tombol Isi Otomatis -->
            <button type="button" id="fill-auto" class="w-full bg-gray-500 text-white py-2 rounded mt-2">Isi Otomatis</button>
        </form>

        <a href="{{ route('orders.index') }}" class="block text-center text-sm text-gray-600 mt-3">Back to Orders</a>

        <script>
            document.getElementById('fill-auto').addEventListener('click', function() {
                document.getElementById('customer_name').value = 'Pelanggan Contoh';
                document.getElementById('total_price').value = Math.floor(Math.random() * 100000) + 50000;
                document.getElementById('status').value = 'Pending';
            });
        </script>


        <a href="{{ route('orders.index') }}" class="block text-center text-sm text-gray-600 mt-3">Back to Orders</a>
    </div>

</body>

</html>