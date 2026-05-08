<?php
session_start();
require_once './config/Database.php';
require_once './controllers/AuthController.php';

$database = new Database();
$db = $database->connect();
$auth = new AuthController($db);

$action = $_GET['action'] ?? 'dashboard';

switch($action) {
    case 'dashboard':
        include 'views/dashboard.php';
        break;

case 'account':
    // FIX: Fetch the logged-in user's data directly to prevent the Undefined Method error
    $userId = $_SESSION['user_id'] ?? 0; 
    
    $stmt = $db->prepare("SELECT username, position FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no user is found (e.g., session expired), provide defaults to prevent "Undefined Variable" in the view
    if (!$user) {
        $user = [
            'username' => 'GUEST',
            'position' => 'NOT DEFINED'
        ];
    }
    
    include 'views/account.php';
    break;

    case 'update_account':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $username = $_POST['username'];
            $position = $_POST['position'];
            $currentPass = $_POST['current_password'];
            $newPass = $_POST['new_password'];

            // Logic to verify current password and update would go here
            // Example: $auth->updateUser($userId, $username, $position, $currentPass, $newPass);
            
            header("Location: index.php?action=account&status=updated");
            exit();
        }
        break;

    case 'add_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newUsername = $_POST['new_username'];
            $newPosition = $_POST['new_position'];
            $newPass = password_hash($_POST['new_user_password'], PASSWORD_DEFAULT);

            $stmt = $db->prepare("INSERT INTO users (username, position, password) VALUES (?, ?, ?)");
            $stmt->execute([$newUsername, $newPosition, $newPass]);

            header("Location: index.php?action=account&status=user_added");
            exit();
        }
        break;

    case 'analytics':
        include 'views/analytics.php';
        break;

    case 'records':
        // Fetch records for the table
        $stmt = $db->query("SELECT * FROM test_records ORDER BY date_tested DESC");
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/records.php';
        break;

    case 'reports':
        // Fetch records specifically for the report view
        $stmt = $db->query("SELECT * FROM test_records ORDER BY date_tested DESC");
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/reports.php';
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?action=login");
        exit();
        break;
}
?>