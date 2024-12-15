<?php
session_start();
if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        case "admin_index":
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['role'] && $_SESSION['role'] == "admin") {
                    header("Location: app/views/admin/admin_index.php");
                } else {
                    header("Location: app/views/user/home.php");
                }
            } else {
                header("Location: app/views/user/home.php");
            }
            break;
        case "log_out":
            header("Location: app/controller/LogOutController.php");
            break;
    }
} else {
    header("Location: app/views/user/home.php");
}
