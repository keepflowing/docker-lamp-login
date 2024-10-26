<head>
    <title>Redirecting...</title>
</head>
<?php
    session_start();
    session_unset();
    session_destroy();
    if(!$_SESSION){
        echo "<script>window.location.href='index.php?logoutSuccess=true'</script>";
    }
?>