<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Tambah Customer</h2>

    {{-- Menampilkan pesan error jika validasi gagal --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Menampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (opsional)</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="text" name="phone" id="phone" class="form-control" required value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat (opsional)</label>
            <textarea name="address" id="address" class="form-control" rows="3">{{ old('address') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
