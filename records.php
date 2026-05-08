<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Records - Macro Access</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard-body">
    <nav class="navbar">
        <div class="nav-logo">
            <a href="index.php?action=dashboard" style="text-decoration: none; color: inherit;">🔬 MACRO ACCESS</a>
        </div>  
        <ul class="nav-links">
            <li><a href="index.php?action=account">ACCOUNT</a></li>
            <li><a href="index.php?action=reports">REPORTS</a></li>
            <li><a href="index.php?action=records" class="active">RECORDS</a></li>
            <li><a href="index.php?action=logout">LOG OUT</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="page-indicator">RECORDS</div>

        <form action="index.php?action=add_record" method="POST" enctype="multipart/form-data">
            <div class="entry-grid">
                
                <div class="white-card entry-card">
                    <div class="card-header">INFORMATION</div>
                    <div class="card-body">
                        <input type="text" name="client_name" placeholder="CLIENT NAME" class="styled-input full-width" required>
                        <div class="info-row">
                            <label for="client_photo" class="image-upload-label">
                                <div class="image-box" id="imagePreview">
                                    <i class="fa-regular fa-image" id="placeholderIcon"></i>
                                    <img src="" id="previewImg" style="display:none; width:100%; height:100%; object-fit:cover; border-radius: 4px;">
                                </div>
                                <input type="file" name="client_photo" id="client_photo" accept="image/*" style="display:none;" onchange="previewFile()">
                            </label>
                            
                            <div class="sub-inputs">
                                <div class="mini-row">
                                    <input type="number" name="age" placeholder="AGE" class="styled-input">
                                    <input type="text" name="sex" placeholder="SEX" class="styled-input">
                                </div>
                                <input type="date" name="birth_date" class="styled-input full-width">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="white-card entry-card">
                    <div class="card-header">RESULT</div>
                    <div class="card-body">
                        <input type="text" name="company_name" placeholder="COMPANY NAME" class="styled-input full-width">
                        <select name="meth_result" class="styled-input full-width">
                            <option value="NEGATIVE">METH NEGATIVE</option>
                            <option value="POSITIVE">METH POSITIVE</option>
                            <option value="INVALID">INVALID</option>
                        </select>
                        <select name="thc_result" class="styled-input full-width">
                            <option value="NEGATIVE">THC NEGATIVE</option>
                            <option value="POSITIVE">THC POSITIVE</option>
                            <option value="INVALID">INVALID</option>
                        </select>
                    </div>
                </div>

                <div class="white-card entry-card actions-card">
                    <div class="card-header">ACTIONS</div>
                    <div class="card-body action-btns">
                        <button type="submit" class="btn-blue-action">ADD</button>
                        <button type="button" class="btn-blue-action" onclick="alert('Select a record from the table below to view details.')">VIEW</button>
                        <button type="button" class="btn-blue-action" onclick="window.print()">PRINT</button>
                    </div>
                </div>

            </div>
        </form>

        <div class="white-card table-card">
            <div class="search-container">
                <form action="index.php" method="GET">
                    <input type="hidden" name="action" value="records">
                    <input type="text" name="search" placeholder="Q SEARCH" class="search-input" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                </form>
            </div>
            <table class="records-table">
                <thead>
                    <tr>
                        <th>CLIENT NAME</th>
                        <th>DATE TESTED</th>
                        <th>METH (METHAMPHETAMINE)</th>
                        <th>THC (TETRAHYDROCANNABINOL)</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($records)): ?>
                        <?php foreach ($records as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['client_name']) ?></td>
                            <td><?= date('Y-m-d', strtotime($row['date_tested'])) ?></td>
                            <td class="<?= $row['meth_result'] === 'POSITIVE' ? 'status-pos' : 'status-neg' ?>">
                                <?= $row['meth_result'] ?>
                            </td>
                            <td class="<?= $row['thc_result'] === 'POSITIVE' ? 'status-pos' : 'status-neg' ?>">
                                <?= $row['thc_result'] ?>
                            </td>
                            <td>
                                <button type="button" class="btn-view-small" 
                                    onclick='openViewModal(<?= json_encode($row) ?>)'>
                                    VIEW
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center; padding: 20px; color: #888;">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'views/modals/view_record.php'; ?>

    <script>
    // 1. File Preview Logic
    function previewFile() {
        const preview = document.getElementById('previewImg');
        const icon = document.getElementById('placeholderIcon');
        const fileInput = document.getElementById('client_photo');
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.style.display = "block";
            icon.style.display = "none";
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            preview.style.display = "none";
            icon.style.display = "block";
        }
    }

    // 2. Modal Core Logic
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // 3. Populate and Open View Modal
    function openViewModal(data) {
        // Map database fields to the modal IDs we created in view_record.php
        document.getElementById('view-client-name').innerText = data.client_name;
        document.getElementById('view-age').innerText = data.age || 'N/A';
        document.getElementById('view-dob').innerText = data.birth_date || 'N/A';
        document.getElementById('view-sex').innerText = data.sex || 'N/A';
        document.getElementById('view-company').innerText = data.company_name || 'N/A';
        
        // Results
        document.getElementById('view-date-meth').innerText = data.date_tested;
        document.getElementById('view-result-meth').innerText = data.meth_result;
        document.getElementById('view-date-thc').innerText = data.date_tested;
        document.getElementById('view-result-thc').innerText = data.thc_result;

        // Apply Colors
        document.getElementById('view-result-meth').className = (data.meth_result === 'POSITIVE') ? 'status-pos' : 'status-neg';
        document.getElementById('view-result-thc').className = (data.thc_result === 'POSITIVE') ? 'status-pos' : 'status-neg';

        // Set Image if available, otherwise show placeholder
        const profileImg = document.getElementById('view-profile-img');
        if(data.photo_path) {
            profileImg.src = data.photo_path;
            profileImg.style.opacity = "1";
        } else {
            profileImg.src = "assets/img/placeholder-user.png";
            profileImg.style.opacity = "0.5";
        }

        openModal('viewRecordModal');
    }
    </script>

    <?php include 'views/footer.php'; ?>
</body>
</html>