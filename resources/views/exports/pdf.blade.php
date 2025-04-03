<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengajuan Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .status {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Laporan Pengajuan Barang</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengaju</th>
                <th>Nama Barang</th>
                <th>Tanggal Pengajuan</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_pengaju }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tanggal_pengajuan)) }}</td>
                    <td>{{ $item->qty }}</td>
                    <td class="status">{{ $item->terpenuhi ? 'Terpenuhi' : 'Belum Terpenuhi' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Data pengajuan barang kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p><i>Dicetak pada: {{ now()->format('d-m-Y H:i:s') }}</i></p>
</body>

</html>
