<?php
include("../../../db/MySQLConnect.php");
/*Thêm Phiếu Nhậ<>*/
if(isset($_POST) ){
    $IDCTGG=$_POST['machitietgiamgia'];
    $MACTGG=$_POST['machuongtrinhgiamgia'];
    $MASP=$_POST['masanpham'];
   
    $addCTGG="INSERT INTO `chitietgiamgia`(`ID_CTGG`, `MA_CTGG`, `MA_SP`) VALUES ('$IDCTGG','$MACTGG','$MASP')";
    mysqli_query($connect,$addCTGG);
    header("Location:../index.php?manage=sale");

}




?>
  

