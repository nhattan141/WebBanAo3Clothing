<?php
if(isset($_POST)){
    $ID_sort=$_POST['SORTCTGG'];
    header("Location:../index.php?manage=sale&sortCTGG=$ID_sort");
}



?>