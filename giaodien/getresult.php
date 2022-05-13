<?php
$checkLogin=0;
if(isset( $_SESSION['alert_login']) && !empty( $_SESSION['alert_login']))
	$checkLogin=1;
$connect =new mysqli("localhost","root","","doanweb2");
$connect -> set_charset("utf8");
require_once("pagination.class.php");
$perPage = new PerPage();	
		
$page = 1;
if(!empty($_GET["page"])) {
	$page = $_GET["page"];	
}

$start = ($page-1)*$perPage->perpage;
if($start < 0) 
	$start = 0;

if(!isset($_GET['type']) && empty($_GET['type'])){	//lay tat ca
	$sql=" SELECT * from sanpham GROUP BY TEN_SP";
	$paginationlink = "giaodien/getresult.php?page=";
}		   
else 
	if(isset($_GET['type']) ){	//lay theo loai
		$id_loai=$_GET['type'];
		$sql=" SELECT * from sanpham WHERE LOAI_SP='$id_loai' GROUP BY TEN_SP";
		$paginationlink = "giaodien/getresult.php?type=$id_loai&page="; 
	}
$getAllProduct=mysqli_query($connect,$sql);

$query =  $sql . " limit " . $start . "," . $perPage->perpage; 
$getLimitProduct=mysqli_query($connect,$query);

if(empty($_GET["rowcount"])) {
	$_GET["rowcount"] = mysqli_num_rows($getAllProduct);
}
$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink);	

$output = '';
$output .= '<input type="hidden" id="rowcount" name="rowcount" value="' . $_GET["rowcount"] . '" />';	

while($row_all_product=mysqli_fetch_array($getLimitProduct)) {
	$MA_SP=$row_all_product['MA_SP'];
	$nameproduct=$row_all_product['TEN_SP'];
	$price=$row_all_product['DON_GIA'];
	$url=$row_all_product['HINH_ANH_URL'];
		//Kiem tra cac san pham co giam gia hay ko
	$getSale=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `chitietgiamgia` WHERE MA_SP='$MA_SP'"));
	$idsale="";$notificationfoot="";$notificationhead="";$notificationpercent="";
	if($getSale!=null){
		$getpercentSale=mysqli_fetch_assoc(mysqli_query($connect,"SELECT PHAN_TRAM_GIAM_GIA FROM chuongtrinhgiamgia WHERE MA_CTGG= '".$getSale['MA_CTGG']."' "));
		$price=$price - $price* $getpercentSale['PHAN_TRAM_GIAM_GIA'];
		$idsale=$getSale['MA_CTGG'];
		//Hien BadGe thong bao % giam gia
		$notificationhead= '  <div class="percent-sale">-';
        $notificationfoot='%</div> ';
		$notificationpercent=$getpercentSale['PHAN_TRAM_GIAM_GIA']*100;
	}
	$numPrice=number_format($price);
	$output .= "<div class=\"col-md-4 col-sm-12 text-center product-content \">
                        <div class=\"product-about\">
                            $notificationhead $notificationpercent $notificationfoot
                            <img src=\"images/product-items/$url\" class=\"img-fluid img-top-sold\">
                            <div class=\"overlay\">
                            <a class=\"info\" href=\"index.php?quanly=detail&id=$MA_SP&sale=$idsale\">Chi Tiết</a>
                            </div>
                        </div>
                        <div class=\"product-infor\">
                            $nameproduct
                            <p style=\"margin-bottom: 1ex;\">
                            <b class=\"price\" style=\"color: red\">$numPrice VNĐ</b>
                            </p>
                    	</div>	
			        </div>";
}

	$output .= '<div id="paginationWrapper"><div id="pagination">' . $perpageresult . '</div></div>';
print $output;
?>
<script>
	function checkLogin(){
		if(<?php echo "$checkLogin" ?> == 0)
			alert("Vui lòng đăng nhập");
	}
</script>
