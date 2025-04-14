@extends('layouts.app')

@section('title', 'Laporan Pengeluaran')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Laporan Pengeluaran</h1>
        <div class="flex space-x-2">
            <form action="{{ route('reports.pengeluaran') }}" method="GET" class="flex items-center space-x-2">
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-2 py-1">
                <span>s/d</span>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-2 py-1">
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Filter</button>
                <a href="{{ route('reports.pengeluaran') }}" class="bg-gray-200 px-4 py-1 rounded">Reset</a>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold">Total Pengeluaran: Rp {{ number_format($total, 0, ',', '.') }}</h2>
                <a href="#" class="text-blue-500 hover:text-blue-700">Export PDF</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pengeluaran as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->kategori }}</td>
                        <td class="px-6 py-4">{{ $item->deskripsi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">Tidak ada data pengeluaran</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection