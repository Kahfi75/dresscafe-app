@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

    {{-- Grafik Live Penjualan --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 mb-8">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">Grafik Penjualan & Order (Live)</h2>
        </div>
        <div class="p-6">
            <div class="chart-container" style="position: relative; height: 400px;">
                <canvas id="liveSalesChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Aktivitas Terbaru</h2>
        <div class="overflow-x-auto">
            <table id="activityTable" class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase text-gray-600 border-b">
                    <tr>
                        <th class="px-6 py-3">Pelanggan</th>
                        <th class="px-6 py-3">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($recentActivities as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $order->customer_name }}</td>
                        <td class="px-6 py-4">{{ $order->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

<script>
    // Inisialisasi Chart
    const ctx = document.getElementById('liveSalesChart').getContext('2d');
    let salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [], // Akan diisi oleh data AJAX
            datasets: [
                {
                    label: 'Total Penjualan (Rp)',
                    data: [],
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3
                },
                {
                    label: 'Jumlah Order',
                    data: [],
                    borderColor: '#A855F7',
                    backgroundColor: 'rgba(168, 85, 247, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    // Fungsi Fetch & Update Chart
    function updateChartData() {
        $.ajax({
            url: '{{ route("dashboard.chartData") }}',
            method: 'GET',
            success: function(response) {
                salesChart.data.labels = response.labels;
                salesChart.data.datasets[0].data = response.sales;
                salesChart.data.datasets[1].data = response.orders;
                salesChart.update();
            },
            error: function(err) {
                console.error('Gagal memuat data chart:', err);
            }
        });
    }

    // Inisialisasi Chart pertama & interval update tiap 10 detik
    updateChartData();
    setInterval(updateChartData, 10000); // 10 detik

    // DataTables - Aktivitas
    $(document).ready(function () {
        $('#activityTable').DataTable({
            pageLength: 5,
            lengthChange: false,    
            searching: false,
            ordering: false,
            info: false,
            language: {
                emptyTable: "Belum ada aktivitas terbaru.",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                }
            },
            initComplete: function () {
                $('.dataTables_wrapper').addClass('mt-2');
            }
        });
    });
</script>
@endpush
@endsection

