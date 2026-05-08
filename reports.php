<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports - Macro Access</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Specific override for printable reports */
        @media print {
            .navbar, .search-container, .footer { display: none; }
            .white-card { box-shadow: none; border: 1px solid #ccc; }
            body { background: white; color: black; }
        }
    </style>
</head>
<body class="dashboard-body">
    <nav class="navbar">
        <div class="nav-logo">
            <a href="index.php?action=dashboard">🔬 MACRO ACCESS</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php?action=account">ACCOUNT</a></li>
            <li><a href="index.php?action=reports" class="active">REPORTS</a></li>
            <li><a href="index.php?action=records">RECORDS</a></li>
            <li><a href="index.php?action=logout">LOG OUT</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="analytics-header">
            <h2 style="color: white;">GENERATED REPORTS</h2>
            <button onclick="window.print()" class="btn-blue-action" style="width: auto; padding: 5px 20px;">PRINT REPORT</button>
        </div>

        <div class="white-card table-card">
            <div class="search-container">
                <input type="text" placeholder="FILTER BY CLIENT OR DATE..." class="search-input" style="width: 300px;">
            </div>
            
            <table class="records-table">
                <thead>
                    <tr>
                        <th>CLIENT NAME</th>
                        <th>COMPANY</th>
                        <th>DATE TESTED</th>
                        <th>METH RESULT</th>
                        <th>THC RESULT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($records)): ?>
                        <?php foreach ($records as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['client_name']) ?></td>
                            <td><?= htmlspecialchars($row['company_name'] ?? 'N/A') ?></td>
                            <td><?= date('M d, Y', strtotime($row['date_tested'])) ?></td>
                            <td class="<?= $row['meth_result'] === 'POSITIVE' ? 'status-pos' : 'status-neg' ?>">
                                <?= $row['meth_result'] ?>
                            </td>
                            <td class="<?= $row['thc_result'] === 'POSITIVE' ? 'status-pos' : 'status-neg' ?>">
                                <?= $row['thc_result'] ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center; padding: 30px;">No records available for the selected period.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'views/footer.php'; ?>
</body>
</html>