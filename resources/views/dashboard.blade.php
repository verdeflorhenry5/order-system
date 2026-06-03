<x-app-layout>

    <div class="mb-3">
        <h4>Dashboard</h4>
        <p class="text-muted">Welcome, {{ auth()->user()->name }}!</p>
    </div>

    <div class="mb-4 row">
        <div class="col-md-3">
            <div class="p-3 text-center card border-primary">
                <h6 class="text-muted">Total Users</h6>
                <h2 class="fw-bold text-primary">{{ $totalUsers }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 text-center card border-warning">
                <h6 class="text-muted">Total Orders</h6>
                <h2 class="fw-bold text-warning">{{ $totalOrders }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 text-center card border-danger">
                <h6 class="text-muted">Pending</h6>
                <h2 class="fw-bold text-danger">{{ $pendingOrders }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 text-center card border-success">
                <h6 class="text-muted">Completed</h6>
                <h2 class="fw-bold text-success">{{ $completedOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="p-3 mb-3 card">
                <h6>Users & Orders — Line Chart</h6>
                <canvas id="lineChart" style="max-height:250px;"></canvas>
            </div>
        </div>
        <div class="col-md-5">
            <div class="p-3 mb-3 card">
                <h6>Order Status — Radar Chart</h6>
                <canvas id="radarChart" style="max-height:250px;"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [
                    {
                        label: 'Users',
                        data: [0, 0, 0, {{ $totalUsers }}],
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13,110,253,0.1)',
                        tension: 0.4,
                        fill: true,
                    },
                    {
                        label: 'Orders',
                        data: [0, 0, 0, {{ $totalOrders }}],
                        borderColor: '#ffc107',
                        backgroundColor: 'rgba(255,193,7,0.1)',
                        tension: 0.4,
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } },
                scales: { y: { beginAtZero: true } }
            }
        });

        new Chart(document.getElementById('radarChart'), {
            type: 'radar',
            data: {
                labels: ['Total Orders', 'Pending', 'Completed', 'Users'],
                datasets: [{
                    label: 'Stats',
                    data: [{{ $totalOrders }}, {{ $pendingOrders }}, {{ $completedOrders }}, {{ $totalUsers }}],
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13,110,253,0.2)',
                    pointBackgroundColor: '#0d6efd',
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>

</x-app-layout>
