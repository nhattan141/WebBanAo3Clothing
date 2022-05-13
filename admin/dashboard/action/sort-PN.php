<?php
if(isset($_POST)){
    $ID_sort=$_POST['sortmaphieunhap'];
    header("Location:../index.php?manage=import&sortPN=$ID_sort");
}



?>