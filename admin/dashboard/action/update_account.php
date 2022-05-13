
<?php

include("../../../db/MySQLConnect.php");
/*Thêm Phiếu Nhậ<>*/
if (isset($_GET)) {
    $MA_TK = $_GET['matk'];
    $MA_GQ = $_GET['manhomquyen'];
    $TEN_DN = $_GET['tendn'];
    $MK = $_GET['mk'];
    $TRANG_THAI = $_GET['trangthai'];
    $EMAIL = $_GET['email'];

    $updateQ = "UPDATE `taikhoan` SET `MA_GROUP_QUYEN`=$MA_GQ,
                                      `TEN_DANG_NHAP`='$TEN_DN',
                                      `MAT_KHAU`='$MK',
                                      `STATUS`=$TRANG_THAI,
                                      `EMAIL`='$EMAIL'
    WHERE MA_TK = '$MA_TK' ";
    mysqli_query($connect, $updateQ);
    echo $updateQ;
    header("Location:../index.php?manage=accounts");
}
?>