<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] && $_SESSION['role'] != "admin") {
        header("Location: ../user/home.php");
    }
} else {
    header("Location: ../user/home.php");
}
//Bao gồm model kết nối tới cơ sở dữ liệu
include '../../model/pdo.php';
if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        case ""
        case "log_out":
            //Chuyển hướng đến file LogOutController.php
            header("Location: ../../controller/LogOutController.php");
            //Dừng lại để không chạy xuống code của case bên dưới
            break;
    }
}
