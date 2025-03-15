<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DressCafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("-translate-x-full");
        }
    </script>
</head>

<body class="bg-gray-50 flex">

    <!-- Sidebar -->
    <div id="sidebar" class="w-64 bg-gray-900 text-white h-screen flex flex-col p-5 fixed transition-transform transform -translate-x-full md:translate-x-0">
        <h2 class="text-2xl font-bold text-center mb-5">DressCafe</h2>
        <nav class="flex flex-col gap-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-md bg-gray-800 hover:bg-gray-700">Dashboard</a>
            <div class="relative">
                <button onclick="document.getElementById('orderDropdown').classList.toggle('hidden')" class="w-full px-4 py-2 rounded-md hover:bg-gray-700 flex justify-between">
                    Orders <span>▼</span>
                </button>
                <div id="orderDropdown" class="hidden flex flex-col bg-gray-800 rounded-md mt-1">
                    <a href="{{ route('orders.index', ['status' => 'Pending']) }}" class="px-4 py-2 hover:bg-gray-700">New Orders</a>

                    <a href="#" class="px-4 py-2 hover:bg-gray-700">Completed Orders</a>
                </div>
            </div>
            <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-700">Payments</a>
            <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-700">Menus</a>
            <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-700">Settings</a>
            <a href="#" class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 mt-auto text-center">Logout</a>
        </nav>
    </div>

    <!-- Content -->
    <div class="w-full md:ml-64 p-6">
        <button onclick="toggleSidebar()" class="md:hidden bg-gray-800 text-white px-3 py-2 rounded-md mb-4">☰ Menu</button>

        <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Total Orders -->
            <div class="bg-blue-500 text-white p-5 rounded-lg shadow-md">
                <h2 class="text-lg">Total Orders</h2>
                <p class="text-2xl font-bold">{{ $totalOrder }}</p>
            </div>

            <!-- Total Revenue -->
            <div class="bg-green-500 text-white p-5 rounded-lg shadow-md">
                <h2 class="text-lg">Total Revenue</h2>
                <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>

            <!-- Total Customers -->
            <div class="bg-purple-500 text-white p-5 rounded-lg shadow-md">
                <h2 class="text-lg">Total Customers</h2>
                <p class="text-2xl font-bold">125</p>
            </div>

            <!-- Top 5 Menu -->
            <div class="bg-yellow-500 text-white p-5 rounded-lg shadow-md col-span-1 md:col-span-2">
                <h2 class="text-lg mb-3">Top 5 Menu</h2>
                <ul class="space-y-2">
                    @foreach($topMenu as $menu)
                    <li class="flex justify-between bg-white text-gray-800 p-2 rounded-lg">
                        {{ $menu->name }}
                        <span class="bg-gray-700 text-white px-2 py-1 rounded">{{ $menu->total_sold }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Sales Chart (Placeholder) -->
            <div class="bg-white p-5 rounded-lg shadow-md col-span-1 md:col-span-3">
                <h2 class="text-lg mb-3">Sales Overview</h2>
                <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-lg">
                    <p class="text-gray-600">Chart Placeholder</p>
                </div>
            </div>

        </div>
    </div>

</body>

</html>