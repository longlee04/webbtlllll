//Slider
let imgBanner = document.querySelector(".real");
const imgBanners = [
  "../../../public/img/real/1.webp",
  "../../../public/img/real/2.jpg",
  "../../../public/img/real/3.jpg",
  "../../../public/img/real/4.jpg",
];
let index = 1;
function imgSlider() {
  imgBanner.src = imgBanners[index];
  index++;
  if (index >= imgBanners.length) {
    index = 0;
  }
}
setInterval(imgSlider, 3000);


//Handle form login/register
const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.getElementById("container");

signUpButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

signInButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

//Xử lý click vào icon user
const icon_user = document.getElementById('user');
icon_user.addEventListener('click', function (event) {
  document.getElementById('div_of_login_register').classList.remove('hidden');
});


const btn_close = document.getElementById('btn-close');
btn_close.addEventListener('click', function () {
  document.getElementById('div_of_login_register').classList.add('hidden');
})

//Validate đăng ký tài khoản
var btn_sign_up = document.getElementById('sign_up');
btn_sign_up.addEventListener("click", function () {
  var username = document.getElementById("register_username");
  var password = document.getElementById("register_password");
  var confirm_password = document.getElementById("register_confirm_password");
  if (username.value == "" || password.value == "" || confirm_password.value == "") {
    alert("Vui lòng không để trống thông tin");
  } else if (password.value != confirm_password.value) {
    alert("Mật khẩu không trùng khớp");
  } else {
    document.getElementById('form_register').submit();
  }
})
//Validate đăng nhập tài khoản
var btn_login = document.getElementById('login');
btn_login.addEventListener("click", function () {
  var username = document.getElementById("login_username");
  var password = document.getElementById("login_password");
  if (username.value == "" || password.value == "" ) {
    alert("Vui lòng không để trống thông tin");
  } else {
    document.getElementById('form_login').submit();
  }
})

