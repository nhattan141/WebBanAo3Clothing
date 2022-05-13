<?php
    $con = mysqli_connect("localhost", "root", "", "doanweb2");
    if(isset($_GET['mahd']) && isset($_GET['masp']) && isset($_GET['sl']) && isset($_GET['tgg']) && 
        isset($_GET['dg']) && isset($_GET['tt'])){
        $MAHD=$_GET['mahd'];
        $MASP=$_GET['masp'];
        $SL=$_GET['sl'];
        $TGG=$_GET['tgg'];
        $DG=$_GET['dg'];
        $STT=$_GET['tt'];
        $TT=(float)$DG*(float)$SL-(float)$TGG;
        $id=$MAHD;
        $sp=$MASP;
        $con -> set_charset("utf8");
        echo $TT;
        mysqli_query($con, "SET NAMES 'utf8");
        $sql="UPDATE chitiethoadon SET SO_LUONG = '$SL',TIEN_GIAM_GIA='$TGG',DON_GIA='$DG',THANH_TIEN='$TT'
                WHERE MA_HD = '$id' AND MA_SP= '$sp'";
                echo $sql;
        mysqli_query($con, $sql);
        header('location: index.php?manage=orders&chitiet=true&mahd='.$MAHD.'&tt='.$STT.'');
    }
?>