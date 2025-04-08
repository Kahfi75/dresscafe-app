<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan - DressCafe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeInModal {
            0% {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-modal {
            animation: fadeInModal 0.4s ease-out forwards;
        }
    </style>

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
                        <a href="{{ route('sales.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-primary-700 bg-primary-50 group transition-colors">
                            <svg class="w-5 h-5 mr-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Transaksi
                        </a>
                        <a href="{{ route('customers.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 group transition-colors">
                            <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Pelanggan
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
                    <h1 class="text-xl font-semibold text-gray-800">Transaksi Penjualan</h1>
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

                @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <button onclick="openCreateModal()"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg animate-fade-in">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Transaksi Baru
                </button>

                <!-- Sales Table -->
                <div class="bg-white shadow overflow-hidden rounded-lg">
                    <div class="overflow-x-auto">
                        <table id="salesTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembayaran</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibayar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kasir</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($sales as $sale)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $sale->customer->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ ucfirst($sale->payment_method) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp{{ number_format($sale->total_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp{{ number_format($sale->paid_amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sale->user->name ?? 'Admin' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('sales.show', $sale->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada transaksi</h3>
                                        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat transaksi baru.</p>
                                        <div class="mt-6">
                                            <button onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                Transaksi Baru
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Create Sale Modal -->
    <div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-40 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition duration-300 ease-in-out">
        <div class="relative top-20 mx-auto p-8 w-full max-w-4xl rounded-2xl bg-white shadow-xl animate-fadeIn">
            <!-- Header -->
            <div class="flex justify-between items-center border-b border-gray-200 pb-4 mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Transaksi Baru</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-700 transition duration-150">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form action="{{ route('sales.store') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <!-- Pelanggan & Metode Pembayaran -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-1">Pelanggan</label>
                        <select name="customer_id" id="customer_id" required
                            class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm">
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" required
                            class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm">
                            <option value="cash">Cash</option>
                            <option value="card">Kartu</option>
                            <option value="digital">Digital</option>
                        </select>
                    </div>
                </div>

                <!-- Produk -->
                <div id="product-container" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end product-row">
                        <div class="md:col-span-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Produk</label>
                            <select name="menu_id[]" required
                                class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm">
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} - Rp{{ number_format($product->price, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                            <input type="number" name="quantity[]" min="1" required
                                class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <button type="button"
                                class="w-full py-2 px-4 rounded-lg text-sm font-semibold text-white bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-red-500 transition">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tombol tambah produk -->
                <div>
                    <button type="button" id="add-product"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-white bg-gray-700 hover:bg-gray-800 focus:ring-2 focus:ring-gray-500 transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Produk
                    </button>
                </div>

                <!-- Jumlah Bayar -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="paid_amount" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Bayar</label>
                        <input type="number" name="paid_amount" id="paid_amount" required
                            class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm">
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="pt-6 flex justify-end gap-4 border-t border-gray-200 mt-8">
                    <button type="button" onclick="closeCreateModal()"
                        class="px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 transition font-medium">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        // Modal functions
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
        }

        // Product row management
        document.getElementById('add-product').addEventListener('click', function() {
            const container = document.getElementById('product-container');
            const row = container.querySelector('.product-row');
            const newRow = row.cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            container.appendChild(newRow);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                const rows = document.querySelectorAll('.product-row');
                if (rows.length > 1) {
                    e.target.closest('.product-row').remove();
                }
            }
        });

        // Initialize DataTable
        $(document).ready(function() {
            $('#salesTable').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data yang tersedia",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)"
                }
            });
        });
    </script>
</body>

</html>