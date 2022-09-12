<?php
if (isset($_SESSION['user_name']) && $_SESSION['user_name']) {
?>
    <div class="container-fluid bg d-flex justify-content-between text-bg-dark p-2 text-light">
        <div class="p-2 px-3 mx-3 text-light">
            <?php
            echo $_SESSION['user_name'];
            ?>
        </div>
        <a class="btn border p-2 px-3 mx-3 text-light" href="partials/Logout.php">Logout</a>
    </div>
<?php
} else {
?>
    <div class="container-fluid bg d-flex justify-content-end text-bg-dark p-2 text-light">
        <a class="btn border p-2 px-3 mx-3 text-light" href="partials/Login.php">Login</a>
        <a class="btn border p-2 px-3 mx-3 text-light" href="partials/Signup.php">Signup</a>
    </div>
<?php
}
?>