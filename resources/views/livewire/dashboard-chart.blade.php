<div>
<div>
    <canvas id="salesOrderChart" width="100%" height="40"></canvas>

    <script>
        document.addEventListener('livewire:load', function () {
            const data = @json($chartData);
            const ctx = document.getElementById('salesOrderChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    stacked: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik Penjualan dan Order Bulan Ini'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>
</div>
