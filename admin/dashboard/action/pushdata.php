<?php
 if(!empty($_GET['Day_Start']) && !empty($_GET['Day_End']) && !empty($_GET['count'])){
    $StartDay= $_GET['Day_Start'];
    $EndDay= $_GET['Day_End'];
    $Count=$_GET['count'];
    header("Location:../index.php?manage=thongke&Day_Start=$StartDay&Day_End=$EndDay&count=$Count");
}



?>