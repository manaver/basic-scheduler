<?php
include "_dbconnect.php";
include "../components/header.php";
include "_nav.php";
session_start();

// Handle Sign in
if (isset($_POST['SignBtn'])) {
    $name = $_POST['SName'];
    $email = $_POST['SEmail'];
    $password = password_hash($_POST['SPassword'], PASSWORD_DEFAULT);
    // checking for uniqueness of email
    $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email'";
    $result = mysqli_query($conn, $sql);
    $count = 0;
    while ($r = mysqli_fetch_assoc($result)) {
        $count++;
    }
    if ($count == 0) {
        $sql = "INSERT INTO `users` (user_name, email, password) VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = "Account Successfully Created! Please Login to continue";
            header("location:../partials/Login.php");
        } else {
            $_SESSION['error_S'] = "Account cannot be created! Please try again";
            header("location:../partials/Signup.php");
        }
    } else {
        $_SESSION['error'] = "Email already exist! Please Login to continue";
        header("location:../partials/Login.php");
    }
}


if (isset($_SESSION['success_S']) && $_SESSION['success_S']) {
    echo '
            <div class="alert border text-success alert-dismissible fade show rounded-0" role="alert">
                <strong>Success! </strong>' . $_SESSION['success_S'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
    unset($_SESSION['success_S']);
} else if (isset($_SESSION['error_S']) && $_SESSION['error_S']) {
    echo '
        <div class="alert border text-danger alert-dismissible fade show rounded-0" role="alert">
        <strong>Alert! </strong>' . $_SESSION['error_S'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    unset($_SESSION['error_S']);
}
?>

<div class="container w-50 mt-5">

    <h1 class="fw-light mb-4 ">
        Sign in
    </h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="SName" placeholder="Enter your name">
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="Email" name="SEmail" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="Password1" name="SPassword" placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-primary" name="SignBtn">Submit</button>
    </form>
</div>