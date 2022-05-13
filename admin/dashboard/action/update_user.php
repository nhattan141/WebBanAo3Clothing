
<?php

include("../../../db/MySQLConnect.php");
/*Thêm Phiếu Nhậ<>*/
if (isset($_GET)) {
    $MA_KH = $_GET['makh'];
    $MA_TK = $_GET['matk'];
    $TEN_KH = $_GET['tenkh'];
    $EMAIL = $_GET['email'];
    $PHONE = $_GET['phone'];
    $GIOITINH = $_GET['sex'];
    $DIACHI = $_GET['dc'];

    $updateQ = "UPDATE `khachhang` SET `MA_TK`=$MA_TK,
                                      `TEN_KH`='$TEN_KH',
                                      `EMAIL`='$EMAIL',
                                      `PHONE`='$PHONE',
                                      `GIOI_TINH`='$GIOITINH',
                                      `DIA_CHI`='$DIACHI'
    WHERE MA_KH = '$MA_KH' ";
    mysqli_query($connect, $updateQ);
    header("Location:../index.php?manage=user");
}
?>