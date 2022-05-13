<header id="header">
		<div class="row">
			<div class=" col-md-5 col-sm-0" >
				<h5 style="font-style: italic;font-weight: bold;color: #fff;">Hotline: 0707624367</h5>
			</div>
			<div class="Logo-Brand col-md-2 col-sm-5" >
				<img src="images/logo.png " style="width:100%">
			</div>
			<div class=" col-md-1 col-sm-0" ></div>
			<div class="Account col-md-4 col-sm-5" >
			<button class="login btn btn-outline-success"   ><a   style="text-decoration: none; color: green;font-weight:bold;"href=
				'<?php
						if (isset($_SESSION['login']) ) {
							if($_SESSION['login']) echo "index.php?quanly=user";
							else echo "giaodien/login.php";
							}
						else echo "giaodien/login.php";
				?>'
			>
			<?php 
				if (isset($_SESSION['login']) ) {
					if($_SESSION['login']) echo '<i class="fas fa-user-alt"></i> '.$_SESSION['customer_name'].""; 
					
					else echo "Đăng Nhập";
				}
				else echo "Đăng Nhập";

			?>	</a></button>
			<button class="btn btn-outline-danger register" ><a class="register" style="text-decoration: none; color: red;font-weight:bold;" href=
				'<?php
					if (isset($_SESSION['login']) ) {
						if($_SESSION['login']) echo "giaodien/logout.php";
						else echo "giaodien/register.php";
						}
					else echo "giaodien/register.php";
				?>'
			>
				<?php
					if (isset($_SESSION['login']) ) {
						if($_SESSION['login']) echo "Đăng Xuất"; 
						  
						else echo "Đăng Ký";
					}
					else echo "Đăng Ký";

				?>
			</a> </button>
			
			</div>
			
		</div>
		
		
	</header>