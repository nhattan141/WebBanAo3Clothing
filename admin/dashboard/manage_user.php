<?php
/*Load dữ liệu cho Sửa và Xoá*/
$action_permission = "./action/add_user.php";
$displayadd = 'block';
$displayupdate = 'none';
$displayblock = 'block';
$displayunblock = 'none';
$MA_KH = "";
$MA_TK = "";
$TEN_KH = "";
$EMAIL = "";
$PHONE = "";
$GIOITINH = "";
$DIACHI = "";


if (isset($_GET['updatekh'])) {

  $displayupdate = 'block';
  $displayadd = 'none';
  $id_ma_tk = $_GET['updatekh'];

  $showAccount = "SELECT * FROM khachhang WHERE MA_KH = '$id_ma_tk'";
  $data1 = mysqli_fetch_assoc(mysqli_query($connect, $showAccount));
  $MA_KH = $data1['MA_KH'];
  $MA_TK = $data1['MA_TK'];
  $TEN_KH = $data1['TEN_KH'];
  $EMAIL = $data1['EMAIL'];
  $PHONE = $data1['PHONE'];
  $GIOITINH = $data1['GIOI_TINH'];
  $DIACHI = $data1['DIA_CHI'];

  $action_permission = "./action/update_user.php";
  //$datePN=date_format($date,'d-m-Y');

}
if (isset($_GET['deletekh'])) {
  $makh = $_GET['deletekh'];
  echo '<div id="thongbaoxoa">
          <h1>Bạn có muốn xóa khách hàng có mã khách hàng là ' . $makh . ' không</h1>
          <button id="bt1" ><a href="./action/delete_user.php?deletekh=' . $makh . '">Có</a></button>
          <button id="bt2" ><a href="index.php?manage=user">Hủy</a></button>
        </div>';
}
if (isset($_GET['blockstt']) && isset($_GET['matk'])) {
  $matk = $_GET['matk'];

  $block = "UPDATE `taikhoan` SET `STATUS`=0 WHERE MA_TK = '$matk'";
  mysqli_query($connect, $block);
}
if (isset($_GET['unblockstt']) && isset($_GET['matk'])) {
  $matk = $_GET['matk'];

  $block = "UPDATE `taikhoan` SET `STATUS`=1 WHERE MA_TK = '$matk'";
  mysqli_query($connect, $block);
}

