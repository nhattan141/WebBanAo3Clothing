<?php
include("../../../db/MySQLConnect.php");
/*Thêm Phiếu Nhậ<>*/
if(isset($_GET) ){
    $MaGG=$_GET['ID_CTGG'];
    $TenGG=$_GET['Name_CTGG'];
    $LoaiGG=$_GET['Type_CTGG'];
    $NDGG=$_GET['Content_CTGG'];
    $PhanTramGG=$_GET['Percent_CTGG'];
    $datemin=$_GET['Day_Start_CTGG'];
    $datemax=$_GET['Day_End_CTGG'];
    $addGG="INSERT INTO `chuongtrinhgiamgia`( `TEN_CHUONG_TRINH`, `LOAI_CHUONG_TRINH`, `ND_GIAM_GIA`, `PHAN_TRAM_GIAM_GIA`, `NGAY_BAT_DAU`, `NGAY_KET_THUC`)
     VALUES ('$TenGG','$LoaiGG','$NDGG','$PhanTramGG','$datemin','$datemax')";
    mysqli_query($connect,$addGG);
    header("Location:../index.php?manage=sale");

}




?>
  

