
<?php
      session_start();
      $checklogin;
     function login() { 
         if(!empty($_POST) &&isset($_POST)){
            $password =$_POST['password'];
            $password=md5($password);
            $email =$_POST['email'];

          
        $connect =new mysqli("localhost","root","","doanweb2");
        $connect -> set_charset("utf8");
        //kiem tra ket noi
        if($connect->connect_error){
            //var_dump($connect->connect_error);
            die();
        }

        //thuc hien truy van du lieu - chen du lieu vao database
        $query="SELECT  EMAIL, MAT_KHAU,TEN_DANG_NHAP FROM taikhoan WHERE EMAIL= '".$email."' AND MAT_KHAU ='".$password."'";
        $checkname ="SELECT TEN_DANG_NHAP FROM taikhoan WHERE EMAIL= '".$email."' AND MAT_KHAU ='".$password."'";
        $result=mysqli_query($connect,$query);
        $resultname =mysqli_query($connect,$checkname);
        //var_dump($result);
        $data=array();
        while($row = mysqli_fetch_array($result,1)){
            $data[] =$row;
        }
        //Lấy Tên Người Dùng
        $username = mysqli_fetch_assoc($resultname);
        $name=$username['TEN_DANG_NHAP'];
        //dong kêt nối
         $connect->close();
        if($data!=null && count($data)>0){
            $_SESSION['customer_name'] = $name;//lay tên người dùng
            $_SESSION['login']=true;
            echo 1;
            exit() ;
            //header("Location: ../index.php");// có thể bỏ dn= true vì người dùng có thể sữa dn thành false hoặc true 
        }
        else{
            echo 0;
            exit() ;
            $_SESSION['login']=false;
            }
        }
           
    }
    login();
?>

