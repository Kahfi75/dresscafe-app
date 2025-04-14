@extends('layouts.app')

@section('title', 'Laporan Order')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Laporan Order</h1>
        <div class="flex space-x-2">
            <form action="{{ route('reports.order') }}" method="GET" class="flex items-center space-x-2">
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-2 py-1">
                <span>s/d</span>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-2 py-1">
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Filter</button>
                <a href="{{ route('reports.order') }}" class="bg-gray-200 px-4 py-1 rounded">Reset</a>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->customer_name ?? 'Guest' }}</td>
                        <td class="px-6 py-4">
                            <ul class="list-disc pl-5">
                                @foreach ($order->orderItems as $item)
                                <li>{{ $item->menu->name }} ({{ $item->quantity }}x)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($order->status == 'selesai') bg-green-100 text-green-800
                                @elseif($order->status == 'dibatalkan') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">Tidak ada data order</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection