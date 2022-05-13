<?php 
	$checkPay=0;
	$connect =new mysqli("localhost","root","","doanweb2");
	$connect -> set_charset("utf8");
	require_once("dbcontroller.php");
	$db_handle = new DBController();		
	if(isset($_SESSION['customer_name'])){	//Lay thong tin khach hang
		$username=$_SESSION['customer_name'];
		$inforUser=$db_handle->runQuery("SELECT k.MA_KH, k.DIA_CHI, k.PHONE FROM khachhang as k INNER JOIN taikhoan as t ON k.MA_TK=t.MA_TK AND k.TEN_KH='$username'");
		$idUser=$inforUser[0]["MA_KH"];
		$address=$inforUser[0]["DIA_CHI"];
		$phone=$inforUser[0]["PHONE"];
	}
	if(isset($_SESSION["cart_item"])){	//lay ma giam gia & tien giam gia
		$discount=array();
		foreach($_SESSION["cart_item"] as $k => $v){
			$getPercent=$db_handle->runQuery("SELECT c.PHAN_TRAM_GIAM_GIA, c.MA_CTGG FROM chuongtrinhgiamgia as c INNER JOIN chitietgiamgia as t ON c.MA_CTGG=t.MA_CTGG AND t.MA_SP=$k");
			if($getPercent!=NULL){
				$percent=$getPercent[0]["PHAN_TRAM_GIAM_GIA"];
				$idDiscount=$getPercent[0]["MA_CTGG"];
			}
			else{
				$percent=0;
				$idDiscount=NULL;
			}
			$getPrice=$db_handle->runQuery("SELECT DON_GIA FROM sanpham WHERE MA_SP=$k");
			$price=$getPrice[0]["DON_GIA"];
			$total=$price*$percent;
			$discount+=array("$k"=>array('id'=>$idDiscount, 'price'=>$total));
		}
	}
	if(isset($_POST["delivery"])){	//ghi du lieu xuong database
		date_default_timezone_set('Asia/Ho_Chi_Minh');	
		$dateBuy=date("Y-m-d h:i:s");
		$queryHD="INSERT INTO hoadon(MA_KH, DIA_CHI, SODIENTHOAI, TINH_TRANG, TONG_TIEN, NGAY_LAP)";
		$queryHD.=" VALUES('" .$idUser. "', '" .$_POST["address_delInfor"]. "', '" .$_POST["phone_delInfor"]. "', 0, '" .$total_price. "', '" .$dateBuy. "')"; 
		$checkPay=mysqli_query($connect,$queryHD);
		$getIDnew=$db_handle->runQuery("SELECT MA_HD FROM `hoadon` ORDER BY `hoadon`.`MA_HD` DESC");
		$IDnew=$getIDnew[0]["MA_HD"];
		foreach($_SESSION["cart_item"] as $k=>$v){
			$getInventory=$db_handle->runQuery("SELECT SO_LUONG FROM sanpham WHERE MA_SP='".$_SESSION["cart_item"][$k]["id"]."'");
			$inventory=$getInventory[0]["SO_LUONG"];
			$newQuanlity=$inventory-$_SESSION["cart_item"][$k]["quanlity"];
			$totalprice=($_SESSION["cart_item"][$k]["price"]+$discount[$k]["price"])*$_SESSION["cart_item"][$k]["quanlity"];
			$queryCT="INSERT INTO chitiethoadon(MA_HD, MA_SP, SO_LUONG, TIEN_GIAM_GIA, DON_GIA, THANH_TIEN)";
			$queryCT.=" VALUES('" .$IDnew. "', '" .$k. "', '" .$_SESSION["cart_item"][$k]["quanlity"]. "', '" .$discount[$k]["price"]. "', '" 
			.$_SESSION["cart_item"][$k]["price"]. "', '" .$totalprice. "')";
			$checkPay=mysqli_query($connect,$queryCT);
			mysqli_query($connect,"UPDATE sanpham SET SO_LUONG=$newQuanlity WHERE MA_SP='".$_SESSION["cart_item"][$k]["id"]."'");
		}
	}
?>
<style>
	#delInfor_container{
		width:25%;
		height:270px;
		background-color:white;
		box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		margin:110px 0 0 37.5%;
		position:fixed;
		z-index:11;
		display:none;
		top:150px;
	}
	#delInfor_container input[type=text]{
		width:90%;
	}
	#delInfor_XSign{
		position:absolute;
		margin-left:97%;
		cursor:pointer
	}
	#delInfor_title{
		width:100%;
		height:50px;
		background-color:#09F;
		color:white;
		text-align:center;
		position:relative
	}
	#btPay{
		background-color:#09F; 
		color:white; 
		border:solid 2px black
	}
	#btPay:active{
		background-color:blue;
	}	
</style>
<script>
	function checkDelInfor(){
		var address, phone;
		address=document.getElementById("txAddress_delInfor").value;
		phone=document.getElementById("txPhone_delInfor").value;
		if(address==""){
			alert("Vui lòng nhập địa chỉ");
			return 0;
		}
		if(phone==""){
			alert("Vui lòng nhập số điện thoại");
			return 0;
		}
		var patt=/^\d+/;
		if(!phone.match(patt)){
			alert("Số điện thoại không hợp lệ");
			return 0;
		}
		delInfor_form.submit();
	}
	function hideDelInfor(){
		document.getElementById("delInfor_container").style.display="none";
	}
</script>
<div id="delInfor_container">
	<div id="delInfor_title">
    	<div id="delInfor_XSign" onclick="hideDelInfor()">X</div>
    	<h5 style="color:white; line-height:50px">THÔNG TIN GIAO HÀNG</h5>
    </div>
    <div style="text-align:left; margin-left:30px">
        <form id="delInfor_form" action="<?php echo  $_SERVER['REQUEST_URI']; ?>" method="post">
        	<input type="hidden" name="delivery" value="1">
            <div style="margin-top:20px"><b>Địa chỉ:</b></div>
            <input id="txAddress_delInfor" name="address_delInfor" type="text" >
            <div style="margin-top:10px"><b>Số điện thoại:</b></div>		
            <input id="txPhone_delInfor" name="phone_delInfor" type="text" > 
      	</form>
    </div>
    <div style="margin-top:25px; text-align:center">
        	<button id="btPay" onClick="checkDelInfor()" >Thanh toán</button>
    </div>
</div>
<script>
	function loadInfor(){
		var address, phone;
		address="<?php
			if(isset($_SESSION['customer_name']))
				echo $address;
		?>";
		phone="<?php 
			if(isset($_SESSION['customer_name']))
				echo $phone;
		?>";
		document.getElementById("txAddress_delInfor").value=address;
		document.getElementById("txPhone_delInfor").value=phone;
	}
	loadInfor();
	if(<?php echo "$checkPay"?>)
		alert("Cảm ơn quý khách đã mua hàng");
</script>
