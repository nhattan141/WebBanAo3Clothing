
<?php

include("../../../db/MySQLConnect.php");
/*Thêm Phiếu Nhậ<>*/
if(isset($_GET) ){
    $MA_GQ=$_GET['manhomquyen'];
    $MA_Q=$_GET['maquyen'];

    $Old_Ten =$_GET['oldName'];

    $data = mysqli_fetch_assoc(mysqli_query($connect , "SELECT TEN_DANH_MUC FROM danhmuc WHERE MA_DANH_MUC = '$MA_Q'"));
    $TEN_DANH_MUC = $data['TEN_DANH_MUC'];
    

    $updateQ="UPDATE `quyen` SET `MA_GROUP_QUYEN`=$MA_GQ,`MA_DANH_MUC`=$MA_Q,`TEN_QUYEN`='$TEN_DANH_MUC' 
    WHERE MA_GROUP_QUYEN = '$MA_GQ' AND TEN_QUYEN = '$Old_Ten' ";
    mysqli_query($connect,$updateQ);
    header("Location:../index.php?manage=permission");

}






?>