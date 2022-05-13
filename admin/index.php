
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>ĐĂNG NHẬP QUẢN TRỊ</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script> 
<!-- //online-fonts -->
</head>
<body>
<!-- main -->

<div class="center-container">
	<!--header-->
	<div class="header-w3l">
		<h1>ĐĂNG NHẬP QUẢN TRỊ HỆ THỐNG</h1>
	</div>
	<!--//header-->
	<div class="main-content-agile">
		<div class="sub-main-w3">	
			<div class="wthree-pro">
				<h2>KÍNH CHÀO BẠN !</h2>
			</div>
			<form action="" method="post" id="login-admin">
				<div class="pom-agile">
					<input placeholder="Nhập Người Dùng" id="name" name="name" class="user" type="text" required="">
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
				<span class="" id="name-error"style="color:red"></span>
				<div class="pom-agile">
					<input  placeholder="Nhập Mật Khẩu" id="password" name="password" class="pass" type="password" required="">
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
				</div>
				<span class="" id="pass-error"style="color:red"></span>
				<div class="sub-w3l">
					<div class="right-w3l">
						<input type="button" id="button_submit" name="login-admin" value="Đăng Nhập">
                       
					</div>
                    <span id="error" style="font-weight:bold;font-size:18px;color:#ff0000"></span>
				</div>
			</form>
		</div>
	</div>
	<!--//main-->
	
</div>
<script type="text/javascript">
    $(document).ready(function(){
	  $("#button_submit").click( function(){
		var error = $("#error");
		var name = $("#name").val();
		var password = $("#password").val();
		var pass_error = $("#pass-error");
		var name_error = $("#name-error");

		// resert 2 thẻ div thông báo trở về rỗng mỗi khi click nút đăng nhập
    	error.html("");
		name_error.html("");
		pass_error.html("");

		// Kiểm tra nếu email rỗng thì báo lỗi
		if (name == "") {
			name_error.html("Tên người dùng không được để trống");
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
		  url: './dashboard/action_login.php',
		  method: 'POST',
		  data: $('#login-admin').serialize(),
		  success : function(response){
		  	if (response == 1 ) {
		  		alert("Đăng Nhập Thành Công!  Chúc Bạn Một Ngày Làm Việc Tốt Lành  ❤️ ✨✨✨✨✨✨✨✨❤❤️❤✨✨✨✨✨✨✨✨ ❤️");
          window.location="./dashboard/index.php";
		  	}else{
		  		error.html("Tên đăng nhập hoặc mật khẩu không chính xác !");
		  	}//alert(response);
      
            }

          })

        });

      });

</script>
</body>
</html>