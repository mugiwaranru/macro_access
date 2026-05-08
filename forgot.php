<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Macro Access</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="form-section" style="width:100%">
            <div class="login-card">
                <h2>Reset Password</h2>
                <?php if(isset($error)) echo "<p style='color:green'>$error</p>"; ?>
                <form action="index.php?action=forgot" method="POST">
                    <p>Enter username to reset to 'password123'</p>
                    <input type="text" name="username" placeholder="Username" required>
                    <button type="submit" class="btn-primary">Reset</button>
                </form>
                <div class="links">
                    <a href="index.php?action=login">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
