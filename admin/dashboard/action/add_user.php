<?php

include("../../../db/MySQLConnect.php");
/*Thêm khach hang<>*/
if(isset($_GET) ){
    $MA_KH = $_GET['makh'];
    $MA_TK = $_GET['matk'];
    $TEN_KH = $_GET['tenkh'];
    $EMAIL = $_GET['email'];
    $PHONE = $_GET['phone'];
    $GIOITINH = $_GET['sex'];
    $DIACHI = $_GET['dc'];

    $addQ="INSERT INTO `khachhang`(`MA_KH`, `MA_TK`, `TEN_KH`, `EMAIL`, `PHONE`, `GIOI_TINH`, `DIA_CHI`) 
    VALUES ('$MA_KH','$MA_TK','$TEN_KH','$EMAIL','$PHONE','$GIOITINH','$DIACHI') ";
    mysqli_query($connect,$addQ);
    header("Location:../index.php?manage=user");

}
