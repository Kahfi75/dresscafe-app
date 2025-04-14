@extends('layouts.app')

@section('title', 'Laporan Omzet')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Laporan Omzet</h1>
        <div class="flex space-x-2">
            <form action="{{ route('reports.omset') }}" method="GET" class="flex items-center space-x-2">
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-2 py-1">
                <span>s/d</span>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-2 py-1">
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Filter</button>
                <a href="{{ route('reports.omset') }}" class="bg-gray-200 px-4 py-1 rounded">Reset</a>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold">Total Omzet: Rp {{ number_format($totalOmzet, 0, ',', '.') }}</h2>
                <a href="#" class="text-blue-500 hover:text-blue-700">Export PDF</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->completed_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->customer_name ?? 'Guest' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">Tidak ada data omzet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection