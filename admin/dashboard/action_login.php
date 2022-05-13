<?php
session_start();
    if(isset($_POST) && !empty($_POST) ){
        $name=$_POST['name'];
        $password=$_POST['password'];
       // $password=md5($password);
        include(" ../../../../db/MySQLConnect.php");
        $query="SELECT TEN_DANG_NHAP,MAT_KHAU,MA_GROUP_QUYEN FROM `taikhoan` WHERE MA_GROUP_QUYEN !=3 AND STATUS = 1  GROUP BY TEN_DANG_NHAP";
        $result=mysqli_query($connect,$query);
        $check=false;
        while($data=mysqli_fetch_array($result) ){
                if($data['TEN_DANG_NHAP']==$name && $data['MAT_KHAU']==$password) {
                    $check=true; $name=$data['TEN_DANG_NHAP'];
                    $temp=$data['MA_GROUP_QUYEN'];
                }
                
        }        
        if( $check==true ){
            $_SESSION['id_nhom_quyen']=$temp;
			$_SESSION['admin_name']=$name;
			$_SESSION['admin_login']=true;
            
            echo 1;
            exit();
		}
        else  {
			$_SESSION['admin_login']=false;
            echo 0;
            exit();
		}
    }


?>