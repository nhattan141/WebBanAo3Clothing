<?php
include("../../../db/MySQLConnect.php");
/*Thêm Phiếu Nhậ<>*/
if(isset($_POST) ){
    $IDCTGG=$_POST['machitietgiamgia'];
    $MACTGG=$_POST['machuongtrinhgiamgia'];
    $MASP=$_POST['masanpham'];
   
    $updateCTGG="UPDATE `chitietgiamgia` SET `MA_CTGG`='$MACTGG',`MA_SP`='$MASP' WHERE ID_CTGG=$IDCTGG";
    mysqli_query($connect,$updateCTGG);
    header("Location:../index.php?manage=sale");

}




?>
  

