<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
</head>
<body>
    <h2>Edit Menu</h2>
    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Menu:</label>
        <input type="text" name="name" value="{{ $menu->name }}" required><br><br>

        <label>Harga:</label>
        <input type="number" name="price" value="{{ $menu->price }}" required><br><br>

        <label>Kategori:</label>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($menu->category_id == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Update</button>
    </form>
    <br>
    <a href="{{ route('menus.index') }}">Kembali</a>
</body>
</html>
