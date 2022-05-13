<?php
session_start();
function UpdateCustomer() { 
	if(!empty($_POST)){
	   $fullname =$_POST['fullname'];
	   $password =$_POST['psw'];
	   $password=md5($password);
	   $phone =$_POST['phone'];
	   $gender =$_POST['gender'];
	   $address =$_POST['address'];
	   include("../db/MySQLConnect.php");
	   $name=$_SESSION['customer_name'];

   //thuc hien truy van du lieu - chen u lieu vao database 2 bang taikhoan va khachhang
   $query="UPDATE khachhang SET TEN_KH='$fullname',PHONE='$phone',GIOI_TINH='$gender',DIA_CHI='$address' WHERE TEN_KH='$name'";
	$query1=" UPDATE `taikhoan` SET TEN_DANG_NHAP='$fullname',MAT_KHAU='$password' WHERE TEN_DANG_NHAP='$name'";
		echo $query1;
		echo $query;
	$result=mysqli_query($connect,$query);	
	$result1=mysqli_query($connect,$query1);
   	header("Location:../index.php?quanly=user");
	   $_SESSION['customer_name']=$fullname;
	$connect->close();        
   }
}
UpdateCustomer();

?>
