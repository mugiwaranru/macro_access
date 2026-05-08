<?php
// Default values if database is empty
$totalShown = $metrics['total_shown'] ?? 0;
$totalResponses = $metrics['total_responses'] ?? 0;
$responseRate = $metrics['response_rate'] ?? 0;
$dismissed = $metrics['dismissed'] ?? 0;
$qualitative = $metrics['qualitative'] ?? 0;

// Chart Data (Promoters, Passives, Detractors)
$donutData = $chartData ?? [0, 0, 0];
$hasData = array_sum($donutData) > 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Analytics - Macro Access</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="dashboard-body">
    <nav class="navbar">
        <div class="nav-logo">
            <a href="index.php?action=dashboard" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;">
                <span>🔬</span> MACRO ACCESS
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php?action=account">ACCOUNT</a></li>
            <li><a href="index.php?action=reports">REPORTS</a></li>
            <li><a href="index.php?action=records">RECORDS</a></li>
            <li><a href="index.php?action=logout">LOG OUT</a></li>
        </ul>
    </nav>

    <div class="analytics-wrapper">
        <div class="analytics-header">
            <h2>ANALYTICS DASHBOARD</h2>
            <form action="index.php?action=analytics" method="POST" class="date-range">
                FROM <input type="date" name="start_date" value="<?= $_POST['start_date'] ?? '2026-01-01' ?>" class="date-picker"> 
                TO <input type="date" name="end_date" value="<?= $_POST['end_date'] ?? '2026-01-31' ?>" class="date-picker">
                <button type="submit" style="display:none">Filter</button>
            </form>
        </div>

        <div class="white-card analytics-main-card">
            <?php if ($totalShown == 0): ?>
                <div class="empty-state-container" style="text-align: center; padding: 100px 0;">
                    <span style="font-size: 50px;">📊</span>
                    <h3 style="color: #888; margin-top: 20px;">NO DATA AVAILABLE FOR THIS RANGE</h3>
                    <p style="color: #bbb;">Try adjusting your date filters or adding new records.</p>
                </div>
            <?php else: ?>
                <div class="metrics-grid">
                    <div class="metric-item">
                        <span class="m-label">Total Shown</span>
                        <div class="m-value"><?= number_format($totalShown) ?></div>
                    </div>
                    <div class="metric-item">
                        <span class="m-label">Total Responses</span>
                        <div class="m-value"><?= number_format($totalResponses) ?></div>
                    </div>
                    <div class="metric-item">
                        <span class="m-label">Response Rate</span>
                        <div class="m-value"><?= $responseRate ?>%</div>
                    </div>
                    <div class="metric-item">
                        <span class="m-label">Dismissed</span>
                        <div class="m-value"><?= number_format($dismissed) ?></div>
                    </div>
                    <div class="metric-item no-border">
                        <span class="m-label">Qualitative</span>
                        <div class="m-value"><?= number_format($qualitative) ?></div>
                    </div>
                </div>

                <div class="charts-container">
                    <div class="chart-column">
                        <p class="chart-title">Score ⓘ</p>
                        <div class="gauge-wrapper">
                            <canvas id="gaugeChart"></canvas>
                            <div class="gauge-center-text"><?= $metrics['score'] ?? 0 ?></div>
                        </div>
                    </div>

                    <div class="chart-column">
                        <p class="chart-title">Responses</p>
                        <div class="donut-wrapper">
                            <canvas id="donutChart"></canvas>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        <?php if ($totalShown > 0): ?>
        // Only initialize charts if data exists
        const ctxDonut = document.getElementById('donutChart');
        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: ['Promoters', 'Passives', 'Detractors'],
                datasets: [{
                    data: <?= json_encode($donutData) ?>,
                    backgroundColor: ['#4ade80', '#e5e7eb', '#f87171'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '80%',
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 11 }, padding: 20 } }
                }
            }
        });
        <?php endif; ?>
    </script>

    <?php include 'views/footer.php'; ?>
</body>
</html>