<!DOCTYPE html>
<html>
<head>
    <title>Login - Macro Access</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="brand-section">
            <div class="logo-placeholder">🔬</div>
            <h1>MACRO ACCESS</h1>
            <p>DRUG TESTING CENTER</p>
        </div>
        <div class="form-section">
            <div class="login-card">
                <h2>Log In</h2>
                <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
                <form action="index.php?action=login" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="btn-primary">Log In</button>
                </form>
                <div class="links">
                    <a href="index.php?action=forgot">Forgot Password?</a>
                    <hr>
                    <a href="index.php?action=register">Register Admin</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>