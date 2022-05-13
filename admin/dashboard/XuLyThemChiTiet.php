<?php
    $con = mysqli_connect("localhost", "root", "", "doanweb2");
    
    if(isset($_GET['mahd']) && isset($_GET['masp']) && isset($_GET['sl']) && isset($_GET['tgg']) && isset($_GET['dg'])){
    $MAHD=$_GET['mahd'];    
    $MASP=$_GET['masp'];
    $SOLUONG=$_GET['sl'];
    $TIENGG=$_GET['tgg'];
    $DONGIA=$_GET['dg'];
    $THANHTIEN=$DONGIA*$SOLUONG-$TIENGG;
    $con -> set_charset("utf8");
    mysqli_query($con, "SET NAMES 'utf8");
    
    $sqltimkiemmasp="SELECT * FROM chitiethoadon WHERE MA_HD='$MAHD' AND MA_SP='$MASP'";
    $rs=mysqli_query($con, $sqltimkiemmasp);
    $sql;
    
    $slmoi = $SOLUONG;
    if($rs->num_rows > 0){
        while ($row = $rs->fetch_assoc()) {
            $slmoi += $row["SO_LUONG"];
        }
        echo $slmoi;
        echo '<br>';
        $sql="UPDATE chitiethoadon SET SO_LUONG = '$slmoi', THANH_TIEN = '$THANHTIEN'
                WHERE MA_HD = '$MAHD' AND MA_SP= '$MASP'";
    } else if(mysqli_num_rows($rs)==0){
        $sql="INSERT INTO chitiethoadon(MA_HD,MA_SP,SO_LUONG,TIEN_GIAM_GIA,DON_GIA, THANH_TIEN)
                VALUE('$MAHD','$MASP','$SOLUONG','$TIENGG','$DONGIA','$THANHTIEN')";
    }
    echo $sql;
    mysqli_query($con, $sql);
    header("location: index.php?manage=orders");
}
?>