<?php
// Kiểm tra nếu biến $result_of_store_product đã được gán giá trị
if (isset($result_of_store_product)) {
    echo $result_of_store_product;
      // Khởi tạo biến $message là chuỗi rỗng
    $message = "";
    // Kiểm tra kết quả thành công hay thất bại
    if ($result_of_store_product == true) {
        // Gán thông báo thành công nếu $result_of_store_product là true
        $message = "Thêm mới sản phẩm thành công!";
    } else if ($result_of_store_product == false) {
         // Gán thông báo thất bại nếu $result_of_store_product là false
        $message = "Thêm mới sản phẩm không thành công!";
    }
}
?>
<div>
    <h2>Thêm mới sản phẩm</h2>
    <div>
     <!-- Liên kết trở về danh sách sản phẩm -->
        <a class="btn btn-secondary" href="?act=list_products"><i class="fas fa-arrow-left me-1"></i>Quay lại</a>
    </div>
    
    <!-- Form tạo mới sản phẩm -->
    <form class="mt-4" action="?act=store_product" method="post" enctype="multipart/form-data" id="form_create_product">
        <?php
 // Kiểm tra nếu biến $message tồn tại và không rỗng
        if (isset($message) && $message != "") {
              // Hiển thị thông báo kết quả (thành công hoặc thất bại)
            echo '<div class="mb-4 text-center">
            <span class="">' . $message . '</span>
        </div>'; 
        }
        ?>

        <div class="d-flex flex-column mb-2">
            <label for="">Tên sản phẩm</label>
            <input type="text" id="product_name" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="d-flex flex-column mb-2">
            <label for="">Ảnh sản phẩm</label>
            <input type="file" id="product_image" name="image" class="form-control" placeholder="Nhập tên sản phẩm" accept="image/*">
        </div>
        <div class="d-flex flex-column mb-2">
            <label for="">Số lượng</label>
            <input type="number" id="product_quantity" name="quantity" class="form-control" placeholder="Nhập số lượng sản phẩm">
        </div>
        <div class="d-flex flex-column mb-2">
            <label for="">Giá thông thường</label>
            <input type="number" id="product_regular_price" name="regular_price" class="form-control" placeholder="Nhập giá thông thường sản phẩm">
        </div>
        <div class="d-flex flex-column mb-2">
            <label for="">Giá giảm</label>
            <input type="number" id="product_sale_price" name="sale_price" class="form-control" placeholder="Nhập giá giảm sản phẩm">
        </div>
        <div class="d-flex flex-column mb-2">
            <button class="btn btn-success" id="btn_store" name="store" type="button">Thêm mới</button>
        </div>
    </form>
</div>
