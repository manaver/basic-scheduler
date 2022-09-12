<?php
include "../partials/_dbconnect.php";
include "header.php";

// Form handling
if (!isset($_GET['Sno'])) {
    $_SESSION['error'] = 'Please try again';
    header("location: ../index.php");
} else {
    $Sno = $_GET['Sno'];
}

if (isset($_POST['EditSubmitBtn'])) {
    $newTitle = $_POST['newTitle'];
    $newTime = $_POST['newTime'];

    $sql = "UPDATE `tasks` SET `task_name` ='$newTitle ', `task_duration` = '$newTime ' WHERE `tasks`.`Sno` = " . $Sno;
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['success'] = 'Successfully edited';
        header("location: ../index.php");
    } else {
        $_SESSION['error'] = 'Please try again';
        header("location: ../index.php");
    }
}


// Pre value in html tag
$sql2 = "SELECT * FROM `tasks` WHERE `tasks`.`Sno` =" . $Sno;
$result2 = mysqli_query($conn, $sql2);
$r = mysqli_fetch_assoc($result2);
?>

<!-- Form for editing -->
<div class="container d-flex mt-5 align-items-center flex-column ">
    <h1 class="fw-light mb-4 underline p-2 border-bottom">Edit Task</h1>
    <form action="" method="POST" class="w-50 border p-5 rounded">
        <div class=" mb-3">
            <label for="newTitle" class="form-label">New Title:</label>
            <input type="text" class="form-control" id="newTitle" name="newTitle" value="<?php echo $r['task_name'] ?>">
        </div>
        <div class="mb-3">
            <label for="NewTime" class="form-label">New Time:</label>
            <input type="number" min=0 class="form-control" id="newTime" name="newTime" value="<?php echo $r['task_duration'] ?>">
        </div>

        <div class="d-flex">
            <button type="submit" class="btn border mx-auto" name="EditSubmitBtn">Submit</button>
        </div>
    </form>
</div>