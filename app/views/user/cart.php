<?php
// Bắt đầu session để quản lý giỏ hàng
session_start();

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_btl_ptud_web"; // Tên cơ sở dữ liệu

$conn = new mysqli($servername, $username, $password, $dbname); // Tạo kết nối với cơ sở dữ liệu

// Kiểm tra nếu kết nối thất bại
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Thêm sản phẩm vào giỏ hàng khi người dùng bấm nút
if (isset($_GET['id'])) { 
    $product_id = intval($_GET['id']); // Lấy ID sản phẩm từ URL và ép kiểu về số nguyên

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT id, name, image, regular_price FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    // Nếu sản phẩm tồn tại trong cơ sở dữ liệu
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới vào session
        if (!isset($_SESSION['cart'][$product_id])) { 
            $_SESSION['cart'][$product_id] = [ 
                'name' => $product['name'],
                'price' => $product['regular_price'],
                'image' => $product['image'],
                'quantity' => 1 // Mặc định số lượng là 1
            ];
        } else { 
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng sản phẩm lên 1
            $_SESSION['cart'][$product_id]['quantity']++;
        }

        // Chuyển hướng về trang giỏ hàng
        header("Location: cart.php");
        exit();
    }
}

// Xóa sản phẩm khỏi giỏ hàng
if (isset($_POST['remove_item'])) {
    $product_id = intval($_POST['product_id']); // Lấy ID sản phẩm từ form
    unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm khỏi session
}

// Cập nhật số lượng sản phẩm trong giỏ hàng
if (isset($_POST['update_cart'])) {
    $product_id = intval($_POST['product_id']); // Lấy ID sản phẩm từ form
    $new_quantity = intval($_POST['quantity']); // Lấy số lượng mới từ form

    if ($new_quantity > 0) {
        $_SESSION['cart'][$product_id]['quantity'] = $new_quantity; // Cập nhật số lượng mới
    } else {
        unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm nếu số lượng = 0
    }
}

// Xử lý thanh toán giỏ hàng
if (isset($_POST['checkout'])) {
    $address = trim($_POST['address']); // Lấy địa chỉ nhận hàng từ form
    $phone = trim($_POST['phone']); // Lấy số điện thoại từ form

    // Kiểm tra nếu người dùng nhập đầy đủ thông tin
    if (!empty($address) && !empty($phone)) {
        // Có thể thêm chức năng lưu đơn hàng vào cơ sở dữ liệu tại đây nếu cần

        // Xóa giỏ hàng sau khi đặt hàng thành công
        unset($_SESSION['cart']);

        // Hiển thị thông báo đặt hàng thành công và chuyển hướng về trang chủ
        echo "<script>alert('Bạn đã đặt hàng thành công!'); window.location.href='home.php';</script>";
        exit();
    } else {
        // Hiển thị thông báo nếu thông tin không đầy đủ
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin địa chỉ và số điện thoại!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="../../../public/css/user/main.css"> <!-- Kết nối file CSS -->
    <style>
        /* Phong cách cơ bản cho giao diện */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f4f4f4;
        }
        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .btn {
            padding: 8px 15px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #a71d2a;
        }
        .btn-back {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            display: inline-block;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #218838;
        }
        .total-price {
            font-size: 1.2em;
            font-weight: bold;
            color: #28a745;
        }
        .checkout-form {
            margin-top: 20px;
            padding: 15px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .checkout-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .checkout-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .checkout-form button {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tiêu đề trang -->
        <h1>Giỏ hàng của bạn</h1>

        <!-- Kiểm tra nếu giỏ hàng không rỗng -->
        <?php if (!empty($_SESSION['cart'])): ?>
            <form method="POST" action="cart.php"> <!-- Gửi form qua phương thức POST để xử lý -->
                <table>
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_price = 0; // Biến lưu tổng tiền giỏ hàng
                        foreach ($_SESSION['cart'] as $id => $item): 
                            $subtotal = $item['price'] * $item['quantity']; // Tính tổng tiền từng sản phẩm
                            $total_price += $subtotal; // Cộng dồn vào tổng tiền
                        ?>
                            <tr>
                                <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"></td>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo number_format($item['price'], 0, ','); ?> VNĐ</td>
                                <td>
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                </td>
                                <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                                <td>
                                    <button type="submit" name="update_cart" class="btn">Cập nhật</button>
                                    <button type="submit" name="remove_item" class="btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Tổng cộng</th>
                            <th colspan="2" class="total-price"><?php echo number_format($total_price, 0, ',', '.'); ?> VNĐ</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="checkout-form">
                    <!-- Form nhập thông tin thanh toán -->
                    <label for="address">Địa chỉ nhận hàng</label>
                    <input type="text" id="address" name="address" >
                    
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" >

                    <button type="submit" name="checkout" class="btn">Mua Tất Cả</button>
                </div>
            </form>
        <?php else: ?>
            <p>Giỏ hàng trống.</p>
        <?php endif; ?>
        <a href="home.php" class="btn-back">Trở về trang chủ</a>
    </div>
</body>
</html>
