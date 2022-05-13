
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Đăng Nhập Tài Khoản </title>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <script src="../js/validate.js"> </script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script> 
</head>
<body>

<div class="main">

       <form action="#" method="POST" class="form" id="form-2">
        <h3 class="heading">ĐĂNG NHẬP</h3>
        <p class="desc">Chúc quý khách mua hàng vui vẻ ❤️</p>

        <div class="spacer"></div>

        <div class="form-group">
          <label for="email" class="form-label">Email:</label>
          <input id="email" name="email" type="text" placeholder="VD: email@domain.com" class="form-control">
          <span class="form-message" id="email-error"></span>
        </div>

        <div class="form-group">
          <label for="pwd" class="form-label">Mật Khẩu:</label>
          <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
          <span class="form-message" id="pass-error"></span>
        </div>

        <button type="button" id="login_submit" name="login_submit"  class="form-submit2">Đăng Nhập</button>
        <br>
        <span id='error' class="error"></span>
      </form>
      
    </div>
   
    <script>

      document.addEventListener('DOMContentLoaded', function () {
        Validator({
          form: '#form-2',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isEmail('#email'),
            Validator.minLength('#password', 5),
          ],
        });
      });

    </script>
    <!--Kiem Tra Dang Nhap Bang Ajax-->
  <script type="text/javascript">
    $(document).ready(function(){
	  $("#login_submit").click( function(){
    var error = $("#error");
    var email = $("#email").val();
		var password = $("#password").val();
		var pass_error = $("#pass-error");
		var email_error = $("#email-error");

		// resert 2 thẻ div thông báo trở về rỗng mỗi khi click nút đăng nhập
    error.html("");
		email_error.html("");
		pass_error.html("");

		// Kiểm tra nếu email rỗng thì báo lỗi
		if (email == "") {
			email_error.html("Email không được để trống");
			return false;
		}
		// Kiểm tra nếu password rỗng thì báo lỗi
		if (password == "") {
			pass_error.html("Mật khẩu không được để trống");
			return false;
		}
		// Chạy ajax gửi thông tin username và password về server check_dang_nhap.php
		// để kiểm tra thông tin đăng nhập hợp lệ hay chưa
		$.ajax({
		  url: 'action_login.php',
		  method: 'POST',
		  data: $('#form-2').serialize(),
		  success : function(response){
		  	if (response == 1 ) {
		  		alert("Đăng Nhập Thành Công!  Chúc Quý Khách Mua Hàng Thật Vui Vẻ    ❤️ ✨✨✨✨✨✨✨✨❤❤️❤✨✨✨✨✨✨✨✨ ❤️");
          window.location="../index.php";
		  	}else {
		  		error.html("Email hoặc mật khẩu không chính xác !");
		  	}
        if (response == -1 ) {
          error.html("Tài Khoản đã bị Khoá");
        }//alert(response);
      
            }

          })

        });

      });

</script>

</body>

</html>

// 