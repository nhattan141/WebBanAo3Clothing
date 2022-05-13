<?php
/*Load dữ liệu cho Sửa và Xoá*/
$action_permission = "./action/add_account.php";
$displayadd = 'block';
$displayupdate = 'none';
$displayblock = 'block';
$displayunblock = 'none';
$MA_TK = "";
$MA_GQ = "";
$TEN_DN = "";
$MK = "";
$TRANG_THAI = "";
$EMAIL = "";
$TEN_GQ = "";


if (isset($_GET['updatetk'])) {

  $displayupdate = 'block';
  $displayadd = 'none';
  $id_ma_tk = $_GET['updatetk'];

  $showAccount = "SELECT * FROM taikhoan WHERE MA_TK = '$id_ma_tk'";
  $data1 = mysqli_fetch_assoc(mysqli_query($connect, $showAccount));
  $MA_TK = $data1['MA_TK'];
  $MA_GQ = $data1['MA_GROUP_QUYEN'];
  $TEN_DN = $data1['TEN_DANG_NHAP'];
  $MK = $data1['MAT_KHAU'];
  $TRANG_THAI = $data1['STATUS'];
  $EMAIL = $data1['EMAIL'];

  $showPermission = "SELECT * FROM groupquyen WHERE MA_GROUP_QUYEN='$MA_GQ'";
  $data = mysqli_fetch_assoc(mysqli_query($connect, $showPermission));

  $TEN_GQ = $data['TEN_GROUP_QUYEN'];

  $action_permission = "./action/update_account.php";
  //$datePN=date_format($date,'d-m-Y');

}
if (isset($_GET['deletetk'])) {
  $matk = $_GET['deletetk'];
  echo '<div id="thongbaoxoa">
          <h1>Bạn có muốn xóa tài khoản có mã tài khoản là ' . $matk . ' không</h1>
          <button id="bt1" ><a href="./action/delete_account.php?deletetk=' . $matk . '">Có</a></button>
          <button id="bt2" ><a href="index.php?manage=accounts">Hủy</a></button>
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
        <h3>Bảng Tài Khoản <small>Chứa thông tin tài khoản</small></h3>
      </div>

      <div class="title_right">
       <!-- <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Tìm!</button>
            </span>
          </div>
        </div>-->
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <!-- Phieu Nhap-->
      <div class="col-md-8 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Thông Tin Tài Khoản </h2>
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
                  <th>MÃ TÀI KHOẢN</th>
                  <th>MÃ NHÓM QUYỀN</th>
                  <th>TÊN ĐĂNG NHẬP</th>
                  <th>MẬT KHẨU</th>
                  <th>TRẠNG THÁI</th>
                  <th>EMAIL</th>
                  <th>THAO TÁC</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $trangthai;
                $getAccount = "SELECT * FROM taikhoan";
                $Accounts = mysqli_query($connect, $getAccount);
                while ($Account = mysqli_fetch_array($Accounts)) {
                  if($Account['STATUS']=='1'){
                    $trangthai="Bình Thường";
                    $displayblock = 'block';
                    $displayunblock = 'none';
                  } else {
                    $trangthai = "Đã Khóa";
                    $displayunblock = 'block';
                    $displayblock = 'none';
                  }
                ?>
                  <tr>
                    <th scope="row"><?php echo $Account['MA_TK']  ?></th>
                    <td><?php echo $Account['MA_GROUP_QUYEN'] ?></td>
                    <td><?php echo $Account['TEN_DANG_NHAP'] ?></td>
                    <td><?php echo $Account['MAT_KHAU'] ?></td>
                    <td><?php echo $trangthai ?></td>
                    <td><?php echo $Account['EMAIL'] ?></td>
                    <td>
                      <button id="open-update-PN" type="button" class="btn btn-warning" onclick=''><a style="color: white;" href="index.php?manage=accounts&updatetk=<?php echo $Account['MA_TK'] ?>">Sửa</a></button>
                      <button type="submit" style="display:<?php echo $displayblock ?>" class="btn btn-success">
                        <a style="color: white;" href="index.php?manage=accounts&blockstt=<?php echo $Account['STATUS']?>&matk=<?php echo $Account['MA_TK'] ?>">Khóa</a>
                      </button>
                      <button type="submit" style="display:<?php echo $displayunblock?>; background: rgb(53, 166, 231);" class="btn btn-warning">
                        <a style="color: white;" href="index.php?manage=accounts&unblockstt=<?php echo $Account['STATUS'] ?>&matk=<?php echo $Account['MA_TK'] ?>">Mở Khóa</a>
                      </button>
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
            <h2>Thêm Tài Khoản</h2>
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

            <form action="<?php echo $action_permission ?>" method="get" id='form-account' >
              <div class="form-group">
                <input type="hidden" class="form-control" id="matk" placeholder="Nhập mã tài khoản" name="matk" value="<?php echo  $MA_TK ?>" require>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="manhomquyen">MÃ NHÓM QUYỀN:</label>
                  <select class="form-control" id="manhomquyen" name="manhomquyen">
                    <option value="<?php echo  $MA_GQ ?>" selected><?php echo  $TEN_GQ ?></option>
                    <?php $getMA_GROUP_QUYEN = mysqli_query($connect, "SELECT MA_GROUP_QUYEN,TEN_GROUP_QUYEN from groupquyen");
                    while ($row_GQ = mysqli_fetch_array($getMA_GROUP_QUYEN)) {       ?>
                      <?php if ($row_GQ['MA_GROUP_QUYEN'] !== $MA_GQ) : ?>
                        <option value="<?php echo $row_GQ['MA_GROUP_QUYEN'] ?>"><?php echo $row_GQ['TEN_GROUP_QUYEN'] ?></option>
                      <?php endif; ?>
                    <?php  } ?>
                  </select>
                  <span class="form-message" id="" style="color:red"></span>
                </div>
                <div class="form-group">
                  <label for="tendn">TÊN ĐĂNG NHẬP:</label>
                  <input type="text" class="form-control" id="tendn" placeholder="Nhập mã tài khoản" name="tendn" value="<?php echo  $TEN_DN ?>" require>
                  <span class="form-message" id="" style="color:red"></span>
                </div>
                <div class="form-group">
                  <label for="mk">MẬT KHẨU:</label>
                  <input type="text" class="form-control" id="mk" placeholder="Nhập mã tài khoản" name="mk" value="<?php echo  $MK ?>" require>
                  <span class="form-message" id="" style="color:red"></span>
                </div>
                <div class="form-group row">
                  <label for="trangthai">TRẠNG THÁI:</label>
                  <?php
                    $checked="";
                    $unchecked="";
                    $gettt = mysqli_query($connect, "SELECT STATUS from taikhoan WHERE MA_TK='$MA_TK'");
                    if ($gettt->num_rows > 0) {
                      while ($row = $gettt->fetch_assoc()) {
                        if ($row["STATUS"] == '1') {
                          $checked="checked" ;
                          $unchecked="";
                        } else if ($row["STATUS"] == '0') {
                          $unchecked="checked";
                          $checked="";
                        }
                      }
                    }
                  ?>
                  <input type="radio" <?php echo $checked;?> class="form-control" id="trangthai" name="trangthai" value="1" require>Bình Thường
                  <input type="radio" <?php echo $unchecked;?> class="form-control" id="trangthai" name="trangthai" value="0" require> Khóa
                  <span class="form-message" id="" style="color:red"></span>
                </div>
                <div class="form-group">
                  <label for="email">EMAIL:</label>
                  <input type="text" class="form-control" id="email" placeholder="Nhập mã tài khoản" name="email" value="<?php echo  $EMAIL ?>" require>
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
          form: '#form-account',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
           Validator.isRequired('#manhomquyen'),
           Validator.isRequired('#tendn'),
           Validator.isRequired('#mk'),
           Validator.isRequired('#trangthai'),
           Validator.isRequired('#email'),
           Validator.isEmail('#email'),
            Validator.minLength('#mk', 5),
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