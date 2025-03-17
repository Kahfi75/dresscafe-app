<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sale</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 400px; margin: auto; }
        label { display: block; margin: 10px 0 5px; }
        input, select { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; }
        button { padding: 10px 15px; background-color: orange; color: white; border: none; cursor: pointer; }
        button:hover { background-color: darkorange; }
    </style>
</head>
<body>

    <h2>Edit Sale Transaction</h2>

    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Select Menu:</label>
        <select name="menu_id[]" multiple required>
            @foreach($menus as $menu)
            <option value="{{ $menu->id }}" @if(in_array($menu->id, $sale->details->pluck('menu_id')->toArray())) selected @endif>
                {{ $menu->name }} - Rp {{ number_format($menu->price, 0, ',', '.') }}
            </option>
            @endforeach
        </select>

        <label>Quantity:</label>
        <input type="number" name="quantity[]" required>

        <button type="submit">Update</button>
    </form>

</body>
</html>
