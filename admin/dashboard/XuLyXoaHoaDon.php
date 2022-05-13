<?php
    $con = mysqli_connect("localhost", "root", "", "doanweb2");
    if(isset($_GET['mahd']) & isset($_GET['xoa'])){
        $MAHD=$_GET['mahd'];
        $Xoa=$_GET['xoa'];
        if($Xoa=='true'){
            $con -> set_charset("utf8");
            mysqli_query($con, "SET NAMES 'utf8");
            $sql="DELETE  FROM  hoadon WHERE MA_HD = '$MAHD'";
            mysqli_query($con, $sql);
            echo $sql;
        }
        header('location: index.php?manage=orders');
    }
   
    mysqli_close($con);
?>