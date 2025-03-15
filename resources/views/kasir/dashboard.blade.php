@extends('kasir.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold">Dashboard Kasir</h1>
    <p class="text-gray-600">Selamat datang, Kasir!</p>

    <div class="mt-4">
        <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Lihat Pesanan</a>
    </div>
</div>
@endsection
