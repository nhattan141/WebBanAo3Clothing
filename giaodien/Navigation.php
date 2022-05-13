<?php 
          $index="";$product="";$sale="";$news="";
                if(!isset($_GET['quanly'])) $index="active";
                else if($_GET['quanly']=='product') $product="active";
                else if($_GET['quanly']=='sale') $sale="active";
                else if($_GET['quanly']=='news') $news ="active";
                  $getLoaiSP=mysqli_query($connect,"SELECT DISTINCT LOAI_SP FROM sanpham;");
                  //$countLoai=mysqli_fetch_row($connect,"SELECT DISTINCT LOAI_SP FROM sanpham;");
                  $getLoaiSPSale=mysqli_query($connect,"SELECT MA_CTGG,LOAI_CHUONG_TRINH,TEN_CHUONG_TRINH FROM chuongtrinhgiamgia;");// Dòng này khi co giam gia se lấy ở đó
?>
<nav class="navbar navbar-expand-lg navbar-light menu " id="navbar">

		<img src="images/logo.png" class="navbar-brand img-fluid  ">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon" ></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo $index ?>">
                <a class="nav-link " href="index.php" style="color: #fff">TRANG CHỦ <span class="sr-only">(current)</span></a>
                </li>
               
                <li class="nav-item <?php echo $product?> dropdown fullmenu" >
                <a class="nav-link " onclick="" id="navbarDropdown" href="index.php?quanly=product" >
                SẢN PHẨM
                </a>
				        <div class="dropdown-content" id="product">
                <?php
                  while ($row_category= mysqli_fetch_array($getLoaiSP)){
                ?>
                    <a class="dropdown-item " href="index.php?quanly=product&type=<?php echo $row_category['LOAI_SP']  ?>"><i class="fas fa-circle"></i><?php echo $row_category['LOAI_SP'] ?></a> 
                <?php
                  }
                ?>
                </div>
                
                </li>

                <li class="nav-item  <?php echo $sale ?> dropdown">
                <a class="nav-link"  id="navbarDropdown" href="index.php?quanly=sale" >
                    KHUYẾN MÃI
                </a>
                <div class="dropdown-content" id="sale">
                <?php
                  while ($sale_category= mysqli_fetch_array($getLoaiSPSale)){
                ?>
                    <a class="dropdown-item " href="index.php?quanly=sale&type=<?php echo $sale_category['MA_CTGG']  ?>"><i class="fas fa-circle"></i><?php echo $sale_category['TEN_CHUONG_TRINH'] ?></a> 
                <?php
                  }
                ?>
                </div>
                </li>
             
		    </ul>
			  
		  <button class="btn btn-outline-success my-2 my-sm-0 openBtn  " id="navbarDropdown" type="submit" onclick="openSearch()"><i class="fa fa-search"></i></button>
		  <div class="nav-item icon" style="margin-right: 5ex;" onclick="showCartContainer()">
			  <a  class="icon-button"><i class="fas fa-cart-plus"></i></a>
		  </div>
	</div>
</nav>
      <!--Search-->
      <div id="myOverlay" class="overlaysearch">
			<span class="closebtn" onclick="closeSearch()" title="Đóng Tìm Kiếm">×</span>
			<div class="overlay-content">
			  <form action="index.php?quanly=search" method ="post">
				<input type="text" style="font-weight: bold; color: #333;" placeholder="Tìm Kiếm..." name="search_product">
				<button type="submit" name="search_submit"><i class="fa fa-search  text-light"></i></button>
			  </form>
			</div>
		  </div>	