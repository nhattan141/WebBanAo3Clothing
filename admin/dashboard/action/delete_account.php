<?php
include("../../../db/MySQLConnect.php");
if (isset($_GET['deletetk'])) {
    $id_ma_tk = $_GET['deletetk'];
    $delete = "DELETE  FROM taikhoan WHERE MA_TK ='$id_ma_tk'";
  
    mysqli_query($connect, $delete);
    echo $delete;
    header("Location:../index.php?manage=accounts");
  }
?>