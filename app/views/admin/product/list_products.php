<?php
$list_products = get_list_products() ?: null;
$message = "";
if (isset($_GET['store'])) {
    if ($_GET['store'] == true) {
        $message = "Thêm mới sản phẩm thành công!";
    } else {
        $message = "Thêm mới sản phẩm không thành công!";
    }
}

if (isset($_GET['destroy'])) {
    if ($_GET['destroy'] == true) {
        $message = "Xóa sản phẩm thành công!";
    } else {
        $message = "Xóa sản phẩm không thành công!";
    }
}
?>
<div>
    <h2>Danh sách sản phẩm</h2>
    <div class="d-flex justify-content-end">
        <a class="btn btn-success" href="?act=create_product"><i class="fas fa-plus me-1"></i>Thêm mới</a>
    </div>
    <?php
    if (isset($message) && $message != "") {
        echo '<div class="mb-4 text-center">
            <span>' . $message . '</span>
        </div>';
    }
    ?>
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

            <?php if ($list_products != null) {
                foreach ($list_products as $product_item) {
                    echo '
                    <tr>
                        <td>' . $product_item['id'] . '</td>
                        <td>' . $product_item['name'] . '</td>
                        <td>';
                    if ($product_item['image']) {
                        echo    ' <div class="d-flex justify-content-center align-items-center">
                                    <img src="../../../public/uploads/products/images/' . $product_item['image'] . '" alt="" width="100" height="100">
                                </div>';
                    } else {
                        echo 'Chưa có ảnh';
                    }
                    echo '</td>
                        <td>' . $product_item['quantity'] . '</td>
                        <td>' . $product_item['regular_price'] . '</td>
                        <td>' . $product_item['sale_price'] . '</td>
                        <td>' . $product_item['created_at'] . '</td>
                        <td>';
                    if ($product_item['updated_at']) {
                        echo $product_item['updated_at'];
                    } else {
                        echo "Chưa cập nhật";
                    }
                    echo '</td>
                        <td>
                            <a href="?act=destroy_product&product_id=' . $product_item['id'] . '" class="btn btn-danger" onclick="return confirm(`Bạn có muốn xóa sản phẩm này không?`)">Xóa</a>
                        </td>
                    </tr>
                    ';
                }
            } else {
                echo '<tr>
                <td colspan="9" align="center">
                    <span>Không có sản phẩm nào!</span>
                </td>
            </tr>';
            } ?>

        </tbody>
    </table>
</div>