<?php
include("../../../db/MySQLConnect.php");
if(isset($_POST)){
    $MaPN=$_POST['maphieunhap'];
    $TenSP=$_POST['tensanpham'];
    $Loai=$_POST['loai'];
    $Mota=$_POST['mota'];
    $Dongia=$_POST['dongia'];
    $Size=$_POST['size'];
    $Soluong=$_POST['soluong'];
    $Url=$_POST['url'];

     # Thêm vào bàng Sản Phẩm
     $query2="INSERT INTO `sanpham`( `TEN_SP`, `SO_LUONG`, `DON_GIA`, `LOAI_SP`, `KICH_THUOC`, `MO_TA`, `HINH_ANH_URL`) 
     VALUES ('$TenSP','$Soluong','$Dongia','$Loai','$Size','$Mota','$Url')";
     mysqli_query($connect,$query2);

     $getID_SP="SELECT MA_SP FROM sanpham WHERE TEN_SP='$TenSP' AND DON_GIA='$Dongia' AND LOAI_SP='$Loai' AND KICH_THUOC='$Size'";
     echo $getID_SP;
     $result=mysqli_query($connect,$getID_SP);
     $MaSP=mysqli_fetch_assoc($result);

    #Thêm vào Chi Tiết Phiếu Nhập
    $query1="INSERT INTO `chitietphieunhap`( `MA_PN`,`MA_SP`, `DON_GIA`, `SIZE`, `SO_LUONG`) VALUES ('$MaPN','".$MaSP['MA_SP']."','$Dongia','$Size','$Soluong')";
    mysqli_query($connect,$query1);
    #check tong tien co dung ko
    #$query3="SELECT SUM(DON_GIA) AS TONGDONGIA FROM chitietphieunhap WHERE MA_PN=$MaPN";
    #$getTongDonGiaCTPN=mysqli_fetch_assoc(mysqli_query($connect,$query3));
    $query4="SELECT  TONG_DON_GIA FROM phieunhap WHERE MA_PN=$MaPN";
    $getTongDonGiaPN=mysqli_fetch_assoc(mysqli_query($connect,$query4));
    $TongTienPN=$getTongDonGiaPN['TONG_DON_GIA'] + $Dongia*$Soluong;
    $query3="UPDATE `phieunhap` SET `TONG_DON_GIA`='$TongTienPN' WHERE MA_PN='$MaPN'";
    mysqli_query($connect,$query3);
    header("Location:../index.php?manage=import#them-chi-tiet-phieu-nhap");


}





?>