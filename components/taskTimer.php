<?php
include "../partials/_dbconnect.php";
session_start();
include "header.php";
if (!isset($_GET['Sno'])) {
    $_SESSION['error'] = ' Please try again';
    header("location: ../index.php");
} else {
    $Sno = $_GET['Sno'];
}
?>


<div class="d-flex min-vh-100 text-center text-bg-dark" data-new-gr-c-s-check-loaded="14.1022.0" data-gr-ext-installed="">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <main class="px-3 mt-10 fw-light">
            <p class="lead">
                <?php
                $sql = "SELECT * FROM `tasks` WHERE Sno=" . $Sno;
                $result = mysqli_query($conn, $sql);
                $r = mysqli_fetch_assoc($result);
                ?>

            <h1><?php echo $r['task_name']; ?></h1>
            <div id="timer" class="col-11 mx-auto d-flex align-items-center justify-content-center h-100 text-center fs-4 m-5 flex-wrap border-top ">
                <div class="row mt-5" style="font-size: 5rem;">
                    <div class="d-flex flex-row col fw-light"><span id="min"><?php echo $r['task_duration']; ?></span> min</div>
                    <div class="col">:</div>
                    <div class="d-flex flex-row col fw-light"><span id="sec">00</span> sec</div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn border text-white fs-3 px-5 " id="start_timer">Start</button>
                <button class="btn border text-white fs-3 px-5 d-none" id="reset_timer">Reset</button>
            </div>
            <h1 class="fw-lighter fs-6 mt-5">Your will be Redirected to Home page when your time is complete.</h1>
    </div>

    <!-- Script for timer -->
    <script>
        $(document).ready(function() {
            // Timer button function start
            document.getElementById("start_timer").addEventListener('click', () => {
                if (document.getElementById("start_timer").classList.contains("d-none")) {
                    document.getElementById("start_timer").classList.remove("d-none");
                    document.getElementById("reset_timer").classList.add("d-none");
                } else {
                    document.getElementById("start_timer").classList.add("d-none");
                    document.getElementById("reset_timer").classList.remove("d-none");
                }
            });
            document.getElementById("reset_timer").addEventListener('click', () => {
                if (document.getElementById("reset_timer").classList.contains("d-none")) {
                    document.getElementById("start_timer").classList.add("d-none");
                    document.getElementById("reset_timer").classList.remove("d-none");
                } else {
                    document.getElementById("start_timer").classList.remove("d-none");
                    document.getElementById("reset_timer").classList.add("d-none");
                }
            });
            // Timer button function end
            document.getElementById("start_timer").addEventListener('click', () => {
                const min = <?php echo $r['task_duration'] ?>;
                const sec = 00;
                let minutes = min;
                let seconds = sec;
                const intervalId = setInterval(() => {
                    document.getElementById('min').textContent = `${minutes<10?0:''}${minutes}`;
                    document.getElementById('sec').textContent = `${seconds<10?0:''}${seconds}`;
                    // Reset timer 
                    document.getElementById("reset_timer").addEventListener('click', () => {
                        clearInterval(intervalId);
                        document.getElementById('min').textContent = `${min}`;
                        document.getElementById('sec').textContent = `${sec}0`;

                    })
                    // Reset timer end
                    if (--seconds < 0) {
                        seconds = 59;
                        minutes--;
                    }
                    if (minutes < 0) {
                        clearInterval(intervalId);
                        window.location.href = '../index.php';
                    }
                }, 1000);
            });
        });
    </script>

    </p>
    <!-- <p class="lead">
                <a href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Learn more</a>
            </p> -->
    </main>
</div>
</div>



<!-- First Modal -->
<div class="modal fade" id="task_view_modal" aria-hidden="true" aria-labelledby="task_view_modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="task_view_modal">Modal 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modal Content -->

                <!-- Timer -->
                <div id="timer" class="col-11 mx-auto text-center fs-4 m-5">
                    <div class="row">
                        <div class="col" id="min">00</div>:
                        <div class="col" id="sec">00</div>
                    </div>
                </div>
            </div>




            <div class="modal-footer col-12">
                <div class="w-100 row d-flex justify-content-between">
                    <button class="btn border col-5" id="start_timer">Start</button>
                    <button class="btn col-5 align-right border" data-bs-target="#edit_modal" data-bs-toggle="modal">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Second Modal -->
<div class="modal fade" id="edit_modal" aria-hidden="true" aria-labelledby="edit_modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal">Modal 2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hide this modal and show the first with the button below.
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#task_view_modal" data-bs-toggle="modal">Back to first</button>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>