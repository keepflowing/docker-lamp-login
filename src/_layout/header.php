<nav>
    <ul>
        <li>
            <a href="/">Home</a>
        </li>
        <li>
            <?php
            if(isset($_SESSION['username'])){
                echo "<a href='../logout.php'>Log out</a>";
            } else {
                echo "<a href='../login.php'>Log in</a>";
            }
            ?>
        </li>
    </ul>
</nav>