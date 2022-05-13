<?php

$name=$_SESSION['customer_name'];
	$query1="SELECT * FROM khachhang WHERE TEN_KH='$name'";
	$result = mysqli_query($connect,$query1);
	$row_customer=mysqli_fetch_assoc($result);
	$id_customer=$row_customer['MA_KH'];
/*Các đơn hàng đã đặt*/
  $getHD="select * from hoadon where MA_KH='$id_customer'"	;
  $resultHD=mysqli_query($connect,$getHD);

?>

		<div class="user-content row">
			<div class="side-menu col-md-3 sol-sm-12">
				<div class="username ">
					<i class="far fa-user-circle font " ></i>
					 Tài khoản của <br> <span  class="font" style="padding-left: 22%;"><?php echo $row_customer['TEN_KH']  ?></span>
				</div>
				<div class="submenu">
					<ul>
						<li class="subc font" onclick=""><a href="index.php?quanly=user" >Thông tin chung</a></li>
						
						<li class="subc font" onclick="document.getElementById('donhang').style.display='block'">Đơn hàng của tôi</li>
					</ul>
				</div>
			</div>
			<div class="information col-md-9 sol-sm-12">
				<div class="information-user">
					<h5 class="font title-infor" >THÔNG TIN CỦA TÔI </h5>
					<p class="font"><span class="font title-infor" >Họ Và Tên:</span> <?php echo $row_customer['TEN_KH']  ?></p>
					<p class="font"><span class="font title-infor " >Email:</span> <?php echo $row_customer['EMAIL']  ?></p>
					<p class="font"><span class="font title-infor " >Giới Tính:</span> <?php echo $row_customer['GIOI_TINH']  ?></p>
					<p class="font"><span class="font title-infor" >Điện Thoại:</span> <?php echo $row_customer['PHONE']  ?></p>
					<p class="font"><span class="font title-infor" >Địa Chỉ:</span> <?php echo $row_customer['DIA_CHI']  ?></p>
				</div>
				<br>
				<button type="button" class="btn btn-outline-primary font " onclick="document.getElementById('id01').style.display='block'">Cập Nhật Thông Tin Cá Nhân</button>
				
				<br>
				
			
			</div>
		
			<div class="container-fluid table-order  " >		
					<br>			
					<div class="table-responsive-md" id="donhang"  style="display: none; margin 0 5%">
					<p class="font"  style="font-weight: bold; font-size: large;">Các Đơn Hàng Đã Đặt:</p>
						<table  class="table table-hover  table-bordered" >
							<thead class="thead-dark">
							<tr>
								<th class="tr">Mã Đơn Hàng</th>
								<th class="tr">Ngày Đặt</th>
								<th class="tr">Tên Sản Phẩm</th>
								<th class="tr">Tổng Tiền</th>
								<th class="tr" style="width: 10%;">Trạng Thái Đơn Hàng</th>
								<th class="tr" >Thao Tác</th>
							</tr>
    						</thead>
							
							<?php 
							$huy="";
							$getIDhuy="";$id_huy="";
							while($row_hoadon=mysqli_fetch_array($resultHD)){
								$MA_HD=$row_hoadon['MA_HD'];
								$NGAY_DAT=$row_hoadon['NGAY_LAP'];
								$TIEN=$row_hoadon['TONG_TIEN'];
								$TRANG_THAI="Chưa Xử Lý";
								if($row_hoadon['TINH_TRANG']==0) $TRANG_THAI="Đang Xử Lý";
								else if($row_hoadon['TINH_TRANG']==1) $TRANG_THAI="Đã Hoàn Thành";
								if($row_hoadon['TINH_TRANG']==-1) {
									$huy='<button  type="button" class="btn btn-danger">
									<a style="color:#000" href="index.php?quanly=user&delete_id_order=';
									$getIDhuy='">									Huỷ</a></button>';
									$id_huy=$MA_HD;
									if(isset($_GET['delete_id_order'])   ){
										$MA_HD_DELETE=$_GET['delete_id_order'];
										$deleteHD="DELETE FROM `hoadon` WHERE MA_HD='$MA_HD_DELET'";
										$deleteCTHD="DELETE FROM `chitiethoadon` WHERE MA_HD='$MA_HD_DELET'";
										mysqli_query($connect,$deleteHD);
										mysqli_query($connect,$deleteCTHD);

									}




								}

							?>
							<tr>
								
								<td class="items id_order"><a  href="index.php?quanly=user&id_order=<?php echo $MA_HD ?>"><?php echo $MA_HD ?> </td>
								<td class="items"><?php echo $NGAY_DAT ?></td>
								<td class="items name-product">
								<?php
								$getDSSP="SELECT p.MA_SP,p.TEN_SP,SUM(od.SO_LUONG) AS TotalQuantity ,p.DON_GIA,p.KICH_THUOC from sanpham as p inner join chitiethoadon as od on p.MA_SP = od.MA_SP WHERE od.MA_HD='$MA_HD' GROUP BY p.MA_SP ORDER BY SUM(od.SO_LUONG)";
								$resultchitietTenSP=mysqli_query($connect,$getDSSP);
								while ($row_TEN_SP=mysqli_fetch_array($resultchitietTenSP)){
										$TEN_SP=$row_TEN_SP['TEN_SP'];
										$ID_SP=$row_TEN_SP['MA_SP'];
										$SL=$row_TEN_SP['TotalQuantity'];
										$SIZE=$row_TEN_SP['KICH_THUOC'];
								?>
								<a  class="name_product_content" href="index.php?quanly=detail&id=<?php echo$ID_SP ?>">
								<?php echo " $TEN_SP ---- Kích Thước:  $SIZE ---- Số Lượng: $SL  </br> "    ?>
								 </a>
								<?php
								}
								?>
								</td>
								<td class="items"><?php echo number_format($TIEN) ?> VNĐ</td>
								<td class="items"><?php echo $TRANG_THAI ?></td>
								<td class="items">
								<?php echo "$huy$id_huy$getIDhuy" ?>
								</td>
							</tr>
							<?php
							}
							?>
						
						</table>
					</div>
				</div>
	
		</div>
		<?php
				if(isset($_GET['id_order'] ) && !empty($_GET['id_order'])  ) {
					include("giaodien/information_oder.php");
				}
				

			?>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="./giaodien/action_user.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="input-content">
				<label for="fullname"><b>Họ và Tên:</b></label>
				<input class="login-input" type="text" placeholder="VD:Nguyễn Văn A" name="fullname" id="uname" required>

				<label for="psw"><b>Mật Khẩu:</b></label>
				<input class="login-input" type="text" placeholder="Nhập Mật Khẩu:" name="psw"  id="psw"required>

				<label for="phone"><b>Số Điện Thoại:</b></label>
				<input class="login-input" type="text" placeholder="Nhập Số Điện Thoại:" name="phone"  id="psw"required>

				<label for="gender"><b>Giới Tính:</b></label>
				<input class="login-input" type="text" placeholder="Nhập Giới Tính:" name="gender"  id="psw"required>

				<label for="address"><b>Địa Chỉ:</b></label>
				<input class="login-input" type="text" placeholder="Nhập Địa Chỉ:" name="address"  id="psw"required>
				
    </div>
	<div class="group-button row">
		<div class="col-md-2 col-sm-0"></div>
      <button type="button" class="btn btn-outline-danger col-md-3" onclick="document.getElementById('id01').style.display='none'">Huỷ</button>
	  <div class="col-md-2 col-sm-0"></div>
	  <button type="submit" class="btn btn-success col-md-3"  >Cập Nhật</button>
	  <div class="col-md-2 col-sm-0"></div>
	</div>
  </form>
</div>



<!-- chình cap nhập dữ liệu bằng rỗng thì ko cập nhật gì hết-->

 <!--
SELECT hd.MA_HD,cthd.MA_SP,sp.TEN_SP,cthd.THANH_TIEN,hd.NGAY_LAP FROM `hoadon` as hd INNER JOIN `chitiethoadon` as cthd inner join `sanpham` as sp on cthd.MA_HD=hd.MA_HD and cthd.MA_SP=sp.MA_SP WHERE hd.MA_KH='3'-->