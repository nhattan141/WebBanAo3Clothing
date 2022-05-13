<?php

include("../../../db/MySQLConnect.php");
/*Thêm tài khoản<>*/
if(isset($_GET) ){
    $MA_TK = $_GET['matk'];
    $MA_GQ = $_GET['manhomquyen'];
    $TEN_DN = $_GET['tendn'];
    $MK = $_GET['mk'];
    $TRANG_THAI = $_GET['trangthai'];
    $EMAIL = $_GET['email'];

    $addQ="INSERT INTO `taikhoan`(`MA_TK`, `MA_GROUP_QUYEN`, `TEN_DANG_NHAP`, `MAT_KHAU`, `STATUS`, `EMAIL`) 
    VALUES ('$MA_TK','$MA_GQ','$TEN_DN','$MK','$TRANG_THAI','$EMAIL') ";
    mysqli_query($connect,$addQ);
    
    header("Location:../index.php?manage=accounts");

}
