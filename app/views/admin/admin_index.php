<?php
session_start(); 
// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {    
    // Kiểm tra vai trò người dùng, nếu không phải admin thì chuyển hướng
    if ($_SESSION['role'] && $_SESSION['role'] != "admin") {        
        header("Location: ../user/home.php");    
    }
} else {    
    // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang người dùng
    header("Location: ../user/home.php");    
}

// Bao gồm model kết nối tới cơ sở dữ liệu
include '../../model/pdo.php'; 

// Bao gồm controller của product
include '../../controller/admin/ProductController.php'; 

// Bao gồm giao diện layout (thanh menu dọc) của admin
include "layout.php"; 

// Kiểm tra giá trị của tham số 'act' trên URL và thực thi hành động phù hợp
if (isset($_GET['act']) && $_GET['act'] != "") {    
    $act = $_GET['act'];    
    switch ($act) {        
        // Nếu trên thanh url key act có giá trị là 'list_products' thì thực thi code bên trong case
        case "list_products":            
            // Bao gồm giao diện hiển thị danh sách sản phẩm            
            include "product/list_products.php";            
            // Dừng lại để không chạy xuống code của case bên dưới            
            break;        
        // Nếu trên thanh url key act có giá trị là 'create_product' thì thực thi code bên trong case        
        case "create_product":            
            // Bao gồm giao diện thêm mới sản phẩm            
            include "product/create_product.php";            
            // Dừng lại để không chạy xuống code của case bên dưới            
            break;        
        // Nếu trên thanh url key act có giá trị là 'store_product' thì thực thi code bên trong case        
        case "store_product":            
            $result_of_store_product = true;            
            // Xử lý khi có dữ liệu gửi lên từ form
            if (isset($_POST['name'])) {                
                $name = $_POST['name'];                
                $image = $_FILES['image'];                
                $quantity = $_POST['quantity'];                
                $regular_price = $_POST['regular_price'];                
                $sale_price = $_POST['sale_price'];                
                // Kiểm tra dữ liệu hợp lệ và lưu sản phẩm vào cơ sở dữ liệu
                if ($name && $image && $quantity && $regular_price && $sale_price) {                    
                    $result_of_store_product = store_product($name, $image, $quantity, $regular_price, $sale_price);                
                } else {                    
                    $result_of_store_product = false;                
                }            
            }            
            // Nếu không lưu được sản phẩm, quay lại trang thêm mới
            if (!$result_of_store_product) {                
                include "product/create_product.php";            
            } else {                
                // Nếu lưu thành công, chuyển hướng về danh sách sản phẩm
                header("Location:?act=list_products&store=true");            
            }            
            break;        
        // Xử lý khi người dùng muốn xóa sản phẩm        
        case "destroy_product":            
            if (isset($_GET['product_id'])) {                
                $product_id = $_GET['product_id'];                
                $result_of_destroy_product = destroy($product_id);                
                // Nếu xóa thành công, quay lại danh sách sản phẩm
                if ($result_of_destroy_product) {                    
                    header("Location:?act=list_products&destroy=true");                
                } else {                    
                    header("Location:?act=list_products&destroy=false");                
                }            
            } else {                
                // Nếu không có product_id thì quay lại danh sách sản phẩm                
                header("Location:?act=list_products");            
            }            
            break;        
        // Xử lý khi người dùng muốn đăng xuất        
        case "log_out":            
            // Chuyển hướng đến file LogOutController.php            
            header("Location: ../../controller/LogOutController.php");            
            break;    
    } 
}

// Bao gồm giao diện footer của admin (các thẻ đóng)
include "footer.php"; 
?>
