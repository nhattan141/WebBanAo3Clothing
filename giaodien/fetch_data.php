<?php

//fetch_data.php
$connect =new mysqli("localhost","root","","doanweb2");
$connect -> set_charset("utf8");
require_once("dbcontroller.php");
$db_handle = new DBController();

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM sanpham  
	";
	if(isset($_POST["name"]))
	{
		$query .= "
		 WHERE TEN_SP LIKE '%".$_POST["name"]."%'
		";
	}
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND DON_GIA BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["typePro"]))
	{
		$type_filter = implode("','", $_POST["typePro"]);
		$query .= "
		 AND LOAI_SP IN('".$type_filter."')
		";
	}
	if(isset($_POST["size"]))
	{
		$size_filter = implode("','", $_POST["size"]);
		$query .= "
		 AND KICH_THUOC IN('".$size_filter."')
		";
	}
	$query .= "
		 GROUP BY TEN_SP
		";
	
	$result = $db_handle->runQuery($query);
	$total_row = $db_handle->numRows($query);
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$getSale=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `chitietgiamgia` WHERE MA_SP='".$row["MA_SP"]."'"));
			$idsale="";$notificationfoot="";$notificationhead="";$notificationpercent="";
			$price=$row["DON_GIA"];
			if($getSale!=null){	//Kiem tra cac san pham co giam gia hay ko
				$getpercentSale=mysqli_fetch_assoc(mysqli_query($connect,"SELECT PHAN_TRAM_GIAM_GIA FROM chuongtrinhgiamgia WHERE MA_CTGG= '".$getSale['MA_CTGG']."' "));
				$price=$price - $price* $getpercentSale['PHAN_TRAM_GIAM_GIA'];
				$idsale=$getSale['MA_CTGG'];
				//Hien BadGe thong bao % giam gia
				$notificationhead= '  <div class="percent-sale">-';
				$notificationfoot='%</div> ';
				$notificationpercent=$getpercentSale['PHAN_TRAM_GIAM_GIA']*100;
			}
			$output .= "<div class=\"col-md-4 col-sm-12 text-center product-content \">
                        <div class=\"product-about\">
							$notificationhead $notificationpercent $notificationfoot
                            <img src=\"images/product-items/".$row["HINH_ANH_URL"]."\" class=\"img-fluid img-top-sold\">
                            <div class=\"overlay\">
                            <a class=\"info\" href=\"index.php?quanly=detail&id=".$row["MA_SP"]."&sale=\">Chi Tiết</a>
                            </div>
                        </div>
                        <div class=\"product-infor\">
                            ".$row["TEN_SP"]."
                            <p style=\"margin-bottom: 1ex;\">
                            <b class=\"price\" style=\"color: red\">".$price." VNĐ</b>
                            </p>
                    	</div>	
			        </div>";
		}
	}
	else
	{
		$output = '<h3>KHÔNG TÌM THẤY SẢN PHẨM PHÙ HỢP</h3>';
	}
	echo $output;
}

?>