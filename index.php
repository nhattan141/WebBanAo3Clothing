<?php
session_start();
include("db/MySQLConnect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/header-website.png" type="image/png" />  
	<title>Three Clothing</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="css/index_product.css">
    <link rel="stylesheet" type="text/css" href="css/user.css">
    <link rel="stylesheet" type="text/css" href="css/allproduct.css">
    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
	<style>
    html{
        scroll-behavior: smooth;
    }
    </style>
	
</head>
<body>
<div class="container-fluid index " id="index" >
     <!--HEADER-->
    <?php require("giaodien/header.php"); ?>
	 <!--NAVIGATION-->
    <script>
		function showCartContainer(){
			document.getElementById("cart_container").style.display="block";
			var t=document.getElementById("productCart").childElementCount;
			if(t>4){
				document.getElementById("titleCart").style.width="98.7%";
				document.getElementById("XSign_cart").style.color="black";
			}
			else{
				document.getElementById("titleCart").style.width="100%";	
				document.getElementById("XSign_cart").style.color="white";
			}
		}
	</script>
	<?php require("giaodien/Navigation.php"); ?>
	
    


    <!--CONTENT-->
    <div class="content">
        <!--BANNER-->
        <?php 
		include("giaodien/cart.php");
		include("giaodien/deliveryInfor.php");
        if(!isset($_GET['quanly'])){
         require("giaodien/slideshow_banner.php"); 
        #Product in INDEX.PHP
         require("giaodien/index_product.php"); }
         else if($_GET['quanly']=='user'){
             require("giaodien/user.php");
         }
         else if($_GET['quanly']=='product'){
             require("giaodien/allproduct.php");
         }
         else if($_GET['quanly']=='sale' ) {
            require("giaodien/sale.php");
        }
        else if($_GET['quanly']=='detail' ) {
            require("giaodien/detail.php");
        }
        else if($_GET['quanly']=='search' ) {
            require("giaodien/search.php");
        }
        
        ?>
	



    </div>


    <!--FOOTER-->
    <?php require("giaodien/footer.php");  ?>

</div>



<script src="js/jquery-3.3.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/slide.js"></script>
<script src="main.js"></script>
</body>

</html>
<?php

?>
