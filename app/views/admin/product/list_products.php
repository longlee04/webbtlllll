<?php
// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$list_products = get_list_products() ?: null;

// Khởi tạo thông báo để hiển thị trạng thái thêm/xóa sản phẩm
$message = "";
if (isset($_GET['store'])) {
    $message = $_GET['store'] == true 
        ? "Thêm mới sản phẩm thành công!" 
        : "Thêm mới sản phẩm không thành công!";
}

if (isset($_GET['destroy'])) {
    $message = $_GET['destroy'] == true 
        ? "Xóa sản phẩm thành công!" 
        : "Xóa sản phẩm không thành công!";
}
?>
<div>
    <!-- Tiêu đề danh sách sản phẩm -->
    <h2>Danh sách sản phẩm</h2>

    <!-- Nút thêm mới sản phẩm -->
    <div class="d-flex justify-content-end">
        <a class="btn btn-success" href="?act=create_product">
            <i class="fas fa-plus me-1"></i>Thêm mới
        </a>
    </div>

    <!-- Hiển thị thông báo trạng thái nếu có -->
    <?php if (!empty($message)): ?>
        <div class="mb-4 text-center">
            <span><?php echo htmlspecialchars($message); ?></span>
        </div>
    <?php endif; ?>

    <!-- Bảng danh sách sản phẩm -->
    <table class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Image</td>
                <td>Quantity</td>
                <td>Regular price</td>
                <td>Sale price</td>
                <td>Created at</td>
                <td>Updated at</td>
                <td>Control</td>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Image</td>
                <td>Quantity</td>
                <td>Regular price</td>
                <td>Sale price</td>
                <td>Created at</td>
                <td>Updated at</td>
                <td>Control</td>
            </tr>
        </tfoot>
        <tbody>
            <?php if ($list_products != null): ?>
                <!-- Lặp qua danh sách sản phẩm -->
                <?php foreach ($list_products as $product_item): ?>
                    <tr>
                        <!-- ID sản phẩm -->
                        <td><?php echo htmlspecialchars($product_item['id']); ?></td>

                        <!-- Tên sản phẩm -->
                        <td><?php echo htmlspecialchars($product_item['name']); ?></td>

                        <!-- Ảnh sản phẩm -->
                        <td>
                            <?php if ($product_item['image']): ?>
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="../../../public/uploads/products/images/<?php echo htmlspecialchars($product_item['image']); ?>" 
                                         alt="Product Image" 
                                         width="100" 
                                         height="100">
                                </div>
                            <?php else: ?>
                                Chưa có ảnh
                            <?php endif; ?>
                        </td>

                        <!-- Số lượng sản phẩm -->
                        <td><?php echo htmlspecialchars($product_item['quantity']); ?></td>

                        <!-- Giá gốc -->
                        <td><?php echo htmlspecialchars($product_item['regular_price']); ?></td>

                        <!-- Giá giảm -->
                        <td><?php echo htmlspecialchars($product_item['sale_price']); ?></td>

                        <!-- Ngày tạo -->
                        <td><?php echo htmlspecialchars($product_item['created_at']); ?></td>

                        <!-- Ngày cập nhật -->
                        <td>
                            <?php echo $product_item['updated_at'] 
                                ? htmlspecialchars($product_item['updated_at']) 
                                : "Chưa cập nhật"; ?>
                        </td>

                        <!-- Nút xóa sản phẩm -->
                        <td>
                            <a href="?act=destroy_product&product_id=<?php echo htmlspecialchars($product_item['id']); ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Hiển thị nếu không có sản phẩm -->
                <tr>
                    <td colspan="9" align="center">
                        <span>Không có sản phẩm nào!</span>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
