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
    <title>DL - Register</title>
    <meta charset="UTF-8">
</head>
<body>
    <?php include '_layout/header.php'; ?>
    <h1>Register</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="uname">Username: </label>
            <input id="uname" type="text" name="uname" />
        </div>
        <div class="form-group">
            <label for="pwd">Password: </label>
            <input id="pwd" type="password" name="pwd" />
        </div>
        <input type="submit" value="Create account" />
    </form>
    <?php
        if(!empty($_POST['uname']) && !empty($_POST['pwd'])){
            $db = getDB();

            if($db){
                $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
                $stmt->bind_param("s", $_POST['uname']);
                $stmt->execute();

                $result = $stmt->get_result();

                if(mysqli_num_rows($result) > 0) {
                    echo "<p class='error'>Username already taken</p>";
                }
                else {
                    $hashed_pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

                    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                    $stmt->bind_param("ss", $_POST['uname'], $hashed_pwd);
                    $stmt->execute();

                    echo "<p class='success'>Registered successfully</p>";
                    echo "<p><a href='login.php'>Login</a></p>";
                }

                $stmt->close();
                $db->close();
            }
            else {
                echo("<p>No connection with database. Try again later.</p>");
            }
        }
        else {
            echo "<p class='error'>Both username and password must be filled in.</p>";
        }
    ?>
    <?php include '_layout/footer.php'; ?>
</body>
</html>