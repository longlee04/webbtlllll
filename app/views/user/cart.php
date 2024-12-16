<?php
// Bắt đầu session để quản lý giỏ hàng
session_start();

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) { #lấy được từ form khi người dùng đăng nhập 
    echo "<script>alert('bạn chưa đăng nhập , vui lòng đăng nhập để mua hàng !'); window.location.href='home.php';</script>";
    exit();
}
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
    $result = $conn->query($sql); // Thực thi câu lệnh SQL trên cơ sở dữ liệu được kết nối bởi đối tượng $conn và result sẽ lưu kết quả sau khi truy vấn 

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

// Xử lý thanh toán giỏ hàng (checkout)
if (isset($_POST['checkout'])) {
    $address = trim($_POST['address']); // Lấy địa chỉ nhận hàng từ form
    $phone = trim($_POST['phone']); // Lấy số điện thoại từ form
    $total_price = trim($_POST['total_price']);// Lấy tổng số tiền từ form
    $subtotal = trim($_POST['subtotal']);// lấy tiền sản phẩm ra từ form 

    // Kiểm tra nếu người dùng nhập đầy đủ thông tin
    if (!empty($address) && !empty($phone)) {
        
        try {
            
            // Lưu thông tin đơn hàng vào bảng orders
            $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, address, phone) VALUES (?, ?, ?, ?)");#chuẩn bị câu lệnh truy vấn sql với các tham số thay thế ? 
            $stmt->bind_param("idss", $_SESSION['user_id'], $total_price, $address, $phone); #dùng để ràng buộc thay thế các câu lệnh trong dấu ? trong lệnh sql đã chuẩn bị 
            $stmt->execute(); #thực thi câu lệnh sql với các tham số thay thế
            $order_id = $stmt->insert_id; // Lấy ID của đơn hàng vừa tạo (insert_id là một thuộc tính để truy xuất id của bản ghi mới được thêm vào )

            // Lưu chi tiết đơn hàng vào bảng order_details
            foreach ($_SESSION['cart'] as $product_id => $item) {

                $stmt = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)"); #chuẩn bị câu lệnh truy vấn sql với các tham số thay thế ? 
                $stmt->bind_param("iiidd", $order_id, $product_id, $item['quantity'], $item['price'], $subtotal); #dùng để ràng buộc thay thế các câu lệnh trong dấu ? trong lệnh sql đã chuẩn bị 
                $stmt->execute(); #thực thi câu lệnh sql với các tham số thay thế
            }

            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);

            // Hiển thị thông báo và chuyển hướng về trang chủ
            echo "<script>alert('Bạn đã đặt hàng thành công!'); window.location.href='home.php';</script>";
            exit();
        } catch (Exception $e) {
            echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại!');</script>";
        }
    } else {
        // Thông báo nếu thông tin không đầy đủ
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
    <link rel="stylesheet" href="../../../public/css/user/cart.css"> <!-- Kết nối file CSS -->
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
                        foreach ($_SESSION['cart'] as $id => $item): //item là giá trị sản phẩm tương ứng với khóa 
                            $subtotal = $item['price'] * $item['quantity']; // Tính tổng tiền từng sản phẩm
                            $total_price += $subtotal; // Cộng dồn vào tổng tiền
                        ?>
                            <tr>
                                <!--hiển thị ảnh  -->    
                                <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"></td>
                                 <!--hiển thị tên   -->  
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                 <!--hiển thị giá   -->  
                                <td><?php echo number_format($item['price'], 0, ','); ?> VNĐ</td>
                                <td>
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1"> <!-- quantity sẽ gửi đi số lượng cần cập nhật  -->
                                    <input type="hidden" name="product_id" value="<?php echo $id; ?>"> <!-- trường hidden sẽ gửi đi id sản phẩm cần xóa -->
                                    <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                                    <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
                                </td>
                                <!--hiển thị tổng giá tiền   --> 
                                <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                                <td>
                                    <button type="submit" name="update_cart" class="btn">Cập nhật</button> <!-- khi người dùng ấn vào nút cập nhật nó gửi lại form qua phương thức post -->
                                    <button type="submit" name="remove_item" class="btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot><!--thẻ này thường dùng để nhóm các nội dung chân bảng -->
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
