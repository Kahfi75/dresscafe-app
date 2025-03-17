<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-5 p-5 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-700 mb-4 flex items-center">
            <i class="fas fa-list mr-2 text-blue-500"></i> Daftar Transaksi
        </h2>

        @if(session('success'))
            <div class="alert alert-success flex items-center p-3 mb-4">
                <i class="fas fa-check-circle text-green-500 mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('sales.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Transaksi
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full border rounded-lg">
                <thead class="bg-blue-500 text-white text-center">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">Kode Seri</th>
                        <th class="p-3">Pelanggan</th>
                        <th class="p-3">Total Harga</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Detail</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    @foreach($sales as $sale)
                    <tr class="border-b">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3 font-bold text-blue-600">{{ $sale->code }}</td>
                        <td class="p-3">{{ $sale->customer->name ?? 'Umum' }}</td>
                        <td class="p-3 text-green-600">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                        <td class="p-3">
                            <span class="px-3 py-1 rounded-full text-white 
                                {{ $sale->status == 'pending' ? 'bg-yellow-500' : 'bg-green-500' }}">
                                {{ ucfirst($sale->status) }}
                            </span>
                        </td>
                        <td class="p-3">
                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                        <td class="p-3 flex gap-2 justify-center">
                            <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('sales.receipt', $sale->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-receipt"></i> Struk
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($sales instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="pagination mt-4 flex justify-center">
                {{ $sales->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
