<?php
include "partials/_dbconnect.php";
session_start();
include "components/header.php";
include "components/nav.php";
?>
<div class="alert">
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


    // Form handling  

    if (isset($_POST['create_task_btn']) && isset($_SESSION['user_name'])) {
        $taskname = mysqli_real_escape_string($conn, $_POST['task_name']);
        $duration = $_POST['task_duration'];
        $name = $_SESSION['user_name'];

        $account_sql = "SELECT user_id from users WHERE user_name='$name'";
        $account_info = mysqli_query($conn, $account_sql);
        $user_id = mysqli_fetch_assoc($account_info)['user_id'];


        //Query to insert into database
        $sql = "INSERT INTO `tasks` (`task_name`, `task_duration`, `user_id`) VALUES ('$taskname', '$duration', '$user_id')";


        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = "Task Successfully created";
            header("location: components/../index.php");
        } else {
            $_SESSION['error'] = "Task Cannot be created Please try again";
            header("location: components/../index.php");
        }
    }
    ?>
</div>
<div class="container-fluid text-center p-1">

    <?php
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    ?>
        <div class="header container  row text-bold w-50 mx-auto mt-3 fw-light fs-1 border-bottom">
            <div class="col-10 text-start">Scheduler</div>
            <!-- <div class="col text-end mt-0">x</div> -->
        </div>
        <div class="content container row w-50 mx-auto mt-5 h-50 p-2 mb-5">
            <form action="" method="POST">
                <input name="task_name" type="text" placeholder="Enter your task" class="form-control">
                <input name="task_duration" type="number" placeholder="Enter task duration in minute" min=0 class="form-control mt-3">

                <button class="btn border mt-4" name="create_task_btn">Create Task</button>
            </form>
        </div>
    <?php
    } else {
    ?>
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Please Login to continue</h1>
                <a class="btn btn-primary btn-lg" href="partials/Login.php">Click here to login</a>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Including tasks file  -->
    <?php
    include "components/tasks.php"
    ?>
</div>
<?php
include "components/footer.php";
?>