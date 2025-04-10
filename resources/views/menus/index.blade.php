<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management - DressCafe</title>
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
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 group transition-colors">
                            <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 group transition-colors">
                            <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Orders
                        </a>
                        <a href="{{ route('menus.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-primary-700 bg-primary-50 group transition-colors">
                            <svg class="w-5 h-5 mr-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Menus
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 group transition-colors">
                            <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
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
                    <h1 class="text-xl font-semibold text-gray-800">Menu Management</h1>
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
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                    <!-- Search Form -->
                    <form action="{{ route('menus.index') }}" method="GET" class="flex-1">
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" placeholder="Search menu..." value="{{ request('search') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        </div>
                    </form>

                    <!-- Add Menu Button -->
                    <button onclick="toggleModal('createMenuModal')" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded hover:bg-primary-700 transition">
                        + Tambah Menu
                    </button>
                </div>

                <!-- Menu Table -->
                <div class="bg-white shadow overflow-hidden rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($menus as $menu)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $menu->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $menu->stock }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $menu->category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-right">
                                        <div class="flex justify-end space-x-2">
                                            <button onclick="openEditModal({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }}, {{ $menu->stock }}, {{ $menu->category_id }})" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                                Edit
                                            </button>
                                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No menus found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination - Only show if $menus is paginated -->
                @if($menus instanceof \Illuminate\Pagination\LengthAwarePaginator && $menus->hasPages())
                <div class="mt-6">
                    {{ $menus->links() }}
                </div>
                @endif
            </main>
        </div>
    </div>

    <!-- Create Menu Modal -->
    <div id="createMenuModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-lg font-semibold text-primary-600">Tambah Menu Baru</h3>
                <button onclick="toggleModal('createMenuModal')" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form action="{{ route('menus.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                        <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" id="price" name="price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" id="stock" name="stock" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required min="0">
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select id="category_id" name="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="button" onclick="toggleModal('createMenuModal')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded mr-2 hover:bg-gray-300">Batal</button>
                        <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded hover:bg-primary-700">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Menu Modal -->
    <div id="editMenuModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-lg font-semibold text-primary-600">Edit Menu</h3>
                <button onclick="toggleModal('editMenuModal')" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form id="editMenuForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="editName" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                        <input type="text" id="editName" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="editPrice" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" id="editPrice" name="price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="editStock" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" id="editStock" name="stock" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required min="0">
                    </div>
                    <div>
                        <label for="editCategory" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select id="editCategory" name="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="button" onclick="toggleModal('editMenuModal')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded mr-2 hover:bg-gray-300">Batal</button>
                        <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded hover:bg-primary-700">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle modal visibility
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        // Open edit modal with menu data
        function openEditModal(menuId, name, price, stock, categoryId) {
            // Set form action
            document.getElementById('editMenuForm').action = `/menus/${menuId}`;
            
            // Fill form fields
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editStock').value = stock;
            
            // Set selected category
            const categorySelect = document.getElementById('editCategory');
            for (let i = 0; i < categorySelect.options.length; i++) {
                if (categorySelect.options[i].value == categoryId) {
                    categorySelect.selectedIndex = i;
                    break;
                }
            }
            
            // Show modal
            toggleModal('editMenuModal');
        }

        // Close modal when clicking outside
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('[id$="Modal"]');
            modals.forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        toggleModal(modal.id);
                    }
                });
            });
        });
    </script>
</body>
</html>