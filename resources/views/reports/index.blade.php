@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Laporan Bisnis</h1>
        <div class="flex space-x-2">
            <button class="bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Filter Tanggal
            </button>
            <button class="bg-blue-600 text-white rounded-lg px-4 py-2 text-sm font-medium flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Pendapatan -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                    <p class="text-2xl font-bold mt-1">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
                    <p class="text-xs text-green-500 mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        12% dari bulan lalu
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full h-12 w-12 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Order -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Order</p>
                    <p class="text-2xl font-bold mt-1">{{ $totalOrder }}</p>
                    <p class="text-xs text-green-500 mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        8% dari bulan lalu
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-full h-12 w-12 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Laba Kotor -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Laba Kotor</p>
                    <p class="text-2xl font-bold mt-1">Rp {{ number_format($labaKotor, 0, ',', '.') }}</p>
                    <p class="text-xs text-green-500 mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        15% dari bulan lalu
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full h-12 w-12 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengeluaran</p>
                    <p class="text-2xl font-bold mt-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                    <p class="text-xs text-red-500 mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        5% dari bulan lalu
                    </p>
                </div>
                <div class="bg-red-100 p-3 rounded-full h-12 w-12 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Menu Items -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Menu Terlaris</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($topMenus as $menu)
            <div class="bg-gray-50 rounded-lg p-4 shadow-sm">
                <h4 class="font-bold text-lg text-gray-800">{{ $menu->name }}</h4>
                <p class="text-sm text-gray-500">{{ $menu->category->name }}</p>
                <p class="text-xl font-semibold text-gray-700">Rp {{ number_format($menu->total_sales, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-400">Terjual: {{ $menu->total_quantity }} kali</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Transaksi Terakhir</h3>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Tanggal</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Pelanggan</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Total</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $transaction->id }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $transaction->date }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $transaction->customer_name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $transaction->status }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">
                        <a href="{{ route('transactions.show', $transaction->id) }}" class="text-blue-600 hover:text-blue-800">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
