<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/admin/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/26096abf41.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="box_admin">
        <aside class="aside">
            <h1 style="font-size: 20px;margin: 10px 0;color: red;">ADMIN</h1>
            <div class="aside_menu mt-2">
                <ul class="aside_menu_list ms-3">
                    <li class="aside_menu_list_item">
                        <a class="aside_menu_list_item_link" href="">Trang chủ</a>
                    </li>
                    <li class="aside_menu_list_item" tabindex="0">
                        <a class="aside_menu_list_item_link">Sản phẩm</a>
                        <ul class="aside_menu_list_item_hidden">
                            <li class="aside_menu_list_item_hidden_item">
                                <a class="aside_menu_list_item_hidden_item_link" href="?act=list_products">- Danh sách sản phẩm</a>
                            </li>
                            <li class="aside_menu_list_item_hidden_item">
                                <a class="aside_menu_list_item_hidden_item_link" href="">- Thêm sản phẩm</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside_menu_list_item">
                        <a class="aside_menu_list_item_link" href="">Danh mục</a>
                    </li>
                    <li class="aside_menu_list_item">
                        <a class="aside_menu_list_item_link" href="">Tính năng</a>
                    </li>
                    <li class="aside_menu_list_item">
                        <a class="aside_menu_list_item_link" href="">Đơn hàng</a>
                    </li>
                </ul>
            </div>
            <div>
            </div>
            <div class="logout d-flex justify-content-center w-100">
                <a class="btn btn-danger" href="admin_index.php?act=log_out">Đăng xuất</a>
            </div>
        </aside>
        <div class="d-flex justify-content-end w-100">
            <div class="content_admin w-75 me-5 p-3">