
<?php

include("../../../db/MySQLConnect.php");
/*update danh muc<>*/
if(isset($_GET) ){
    $Ten_DM=$_GET['Ten_danh_muc'];
    $MA_DM=$_GET['madanhmuc'];

    $updateQ="UPDATE `danhmuc` SET `MA_DANH_MUC`='$MA_DM',`TEN_DANH_MUC`='$Ten_DM' 
    WHERE `MA_DANH_MUC`='$MA_DM' ";
    
    mysqli_query($connect,$updateQ);
    header("Location:../index.php?manage=permission");

}






?>