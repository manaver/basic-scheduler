<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "scheduler";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("DB not connected");
}
