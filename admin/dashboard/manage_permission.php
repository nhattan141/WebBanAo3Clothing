
<?php
    /*Load dữ liệu cho Sửa và Xoá*/        
          $action_permission="./action/add_permission.php";$displayadd='block';$displayupdate='none';
          $MA_GQ = "";
          $TEN_GQ = "";
          $MA_DM = "";
          $TEN_DM = "";
          
          if( !empty($_GET['updategq']) && !empty($_GET['updateq'])){

                  $displayupdate='block';$displayadd='none';
                  $id_group_permission=$_GET['updategq'];
                  $id_permssion = $_GET['updateq'];

                  $showPermission="SELECT * FROM groupquyen WHERE MA_GROUP_QUYEN='$id_group_permission'";
                  $data=mysqli_fetch_assoc(mysqli_query($connect,$showPermission));

                  $MA_GQ=$data['MA_GROUP_QUYEN'];
                  $TEN_GQ=$data['TEN_GROUP_QUYEN'];

                   

                  $showPermission="SELECT * FROM danhmuc WHERE MA_DANH_MUC = '$id_permssion'";
                  $data1=mysqli_fetch_assoc(mysqli_query($connect,$showPermission));
                  
                  $MA_DM=$data1['MA_DANH_MUC'];
                  $TEN_DM=$data1['TEN_DANH_MUC'];

                  $action_permission="./action/update_permission.php";
                //$datePN=date_format($date,'d-m-Y');

          }
          if(!empty($_GET['deleteq']) && !empty($_GET['deletegq']) ){
              $id_q=$_GET['deleteq'];
              $id_gq = $_GET['deletegq'];
              $delete="DELETE  FROM quyen WHERE MA_DANH_MUC ='$id_q' AND MA_GROUP_QUYEN = '$id_gq'";
              
              mysqli_query($connect,$delete);
      }
      // ==================================Danh Mục ===============================================
      $action_danhmuc="./action/add_danhmuc.php";$displayaddDM='block';$displayupdateDM='none';
      $MA_DanhMuc = "";
      $Ten_DanhMuc = "";
      if( !empty($_GET['updateDM'])){

        $displayupdateDM='block';$displayaddDM='none';
        $id_DM = $_GET['updateDM'];

        $showDM="SELECT * FROM danhmuc WHERE MA_DANH_MUC = '$id_DM'";
        $data1=mysqli_fetch_assoc(mysqli_query($connect,$showDM));
        
        $MA_DanhMuc=$data1['MA_DANH_MUC'];
        $Ten_DanhMuc=$data1['TEN_DANH_MUC'];

        $action_danhmuc="./action/update_danhmuc.php";
      }
        if(!empty($_GET['deleteDM'])){
          $id_DM=$_GET['deleteDM'];
          $deleteDM="DELETE FROM `danhmuc` WHERE `MA_DANH_MUC` = '$id_DM'";
          
          $test = mysqli_query($connect,$deleteDM);
           
        }



