<?php
include "_dbconnect.php";
include "../components/header.php";
include "_nav.php";
session_start();

// Handle Login
if (isset($_POST['SignBtn'])) {
    $email = $_POST['SEmail'];
    $password = $_POST['SPassword'];
}

// Handle Login
if (isset($_POST['LoginBtn'])) {
    $email = $_POST['LEmail'];
    $password = $_POST['LPassword'];
    // checking if email exist
    $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email'";
    $result = mysqli_query($conn, $sql);
    $count = 0;
    while ($r = mysqli_fetch_assoc($result)) {
        $count++;
    }
    if ($count > 0) {
        $sqlDB = "SELECT * FROM users WHERE email='$email'";
        $resultDB = mysqli_query($conn, $sqlDB);
        $DBdata = mysqli_fetch_assoc($resultDB);
        $SavedPassword = password_verify($password, $DBdata['password']);
        if ($SavedPassword == $password) {
            $_SESSION['user_name'] = $DBdata['user_name'];
            $_SESSION['loggedIn'] = true;
            header("location: ../index.php");
        } else {
            $_SESSION['error'] = 'Wrong Password! Please try again';
            echo 'hee';
        }
    } else {
        // $_SESSION['error'] = "Please Sign in First";
        header("location: Signup.php");
    }
}
?>

<?php
// include "components/taskModal.php";
if (isset($_SESSION['success']) && $_SESSION['success']) {
    echo '
            <div class="alert border text-success alert-dismissible fade show rounded-0" role="alert">
                <strong>Success! </strong>' . $_SESSION['success'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
    unset($_SESSION['success']);
} else if (isset($_SESSION['error']) && $_SESSION['error']) {
    echo '
        <div class="alert border text-danger alert-dismissible fade show rounded-0" role="alert">
        <strong>Alert! </strong>' . $_SESSION['error'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    unset($_SESSION['error']);
}
?>

<div class="container w-50 mt-5">
    <h1 class="fw-light mb-4 ">
        Login
    </h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="Email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="Email" name="LEmail" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="Password1" name="LPassword" placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-primary" name="LoginBtn">Submit</button>
    </form>
</div>