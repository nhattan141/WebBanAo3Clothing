
<?php

include("../../../db/MySQLConnect.php");
/*Thêm danh muc<>*/
if(isset($_GET) ){
    $Ten_DM=$_GET['Ten_danh_muc'];

    $addDM="INSERT INTO `danhmuc`(`MA_DANH_MUC`, `TEN_DANH_MUC`) VALUES (null,'$Ten_DM') ";
    mysqli_query($connect,$addDM);
    header("Location:../index.php?manage=permission");
    

}

?>