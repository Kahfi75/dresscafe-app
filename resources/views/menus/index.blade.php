<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Daftar Menu</h2>
        <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>

        <!-- Search Form -->
        <form action="{{ route('menus.index') }}" method="GET" class="mb-4 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari menu atau kategori..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>

        <div class="row">
            @foreach ($menus as $menu)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <p class="card-text"><strong>Kategori:</strong> {{ $menu->category->name }}</p>
                        <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Stok:</strong> {{ $menu->stock }}</p>
                        <p class="card-text">
                            <strong>Ketersediaan:</strong>
                            @if($menu->stock > 0)
                            <span class="text-success">Tersedia</span>
                            @else
                            <span class="text-danger">Habis</span>
                            @endif
                        </p>
                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
