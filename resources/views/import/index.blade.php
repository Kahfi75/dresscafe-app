<!-- resources/views/import/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data</title>
</head>
<body>
    <h1>Import Data</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('import/users/excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Import Users</h2>
        <input type="file" name="file" required>
        <button type="submit">Import Users</button>
    </form>

    <form action="{{ url('import/sales/excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Import Sales</h2>
        <input type="file" name="file" required>
        <button type="submit">Import Sales</button>
    </form>

    <form action="{{ url('import/menus/excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Import Menus</h2>
        <input type="file" name="file" required>
        <button type="submit">Import Menus</button>
    </form>

    <form action="{{ url('import/order_items/excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Import Order Items</h2>
        <input type="file" name="file" required>
        <button type="submit">Import Order Items</button>
    </form>

    <form action="{{ url('import/categories/excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Import Categories</h2>
        <input type="file" name="file" required>
        <button type="submit">Import Categories</button>
    </form>

</body>
</html>
