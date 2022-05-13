<?php
 function checkmail(){
    if(!empty($_POST)){
        $email =$_POST['email'];
        include("../db/MySQLConnect.php");

    //thuc hien truy van du lieu - chen du lieu vao database 2 bang taikhoan va khachhang
    $checkemail="SELECT * from taikhoan WHERE EMAIL='".$email."'  ";
    $data=array();
    $data= mysqli_fetch_array(mysqli_query($connect,$checkemail));
     if($data == null)     {    echo 1; exit();}
     else           { echo 0;exit();}  
    
    }
 }


?>