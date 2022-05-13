<?php
include("../../../db/MySQLConnect.php");
if(isset($_GET)){
$tensp=(empty($_GET['tensp']) )? "":$_GET['tensp'] ;
$giamin=(empty($_GET['giamin']) )? 00:$_GET['giamin'] ;
$giamax=(empty($_GET['giamax']) )? 999999:$_GET['giamax'] ;
$loai=($_GET['loai']=="Không" )? "":$_GET['loai'] ;
$size=($_GET['size']=="Không" )? "":$_GET['size'] ;
$search="SELECT * from sanpham WHERE TEN_SP LIKE  '%$tensp%'
 AND DON_GIA BETWEEN $giamin AND $giamax AND  LOAI_SP LIKE '%$loai%' AND KICH_THUOC LIKE '%$size%'" ;
 $result=mysqli_query($connect,$search);
    foreach ($result  as $product ):
 

   echo "<tr>
      <td>".$product['MA_SP']."</td>
      <td>".$product['TEN_SP']."</td>
      <td>".$product['SO_LUONG']."</td>
      <td>".$product['DON_GIA']."</td>
      <td>".$product['LOAI_SP']."</td>
      <td>".$product['KICH_THUOC']."</td>
      <td style='width:30%'>".$product['MO_TA'] ." </td>
      <td style='width:10%'>".$product['HINH_ANH_URL']."</td>
      <td>
          <a href='./action_update_manage_product.php?id=". $product['MA_SP']."' class='btn btn-primary'>Sửa</a>
      </td>
    </tr>";
  endforeach; 

}


?>