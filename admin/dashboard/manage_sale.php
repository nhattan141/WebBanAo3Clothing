
<?php
               $actionPN="./action/add_sale.php";$displayadd='block';$displayupdate='none';$showMaPN="";$showMaTK="";$showTien="";$date="";
               $showMaCTGG="";$showTenCTGG="";$showLoaiCTGG="";$showNDCTGG=""; $showPhanTramCTGG="";$datemin= ""; $datemax="";
               if(isset($_GET['update']) && !empty($_GET['update']) ){
                       $displayupdate='block';$displayadd='none';
                       $id_CTGG=$_GET['update'];
                       $showCTGG="SELECT * FROM chuongtrinhgiamgia WHERE MA_CTGG='$id_CTGG'";
                       $dataCTGG=mysqli_fetch_assoc(mysqli_query($connect,$showCTGG));
                       $showMaCTGG=$dataCTGG['MA_CTGG'];
                       $showTenCTGG=$dataCTGG['TEN_CHUONG_TRINH'];
                       $showLoaiCTGG=$dataCTGG['LOAI_CHUONG_TRINH'];
                       $showNDCTGG=$dataCTGG['ND_GIAM_GIA'];
                       $showPhanTramCTGG=$dataCTGG['PHAN_TRAM_GIAM_GIA'];
                       $datemin=$dataCTGG['NGAY_BAT_DAU'];
                       $datemax=$dataCTGG['NGAY_KET_THUC'];
                       $actionPN="./action/update_sale.php";
                       //$datePN=date_format($date,'d-m-Y');

               }
               if(isset($_GET['delete']) && !empty($_GET['delete']) ){
                   $id_CTGG=$_GET['delete'];
                   $deleteGG="DELETE  FROM chuongtrinhgiamgia WHERE MA_CTGG='$id_CTGG'";
                   $deleteCTGG="DELETE  FROM chitietgiamgia WHERE MA_CTGG='$id_CTGG'";
                   echo $id_CTGG;
                   if($_COOKIE['checkdeleteGG']=='true' ) {mysqli_query($connect,$deleteGG);
                   mysqli_query($connect,$deleteCTGG);}
           }
           

                    
