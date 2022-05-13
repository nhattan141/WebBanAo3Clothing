
<?php

include("../../../db/MySQLConnect.php");
/*Thêm Phiếu Nhậ<>*/
if(isset($_GET) ){
    $MA_PN=$_GET['maphieunhap'];
    $MA_TK=$_GET['mataikhoan'];
    $NGAY_NHAP=$_GET['ngaynhap'];
    $TONG_TIEN=$_GET['tongtien'];
    $addPN="INSERT INTO `phieunhap`(`MA_PN`, `MA_TK`, `NGAY_NHAP`, `TONG_DON_GIA`) VALUES ('$MA_PN','$MA_TK','$NGAY_NHAP','$TONG_TIEN') ";
    mysqli_query($connect,$addPN);
    header("Location:../index.php?manage=import");

}






?>