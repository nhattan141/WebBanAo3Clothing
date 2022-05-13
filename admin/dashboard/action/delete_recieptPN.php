<?php
include("../../../db/MySQLConnect.php");

if(isset($_GET) ){
    $MA_PN=$_GET['maphieunhap'];
    $MA_TK=$_GET['mataikhoan'];
    $NGAY_NHAP=$_GET['ngaynhap'];
    $TONG_TIEN=$_GET['tongtien'];
    $deletePN="DELETE FROM `phieunhap` WHERE MA_PN='$MA_PN'";
    mysqli_query($connect,$deletePN);
    header("Location:../index.php?manage=import");
}




?>