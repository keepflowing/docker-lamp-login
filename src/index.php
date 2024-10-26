<?php include 'db.php'?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Docker LAMP</title>
    <meta charset="UTF-8">
</head>
<body>
    <?php include '_layout/header.php'; ?>
    <?php
        if(isset($_GET['loginSuccess'])){
            echo "Logged in as " . $_SESSION['username'] . ".";
        } else if (isset($_GET['logoutSuccess'])){
            echo "Logged out.";
        }
    ?>
    <h1>Index</h1>
    <p><a href='login.php'>Login</a></p>
    <p><a href="register.php">Create account</a></p>
<?php include '_layout/footer.php'; ?>
</body>
</html>