?>   
                          

        <!-- page content -->
    <div class="right_col" role="main">
    <
        <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>CHƯƠNG TRÌNH GIẢM GIÁ <small>Chứa thông tin nội dung giảm giá</small></h3>
              </div>

              <div class="title_right">
              
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            <!-- Phieu Nhap-->
              <div class="col-md-12 col-sm-12 col-xs-12" >
                  <div class="x_panel">
                    <div class="x_title">
                        <h2>Cập Nhật Chương Trình Giảm Giá</h2>
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
                          
                      <form method="get" action ="<?php echo $actionPN ?>" id='form-add-chuong-trinh-giam-gia'>
                        <div class="form-row">
                           
                            <input type="hidden" class="form-control" id="ID_CTGG" placeholder="Không được nhập" name="ID_CTGG" value="<?php echo $showMaCTGG ?>">
                   
                            <div class="col-md-4 col-sm-12 form-group">
                            <label for="Name_CTGG">TÊN TRÌNH GIẢM GIÁ</label>
                            <input type="text" class="form-control" id="Name_CTGG" placeholder="Nhập Tên Chương Trình" name="Name_CTGG" value="<?php echo $showTenCTGG?>">
                            <span class="form-message" style="color:red"></span>
                            </div>
                            <div class="col-md-4 col-sm-12 form-group">
                            <label for="Type_CTGG">LOẠI CHƯƠNG TRÌNH GIẢM GIÁ</label>
                            <input type="text" class="form-control" id="Type_CTGG" placeholder="Nhập Loại Chương trình" name="Type_CTGG" value="<?php echo $showLoaiCTGG ?>">
                            <span class="form-message" style="color:red"></span>
                            </div>
                          
                            <div class="col-md-4 col-sm-12 form-group ">
                            <label for="Percent_CTGG">PHẦN TRĂM CHƯƠNG TRÌNH GIẢM GIÁ</label>
                            <input type="text" class="form-control" id="Percent_CTGG" placeholder="Nhập phần trăm giảm giá" name="Percent_CTGG" value="<?php echo $showPhanTramCTGG ?>">
                            <span class="form-message" style="color:red"></span>
                            </div>
                            <div class="col-md-4 col-sm-12 form-group">
                            <label for="Day_Start_CTGG">NGÀY BẮT ĐẦU CHƯƠNG TRÌNH GIẢM GIÁ</label>
                            <input type="date" class="form-control" id="Day_Start_CTGG" placeholder="yyyy-mm-dd" name="Day_Start_CTGG" value="<?php echo $datemin ?>">
                            <span class="form-message" style="color:red"></span>
                            </div>
                            <div class="col-md-4 col-sm-12 form-group">
                            <label for="Day_End_CTGG">NGÀY KẾT THÚC CHƯƠNG TRÌNH GIẢM GIÁ</label>
                            <input type="date" class="form-control" id="Day_End_CTGG" placeholder="yyyy-mm-dd" name="Day_End_CTGG" value="<?php echo $datemax ?>">
                            <span class="form-message" style="color:red"></span>
                            </div>
                            <div class="col-md-4 col-sm-4 form-group">
                            <label for="Content_CTGG">NỘI DUNG CHƯƠNG TRÌNH GIẢM GIÁ</label>
                            <input type="text" class="form-control" id="Content_CTGG" placeholder="Nội Dung" name="Content_CTGG" value="<?php echo $showNDCTGG?>">
                            <span class="form-message" style="color:red"></span>
                            </div>
                            <div class="col-md-5 col-sm-0"></div>
                            <div class="col-md-2 col-sm-12">
                                  <div id="button-add-PN" style="display:<?php echo $displayadd ?>">
                                  <button type="submit"  class="btn btn-success">Thêm</button>
                                  </div>
                                  <div id="button-update-PN" style="display:<?php echo $displayupdate ?>">
                                  <button type="submit"  class="btn btn-warning">Sửa</button>
                                  </div>
                            </div>
                            <div class="col-md-5 col-sm-0"></div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Input Phieu Nhap-->
                
              
              <div class="clearfix"></div>
      


              

                <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bảng Chương Trình Giảm Giá</h2>
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

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Mã Giảm Giá</th>
                            <th class="column-title">Tên Chương Trình </th>
                            <th class="column-title">Loại Chương Trình  </th>
                            <th class="column-title">Nội Dung Giảm Giá </th>
                            <th class="column-title">Phần Trăm Giảm Giá </th>
                            <th class="column-title">Ngày Bắt Đầu </th>
                            <th class="column-title">Ngày Kết Thúc </th>
                            <th class="column-title no-link last"><span class="nobr">Thao Tác</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Chọn Tất Cả ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php
                            $loadCTGG="SELECT * FROM chuongtrinhgiamgia";
                            $resultCTGG=mysqli_query($connect,$loadCTGG);
                            while($row_CTGG=mysqli_fetch_array($resultCTGG)){
                                        $MaCTGG=$row_CTGG['MA_CTGG'];
                                        $TenCTGG=$row_CTGG['TEN_CHUONG_TRINH'];
                                        $LoaiCTGG=$row_CTGG['LOAI_CHUONG_TRINH'];
                                        $NoiDung=$row_CTGG['ND_GIAM_GIA'];
                                        $PhanTram=$row_CTGG['PHAN_TRAM_GIAM_GIA'];
                                        $NgayBD=$row_CTGG['NGAY_BAT_DAU'];
                                        $NgayKT=$row_CTGG['NGAY_KET_THUC'];


                        ?>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" "><?php echo  $MaCTGG ?></td>
                            <td class=" "><?php echo $TenCTGG ?></td>
                            <td class=" "><?php echo $LoaiCTGG ?></td>
                            <td class=" "><?php echo $NoiDung ?></td>
                            <td class=" "><?php echo $PhanTram ?></td>
                            <td class=""><?php echo  $NgayBD ?></td>
                            <td class=""><?php echo $NgayKT ?> </td>
                            <td class=" last">
                            <button id="open-update-PN" type="button" class="btn btn-warning"onclick='' ><a href="index.php?manage=sale&update=<?php echo $MaCTGG ?>">Sửa</a></button>
                            <button id="open-delete-PN"type="button" class="btn btn-danger" onclick="askDeleteReciept() "><a href="index.php?manage=sale&delete=<?php echo $MaCTGG ?>">Xoá</a></button>
                            </td>
                          </tr>
                        <?php  } ?>
                        </tbody>
                      </table>
                    </div>
							
						
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="page-title">
              <div class="title_left">
                <h3>Bảng Chi Tiết Phiếu Nhập <small>Chứa thông tin chi tiết phiếu nhập</small></h3>
              </div>

              <div class="title_right">
                          
                <div class="col-md-5 col-sm-5 col-xs-12 mr-3 form-group pull-right top_search">
                <form class="input-group" action="./action/sort-CTGG.php" method=post>
                    <select class="form-control" id="maphieunhap" placeholder="" name="SORTCTGG">
                    <?php $get_sort_MA_CTGG=mysqli_query($connect,"SELECT MA_CTGG from chuongtrinhgiamgia ");
                      while($row_sort_CTGG= mysqli_fetch_array($get_sort_MA_CTGG)) {       ?>
                      <option value="<?php echo $row_sort_CTGG['MA_CTGG']?>"><?php echo "Mã Chương Trình Giảm Giá: ".$row_sort_CTGG['MA_CTGG']." "?></option>
                    <?php  } ?>
                    </select>
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Lọc</button>
                    </span>
                  </form>
                </div>
              </div>
              <div class="clearfix"></div>
              <!-- Chi Tiet Phieu Nhap-->

               <!-- Input Chi Tiet Phieu Nhap-->
             <div class="col-md-4 col-sm-6 col-xs-12 row" >
               <div class="col-md-12 col-sm-12">
                  
                  <!-- Them Chi Tiet Phieu Nhap-->
                  <div class="x_panel  ">
                  <div class="x_title">
                    <h2>Nhập Sản Phẩm </h2>
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
                  <?php
                  /*Load dữ liệu cho Sửa và Xoá*/
                      /*Thêm San Pham vao chi tiet phieu nhap*/

                      /*Thệm san pham vao bang Sản Phẩm*/

                    ?>   
                                 
                <form action="./action/add_detail_sale.php" method="post" id="them-chi-tiet-phieu-nhap">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="sua_machitietphieunhap"  placeholder="Không Được Phép Nhập" name="machitietgiamgia" disable value=""  >
                    </div>
                    <label for="machuongtrinhgiamgia">MÃ CHƯƠNG TRÌNH GIẢM GIÁ:</label>
                    <select class="form-control" id="sua_maphieunhap" placeholder="Nhập mã tài khoản" name="machuongtrinhgiamgia">
                    <?php $getMA_PN=mysqli_query($connect,"SELECT MA_CTGG from chuongtrinhgiamgia ");
                      while($row_PN= mysqli_fetch_array($getMA_PN)) {       ?>
                      <option value="<?php echo $row_PN['MA_CTGG']?>"><?php echo $row_PN['MA_CTGG']?></option>
                    <?php  } ?>
                    </select>
                    <div class="form-group">
                    <label for="masanpham">MÃ SẢN PHẨM:</label>
                    <select class="form-control" id="sua_maphieunhap" placeholder="Nhập mã tài khoản" name="masanpham">
                    <?php $getMA_SP=mysqli_query($connect,"SELECT MA_SP,TEN_SP from sanpham ");
                      while($row_SP= mysqli_fetch_array($getMA_SP)) {       ?>
                      <option value="<?php echo $row_SP['MA_SP'] ?>"><?php echo "  ".$row_SP['MA_SP']."---".$row_SP['TEN_SP']."   "?></option>
                    <?php  } ?>
                    </select> 
                    </div>
                 
                  
                    <button type="submit"  class="btn btn-success">Thêm</button>

                </form>
                </div>
                </div>

                <!-- Su Xoa Chi Tiet Phieu Nhap-->
                <div class="x_panel  ">
                  <div class="x_title">
                    <h2>Cập Nhật Chi Tiết Phiếu nhập</h2>
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
                  <?php
                  /*Load dữ liệu cho Sửa và Xoá*/
                  $show_MaCTGG=""; $showMaSPCTGG=""; $show_CTMaGG="";
                        if(isset($_GET['updateCTGG']) && !empty($_GET['updateCTGG']) ){
                                $id_CTGG=$_GET['updateCTGG'];
                                $showCTPN="SELECT * FROM chitietgiamgia WHERE ID_CTGG='$id_CTGG'"; 
                                $dataCTPN=mysqli_fetch_assoc(mysqli_query($connect,$showCTPN));
                                $showMaCTGG=$dataCTPN['ID_CTGG'];
                                $show_CTMaGG=$dataCTPN['MA_CTGG'];
                                $showMaSPCTGG=$dataCTPN['MA_SP'];


                        }
                        if(isset($_GET['deleteCTGG']) && !empty($_GET['deleteCTGG']) ){
                          $id_CTGG=$_GET['deleteCTGG']; 
                          if($_COOKIE['checkdeleteCTGG']=='true' ) 
                         mysqli_query($connect,"DELETE FROM chitietgiamgia WHERE ID_CTGG='$id_CTGG'");
                  }

                    ?>   
                                 
           <form action="./action/update_detail_sale.php" method="post" id="them-chi-tiet-phieu-nhap">
                    <div class="form-group">
                    <input type="hidden" class="form-control" id="sua_machitietphieunhap"  placeholder="Không Được Phép Nhập" name="machitietgiamgia" disable value="<?php echo $showMaCTGG?>"  >
                    </div>
                    <div class="form-group">
                      <label for="machuongtrinhgiamgia">MÃ CHƯƠNG TRÌNH GIẢM GIÁ:</label>
                      <select class="form-control" id="sua_maphieunhap" placeholder="Nhập mã tài khoản" name="machuongtrinhgiamgia">
                      <?php $getMA_PN=mysqli_query($connect,"SELECT MA_CTGG from chuongtrinhgiamgia ");
                        while($row_PN= mysqli_fetch_array($getMA_PN)) {       ?>
                        <option value="<?php echo $row_PN['MA_CTGG']?>"><?php echo $row_PN['MA_CTGG']?></option>
                      <?php  } ?>
                      </select>
                    </div>
                    <div class="form-group">
                    <label for="masanpham">MÃ SẢN PHẨM:</label>
                    <select class="form-control" id="sua_maphieunhap" placeholder="Nhập mã tài khoản" name="masanpham">
                    <?php $getMA_SP=mysqli_query($connect,"SELECT MA_SP,TEN_SP from sanpham ");
                      while($row_SP= mysqli_fetch_array($getMA_SP)) {       ?>
                      <option value="<?php echo $row_SP['MA_SP'] ?>"><?php echo "  ".$row_SP['MA_SP']."---".$row_SP['TEN_SP']."   "?></option>
                    <?php  } ?>
                    </select> 
                    </div>
                 
                  
                    <button type="submit"  class="btn btn-warning">Sửa</button>

                </form>
                </div>
                </div>
                </div>
              </div>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Thông Tin Chi Tiết Giảm Giá </h2>
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
                 
                  <table class="table table-striped" id="table-chitiet-phieunhap">
                      <thead>
                        <tr>
                          <th>THAO TÁC</th>
                          <th>MÃ CHI TIẾT GIẢM GIÁ</th>
                          <th>MÃ CHƯƠNG TRÌNH GIẢM GIÁ</th>
                          <th>MÃ SẢN PHẨM</th>
                          <th>TÊN SẢN PHẨM</th>
                          <th>KÍCH THƯỚC</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                            $condition="";
                            if(!empty($_GET['sortCTGG'])) $condition="AND MA_CTGG='".$_GET['sortCTGG']."'";
                            $get_CTGG="SELECT ctgg.ID_CTGG,ctgg.MA_CTGG,ctgg.MA_SP,sp.TEN_SP,sp.KICH_THUOC 
                            FROM `chitietgiamgia` as ctgg inner join sanpham as sp WHERE ctgg.MA_SP=sp.MA_SP $condition";
                            $result_CTGG=mysqli_query($connect,$get_CTGG);
                            while($row_chi_tiet_giam_gia=mysqli_fetch_array($result_CTGG)){


                        ?>
                         <a href="">
                        <tr>
                        <th scope="row">

                            <button id="open-update-PN" type="button" class="btn btn-warning"onclick='' ><a href="index.php?manage=sale&updateCTGG=<?php echo $row_chi_tiet_giam_gia['ID_CTGG'] ?>#table-chitiet-phieunhap">Sửa</a></button>
                            <button id="open-delete-PN"type="button" class="btn btn-danger" onclick=" askDeleteDetailReciept() "><a href="index.php?manage=sale&deleteCTGG=<?php echo $row_chi_tiet_giam_gia['ID_CTGG'] ?>#table-chitiet-phieunhap">Xoá</a></button>
                            </th>
                            <td><?php echo $row_chi_tiet_giam_gia['ID_CTGG']  ?></td>
                          <td><?php echo $row_chi_tiet_giam_gia['MA_CTGG']  ?></td>
                          <td><?php echo $row_chi_tiet_giam_gia['MA_SP'] ?></td>
                          <td><?php echo $row_chi_tiet_giam_gia['TEN_SP'] ?></td>
                          <td><?php echo $row_chi_tiet_giam_gia['KICH_THUOC'] ?></td>
                          
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



             

<div class="clearfix"></div>

          
            </div>
        </div>
    </div>
        <!-- /page content -->
        <script>
      document.addEventListener('DOMContentLoaded', function () {
        Validator({
          form: '#form-add-chuong-trinh-giam-gia',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
           Validator.isRequired('#Name_CTGG'),
           Validator.isRequired('#Type_CTGG'),
           Validator.isRequired('#Content_CTGG'),
           Validator.isRequired('#Percent_CTGG'),
           Validator.isRequired('#Day_Start_CTGG'),
           Validator.isRequired('#Day_End_CTGG'),
            Validator.isRealNumber('#Percent_CTGG'),
          ],
        });
      });


</script>

 <script>
function askDeleteReciept() {
  var  checkdeleteGG=  confirm("Khi xoá chương trình giảm giá, sẽ xoá tất cả các nội dung giảm giá tương ứng.Bạn có thật sự muốn xoá không?");
if(checkdeleteGG==true) document.cookie="checkdeleteGG=true";
else document.cookie="checkdeleteGG=false";
}
function askDeleteDetailReciept() {
var  checkdeleteCTGG= confirm("Bạn có thật sự muốn xoá chi tiết giảm giá này không?");
if(checkdeleteCTGG==true) document.cookie="checkdeleteCTGG=true";
else document.cookie="checkdeleteCTGG=false";


}
</script>