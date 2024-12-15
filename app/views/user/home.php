<?php
session_start();
include "../../model/pdo.php";
$notification = "";
if (isset($_POST['confirm_password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // $sql = "SELECT * FROM `users` WHERE `username`=?";
  // $check = pdo_query_one($sql, [$username]);
  // if ($check) {
  // }

  $sql = "INSERT INTO `users`(`username`,`password`,`role`) VALUES (?,?,?)";
  pdo_execute($sql, [$username, $password, 'user']);
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
} else if (isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM `users` WHERE `username`=?";
  $check = pdo_query_one($sql, [$username]);
  if ($check) {
    if ($check['password'] == $password) {
      $_SESSION['user_id'] = $check['id'];
      $_SESSION['username'] = $check['username'];
      $_SESSION['role'] = $check['role'];
      if ($check['role'] == "user") {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
      } else {
        header("Location: ../admin/admin_index.php");
        exit();
      }
    } else {
      $notification = "Mật khẩu không chính xác!";
    }
  } else {
    $notification = "Tài khoản không tồn tại";
  }
}
if (isset($_SESSION['user_id'])) {
  $notification = "Đăng nhập thành công!";
}
 

###cart###

// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_btl_ptud_web"; // Thay thế với tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname); #kết nối CSDL với đối tượng $conn để truy vấn  

// Kiểm tra kết nối
if ($conn->connect_error) { #connect_error thuộc tính của đối tượng $conn xem và biểu thức kiểm tra xem thuộc tính có tồn tại hay không 
  die("Connection failed: " . $conn->connect_error); #thông báo là kết nối thất bại  
}

// Truy vấn dữ liệu sản phẩm
$sql = "SELECT id, name, image,quantity, regular_price FROM products"; # $sql là một chuỗi chứa câu lệnh truy vấn để lấy dữ liệu từ bảng products 
$result = $conn->query($sql); #phương thức query của đối tượng $conn dùng để gửi câu truy vấn sql đến csdl và lưu kết quả trả về từ truy vấn bằng $result

// Kiểm tra lỗi trong truy vấn SQL
if (!$result) { #kiểm tra xem result có false hay không 
    die("Query failed: " . $conn->error); #Nếu truy vấn thất bại gửi thông báo 
}


###cart###
?>






<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bán Hàng</title>
  <link rel="stylesheet" href="../../../public/css/user/main.css" />
  <link rel="stylesheet" href="../../../public/css/user/reset.css" />

  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- CSS of form login and register -->
  <link rel="stylesheet" href="../../../public/css/form_login_register.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" />
  <!-- Thư viện icon -->
  <script src="https://kit.fontawesome.com/26096abf41.js" crossorigin="anonymous"></script>
</head>

<body class="position-relative">

  <?php
  echo  "<h1 align='center' style='color:red;'>" . $notification . "</h1>";
  ?>

  <div class="container">
    <div class="head">
      <div class="width-section">
        <div class="header">
          <div class="logo">
            <img src="../../../public/img/logo/logo.webp" alt="" />
          </div>
          <div class="btn-header">
            <div class="input-search">
              <input type="text" name="" id="" placeholder="  Bạn muốn tìm gì ?" />
              <i class="bx bx-search"></i>
              <!-- <div class="search">
                  <i class="bx bx-search"></i>
                </div> -->
            </div>
            <div class="btn-info">
              <ul>
                <li class="hotline">
                  <i class='bx bxs-phone-call bx-tada'></i></i>
                  <p>Hotline: 03555 39891</p>
                </li>
                <?php
                if (isset($_SESSION['user_id'])) {
                  echo '<li class="hello_username">
                  <p>Hello: ' . $_SESSION["username"] . '</p>
                </li>';
                } else {
                  echo '<li id="user" class="user"><img src="../../../public/img/icon header/user.png" alt="">
                  </li>';
                }
                ?>

                <li><img src="../../../public/img/icon header/map.png" alt=""><span class="count">8</span></li>
                <li><img src="../../../public/img/icon header/heart.png" alt=""><span class="count">0</span></li>
                <li><img src="../../../public/img/icon header/shopping.png" alt=""><span class="count">0</span></i></li>
                <?php
                if (isset($_SESSION['user_id'])) {
                  echo '<li class="logout">
                    <a href="../../../index.php?act=log_out">Đăng xuất</a>
                  </li>';
                }
                ?>

              </ul>
            </div>
          </div>
        </div>
        <div class="nav">
          <ul>
            <li><a href="">Trang chủ</a></li>
            <li><a href="">Sản phẩm</a></li>
            <li><a href="gt.php">Giới thiệu</a></li>  
          </ul>
        </div>
      </div>
      <div class="box-real"><img src="../../../public/img/real/1.webp " alt="" class="real"></div>
    </div>

    <!-- content -->
    <div class="content">
      <div class="width-section">
        <div class="box-content">
          <div class="title-index">
            <div class="title-name">
              <a href="">Danh mục nổi bật</a> <img src="../../../public/img/title-name/leaf.webp" alt="" class="leaf">
            </div>
           
          </div>
          <div class="swiper-wrapper">
            <div class="list-food">
              <div class="food">
                <img src="../../../public/img/food-list/food1.webp" alt="">
                <p>Rau củ</p>
              </div>
              <div class="food">
                <img src="../../../public/img/food-list/food2.webp" alt="">
                <p>Trái cây</p>
              </div>
              <div class="food">
                <img src="../../../public/img/food-list/food3.webp" alt="">
                <p>Đồ khô</p>
              </div>
              <div class="food">
                <img src="../../../public/img/food-list/food4.webp" alt="">
                <p>Nước ép</p>
              </div>
              <div class="food">
                <img src="../../../public/img/food-list/food5.webp" alt="">
                <p>Salad</p>
              </div>
              <div class="food">
                <img src="../../../public/img/food-list/food6.webp" alt="">
                <p>Thực phẩm khác</p>
              </div>
            </div>
          </div>




          

          <div class="title-index">
  <div class="title-name">
    <a href="">Danh mục nổi bật</a> <img src="../../../public/img/title-name/leaf.webp" alt="" class="leaf">
    <span class="font16-block">Chương trình khuyến mãi hấp dẫn đang chờ đợi bạn</span>
    <strong style="font-size: 14px;">Chương trình đã kết thúc, hẹn gặp lại trong thời gian sớm nhất!</strong>
  </div>
  
</div>


<!-- hiển thị sanr phẩm trong sql -->
<div class="swiper-wrapper">
  <div class="list-food">
    <?php if ($result->num_rows > 0): ?> <!-- thuộc tính run_rows của đối tượng $result trả về số lượng hàng dòng mà truy vấn sql lấy được và kiếm tra nếu > 0 thì thực thi khối lệnhh bên trong  -->
      <?php while ($product = $result->fetch_assoc()): ?> <!-- $result->fetch_assoc() trả về một dòng dữ liệu từ $result dưới dạng một mảng liên kết và khi không còn dữ liệu nào nó trả về false và dừng vòng lặp   -->
        <div class="food sale">
          <!-- Hình ảnh sản phẩm -->
          <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">

          <!-- Tên sản phẩm -->
          <strong><?php echo htmlspecialchars($product['name']); ?></strong>

          <!-- Giá sản phẩm -->
          <div class="price-box">
          <?php echo number_format($product['regular_price'], 0, ','); ?> VNĐ <!-- hiển thị số ra màn hình và ngăn cách bởi dấu phẩy -->
          </div>

          <!-- nút đến trang giỏ hàng -->
          <div class="shopping">
            <a href="cart.php?id=<?php echo $product['id']; ?>">
              <i class='bx bxs-shopping-bag'></i>
            </a>
          </div>
        </div>
      <?php endwhile; ?> <!--thưc hiện cho đến khi trả về giá trị false--> 
    <?php else: ?>
      <p>Không có sản phẩm nào được tìm thấy.</p>
    <?php endif; ?> <!--kết thức câu lệnh if--> 
  </div>

  
</div>

<?php
// Đóng kết nối
$conn->close(); # đóng kết nối 
?>

          <!-- ok2 -->
          <div class="title-index">
            <div class="title-name">
              <a href="">Dịch vụ đặc biệt của chúng tôi</a> <img src="../../../public/img/title-name/leaf.webp" alt=""
                class="leaf">
              <span class="font16-block">Những dịch vụ tốt nhất dành cho khách hàng của chúng tôi</span>

            </div>
            
          </div>
          <div class="swiper-wrapper">
            <div class="list-food">
              <div class="food service">
                <img src="../../../public/img/service/1.webp" alt="">
                <h3>Rau hữu cơ tươi</h3>
                <p class="text">Được trồng theo phương pháp hiện đại nhất,<br> đạt tiêu chuẩn quốc tế, vô cùng an toàn
                  khi sử dụng.</p>
                
              </div>
              <div class="food service">
                <img src="../../../public/img/service/2.webp" alt="">
                <h3>Giao hàng nhanh chóng</h3>
                <p class="text">Giao hàng trong thời gian nhanh nhất để đảm bảo chất lượng tốt nhất cho những sản phẩm
                  bạn đã đặt.</p>
                
              </div>
              <div class="food service">
                <img src="../../../public/img/service/3.webp" alt="">
                <h3>Thanh toán dễ dàng</h3>
                <p class="text">Nhiều hình thức thanh toán làm cho việc đặt hàng của bạn và shop trở nên dễ dàng và tiện
                  lợi hơn rất nhiều.</p>
               
              </div>

            </div>
          </div>


          <!-- ok3 -->
          <div class="vegetable">
            <div class="img-title-vegetable">
              <div class="box-img-title-vegetable">
                <img src="../../../public/img/title left/image_product1.webp" alt="">
              </div>
            </div>
            <div class="box-body">
              <div class="title-index sub">
                <div class="title-name">
                  <a href="">Rau củ</a> <img src="../../../public/img/title-name/leaf.webp" alt="" class="leaf">
                  <span class="font16-block">Chương trình khuyến mãi hấp dẫn đang chờ đợi bạn</span>
                  <strong style="font-size: 14px;">Chương trình đã kết thúc, hẹn gặp lại trong thời gian sớm
                    nhất!</strong>
                </div>
                
              </div>
              <div class="swiper-wrapper">
                <div class="list-food">
                  <div class="food sale vegetable-sub">
                    <img src="../../../public/img/vegetable/1.webp" alt="">
                    <strong>Rau dền 4KFarm 500gr</strong>
                    <div class="price-box price-box-sub">
                      12000₫ <span>13500₫</span>
                    </div>

                    <div class="smart">Giảm 20%</div>
                    <div class="shopping">
                      <i class='bx bxs-shopping-bag'></i>
                      <i class='bx bx-search'></i>
                      <i class='bx bxs-heart'></i>
                    </div>
                  </div>
                  <div class="food sale vegetable-sub">
                    <img src="../../../public/img/vegetable/2.webp" alt="">
                    <strong>Rau muống 4KFarm</strong>
                    <div class="price-box price-box-sub">
                      16.000₫ <span>20.000₫</span>
                    </div>

                    <div class="smart">Giảm 80%</div>
                    <div class="shopping">
                      <i class='bx bxs-shopping-bag'></i>
                      <i class='bx bx-search'></i>
                      <i class='bx bxs-heart'></i>
                    </div>
                  </div>
                  <div class="food sale vegetable-sub">
                    <img src="../../../public/img/vegetable/3.webp" alt="">
                    <strong>Cải thìa 4KFarm</strong>
                    <div class="price-box price-box-sub">
                      4.500₫ <span>9.000₫</span>
                    </div>

                    <div class="smart">Giảm 99%</div>
                    <div class="shopping">
                      <i class='bx bxs-shopping-bag'></i>
                      <i class='bx bx-search'></i>
                      <i class='bx bxs-heart'></i>
                    </div>
                  </div>

                  <div class="food sale vegetable-sub">
                    <img src="../../../public/img/vegetable/3.webp" alt="">
                    <strong>Cải ngọt 4KFarm</strong>
                    <div class="price-box price-box-sub">
                      21.000₫ <span>27.000₫</span>
                    </div>

                    <div class="smart">Giảm 70%</div>
                    <div class="shopping">
                      <i class='bx bxs-shopping-bag'></i>
                      <i class='bx bx-search'></i>
                      <i class='bx bxs-heart'></i>
                    </div>
                  </div>

                </div>
                
              </div>
            </div>
          </div>




          <div class="feeback-vegetable">
            <div class="img-title-vegetable">
              <div class="box-img-title-vegetable">
                <img src="../../../public/img/feedback/1.webp" alt="">
              </div>
            </div>
            <div class="img-title-vegetable">
              <div class="box-img-title-vegetable">
                <img src="../../../public/img/feedback/2.webp" alt="">
              </div>
            </div>
            <div class="img-title-vegetable">
              <div class="box-img-title-vegetable">
                <img src="../../../public/img/feedback/3.webp" alt="">
              </div>
            </div>
          </div>
        </div>



        <div class="vegetable">
          <div class="img-title-vegetable">
            <div class="box-img-title-vegetable">
              <img src="../../../public/img/frui/title left.webp" alt="">
            </div>
          </div>
          <div class="box-body">
            <div class="title-index sub">
              <div class="title-name">
                <a href="">Trái cây</a> <img src="../../../public/img/title-name/leaf.webp" alt="" class="leaf">
                <span class="font16-block">Chương trình khuyến mãi hấp dẫn đang chờ đợi bạn</span>
                <strong style="font-size: 14px;">Chương trình đã kết thúc, hẹn gặp lại trong thời gian sớm
                  nhất!</strong>
              </div>
              
            </div>
            <div class="swiper-wrapper">
              <div class="list-food">
                <div class="food sale vegetable-sub">
                  <img src="../../../public/img/frui/1.webp" alt="">
                  <strong>Bưởi da xanh trái 1.7kg trở lên</strong>
                  <div class="price-box price-box-sub">
                    90000₫ <span>13500₫</span>
                  </div>

                  <div class="smart">Giảm 200%</div>
                  <div class="shopping">
                    <i class='bx bxs-shopping-bag'></i>
                    <i class='bx bx-search'></i>
                    <i class='bx bxs-heart'></i>
                  </div>

                </div>
                <div class="food sale vegetable-sub">
                  <img src="../../../public/img/frui/2.webp" alt="">
                  <strong>Bưởi da xanh trái 1.7kg trở lên</strong>
                  <div class="price-box price-box-sub">
                    500.000₫ <span>20.000₫</span>
                  </div>

                  <div class="smart">Giảm 300%</div>
                  <div class="shopping">
                    <i class='bx bxs-shopping-bag'></i>
                    <i class='bx bx-search'></i>
                    <i class='bx bxs-heart'></i>
                  </div>
                </div>
                <div class="food sale vegetable-sub">
                  <img src="../../../public/img/frui/3.webp" alt="">
                  <strong>Xoài Đài Loan trái 600g trở lên</strong>
                  <div class="price-box price-box-sub">
                    4.500₫ <span>9.000₫</span>
                  </div>

                  <div class="smart">Giảm 99%</div>
                  <div class="shopping">
                    <i class='bx bxs-shopping-bag'></i>
                    <i class='bx bx-search'></i>
                    <i class='bx bxs-heart'></i>
                  </div>
                </div>

                <div class="food sale vegetable-sub">
                  <img src="../../../public/img/frui/4.webp" alt="">
                  <strong>Chuối cau nải 800g trở lên ăn luôn</strong>
                  <div class="price-box price-box-sub">
                    21.000₫ <span>27.000₫</span>
                  </div>

                  <div class="smart">Giảm 70%</div>
                  <div class="shopping">
                    <i class='bx bxs-shopping-bag'></i>
                    <i class='bx bx-search'></i>
                    <i class='bx bxs-heart'></i>
                  </div>
                </div>

              </div>
              
            </div>
          </div>
        </div>



        <div class="slide-vegetable">
          <div class="img-title-vegetable">
            <div class="box-img-title-vegetable">
              <img src="../../../public/img/slide-img/banner.webp" alt="">
            </div>
          </div>
        </div>

        <div class="vegetable">
          <div class="img-title-vegetable">
            <div class="box-img-title-vegetable">
              <img src="../../../public/img/dokho/title.webp" alt="">
            </div>
          </div>
          <div class="box-body">
            <div class="title-index sub">
              <div class="title-name">
                <a href="">Đồ khô</a> <img src="../../../public/img/title-name/leaf.webp" alt="" class="leaf">
                <span class="font16-block">Chương trình khuyến mãi hấp dẫn đang chờ đợi bạn</span>
                <strong style="font-size: 14px;">Chương trình đã kết thúc, hẹn gặp lại trong thời gian sớm
                  nhất!</strong>
              </div>
              
            </div>
            <div class="swiper-wrapper">
              <div class="list-food">
                <div class="food sale vegetable-sub">
                  <img src="../../../public/img/dokho/1.webp" alt="">
                  <strong>Lạc cúc đỏ Lý Tưởng</strong>
                  <div class="price-box price-box-sub">
                    90000₫ <span>13500₫</span>
                  </div>

                  <div class="smart">Giảm 200%</div>
                  <div class="shopping">
                    <i class='bx bxs-shopping-bag'></i>
                    <i class='bx bx-search'></i>
                    <i class='bx bxs-heart'></i>
                  </div>
                </div>
                <div class="food sale vegetable-sub">
                  <img src="../../../public/img/dokho/2.webp" alt="">
                  <strong>Nấm hương khô Việt San</strong>
                  <div class="price-box price-box-sub">
                    500.000₫ <span>20.000₫</span>
                  </div>

                  <div class="smart">Giảm 300%</div>
                  <div class="shopping">
                    <i class='bx bxs-shopping-bag'></i>
                    <i class='bx bx-search'></i>
                    <i class='bx bxs-heart'></i>
                  </div>
                </div>
                <div class="food sale vegetable-sub">
                  <img src="../../../public/img/dokho/3.webp" alt="">
                  <strong>Đậu phộng việt san</strong>
                  <div class="price-box price-box-sub">
                    4.500₫ <span>9.000₫</span>
                  </div>

                  <div class="smart">Giảm 99%</div>
                  <div class="shopping">
                    <i class='bx bxs-shopping-bag'></i>
                    <i class='bx bx-search'></i>
                    <i class='bx bxs-heart'></i>
                  </div>
                </div>

                <div class="food sale vegetable-sub">
                  <img src="../../../public/img/dokho/4.webp" alt="">
                  <strong>Bột mỳ đa dụng</strong>
                  <div class="price-box price-box-sub">
                    21.000₫ <span>27.000₫</span>
                  </div>

                  <div class="smart">Giảm 70%</div>
                  <div class="shopping">
                    <i class='bx bxs-shopping-bag'></i>
                    <i class='bx bx-search'></i>
                    <i class='bx bxs-heart'></i>
                  </div>
                </div>

              </div>
             
            </div>
          </div>
        </div>


        <div class="slide-vegetable">
          <div class="img-title-vegetable">
            <div class="box-img-title-vegetable">
              <img src="../../../public/img/raucusach.webp" alt="">
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- footer -->
    <div class="footer">
      <div class="width-section">
        <div class="pay">
          <div class="logo">
            <img src="../../../public/img/logo/logo.webp" alt="">
          </div>
          <p>Chúng tôi hi vọng tất cả người tiêu dùng Việt nam sẽ được sử dụng những thụ phẩm rau củ quả tươi ngon, bổ
            dưỡng và an toàn nhất tại cửa hàng cung cấp thực phẩm rau củ sạch Dola <br>Organic.</p>
          <br>
          <h4 class="title-menu">Hình thức thanh toán</h4>
          <img src="../../../public/img/pay/money.webp" alt="" class="img-pay">
          <img src="../../../public/img/pay/bankking.webp" alt="" class="img-pay">
          <img src="../../../public/img/pay/visa.webp" alt="" class="img-pay">

        </div>


        <div class="policy">
          <h4 class="title-menu">Chính sách</h4>
          <p class="font16">Chính sách thành viên</p>
          <p class="font16">Chính sách thanh toán</p>
          <p class="font16">Hướng dẫn mua hàng</p>
          <p class="font16">Bảo mật thông tin cá nhân</p>
          <p class="font16">Quà tặng tri ân</p>
        </div>



        <div class="info">
          <h4 class="title-menu">Thông tin chung</h4>
          <p class="font16"><b>Địa chỉ:</b> 70 Lữ Gia, Phường 15, Quận 11, <br>TP.HCM</p>
          <p class="font16"><b>Điện thoại:</b> 03555 39891</p>
          <p class="font16"><b>Email</b>: support@.vn</p>
          <h4 class="title-menu">Liên kết sàn</h4>
          <img src="../../../public/img/mxh/zalo.webp" alt="" class="img-info">
          <img src="../../../public/img/mxh/facebook.webp" alt="" class="img-info">
          <img src="../../../public/img/mxh/youtube.webp" alt="" class="img-info">
          <img src="../../../public/img/mxh/google.webp" alt="" class="img-info">
        </div>

        <div class="intagram">
          <h4 class="title-menu">Instagram</h4>
        </div>
      </div>
      <div class="copyright">
        <p class="font16">Bản quyền thuộc về <b>Nhóm 12</b>. Cung cấp bởi Sapo</p>
      </div>

    </div>
  </div>

<!-- Container chính của modal đăng nhập và đăng ký -->
<div class="position-fixed div_of_login_register hidden" id="div_of_login_register">
  <!-- Nội dung của modal đăng nhập và đăng ký -->
  <div class="body_login_register">
    
    <!-- Container chứa toàn bộ form đăng nhập và đăng ký -->
    <div class="container_of_login_register position-relative" id="container">

      <!-- Nút đóng modal -->
      <div class="position-absolute" id="div_of_btn_close">
        <i class="fas fa-xmark fa-2xl" id="btn-close"></i>
      </div>

      <!-- Phần form đăng ký -->
      <div class="form-container sign-up-container">
        <!-- Form đăng ký -->
        <form action="#" method="POST" id="form_register">
          <h1>Tạo tài khoản</h1>

          <!-- Các nút đăng nhập qua mạng xã hội -->
          <div class="social-container">
            <a href="#" class="social a_of_login_register"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social a_of_login_register"><i class="fab fa-google-plus-g"></i></a>
            <a href="#" class="social a_of_login_register"><i class="fab fa-linkedin-in"></i></a>
          </div>

          <!-- Lựa chọn đăng ký qua email -->
          <span class="span_of_login_register">hoặc sử dụng email để đăng ký</span>

          <!-- Các trường nhập tên người dùng, mật khẩu và xác nhận mật khẩu -->
          <input class="input_of_login_register" id="register_username" type="text" placeholder="Tên người dùng" name="username" />
          <input class="input_of_login_register" id="register_password" type="password" placeholder="Mật khẩu" name="password" />
          <input class="input_of_login_register" id="register_confirm_password" type="password" placeholder="Xác nhận mật khẩu" name="confirm_password" />

          <!-- Nút gửi form đăng ký -->
          <button id="sign_up" name="register" type="button">Đăng ký</button>
        </form>
      </div>

      <!-- Phần form đăng nhập -->
      <div class="form-container sign-in-container">
        <!-- Form đăng nhập -->
        <form action="#" method="POST" id="form_login">
          <h1>Đăng nhập</h1>

          <!-- Các nút đăng nhập qua mạng xã hội -->
          <div class="social-container">
            <a href="#" class="social a_of_login_register"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social a_of_login_register"><i class="fab fa-google-plus-g"></i></a>
            <a href="#" class="social a_of_login_register"><i class="fab fa-linkedin-in"></i></a>
          </div>

          <!-- Lựa chọn đăng nhập qua tài khoản -->
          <span class="span_of_login_register">hoặc sử dụng tài khoản của bạn</span>

          <!-- Các trường nhập tên người dùng và mật khẩu -->
          <input class="input_of_login_register" id="login_username" type="text" placeholder="Tên người dùng" name="username" />
          <input class="input_of_login_register" id="login_password" type="password" placeholder="Mật khẩu" name="password" autocomplete="false" />

          <!-- Liên kết quên mật khẩu -->
          <a class="a_of_login_register" href="#">Quên mật khẩu?</a>

          <!-- Nút gửi form đăng nhập -->
          <button type="button" value="Login" id="login" name="login">Đăng nhập</button>
        </form>
      </div>

      <!-- Overlay để chuyển đổi giữa các form đăng nhập và đăng ký -->
      <div class="overlay-container">
        <div class="overlay">
          <!-- Panel cho phần đăng nhập -->
          <div class="overlay-panel overlay-left">
            <h1>Chào mừng trở lại!</h1>
            <p class="p_of_login_register">
              Để kết nối với chúng tôi, vui lòng đăng nhập bằng thông tin cá nhân của bạn
            </p>
            <button class="ghost" id="signIn">Đăng nhập</button>
          </div>

          <!-- Panel cho phần đăng ký -->
          <div class="overlay-panel overlay-right">
            <h1>Chào bạn, bạn là người bạn của chúng tôi!</h1>
            <p class="p_of_login_register">Nhập thông tin cá nhân và bắt đầu hành trình cùng chúng tôi</p>
            <button class="ghost" id="signUp">Đăng ký</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tệp JavaScript để xử lý các hành động đăng nhập và đăng ký -->
<script src="../../../public/js/user/main.js"></script>
</body>
</html>
