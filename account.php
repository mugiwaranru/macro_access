<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Settings - Macro Access</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="dashboard-body">
    <nav class="navbar">
        <div class="nav-logo">
            <a href="index.php?action=dashboard" style="text-decoration: none; color: inherit;">🔬 MACRO ACCESS</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php?action=account" class="active">ACCOUNT</a></li>
            <li><a href="index.php?action=reports">REPORTS</a></li>
            <li><a href="index.php?action=records">RECORDS</a></li>
            <li><a href="index.php?action=logout">LOG OUT</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="page-indicator">ACCOUNT</div> 
        
        <div class="white-card account-display-card">
            <form>
                <div class="input-block">
                    <label>USERNAME</label>
                    <input type="text" class="thick-border-input" value="<?= htmlspecialchars($user['username'] ?? 'ADMIN') ?>" readonly>
                </div>

                <div class="input-block">
                    <label>POSITION</label>
                    <input type="text" class="thick-border-input" value="<?= htmlspecialchars($user['position'] ?? 'CHIEF TECHNOLOGIST') ?>" readonly>
                </div>
                
                <div class="card-footer-actions">
                    <button type="button" class="btn-blue-pill" onclick="openModal('addUserModal')">ADD USER</button>
                    <button type="button" class="btn-blue-pill" onclick="openModal('editModal')">EDIT</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'views/modals/edit_account.php'; ?>
    <?php include 'views/modals/add_user.php'; ?>

    <script>
        function openModal(id) { 
            const target = document.getElementById(id);
            if(target) target.style.display = 'flex'; 
        }
        
        function closeModal(id) { 
            const target = document.getElementById(id);
            if(target) target.style.display = 'none'; 
        }

        // Close on outside click
        window.onclick = function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                event.target.style.display = 'none';
            }
        }
    </script>

    <?php include 'views/footer.php'; ?>
</body>
</html>