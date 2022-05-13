
<?php

include("../../../db/MySQLConnect.php");
/*Thêm Phiếu Nhậ<>*/
if(isset($_GET) ){
    $MA_GQ=$_GET['manhomquyen'];
    $MA_Q=$_GET['maquyen'];

    $data = mysqli_fetch_assoc(mysqli_query($connect , "SELECT TEN_DANH_MUC FROM danhmuc WHERE MA_DANH_MUC = '$MA_Q'"));
    $TEN_DANH_MUC = $data['TEN_DANH_MUC'];

    $addQ="INSERT INTO `quyen`(`MA_GROUP_QUYEN`, `MA_DANH_MUC`, `TEN_QUYEN`) VALUES ('$MA_GQ','$MA_Q','$TEN_DANH_MUC') ";
    mysqli_query($connect,$addQ);
    header("Location:../index.php?manage=permission");

}

?>