<?php
include "partials/_dbconnect.php";
session_start();
include "components/header.php"
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
        <strong>Alert!</strong>' . $_SESSION['error'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
        unset($_SESSION['error']);
    }
    ?>
</div>
<div class="container-fluid text-center p-1">
    <div class="header container  row text-bold w-50 mx-auto mt-5 fw-light fs-1 border-bottom">
        <div class="col-10">Scheduler</div>
        <div class="col text-end mt-0">x</div>
    </div>
    <div class="content container row w-50 mx-auto mt-5 h-50 p-2 mb-5">

        <!-- Form handling  -->
        <?php
        if (isset($_POST['create_task_btn'])) {
            $taskname = mysqli_real_escape_string($conn, $_POST['task_name']);
            $duration = $_POST['task_duration'];

            //Query to insert into database
            $sql = "INSERT INTO `tasks` (`task_name`, `task_duration`) VALUES ('$taskname', '$duration')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['success'] = "Task Successfully created";
            } else {
                $_SESSION['error'] = "Task Cannot be created Please try again";
            }
        }
        ?>


        <form action="" method="POST">
            <input name="task_name" type="text" placeholder="Enter your task" class="form-control">
            <input name="task_duration" type="number" placeholder="Enter task duration in minute" min=0 class="form-control mt-3">

            <button class="btn border mt-4" name="create_task_btn">Create Task</button>
        </form>
    </div>

    <!-- Including tasks file  -->
    <?php
    include "components/tasks.php"
    ?>
</div>
<?php
include "components/footer.php";
?>