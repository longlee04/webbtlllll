<?php
// Kiểm tra nếu biến $result_of_store_product đã tồn tại
if (isset($result_of_store_product)) {
    // Hiển thị giá trị của $result_of_store_product (debugging hoặc thông báo tạm thời)
    echo $result_of_store_product;

    // Khởi tạo biến $message để chứa thông báo
    $message = "";

    // Kiểm tra kết quả của $result_of_store_product và gán thông báo tương ứng
    if ($result_of_store_product == true) {
        $message = "Thêm mới sản phẩm thành công!";
    } else if ($result_of_store_product == false) {
        $message = "Thêm mới sản phẩm không thành công!";
    }
}
?>

<div>
    <!-- Tiêu đề trang -->
    <h2>Thêm mới sản phẩm</h2>
    <div>
        <!-- Nút quay lại danh sách sản phẩm -->
        <a class="btn btn-secondary" href="?act=list_products">
            <i class="fas fa-arrow-left me-1"></i>Quay lại
        </a>
    </div>

    <!-- Form thêm mới sản phẩm -->
    <form class="mt-4" action="?act=store_product" method="post" enctype="multipart/form-data" id="form_create_product">
        <?php
        // Hiển thị thông báo kết quả (nếu có)
        if (isset($message) && $message != "") {
            echo '<div class="mb-4 text-center">
                    <span class="">' . $message . '</span>
                  </div>';
        }
        ?>

        <!-- Input: Tên sản phẩm -->
        <div class="d-flex flex-column mb-2">
            <label for="product_name">Tên sản phẩm</label>
            <input type="text" id="product_name" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
        </div>

        <!-- Input: Ảnh sản phẩm -->
        <div class="d-flex flex-column mb-2">
            <label for="product_image">Ảnh sản phẩm</label>
            <input type="file" id="product_image" name="image" class="form-control" accept="image/*">
        </div>

        <!-- Input: Số lượng sản phẩm -->
        <div class="d-flex flex-column mb-2">
            <label for="product_quantity">Số lượng</label>
            <input type="number" id="product_quantity" name="quantity" class="form-control" placeholder="Nhập số lượng sản phẩm">
        </div>

        <!-- Input: Giá thông thường -->
        <div class="d-flex flex-column mb-2">
            <label for="product_regular_price">Giá thông thường</label>
            <input type="number" id="product_regular_price" name="regular_price" class="form-control" placeholder="Nhập giá thông thường sản phẩm">
        </div>

        <!-- Input: Giá giảm -->
        <div class="d-flex flex-column mb-2">
            <label for="product_sale_price">Giá giảm</label>
            <input type="number" id="product_sale_price" name="sale_price" class="form-control" placeholder="Nhập giá giảm sản phẩm">
        </div>

        <!-- Nút Thêm mới sản phẩm -->
        <div class="d-flex flex-column mb-2">
            <button class="btn btn-success" id="btn_store" name="store" type="button">
                Thêm mới
            </button>
        </div>
    </form>
</div>
