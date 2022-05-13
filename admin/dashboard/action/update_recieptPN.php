<?php
include("../../../db/MySQLConnect.php");



if(isset($_GET) ){
    $MA_PN=$_GET['maphieunhap'];
    $MA_TK=$_GET['mataikhoan'];
    $NGAY_NHAP=$_GET['ngaynhap'];
    $TONG_TIEN=$_GET['tongtien'];
    $updatePN="UPDATE `phieunhap` SET `MA_TK`='$MA_TK',`NGAY_NHAP`='$NGAY_NHAP',`TONG_DON_GIA`='$TONG_TIEN' WHERE MA_PN='$MA_PN'";
    mysqli_query($connect,$updatePN);
    echo $updatePN;
    header("Location:../index.php?manage=import");

}



?>