<!DOCTYPE html>
<html>
<head>
    <title>Export PDF Kategori</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 6px; }
    </style>
</head>
<body>
    <h2>Laporan Kategori</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $i => $cat)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $cat->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
