<aside class="w-64 bg-gray-900 text-white min-h-screen p-4">
    <h2 class="text-lg font-bold mb-6">Admin Panel</h2>
    <ul>
        <li class="mb-2">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 bg-gray-800 rounded">Dashboard</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('orders.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Pesanan</a>
        </li>
        <li class="mb-2">
            <a href="{{ route('menus.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Menu</a>
        </li>
        <li class="mb-2">
            <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded">Laporan</a>
        </li>
    </ul>
</aside>
