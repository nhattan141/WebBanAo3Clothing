<?php
    $con = mysqli_connect("localhost", "root", "", "doanweb2");
    if(isset($_GET['mhd']) && isset($_GET['manv']) && isset($_GET['makh'])  && 
    isset($_GET['dc']) && isset($_GET['sdt']) && isset($_GET['tt']) &&  
    isset($_GET['tongtien']) && isset($_GET['ngaylap'])){
        $MAHD=$_GET['mhd'];
        $MANV=$_GET['manv'];
        $MKH=$_GET['makh'];
        $DC=$_GET['dc'];
        $SDT=$_GET['sdt'];
        $TT=$_GET['tt'];
        $TONG=$_GET['tongtien'];
        $NGAY=$_GET['ngaylap'];
        $con -> set_charset("utf8");
        mysqli_query($con, "SET NAMES 'utf8");
        $sql="INSERT INTO hoadon(MA_NV,MA_KH,DIA_CHI,SODIENTHOAI,TINH_TRANG,TONG_TIEN,NGAY_LAP)
             VALUE('$MANV','$MKH','$DC','$SDT','$TT','$TONG','$NGAY')";
        mysqli_query($con, $sql);
        echo $sql;
        header('location: index.php?manage=orders');
    }
?>