<?php require 'db.php'?>
<?php session_start(); ?>
<?php
    if(isset($_SESSION['username'])){
        echo "<script>window.location.href='index.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>DL - Login</title>
    <meta charset="UTF-8">
</head>
<body>
<?php include '_layout/header.php'; ?>
<h1>Login</h1>
<form action="" method="POST">
    <input type="hidden" name="attempted" value="true" />
    <div class="form-group">
        <label for="uname">Username: </label>
        <input id="uname" type="text" name="uname" />
    </div>
    <div class="form-group">
        <label for="pwd">Password: </label>
        <input id="pwd" type="password" name="pwd" />
    </div>
    <input type="submit" value="Login" />
</form>
<?php
if(!empty($_POST['uname']) && !empty($_POST['pwd'])){
    $db = getDB();

    if($db){
        $hashed_pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $_POST['uname']);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if(mysqli_num_rows($result) > 0 && password_verify($_POST['pwd'], $user['password'])) {
            $_SESSION['userId'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo "<p class='success'>Successfully logged in as " . $_POST['uname'] . ".</p>";
            echo "<script>window.location.href='index.php?loginSuccess=true'</script>";
        }
        else {
            echo "<p class='error'>Invalid combination of username and password.</p>";
        }

        $stmt->close();
        $db->close();
    }
    else {
        echo("<p>No connection with database. Try again later.</p>");
    }
}
else if (isset($_POST['attempted'])) {
    echo "<p class='error'>Both username and password must be filled in.</p>";
}
?>
<?php include '_layout/footer.php'; ?>
</body>
</html>