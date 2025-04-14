@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-6">Dashboard</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="absolute top-2 right-2 text-green-700" onclick="this.parentElement.remove()">
                &times;
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow text-center">
            <h5 class="text-gray-700 text-lg font-medium">Total Orders</h5>
            <p class="text-2xl font-bold mt-2 text-gray-900">{{ $totalOrders }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded shadow text-center">
            <h5 class="text-yellow-800 text-lg font-medium">Pending</h5>
            <p class="text-2xl font-bold mt-2 text-yellow-900">{{ $pendingOrders }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded shadow text-center">
            <h5 class="text-green-800 text-lg font-medium">Completed</h5>
            <p class="text-2xl font-bold mt-2 text-green-900">{{ $completedOrders }}</p>
        </div>
        <div class="bg-red-100 p-4 rounded shadow text-center">
            <h5 class="text-red-800 text-lg font-medium">Cancelled</h5>
            <p class="text-2xl font-bold mt-2 text-red-900">{{ $cancelledOrders }}</p>
        </div>
    </div>

    <div class="bg-white rounded shadow p-6 mb-6">
        <h5 class="text-xl font-semibold text-gray-700 mb-2">Total Revenue (Completed Orders)</h5>
        <p class="text-3xl font-bold text-green-600 mt-2">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white rounded shadow p-6">
        <h5 class="text-xl font-semibold text-gray-700 mb-4">Pesanan Terbaru</h5>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Pelanggan</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Total Harga</th>
                        <th class="px-4 py-2 border">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($pesananTerbaru as $index => $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $order->customer_name ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 border">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border text-center">
                                @php
                                    $statusClasses = [
                                        'Pending' => 'bg-yellow-200 text-yellow-800',
                                        'Completed' => 'bg-green-200 text-green-800',
                                        'Cancelled' => 'bg-red-200 text-red-800',
                                    ];
                                    $badgeClass = $statusClasses[$order->status] ?? 'bg-gray-200 text-gray-800';
                                @endphp
                                <span class="px-2 py-1 rounded text-sm font-medium {{ $badgeClass }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-400 py-4">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
