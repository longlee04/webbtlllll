<?php
function get_list_products()
{
    $sql = "SELECT * FROM `products`";
    return pdo_query($sql);
}
function store_product($name, $image, $quantity, $regular_price, $sale_price)
{
    //============Xử lý thêm ảnh vào kho để khi cần hiển thị ảnh thì sẽ lấy ra từ đây==========
    $image_name = $image['name'];
    $image_name_insert = time() . basename($image_name);
    $image_name_tmp = $image['tmp_name'];
    $target_dir = "../../../public/uploads/products/images/";
    $target_file = $target_dir . $image_name_insert;
    if (!move_uploaded_file($image_name_tmp, $target_file)) {
        return false;
    }
    // ================================Xử lý thêm mới sản phẩm==============================
    //Tạo biến $sql để lưu trữ lệnh sql thực thi thêm mới dữ liệu sản phẩm
    $sql = "INSERT INTO `products`(`name`,`image`,`quantity`,`regular_price`,`sale_price`) VALUES (?,?,?,?,?)";
    //Tạo biến $result để lưu trữ kết quả trả về từ hàm thực thi thêm mới dữ liệu pdo_execute
    $result = pdo_execute($sql, [$name, $image_name_insert, $quantity, $regular_price, $sale_price]);
    //Tạo biến $status_store_product để lưu trữ trạng thái của việc thêm mới sản phẩm, thiết lập giá trị mặc định là false
    $status_store_product = false;
    //Kiểm tra nếu biến $result là true có nghĩa là việc thực thi thêm mới dữ liệu sản phẩm đã thành công nên có dữ liệu và nó sẽ trả về true,
    //còn nếu việc thêm mới dữ liệu sản phẩm không thành công thì không có dữ liệu nên sẽ trả về false
    if ($result) {
        //Ở đây nếu $result là true có nghĩa là có dữ liệu thì sẽ thiết lập giá trị của biến $status_store_product thành true
        $status_store_product = true;
    }
    //Trả về giá trị của biến $status_store_product
    return $status_store_product;
}
function destroy($product_id)
{
    $sql_check = "SELECT * FROM `products` WHERE `id`=?";
    $check_exist_product = pdo_query_one($sql_check, [$product_id]);
    if ($check_exist_product) {
        $sql = "DELETE FROM `products` WHERE `id`=?";
        pdo_execute($sql, [$product_id]);
        return true;
    } else {
        return false;
    }
}
