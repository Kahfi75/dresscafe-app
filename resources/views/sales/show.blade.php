<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-700 flex items-center">
                <i class="fas fa-receipt mr-2 text-blue-500"></i> Detail Transaksi
            </h2>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="border p-4 rounded-lg bg-gray-50 mb-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Informasi Transaksi</h3>
            <div class="grid grid-cols-2 gap-4">
                <p><strong>Kode Transaksi:</strong> {{ $sale->code }}</p>
                <p><strong>Pelanggan:</strong> {{ $sale->customer->name ?? 'Umum' }}</p>
                <p><strong>Kasir:</strong> {{ $sale->user->name }}</p>
                <p><strong>Tanggal:</strong> {{ $sale->created_at->format('d-m-Y H:i') }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($sale->payment_method) }}</p>
                <p>
                    <strong>Status:</strong>
                    @php
                    $statusInfo = [
                    'pending' => ['text' => 'Menunggu pembayaran atau konfirmasi.', 'color' => 'bg-yellow-500'],
                    'completed' => ['text' => 'Transaksi telah selesai.', 'color' => 'bg-green-500'],
                    'canceled' => ['text' => 'Transaksi dibatalkan.', 'color' => 'bg-red-500']
                    ];
                    $status = $sale->status;
                    $statusText = ucfirst($status);
                    $statusClass = $statusInfo[$status]['color'] ?? 'bg-gray-500';
                    $statusDesc = $statusInfo[$status]['text'] ?? 'Status tidak dikenal.';
                    @endphp
                    <span class="px-3 py-1 rounded-full text-white {{ $statusClass }}">
                        {{ $statusText }}
                    </span>
                    <small class="text-gray-600 block mt-1">{{ $statusDesc }}</small>
                </p>

            </div>
        </div>

        <div class="border p-4 rounded-lg bg-white mb-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Daftar Item</h3>
            <table class="table table-striped border rounded-lg w-full">
                <thead class="bg-blue-500 text-white text-center">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">Nama Menu</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    @foreach($sale->details as $detail)
                    <tr class="border-b">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $detail->menu->name }}</td>
                        <td class="p-3">Rp {{ number_format($detail->menu->price, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $detail->quantity }}</td>
                        <td class="p-3 text-green-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border p-4 rounded-lg bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Total Pembayaran</h3>
            <p class="text-xl font-bold">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</p>
        </div>

        <div class="mt-5 flex gap-3">
            <a href="{{ route('sales.receipt', $sale->id) }}" class="btn btn-info">
                <i class="fas fa-print"></i> Cetak Struk
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>