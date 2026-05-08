<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Macro Access - Home</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="dashboard-body">
    <nav class="navbar">
        <div class="nav-logo">
            <a href="index.php?action=dashboard" style="text-decoration: none; color: inherit;">🔬 MACRO ACCESS</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php?action=account">ACCOUNT</a></li>
            <li><a href="index.php?action=reports">REPORTS</a></li>
            <li><a href="index.php?action=records">RECORDS</a></li>
            <li><a href="index.php?action=logout">LOG OUT</a></li>
        </ul>
    </nav>

    <main class="landing-hero">
        <div class="hero-content">
            <h1>Accurate Results,<br>Trusted Service.</h1>
            <p>Simple, professional, and reassuring. Emphasizes accuracy which is the most important thing in drug testing.</p>
            <button class="btn-stats" onclick="window.location.href='index.php?action=analytics'">VIEW STATISTICS</button>
        </div>

        <div class="hero-chart-box">
            <?php
            // Logic to check if database has records (Assume $hasData comes from Controller)
            // For now, we simulate with a variable. Set to false to see the empty state.
            $hasData = false; 

            if ($hasData): ?>
                <div class="chart-wrapper">
                    <canvas id="landingChart"></canvas>
                </div>
            <?php else: ?>
                <div class="no-data-placeholder">
                    <p>No analytics data available yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <script>
        <?php if ($hasData): ?>
        const ctx = document.getElementById('landingChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    data: [50, 80, 60, 95, 130, 150, 115],
                    backgroundColor: '#4ade80',
                    borderRadius: 5
                }]
            },
            options: { 
                maintainAspectRatio: false, // Allows custom size via CSS
                plugins: { legend: { display: false } }, 
                scales: { y: { beginAtZero: true } } 
            }
        });
        <?php endif; ?>
    </script>
    <?php include 'views/footer.php'; ?>
</body>
</html>