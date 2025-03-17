<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.menu-item').forEach((row) => {
                let price = parseInt(row.querySelector('.price').dataset.price);
                let qty = parseInt(row.querySelector('.quantity').value) || 0;
                let subtotal = price * qty;
                row.querySelector('.subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
                total += subtotal;
            });
            document.getElementById('totalHarga').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        function addMenuItem() {
            let menuSelect = document.getElementById('menuSelect');
            let selectedMenu = menuSelect.options[menuSelect.selectedIndex];

            if (selectedMenu.value === "") return;

            let price = selectedMenu.dataset.price;
            let menuId = selectedMenu.value;
            let menuName = selectedMenu.text;

            let row = document.createElement('div');
            row.classList.add('row', 'menu-item', 'mb-2');
            row.innerHTML = `
                <div class="col-4">
                    <input type="hidden" name="menu_id[]" value="${menuId}">
                    <span>${menuName}</span>
                </div>
                <div class="col-2 price" data-price="${price}">Rp ${parseInt(price).toLocaleString('id-ID')}</div>
                <div class="col-3">
                    <input type="number" name="quantity[]" class="form-control quantity" min="1" value="1" oninput="updateTotal()">
                </div>
                <div class="col-3 subtotal">Rp ${parseInt(price).toLocaleString('id-ID')}</div>
            `;

            document.getElementById('menuList').appendChild(row);
            updateTotal();
        }
    </script>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-3">Tambah Transaksi</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <!-- Pilih Pelanggan -->
        <div class="mb-3">
            <label class="form-label">Pilih Pelanggan</label>
            <select name="customer_id" class="form-select" required>
    <option value="">Pilih pelanggan...</option>
    @foreach($customers as $customer)
        <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->phone }}</option>
    @endforeach
</select>

        </div>

        <!-- Pilih Menu -->
        <div class="mb-3">
            <label class="form-label">Pilih Menu</label>
            <select id="menuSelect" class="form-select">
                <option value="">Pilih menu...</option>
                @foreach($menu as $menu)
                    <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">
                        {{ $menu->name }} - Rp {{ number_format($menu->price, 0, ',', '.') }} (Stok: {{ $menu->stock }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="button" class="btn btn-success mb-3" onclick="addMenuItem()">Tambah ke Daftar</button>

        <div class="row fw-bold">
            <div class="col-4">Menu</div>
            <div class="col-2">Harga</div>
            <div class="col-3">Jumlah</div>
            <div class="col-3">Subtotal</div>
        </div>
        <div id="menuList"></div>

        <div class="mt-3 fw-bold">Total Harga: <span id="totalHarga">Rp 0</span></div>

        <!-- Pilih Metode Pembayaran -->
        <div class="mb-3 mt-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="payment_method" class="form-select" required>
                <option value="cash">Tunai</option>
                <option value="card">Kartu</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Proses Transaksi</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