?>   
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Bảng Nhóm Quyền <small>Chứa thông tin các nhóm quyền</small></h3>
              </div>

              <div class="title_right">
              <!--  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
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
                    <h2>Thông Tin Nhóm Quyền </h2>
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

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>MÃ NHÓM QUYỀN</th>
                          <th>MÃ DANH MỤC</th>
                          <th>TÊN NHÓM QUYỀN</th>
                          <th>TÊN QUYỀN</th>
                          <th>THAO TÁC</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                            $getPermission="SELECT q.MA_DANH_MUC , q.TEN_QUYEN , gq.MA_GROUP_QUYEN , gq.TEN_GROUP_QUYEN
                            FROM quyen as q
                            INNER JOIN groupquyen as gq ON q.MA_GROUP_QUYEN = gq.MA_GROUP_QUYEN";
                            $Permissions = mysqli_query($connect,$getPermission);
                            while($Permission=mysqli_fetch_array($Permissions)){
                        ?>
                         <a href="">
                        <tr>
                          <th scope="row"><?php echo $Permission['MA_GROUP_QUYEN']  ?></th>
                          <td><?php echo $Permission['MA_DANH_MUC'] ?></td>
                          <td><?php echo $Permission['TEN_GROUP_QUYEN'] ?></td>
                          <td><?php echo $Permission['TEN_QUYEN'] ?></td>
                          <td>
                            <button id="open-update-PN" type="button" class="btn btn-warning"onclick='' ><a href="index.php?manage=permission&updategq=<?php echo $Permission['MA_GROUP_QUYEN']?>&updateq=<?php echo $Permission['MA_DANH_MUC']?>">Sửa</a></button>
                            <button id="open-delete-PN"type="button" class="btn btn-danger" onclick="askDeleteReciept() "><a href="index.php?manage=permission&deletegq=<?php echo $Permission['MA_GROUP_QUYEN']?>&deleteq=<?php echo $Permission['MA_DANH_MUC'] ?>">Xoá</a></button>
                          </td>

                        </tr>
                        </a>
                       <?php
                            }
                        ?>
                      </tbody>
                    </table>
                        
                  </div>
                </div>
              </div>
               <!-- Input Phieu Nhap-->
               <div class="col-md-4 col-sm-6 col-xs-12" >
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cập Nhật Nhóm Quyền</h2>
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
                  <div class="x_content" >
                         
                <form action="<?php echo $action_permission ?>" method="get" id='form-nhomquyen'>
                    <div class="form-group">
                    <label for="manhomquyen">MÃ NHÓM QUYỀN:</label>
                    <select class="form-control" id="manhomquyen" name="manhomquyen">
                    <?php $getMA_GROUP_QUYEN = mysqli_query($connect,"SELECT MA_GROUP_QUYEN,TEN_GROUP_QUYEN from groupquyen");
                      while($row_GQ= mysqli_fetch_array($getMA_GROUP_QUYEN)) {       ?>
                      <?php if($row_GQ['MA_GROUP_QUYEN'] !== $MA_GQ): ?>
                      <option value="<?php echo $row_GQ['MA_GROUP_QUYEN']?>"><?php echo $row_GQ['TEN_GROUP_QUYEN']?></option>
                      <?php endif; ?>
                      <?php if($row_GQ['MA_GROUP_QUYEN'] == $MA_GQ): ?>
                        <option value="<?php echo $row_GQ['MA_GROUP_QUYEN']?>" selected><?php echo $row_GQ['TEN_GROUP_QUYEN']?></option>
                      <?php endif; ?>
                    <?php  } ?>
                    </select>
                    <span class="form-message" id="" style="color:red"></span>
                    </div>
                    <div class="form-group">

                    <label for="maquyen">MÃ QUYỀN:</label>
                    <select class="form-control" id="maquyen" name="maquyen">
                    <?php $getMA_QUYEN=mysqli_query($connect,"SELECT MA_DANH_MUC,TEN_DANH_MUC from danhmuc");
                      while($row_Quyen= mysqli_fetch_array($getMA_QUYEN)) {       ?>
                      <?php if($row_Quyen['MA_DANH_MUC'] !== $MA_DM): ?>
                      <option value="<?php echo $row_Quyen['MA_DANH_MUC']?>"><?php echo $row_Quyen['TEN_DANH_MUC']?></option>
                      <?php endif; ?>
                      <?php if($row_Quyen['MA_DANH_MUC'] == $MA_DM): ?>
                      <option value="<?php echo $row_Quyen['MA_DANH_MUC']?>" selected><?php echo $row_Quyen['TEN_DANH_MUC']?></option>
                      <?php endif; ?>
                    <?php  } ?>
                    </select>
                    <span class="form-message" id="" style="color:red"></span>
                    </div>
                    <div id="button-add-PN" style="display:<?php echo $displayadd ?>">
                    <button type="submit"  class="btn btn-success">Thêm</button>
                    </div>
                    <div id="button-update-PN" style="display:<?php echo $displayupdate ?>">
                    <button type="submit"  class="btn btn-warning">Sửa</button>
                    </div>

                </form>
                </div>
                </div>
              </div>
<!--============================================================Thong tin danh muc ================================================-->
<!--============================================================Thong tin danh muc ================================================-->
<!--============================================================Thong tin danh muc ================================================-->

            <!-- Danh Muc-->
              <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Thông Tin Danh Mục </h2>
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

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>MÃ DANH MỤC</th>
                          <th>TÊN DANH MỤC</th>
                          <th>THAO TÁC</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                            $getDM="SELECT * FROM danhmuc";
                            $ListDanhmuc = mysqli_query($connect,$getDM);
                            while($Danhmuc=mysqli_fetch_array($ListDanhmuc)){
                        ?>
                         <a href="">
                        <tr>
                          <th scope="row"><?php echo $Danhmuc['MA_DANH_MUC']  ?></th>
                          <td><?php echo $Danhmuc['TEN_DANH_MUC'] ?></td>
                          <td>
                            <button id="open-update-PN" type="button" class="btn btn-warning"onclick='' ><a href="index.php?manage=permission&updateDM=<?php echo $Danhmuc['MA_DANH_MUC']?>">Sửa</a></button>
                            <button id="open-delete-PN"type="button" class="btn btn-danger" onclick="askDeleteReciept()"><a href="index.php?manage=permission&deleteDM=<?php echo $Danhmuc['MA_DANH_MUC']?>">Xoá</a></button>
                          </td>

                        </tr>
                        </a>
                       <?php
                            }
                        ?>
                      </tbody>
                    </table>
                        
                  </div>
                </div>
              </div>
               <!-- Input Phieu Nhap-->
               <div class="col-md-4 col-sm-6 col-xs-12" >
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cập Nhật Danh Mục Quyền</h2>
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
                  <div class="x_content" >
                         
                <form action="<?php echo $action_danhmuc ?>" method="get" id="form-danh-muc">

                    <div class="form-group">
                    <label for="pwd">TÊN DANH MỤC: </label>
                    <input type="text" class="form-control" id="Ten_danh_muc" name="Ten_danh_muc" value="<?php echo $Ten_DanhMuc ?>">
                    <span class="form-message" id="" style="color:red"></span>
                    </div>

                    <div class="form-group">
                    <input  type="hidden" name="madanhmuc" value="<?php echo $MA_DanhMuc?>"/>
                    </div>

                    <div id="button-add-PN" style="display:<?php echo $displayaddDM ?>">
                    <button type="submit"  class="btn btn-success">Thêm</button>
                    </div>
                    <div id="button-update-PN" style="display:<?php echo $displayupdateDM ?>">
                    <button type="submit"  class="btn btn-warning">Sửa</button>
                    </div>

                </form>
                </div>
                </div>
              </div>
              
              <script>

      document.addEventListener('DOMContentLoaded', function () {
        Validator({
          form: '#form-danh-muc',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
           Validator.isRequired('#Ten_danh_muc'),    

          ],
        });
      });
</script>