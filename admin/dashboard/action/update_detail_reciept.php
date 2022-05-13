<?php
include("../../../db/MySQLConnect.php");
if(isset($_POST)){
    $MaCTPN=$_POST['sua_machitietphieunhap'];
    $MaPN=$_POST['sua_maphieunhap'];
    $MaSP=$_POST['sua_masanpham'];
    $Dongia=$_POST['sua_dongia'];
    $Size=$_POST['sua_size'];
    $Soluong=$_POST['sua_soluong'];

     # Update ChiTietPhieuNhap
     $query1="UPDATE `chitietphieunhap` 
     SET `MA_PN`='$MaPN',`MA_SP`='$MaSP',`DON_GIA`='$Dongia',`SIZE`='$Size',`SO_LUONG`='$Soluong' WHERE MA_CTPN='$MaCTPN'";
     echo $query1;
    mysqli_query($connect,$query1);
    #check tong tien co dung ko
    #get TongTienChiTietPhieuNhap
    $query3="SELECT SUM(DON_GIA*SO_LUONG) AS TONGDONGIA FROM chitietphieunhap WHERE MA_PN=$MaPN";
    $getTongDonGiaCTPN=mysqli_fetch_assoc(mysqli_query($connect,$query3));
    #get TongTienPhieuNhap
    $query4="SELECT  TONG_DON_GIA FROM phieunhap WHERE MA_PN=$MaPN";
    $getTongDonGiaPN=mysqli_fetch_assoc(mysqli_query($connect,$query4));
    //echo $getTongDonGiaCTPN['TONGDONGIA'];
    //echo $getTongDonGiaPN['TONG_DON_GIA'];
    if($getTongDonGiaCTPN['TONGDONGIA'] != $getTongDonGiaPN['TONG_DON_GIA']) 
     {
          if($getTongDonGiaCTPN['TONGDONGIA'] > $getTongDonGiaPN['TONG_DON_GIA']) 
                $TongTienPN=$getTongDonGiaPN['TONG_DON_GIA'] + ( $getTongDonGiaCTPN['TONGDONGIA'] - $getTongDonGiaPN['TONG_DON_GIA']);
          else  $TongTienPN=$getTongDonGiaPN['TONG_DON_GIA'] - ( $getTongDonGiaPN['TONG_DON_GIA'] - $getTongDonGiaCTPN['TONGDONGIA'] );
          
      $query5="UPDATE `phieunhap` SET `TONG_DON_GIA`='$TongTienPN' WHERE MA_PN='$MaPN'";
      mysqli_query($connect,$query5);
     // echo $getTongDonGiaCTPN['TONGDONGIA'] - $getTongDonGiaPN['TONG_DON_GIA'];
     // echo $TongTienPN;
     }

   header("Location:../index.php?manage=import#button-update-PN");


}





?>