<?php
  session_start();
  include("../../db/MySQLConnect.php");
  if(isset( $_SESSION['admin_login']) ) $checklogin=$_SESSION['admin_login'];

  $getLoaiSP="SELECT DISTINCT sanpham.LOAI_SP FROM `sanpham`"	;
  $LoaiSP=mysqli_query($connect,$getLoaiSP);
  
  $id = $_GET['id'];
  

  $getSP="SELECT * FROM `sanpham` WHERE sanpham.MA_SP = $id"	;  
  $temp=mysqli_query($connect,$getSP);
  $SP = $temp->fetch_assoc();

  $errors = [];

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $Ma_SP = $SP['MA_SP'];
      $Ten_SP = $_POST['ten_sp'];
      $So_luong = $SP['SO_LUONG'];
      $Don_gia = $SP['DON_GIA'];
      $Loai = $_POST['loai'];
      $Kich_thuoc = $_POST['kich_thuoc'];
      $Mo_ta = $_POST['mo_ta'];
      $Hinh_anh=empty($_POST['hinh_anh'])?"no_img.jpg ":$_POST['hinh_anh'];
      // $Hinh_anh = $_POST['hinh_anh'] ?? "";
      
      // if(!$Ten_SP){
      //   $errors = 'Tên sản phẩm không hợp lệ';
      // }
      // if(!$Mo_ta){
      //   $errors = 'Mô tả không hợp lệ';
      // }
      // exit;
      $update="UPDATE `sanpham` SET `MA_SP`='$Ma_SP',`TEN_SP`= '$Ten_SP',`SO_LUONG`='$So_luong',
      `DON_GIA`='$Don_gia',`LOAI_SP`='$Loai',`KICH_THUOC`='$Kich_thuoc',`MO_TA`='$Mo_ta',
      `HINH_ANH_URL`='$Hinh_anh' WHERE `MA_SP`= $Ma_SP"	;

      $updateProduct=mysqli_query($connect,$update);
      // echo '<pre>'; 
      // var_dump($update);
      // var_dump($updateProduct);
      // echo '</pre>';
      // exit;
      header('Location: ./index.php?manage=products');
      exit;

  }

  // echo '<pre>'; 
  // var_dump($_POST);
  // echo '</pre>';
  // exit;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../../images/header-website.png" type="image/png" />  

    <title>Three Colthing | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script> 
  </head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
    <?php
        /*Navigation*/
        include("navigation.php");
        /* header */
        include("header.php");

        /*page content */


        if(!isset($_GET['manage'])) {
          require("overview.php"); }

          else if($_GET['manage']=='orders'){
              require("manage_order.php");
          }
          else if($_GET['manage']=='products'){
              require("manage_product.php");
          }
 
         else if($_GET['manage']=='accounts' ) {
             require("manage_account.php");
         }
        /* footer content */
        include("footer.php");

     ?>   
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Chỉnh sửa sản phẩm</h3>
              </div>

               <div class="title_right">
              
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Thông tin sản phẩm </h2>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                      
                        </ul>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

             
                    <form action= "" method = "post" id="update-form">
                      <div class = "form-group">
                        <label>Tên Sản Phẩm</label>
                        <br>
                        <input type = "text" name="ten_sp" id="tensp" clas = "form-control" value ="<?php echo $SP['TEN_SP']?>">
                        <span class="form-message" id="pass-confir-error" style="color:red"></span>
                      </div>
                      <div class = "form-group">
                        <label>Số lượng</label>
                        <br>
                        <input type = "text" name = "so_luong" clas = "form-control" value = <?php echo $SP['SO_LUONG']?> disabled>
                      </div>
                      <div class = "form-group">
                        <label>Đơn Giá</label>
                        <br>
                        <input type = "text" name = "don_gia"clas = "form-control" value = <?php echo $SP['DON_GIA']?> disabled>
                      </div>
                      <div class = "form-group">
                        <label for = "loai">Loại SP</label>
                        <br>
                        <select id="loai" name = "loai">
                        <option value= <?php echo $SP['LOAI_SP'] ?> selected><?php echo $SP['LOAI_SP'] ?></option>
                        <?php foreach ($LoaiSP as $loaisp): ?>
                          <?php if($loaisp['LOAI_SP'] !== $SP['LOAI_SP']): ?>
                            <option value= <?php echo $loaisp['LOAI_SP'] ?>><?php echo $loaisp['LOAI_SP'] ?></option>
                          <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                        
                      </div>
                      <div class = "form-group">
                        <label for="kich_thuoc">Kích Thước</label>
                        <br>
                        <select id="kich_thuoc" name = "kich_thuoc">
                          <option value=<?php echo $SP['KICH_THUOC']?> selected><?php echo $SP['KICH_THUOC']?></option>
                          <option value="S">S</option>
                          <option value="M">M</option>
                          <option value="L">L</option>

                        </select>
                      </div>
                      <div class = "form-group">
                        <label>Mô tả</label>
                        <br>
                        <textarea id="mota" name = "mo_ta" clas = "form-control"><?php echo $SP['MO_TA'] ?></textarea>
                        <span class="form-message" id="pass-confir-error" style="color:red"></span>
                      </div>
                      <div class = "form-group">
                        <label>Hình ảnh</label>
                        <br>
                        <input type = "file" name = "hinh_anh">
                      </div>

                      <?php if(!empty($errors)) :?>
                      <div class = "alert alert-danger">
                          <?php foreach($errors as $error): ?>
                            <div><?php echo $error?></div>
                          <?php endforeach; ?>
                      </div>
                      <?php endif;?>
                          <button type="submit" class="btn btn-sm btn-outline-danger">Xác Nhận</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        </div>
</div>
 <!-- jQuery -->
 <script>
      document.addEventListener('DOMContentLoaded', function () {
        Validator({
          form: '#update-form',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
           Validator.isRequired('#tensp'),
           Validator.isRequired('#mota'),
          ],
        });
      });

</script>
<script src="../../js/validate.js"></script>
 <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
