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
    $updateGG="UPDATE `chuongtrinhgiamgia` SET `TEN_CHUONG_TRINH`='$TenGG',`LOAI_CHUONG_TRINH`='$LoaiGG',
    `ND_GIAM_GIA`='$NDGG',`PHAN_TRAM_GIAM_GIA`='$PhanTramGG',`NGAY_BAT_DAU`='$datemin',`NGAY_KET_THUC`='$datemax' WHERE MA_CTGG='$MaGG'";
    mysqli_query($connect,$updateGG);
    header("Location:../index.php?manage=sale");

}




?>