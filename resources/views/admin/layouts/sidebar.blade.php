<aside class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
        <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
            <nav class="flex-1 space-y-2">

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 bg-primary-50 group">
                    <svg class="w-5 h-5 mr-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <!-- Orders -->
                <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Pesanan
                </a>

                <!-- Menu -->
                <a href="{{ route('menus.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Menu
                </a>

                <!-- Sales -->
                <a href="{{ route('sales.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10h2l1 2h11l1-2h2M4 10l1 6h14l1-6M5 16a2 2 0 104 0 2 2 0 00-4 0m10 0a2 2 0 104 0 2 2 0 00-4 0" />
                    </svg>
                    Penjualan
                </a>

                <!-- Reports -->
                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Laporan
                </a>

                <!-- Pengajuan Barang -->
                <a href="{{ route('pengajuan_barang.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Pengajuan Barang
                </a>

                <!-- Customers -->
                <a href="{{ route('customers.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Customer
                </a>

                <!-- Categories -->
                <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Kategori
                </a>

            </nav>
        </div>

        <div class="px-4 py-4 border-t border-gray-200">
            <div class="flex items-center">
                <!-- Optional: user info / logout -->
            </div>
        </div>
    </div>
</aside>
