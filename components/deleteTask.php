<?php
include "../partials/_dbconnect.php";
session_start();
if (!isset($_GET['Sno'])) {
    $_SESSION['error'] = 'Please try again';
    header("location: ../index.php");
} else {
    $Sno = $_GET['Sno'];
    $sql = "DELETE FROM tasks WHERE `tasks`.`Sno` = " . $Sno;
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['success'] = 'Successfully Deleted!';
        header("location: ../index.php");
    } else {
        $_SESSION['error'] = 'Please try again';
        header("location: ../index.php");
    }
}
