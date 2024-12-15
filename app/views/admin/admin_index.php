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
//Bao gồm controller của product
include '../../controller/admin/ProductController.php';
//Bao gồm giao diện layout (thanh menu dọc) của admin
include "layout.php";
if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
            //Nếu trên thanh url key act có giá trị là list_products thì thực thi code bên trong case
        case "list_products":
            //Bao gồm giao diện hiển thị danh sách sản phẩm
            include "product/list_products.php";
            //Dừng lại để không chạy xuống code của case bên dưới
            break;
            //Nếu trên thanh url key act có giá trị là create_product thì thực thi code bên trong case


        case "create_product":
            //Bao gồm giao diện thêm mới sản phẩm
            include "product/create_product.php";
            //Dừng lại để không chạy xuống code của case bên dưới
            break;
            //Nếu trên thanh url key act có giá trị là log_out thì thực thi code bên trong case


            //=======Xử lý thêm mới sản phẩm vào cơ sở dữ liệu=======
        case "store_product":
            $result_of_store_product = true;
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
                $image = $_FILES['image'];
                $quantity = $_POST['quantity'];
                $regular_price = $_POST['regular_price'];
                $sale_price = $_POST['sale_price'];
                if ($name && $image && $quantity && $regular_price && $sale_price) {
                    $result_of_store_product = store_product($name, $image, $quantity, $regular_price, $sale_price);
                } else {
                    $result_of_store_product = false;
                }
            }
            if (!$result_of_store_product) {
                include "product/create_product.php";
            } else {
                header("Location:?act=list_products&store=true");
            }
            break;

        case "destroy_product":
            if (isset($_GET['product_id'])) {
                $product_id = $_GET['product_id'];
                $result_of_destroy_product = destroy($product_id);
                if ($result_of_destroy_product) {
                    header("Location:?act=list_products&destroy=true");
                } else {
                    header("Location:?act=list_products&destroy=false");
                }
            } else {
                header("Location:?act=list_products");
            }
            break;
        case "log_out":
            //Chuyển hướng đến file LogOutController.php
            header("Location: ../../controller/LogOutController.php");
            //Dừng lại để không chạy xuống code của case bên dưới
            break;
    }
}
//Bao gồm giao diện layout của admin (các thẻ đóng)
include "footer.php";
