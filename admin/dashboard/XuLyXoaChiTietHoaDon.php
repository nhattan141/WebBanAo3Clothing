<?php
    $con = mysqli_connect("localhost", "root", "", "doanweb2");
    if(isset($_GET['mahd']) & isset($_GET['xoa']) & isset($_GET['masp']) & isset($_GET['tt'])){
        $MAHD=$_GET['mahd'];
        $Xoa=$_GET['xoa'];
        $MASP=$_GET['masp'];
        $tt=$_GET['tt'];
        if($Xoa=='true'){
            $con -> set_charset("utf8");
            mysqli_query($con, "SET NAMES 'utf8");
            $sql="DELETE  FROM  chitiethoadon WHERE MA_HD = '$MAHD' AND MA_SP='$MASP'";
            mysqli_query($con, $sql);
            echo $sql;
            header("location: index.php?manage=orders&chitiet=true&mahd=$MAHD&tt=$tt");
        } 
    }
    mysqli_close($con);
?>