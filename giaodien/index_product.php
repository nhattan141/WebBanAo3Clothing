<?php
	// Thiet Lap muoi Gio
	date_default_timezone_set('Asia/Ho_Chi_Minh');	
	$datemax=date_create(date('d-m-Y'));
	$datemin=date_create(date('d-m-Y'));
	date_modify($datemin,"-1 month");
	$min=date_format($datemin,'Y-m-d');
	$max=date_format($datemax,'Y-m-d');
	
	$query1="SELECT p.MA_PN,ct.MA_SP,sp.TEN_SP,sp.DON_GIA,sp.HINH_ANH_URL  FROM phieunhap as p inner join chitietphieunhap as ct inner join  sanpham as sp on p.MA_PN = ct.MA_PN and ct.MA_SP=sp.MA_SP  
	WHERE p.NGAY_NHAP BETWEEN '$min' AND '$max' GROUP BY sp.TEN_SP ORDER BY p.NGAY_NHAP DESC  LIMIT 4 ";
	/*$getMaPN=mysqli_query($connect,$query1);//echo $query1;
	$MaPN=mysqli_fetch_assoc($getMaPN);
	$query2="SELECT DISTINCT MA_SP FROM chitietphieunhap WHERE MA_PN ='".$MaPN['MA_PN']."' ORDER BY  MA_SP ASC";//DUNG TOI DAY
	//echo $query2;
	$getMaSP=mysqli_query($connect,$query2);
	$ArrayMaSP=array();
	$i=0;
	while($row_MaSP=mysqli_fetch_array($getMaSP,1)){
		//$ArrayMaSP[$i++]=$MaSP['MA_SP'];
		//echo $MASP['MA_SP'];
		$ArrayMaSP[$i++]= $row_MaSP['MA_SP'];
	}
	$query3="SELECT DISTINCT TEN_SP FROM sanpham WHERE   MA_SP BETWEEN '".$ArrayMaSP['0']."' AND '".$ArrayMaSP[$i-1]."' ORDER BY  MA_SP DESC LIMIT 4 ";*/
   $result =mysqli_query($connect,$query1);
?>

<div class="container-fluid content-product">

<div class="container-fluid new-arrival">
		<p class="text-center title">SẢN PHẨM MỚI</p>
		<hr class="hr-arrival">
		<div class="row new-arrival-content " id="arrival">
        <?php
            while($row_new_product=mysqli_fetch_array($result)){
				$price=$row_new_product['DON_GIA'];
				//Lay thông tin cac san pham giam gia neu co
				$getSale=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `chitietgiamgia` WHERE MA_SP='".$row_new_product['MA_SP']."'"));
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
		?>
        		
			<div class="col-md-3 col-sm-12   text-center new-arrival-product" >		

				<div class="  new-arrival-items">
				<?php  echo $notificationhead; echo $notificationpercent; echo $notificationfoot; ?>
					<img src="images/product-items/<?php echo $row_new_product['HINH_ANH_URL'];?>" class="img-fluid img-new-arrival">
					<div class="overlay">
					<a class="info" href="index.php?quanly=detail&id=<?php echo $row_new_product['MA_SP'] ?>&sale=<?php echo $idsale ?>">Chi Tiết</a>
					</div>
															
				</div>
				<div class="new-arrival-infor"   >
						<?php  echo $row_new_product['TEN_SP']; ?>
						<p>
						<b class="price " style="color: red"><?php  echo number_format($price) ;?> VNĐ </b>
					</p>
				</div>	
				
			</div>
            <?php
              
			
            }
            ?>
		</div>
		
	</div>
		<br>

		<!--- Sản Phẩm Bán Chạy-->
	<?php
	$query2="SELECT p.MA_SP,p.TEN_SP,SUM(od.SO_LUONG) AS TotalQuantity ,p.DON_GIA,p.HINH_ANH_URL 
	from sanpham as p inner join chitiethoadon as od on p.MA_SP = od.MA_SP 
	GROUP BY p.TEN_SP ORDER BY SUM(od.SO_LUONG) DESC LIMIT 6";
	$getBestSelling= mysqli_query($connect,$query2);
