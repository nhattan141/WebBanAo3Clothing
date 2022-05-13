<?php
    $con = mysqli_connect("localhost", "root", "", "doanweb2");
    if(isset($_GET['mahd']) && isset($_GET['manv']) && isset($_GET['makh']) && 
        isset($_GET['dc']) && isset($_GET['sdt']) && isset($_GET['tt']) && isset($_GET['ngaylap'])){
        $MAHD=$_GET['mahd'];
        $MANV=$_GET['manv'];
        $MKH=$_GET['makh'];
        $DC=$_GET['dc'];
        $SDT=$_GET['sdt'];
        $TT=$_GET['tt'];
        $NGAY=$_GET['ngaylap'];
        $con -> set_charset("utf8");
        mysqli_query($con, "SET NAMES 'utf8");
        $sql="UPDATE hoadon SET MA_NV = '$MANV', MA_KH = '$MKH',
                    DIA_CHI='$DC',SODIENTHOAI = '$SDT',TINH_TRANG='$TT',NGAY_LAP='$NGAY'
                WHERE MA_HD = '$MAHD'";
        mysqli_query($con, $sql);
        echo $sql;
    }
    header('location: index.php?manage=orders&');
?>