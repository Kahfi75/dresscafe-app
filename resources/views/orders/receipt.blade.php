<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            padding: 20px;
            max-width: 300px;
            margin: auto;
        }
        .text-center { text-align: center; }
        .mb-2 { margin-bottom: 8px; }
        .mb-1 { margin-bottom: 4px; }
        .border-top { border-top: 1px dashed #000; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 2px 0; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        @media print {
            body { margin: 0; }
        }
    </style>
</head>
<body>
    <div class="text-center mb-2">
        <h2 class="mb-1">DRESSCAFE</h2>
        <p class="mb-1">Jl.Shiganshina Tatakae no.09</p>
        <p class="mb-1">Telp: 0812-3456-7890</p>
        <div class="border-top"></div>
        <p class="mb-1">Struk Pembelian</p>
        <p>{{ $order->created_at->format('d M Y H:i') }}</p>
    </div>

    <p class="mb-1">Kasir: {{ $order->user->name ?? '-' }}</p>
    <p class="mb-2">Pelanggan: {{ $order->customer_name ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <td><strong>Item</strong></td>
                <td class="right"><strong>Qty</strong></td>
                <td class="right"><strong>Harga</strong></td>
                <td class="right"><strong>Subtotal</strong></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->menu->name }}</td>
                    <td class="right">{{ $item->quantity }}</td>
                    <td class="right">Rp{{ number_format($item->menu->price, 0, ',', '.') }}</td>
                    <td class="right">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="border-top"></div>
    <table>
        <tr>
            <td class="bold">Total</td>
            <td class="right bold" colspan="3">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td class="right" colspan="3">{{ $order->status }}</td>
        </tr>
    </table>

    <div class="border-top"></div>
    <div class="text-center">
        <p>Terima kasih telah berbelanja!</p>
        <p>~ DressCafe ~</p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
