<?php
include("../../../db/MySQLConnect.php");
if (isset($_GET['deletekh'])) {
    $id_ma_tk = $_GET['deletekh'];
    $delete = "DELETE  FROM khachhang WHERE MA_KH ='$id_ma_tk'";
  
    mysqli_query($connect, $delete);
    header("Location:../index.php?manage=user");
  }
?>