@extends('kasir.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 display-6 fw-bold">Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="fs-4 fw-bold">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-center shadow-sm bg-warning bg-opacity-25">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <p class="fs-4 fw-bold">{{ $pendingOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-center shadow-sm bg-success bg-opacity-25">
                <div class="card-body">
                    <h5 class="card-title">Completed</h5>
                    <p class="fs-4 fw-bold">{{ $completedOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-center shadow-sm bg-danger bg-opacity-25">
                <div class="card-body">
                    <h5 class="card-title">Cancelled</h5>
                    <p class="fs-4 fw-bold">{{ $cancelledOrders }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Total Revenue (Completed Orders)</h5>
            <p class="display-6 text-success fw-bold mt-3">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Pesanan Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesananTerbaru as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->customer_name ?? '-' }}</td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $badgeClass = match($order->status) {
                                            'Pending' => 'bg-warning text-dark',
                                            'Completed' => 'bg-success',
                                            'Cancelled' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $order->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