//SELECT sp.MA_SP,sp.TEN_SP,SUM(cthd.SO_LUONG) as SOLUONG from chitiethoadon as cthd inner join sanpham as sp on cthd.MA_SP=sp.MA_SP WHERE cthd.MA_HD='4' ORDER BY SUM(cthd.SO_LUONG)
	?>
	<div class="container-fluid  top-sold row">
		<p class="text-center title ">SẢN PHẨM BÁN CHẠY</p>
		<hr class="hr-arrival">
		<br>
		<div class="col-md-1 col-sm-1"></div>
		<div class="col-md-10 col-sm-10 row top-sold-content " id="bestseller">
		<?php
            while($row_best_seller=mysqli_fetch_array($getBestSelling)) {
				$name_product_best_sell=$row_best_seller['TEN_SP'];
				$price_product_best_sell=$row_best_seller['DON_GIA'];
				$url_product_best_sell=$row_best_seller['HINH_ANH_URL'];
				$id_product_best_sell=$row_best_seller['MA_SP'];
				//Lay thông tin cac san pham giam gia neu co
				$getSale=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `chitietgiamgia` WHERE MA_SP='".$row_best_seller['MA_SP']."'"));
				$idsale="";$notificationfoot="";$notificationhead="";$notificationpercent="";
				if($getSale!=null){
					$getpercentSale=mysqli_fetch_assoc(mysqli_query($connect,"SELECT PHAN_TRAM_GIAM_GIA FROM chuongtrinhgiamgia WHERE MA_CTGG= '".$getSale['MA_CTGG']."' "));
					$price_product_best_sell=$price_product_best_sell - $price_product_best_sell* $getpercentSale['PHAN_TRAM_GIAM_GIA'];
					$idsale=$getSale['MA_CTGG'];
					//Hien BadGe thong bao % giam gia
					$notificationhead= '  <div class="percent-sale">-';
					$notificationfoot='%</div> ';
					 $notificationpercent=$getpercentSale['PHAN_TRAM_GIAM_GIA']*100;

				}

		?>	
			<div class="col-md-4 col-sm-12 text-center top-sold-product">
				<div class="  top-sold-items">
					<?php  echo $notificationhead; echo $notificationpercent; echo $notificationfoot; ?>
					<img src="images/product-items/<?php echo $url_product_best_sell?>" class="img-fluid img-top-sold">
					<div class="overlay">
					<a class="info" href="index.php?quanly=detail&id=<?php echo $id_product_best_sell ?>&sale=<?php echo $idsale ?>">Chi Tiết</a>
					</div>										
				</div>
				<div class="top-sold-infor">
					<?php echo $name_product_best_sell ?>
						<p style="margin-bottom: 1ex;">
					
						<b class="price " style="color: red"><?php echo number_format($price_product_best_sell )?> VNĐ </b>
					</p>
				</div>	
			</div>
			<?php
			}
			?>
		</div>
		<div class="col-md-1 col-sm-1"></div>

			
		

		<button type="button" class="btn btn-outline-warning extendend"><a href="index.php?quanly=product"> Xem Thêm</a> </button>

		<br>
	
	    </div>
    </div>
<!--SELECT p.MA_PN,ct.MA_SP,sp.TEN_SP,sp.DON_GIA,sp.HINH_ANH_URL  FROM phieunhap as p inner join chitietphieunhap as ct inner join  sanpham as sp on p.MA_PN = ct.MA_PN and ct.MA_SP=sp.MA_SP  
WHERE p.NGAY_NHAP BETWEEN '2020-02-01' AND '2021-05-05' GROUP BY sp.TEN_SP ORDER BY p.NGAY_NHAP DESC 

	//SELECT p.PHAN_TRAM_GIAM_GIA,od.MA_CTGG,od.MA_SP from chuongtrinhgiamgia as p inner join chitietgiamgia as od on p.MA_CTGG = od.MA_CTGG GROUP BY od.MA_SP-->