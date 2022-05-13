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
	$sql="SELECT od.MA_CTGG,p.MA_SP,ctgg.PHAN_TRAM_GIAM_GIA,p.TEN_SP,p.HINH_ANH_URL,p.DON_GIA from sanpham as p inner join chitietgiamgia as od INNER JOIN chuongtrinhgiamgia as ctgg on p.MA_SP = od.MA_SP and ctgg.MA_CTGG=od.MA_CTGG  GROUP BY p.TEN_SP";
	$paginationlink = "giaodien/getresult_sale.php?page=";
}		   
else 
	if(isset($_GET['type']) ){	//lay theo loai
		$id_CTGG=$_GET['type'];
		$sql="SELECT od.MA_CTGG,p.MA_SP,ctgg.PHAN_TRAM_GIAM_GIA,p.TEN_SP,p.HINH_ANH_URL,p.DON_GIA from sanpham as p inner join chitietgiamgia as od INNER JOIN chuongtrinhgiamgia as ctgg on p.MA_SP = od.MA_SP and ctgg.MA_CTGG=od.MA_CTGG WHERE ctgg.MA_CTGG='$id_CTGG' GROUP BY p.TEN_SP";
		$paginationlink = "giaodien/getresult_sale.php?type=$id_CTGG&page="; 
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

while($row_all_product_sale=mysqli_fetch_array($getLimitProduct)) {
	$MA_CTGG=$row_all_product_sale['MA_CTGG'];
	$MA_SP=$row_all_product_sale['MA_SP'];
	$TEN_SP=$row_all_product_sale['TEN_SP'];
	$URL=$row_all_product_sale['HINH_ANH_URL'];
	$giamoi=$row_all_product_sale['DON_GIA'] - $row_all_product_sale['DON_GIA']*$row_all_product_sale['PHAN_TRAM_GIAM_GIA'];
	$PTGG=$row_all_product_sale['PHAN_TRAM_GIAM_GIA']*100;
	$num_giamoi=number_format($giamoi);
	$dongia=number_format($row_all_product_sale['DON_GIA']);
	$output .= "<div class=\"col-md-3 col-sm-12 text-center product-content\">
               		<div class=\"  product-about\">
                        <div class=\"percent-sale\">-$PTGG%</div>
                        <img src=\"images/product-items/$URL\" class=\"img-fluid img-top-sold\">
                        <div class=\"overlay\">
                        	<a class=\"info\" href=\"index.php?quanly=detail&id=$MA_SP&sale=$MA_CTGG\">Chi Tiết</a>
                        </div>                                          
                    </div> 
                    <div class=\"product-infor\">
                    	$TEN_SP
                        <p style=\"margin-bottom: 1ex; color: red;font-weight:bold\">
							$num_giamoi VNĐ
							<em  style=\"margin-left:2ex;font-weight:bold\">Giá gốc: 
								<span style=\"text-decoration: line-through;color: #aaa;font-size: 18px; \">
								$dongia VNĐ
								</span>
                            </em>
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

