@extends('admin.layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold">Total Penjualan</h3>
        <p class="text-2xl">Rp 15.000.000</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold">Total Order</h3>
        <p class="text-2xl">320</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold">Total Pelanggan</h3>
        <p class="text-2xl">120</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold">Pendapatan</h3>
        <p class="text-2xl">Rp 25.000.000</p>
    </div>
</div>

<!-- Grafik Penjualan -->
<div class="bg-white p-4 rounded shadow mt-6">
    <canvas id="chartPenjualan"></canvas>
</div>

<script>
    const ctx = document.getElementById('chartPenjualan').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Pendapatan',
                data: [5000000, 7000000, 6000000, 9000000, 8000000, 10000000],
                borderColor: 'rgb(75, 192, 192)',
                fill: false
            }]
        }
    });
</script>

<!-- Daftar Pesanan Terbaru -->
<div class="bg-white p-4 rounded shadow mt-6">
    <h3 class="text-lg font-bold mb-4">Pesanan Terbaru</h3>
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No</th>
                <th class="p-2">Nama Pelanggan</th>
                <th class="p-2">Total</th>
                <th class="p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-2">1</td>
                <td class="p-2">Budi</td>
                <td class="p-2">Rp 50.000</td>
                <td class="p-2 text-green-600">Selesai</td>
            </tr>
            <tr>
                <td class="p-2">2</td>
                <td class="p-2">Rina</td>
                <td class="p-2">Rp 75.000</td>
                <td class="p-2 text-yellow-600">Diproses</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
