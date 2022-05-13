<?php
if(isset($_POST)){
    $datemin=$_POST['date_min'];
    $datemax=$_POST['date_max'];
    header("Location:../index.php?manage=import&sortdatemin=$datemin&sortdatemax=$datemax");
}



?>