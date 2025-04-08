<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Penjualan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Transaksi Penjualan Baru</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <!-- Pilih Customer -->
        <div class="mb-3">
            <label for="customer_id" class="form-label">Pelanggan</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Produk Dinamis -->
        <div id="produk-list">
            <div class="row mb-3 produk-item">
                <div class="col-md-6">
                    <label class="form-label">Produk</label>
                    <select name="menu_id[]" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }} - Rp{{ number_format($product->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="quantity[]" class="form-control" min="1" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-item">Hapus</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" id="add-product" class="btn btn-primary">Tambah Produk</button>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="">-- Pilih Metode --</option>
                <option value="cash">Tunai</option>
                <option value="card">Kartu</option>
                <option value="digital">Digital</option>
            </select>
        </div>

        <!-- Jumlah Dibayar -->
        <div class="mb-3">
            <label for="paid_amount" class="form-label">Jumlah Dibayar</label>
            <input type="number" name="paid_amount" id="paid_amount" class="form-control" min="0" required>
        </div>

        <!-- ID User Login -->
        <input type="hidden" name="user_id" value="{{ auth()->id() ?? 1 }}">

        <button type="submit" class="btn btn-success">Simpan Transaksi</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('add-product').addEventListener('click', function () {
        const container = document.getElementById('produk-list');
        const item = document.querySelector('.produk-item');
        const clone = item.cloneNode(true);
        clone.querySelector('select').value = '';
        clone.querySelector('input').value = '';
        container.appendChild(clone);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-item')) {
            const items = document.querySelectorAll('.produk-item');
            if (items.length > 1) {
                e.target.closest('.produk-item').remove();
            }
        }
    });
</script>
</body>
</html>