?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Bảng Khách Hàng <small>Chứa thông tin khách hàng</small></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Tìm!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <!-- Phieu Nhap-->
      <div class="col-md-8 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Thông Tin Khách Hàng </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content" style="overflow: auto;">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>MÃ KHÁCH HÀNG</th>
                  <th>MÃ TÀI KHOẢN</th>
                  <th>TÊN KHÁCH HÀNG</th>
                  <th>EMAIL</th>
                  <th>PHONE</th>
                  <th>GIỚI TÍNH</th>
                  <th>ĐỊA CHỈ</th>
                  <th>THAO TÁC</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sex;
                $getUser = "SELECT * FROM khachhang";
                $Users = mysqli_query($connect, $getUser);
                while ($User = mysqli_fetch_array($Users)) {
                    if($User['GIOI_TINH']=='1'){
                        $sex="Nam";
                      } else if($User['GIOI_TINH']=='0'){
                        $sex = "Nữ";
                      } else if($User['GIOI_TINH']=='-1'){
                        $sex = "Khác";
                      }else $sex = $User['GIOI_TINH'];
                ?>
                  <tr>
                    <th scope="row"><?php echo $User['MA_KH']  ?></th>
                    <td><?php echo $User['MA_TK'] ?></td>
                    <td><?php echo $User['TEN_KH'] ?></td>
                    <td><?php echo $User['EMAIL'] ?></td>
                    <td><?php echo $User['PHONE'] ?></td>
                    <td><?php echo $sex ?></td>
                    <td><?php echo $User['DIA_CHI'] ?></td>
                    <td>
                      <button id="open-update-PN" type="button" class="btn btn-warning" onclick=''><a style="color: white;" href="index.php?manage=user&updatekh=<?php echo $User['MA_KH'] ?>">Sửa</a></button>
  
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Input Phieu Nhap-->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Thêm Khách Hàng</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="<?php echo $action_permission ?>" method="get" id="form-customer">
              <div class="form-group">
                <input type="hidden" class="form-control" id="makh" placeholder="Nhập mã khách hàng" name="makh" value="<?php echo  $MA_KH?>" require>
                <span class="form-message" id="" style="color:red"></span>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="matk">MÃ TÀI KHOẢN:</label>
                  <select class="form-control" id="matk" name="matk">
                    <option hidden value="<?php echo  $MA_TK ?>" selected><?php echo  $MA_TK ?></option>
                    <?php $getMA_TK = mysqli_query($connect, "SELECT MA_TK from taikhoan WHERE MA_GROUP_QUYEN=3");
                    while ($row_MA_TK = mysqli_fetch_array($getMA_TK)) {       ?>
                      <?php if ($row_MA_TK['MA_TK'] !== $MA_TK) : ?>
                        <option value="<?php echo $row_MA_TK['MA_TK'] ?>"><?php echo $row_MA_TK['MA_TK'] ?></option>
                      <?php endif; ?>
                    <?php  } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tenkh">TÊN KHÁCH HÀNG:</label>
                  <input type="text" class="form-control" id="tenkh" placeholder="Nhập tên khách hàng" name="tenkh" value="<?php echo  $TEN_KH ?>" require>
                  <span class="form-message" id="" style="color:red"></span>
                </div>
                <div class="form-group">
                  <label for="email">EMAIL:</label>
                  <input type="text" class="form-control" id="email" placeholder="Nhập email" name="email" value="<?php echo  $EMAIL ?>" require>
                  <span class="form-message" id="" style="color:red"></span>
                </div>
                <div class="form-group">
                  <label for="phone">PHONE:</label>
                  <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" name="phone" value="<?php echo $PHONE ?>" require>
                  <span class="form-message" id="" style="color:red"></span>
                </div>
                <div class="form-group">
                  <label for="sex">GIỚI TÍNH:</label>
                  <select class="form-control" id="sex" name="sex">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                    <option value="-1">Khác</option>
                  </select>
                  <span class="form-message" id="" style="color:red"></span>
                </div>
                <div class="form-group">
                  <label for="dc">ĐỊA CHỈ:</label>
                  <input type="text" class="form-control" id="dc" placeholder="Nhập địa chỉ" name="dc" value="<?php echo  $DIACHI ?>" require>
                  <span class="form-message" id="" style="color:red"></span>
                </div>
                <input type="hidden" name="oldName" value="<?php echo $TEN_DM ?>">
                <div id="button-add-PN" style="display:<?php echo $displayadd ?>">
                  <button type="submit" class="btn btn-success">Thêm</button>
                </div>
                <div id="button-update-PN" style="display:<?php echo $displayupdate ?>">
                  <button type="submit" class="btn btn-warning">Sửa</button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>

document.addEventListener('DOMContentLoaded', function () {
  Validator({
    form: '#form-customer',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
      Validator.isRequired('#tenkh'),  
      Validator.isRequired('#email'),  
      Validator.isRequired('#phone'),  
      Validator.isRequired('#dc'),  
      Validator.isEmail('#email'),  
      Validator.isPhoneNumber('#phone'),  
        

    ],
  });
});
</script>
<style>
  #thongbaoxoa {
    display: block;
    width: 500px;
    height: 200px;
    position: absolute;
    top: 150px;
    left: 35%;
    color: #73879C;
    background: rgb(230, 228, 228);
    z-index: 200;
    text-align: center;
  }

  #bt1 {
    width: 50px;
    height: 50px;
    position: absolute;
    bottom: 20px;
    left: 50px;
  }

  #bt2 {
    width: 50px;
    height: 50px;
    position: absolute;
    bottom: 20px;
    right: 50px;
  }
</style>