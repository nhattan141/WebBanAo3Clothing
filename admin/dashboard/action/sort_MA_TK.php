<?php
if(isset($_POST)){
    $ID_sort=$_POST['sortmataikhoan'];
    header("Location:../index.php?manage=import&sortTK=$ID_sort");
}



?>