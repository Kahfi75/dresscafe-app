<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .receipt {
            width: 350px;
            padding: 20px;
            border: 1px dashed black;
            margin: auto;
            background: #f8f9fa;
        }
        .text-center {
            text-align: center;
        }
        .btn-print {
            display: block;
            margin: 20px auto;
        }
        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="receipt">
    <h4 class="text-center">Cafe DressCafe</h4>
    <p class="text-center">Jl. Contoh No. 123, Kota</p>
    <hr>
    <p><strong>Cashier:</strong> {{ $sale->user->name ?? '-' }}</p>
    <p><strong>Customer:</strong> {{ $sale->customer->name ?? 'Umum' }}</p>
    <p><strong>Date:</strong> {{ $sale->created_at->format('d M Y, H:i') }}</p>
    <hr>

    <table class="table table-sm table-borderless">
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-end">Qty</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleDetails as $detail)
            <tr>
                <td>{{ $detail->menu->name ?? '-' }}</td>
                <td class="text-end">{{ $detail->quantity }}</td>
                <td class="text-end">Rp {{ number_format($detail->subtotal ?? $detail->price * $detail->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <p><strong>Total:</strong> Rp {{ number_format($sale->total_price, 0, ',', '.') }}</p>
    <p><strong>Payment:</strong> {{ ucfirst($sale->payment_method) }}</p>
    <p><strong>Status:</strong> {{ $sale->payment_status }}</p>

    <button onclick="window.print()" class="btn btn-primary btn-print">Print</button>
</div>

</body>
</html>
