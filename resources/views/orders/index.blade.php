<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menus - DressCafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white h-screen flex flex-col p-5 fixed">
        <h2 class="text-2xl font-bold text-center mb-5">DressCafe</h2>
        <nav class="flex flex-col gap-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-md hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('orders.index') }}" class="px-4 py-2 rounded-md hover:bg-gray-700">Orders</a>
            <a href="{{ route('menus.index') }}" class="px-4 py-2 rounded-md bg-gray-800 hover:bg-gray-700">Menus</a>
            <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-700">Settings</a>
            
            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 text-center">
                    Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Content -->
    <div class="w-full md:ml-64 p-6">
        <h1 class="text-3xl font-semibold mb-6">Menus</h1>

        <!-- Notifikasi -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('menus.index') }}" method="GET" class="mb-4 flex items-center">
            <input type="text" name="search" placeholder="Search menu..." value="{{ request('search') }}"
                class="border p-2 rounded-l-md w-full">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md">Search</button>
        </form>

        <div class="bg-white p-5 rounded-lg shadow-md">
            <a href="{{ route('menus.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 inline-block">
                + Add Menu
            </a>

            <table class="w-full border-collapse mt-4">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 text-left">#</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Price</th>
                        <th class="p-3 text-left">Category</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($menus)
                        @forelse($menus as $menu)
                        <tr class="border-b">
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $menu->name }}</td>
                            <td class="p-3">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td class="p-3">{{ $menu->category->name }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('menus.edit', $menu->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded-md text-sm">Edit</a>
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center text-gray-500">No menus found.</td>
                        </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
