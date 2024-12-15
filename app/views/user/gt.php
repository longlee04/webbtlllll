<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Giới Thiệu </title>
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
            <li><a href="home.php">Trang chủ</a></li>
            <li><a href="">Sản phẩm</a></li>
            <li><a href="">Giới thiệu</a></li>
          </ul>
        </div>
        <div style="margin-top: 20px;">
            <h1 style="font-size:30px; text-align: center;"  >Chào mừng bạn đến với cửa hàng rau sạch!</h1></br>
            <p style="font-size:20px;">Chúng tôi tự hào là địa chỉ tin cậy chuyên cung cấp các sản phẩm rau củ quả đạt tiêu chuẩn sạch, hữu cơ và không hóa chất độc hại. Với sứ mệnh mang lại sức khỏe và sự an tâm cho mọi gia đình, chúng tôi cam kết:</p></br>
                <ul style="font-size:18px;">
                    <li>🌱<strong>Rau sạch 100% tự nhiên</strong>: Tất cả sản phẩm đều được canh tác theo quy trình chuẩn, không sử dụng thuốc trừ sâu hay phân bón hóa học.</li></br>
                    <li>🚜<strong>Nguồn gốc rõ ràng</strong>: Rau củ được thu hoạch trực tiếp từ các trang trại địa phương và kiểm định nghiêm ngặt trước khi đến tay bạn.</li></br>
                    <li>🛒<strong>Dịch vụ tiện lợi</strong>: Mua sắm dễ dàng với vài cú nhấp chuột, giao hàng tận nơi nhanh chóng và đảm bảo chất lượng.</li></br>
                    <li>💚<strong>Giá cả hợp lý</strong>: Mang đến các sản phẩm vừa túi tiền mà vẫn đảm bảo chất lượng tốt nhất.</li></br>
                </ul>
            <p style="font-size:20px;">Hãy để chúng tôi trở thành người bạn đồng hành cùng sức khỏe và môi trường sống xanh của bạn. Truy cập ngay [Tên trang web của bạn] để khám phá thế giới rau sạch và tận hưởng những ưu đãi đặc biệt hôm nay!</p>
        </div>    
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
        <p class="font16">Bản quyền thuộc về <b>Nhóm 12 </b>. Cung cấp bởi Sapo</p>
      </div>

    </div>
</div>
  <script src="../../../public/js/user/main.js"></script>
</body>

</html>
