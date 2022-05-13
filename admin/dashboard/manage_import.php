
<?php
                  /*Load dữ liệu cho Sửa và Xoá*/        
                        $actionPN="./action/add_recieptPN.php";$displayadd='block';$displayupdate='none';$showMaPN="";$showMaTK="";$showTien="";$date="";
                        if(isset($_GET['update']) && !empty($_GET['update']) ){
                                $displayupdate='block';$displayadd='none';
                                $id_PN=$_GET['update'];
                                $showPN="SELECT * FROM phieunhap WHERE MA_PN='$id_PN'";
                                $dataPN=mysqli_fetch_assoc(mysqli_query($connect,$showPN));
                                $showMaPN=$dataPN['MA_PN'];
                                $showMaTK=$dataPN['MA_TK'];
                                $showTien=$dataPN['TONG_DON_GIA'];
                                $date=$dataPN['NGAY_NHAP'];
                                $actionPN="./action/update_recieptPN.php";
	                            //$datePN=date_format($date,'d-m-Y');

                        }
                        if(isset($_GET['delete']) && !empty($_GET['delete']) ){
                            $id_PN=$_GET['delete'];
                            $deletePN="DELETE  FROM phieunhap WHERE MA_PN='$id_PN'";
                            $deleteCTPN="DELETE  FROM chitietphieunhap WHERE MA_PN='$id_PN'";
                            if($_COOKIE['checkdeletePN']=='true' ) {mysqli_query($connect,$deletePN);
                            mysqli_query($connect,$deleteCTPN);}
                    }
                    
                  
                    ?>   
                          

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Bảng Phiếu Nhập <small>Chứa thông tin các phiếu nhập</small></h3>
              </div>

              <div class="title_right ">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group pull-right top_search">
                <form class="input-group" action="./action/sort_MA_TK.php" method=post>
                    <select class="form-control" id="mataikhoan" placeholder="" name="sortmataikhoan">
                    <?php $get_sort_MA_TK=mysqli_query($connect,"SELECT MA_TK from taikhoan WHERE MA_TK ='1'  OR MA_TK='2' ORDER BY MA_TK ASC ");
                      while($row_sort_TK= mysqli_fetch_array($get_sort_MA_TK)) {       ?>
                      <option value="<?php echo $row_sort_TK['MA_TK']?>"><?php echo "Mã Tài Khoản: ".$row_sort_TK['MA_TK']." "?></option>
                    <?php  } ?>
                    </select>
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Lọc</button>
                    </span>
                  </form>
                  <form class="input-group" action="./action/sort_DatePN.php" method=post style="float:right">
                        <div class="form-group">
                            <label for="date_min">TỪ NGÀY:</label>
                            <input type="date" class="form-control" id="" placeholder="yyyy-mm-dd" name="date_min" >
                        </div>
                        <div class="form-group">
                            <label for="date_max">ĐẾN NGÀY:</label>
                            <input type="date" class="form-control" id="" placeholder="yyyy-mm-dd" name="date_max">
                        </div>
                        <input class="btn btn-default" type="submit" value="Tìm">
                  </form>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            <!-- Phieu Nhap-->
              <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Thông Tin Phiếu Nhập </h2>
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
                          <th>MÃ PHIẾU NHẬP</th>
                          <th>MÃ TÀI KHOẢN</th>
                          <th>NGÀY NHẬP</th>
                          <th>TỔNG TIỀN</th>
                          <th>THAO TÁC</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                             $conditionTK=1;
                             if(!empty($_GET['sortTK'])) $conditionTK="MA_TK='".$_GET['sortTK']."'";
                             if(!empty($_GET['sortdatemin']) && !empty($_GET['sortdatemax'])) $conditionTK=" NGAY_NHAP BETWEEN '".$_GET['sortdatemin']."' AND '".$_GET['sortdatemax']."'";
                             $getTK="SELECT * FROM phieunhap WHERE $conditionTK ";
                            $result_TK=mysqli_query($connect,$getTK);
                            while($row_phieu_nhap=mysqli_fetch_array($result_TK)){


                        ?>
                         <a href="">
                        <tr>
                       
                          <th scope="row"><?php echo $row_phieu_nhap['MA_PN']  ?></th>
                          <td><?php echo $row_phieu_nhap['MA_TK'] ?></td>
                          <td><?php echo $row_phieu_nhap['NGAY_NHAP'] ?></td>
                          <td><?php echo $row_phieu_nhap['TONG_DON_GIA'] ?></td>
                          <td>
                            <button id="open-update-PN" type="button" class="btn btn-warning"onclick='' ><a href="index.php?manage=import&update=<?php echo $row_phieu_nhap['MA_PN'] ?>">Sửa</a></button>
                            <button id="open-delete-PN"type="button" class="btn btn-danger" onclick="askDeleteReciept() "><a href="index.php?manage=import&delete=<?php echo $row_phieu_nhap['MA_PN'] ?>">Xoá</a></button>
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
                    <h2>Cập Nhật Phiếu nhập</h2>
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
                         
                <form action="<?php echo $actionPN ?>" method="get" id="form-PN">
                    <div class="form-group">
                    <input type="hidden" class="form-control" id="maphieunhap" placeholder="Không Được Phép Nhập" name="maphieunhap"   value="<?php echo $showMaPN ?>">
                    </div>
                    <div class="form-group">

                    <label for="mataikhoan">MÃ TÀI KHOẢN:</label>
                    <select class="form-control" id="mataikhoan" placeholder="Nhập mã tài khoản" name="mataikhoan">
                    <?php $getMA_TK=mysqli_query($connect,"SELECT MA_TK,TEN_DANG_NHAP from taikhoan WHERE MA_GROUP_QUYEN=1 OR MA_GROUP_QUYEN=2");
                      while($row_account= mysqli_fetch_array($getMA_TK)) {       ?>
                      <option value="<?php echo $row_account['MA_TK']?>"><?php echo $row_account['TEN_DANG_NHAP']?></option>
                    <?php  } ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="email">NGÀY NHẬP</label>
                    <input  type="date" class="form-control" id="ngaynhap" placeholder="" name="ngaynhap" value="<?php echo $date?>">
                    <span class="form-message" style="color:red"></span>
                    </div>
                    <div class="form-group">
                    <label for="pwd">TỔNG TIỀN</label>
                    <input type="text" class="form-control" id="tongtien" placeholder="Nhập Tổng Tiền" name="tongtien" value="<?php echo $showTien ?>">
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
              <!--Sửa Phieu Nhap-->
              
              <div class="clearfix"></div>
              <div class="page-title">
              <div class="title_left">
                <h3>Bảng Chi Tiết Phiếu Nhập <small>Chứa thông tin chi tiết phiếu nhập</small></h3>
              </div>

              <div class="title_right">
                          
                <div class="col-md-5 col-sm-5 col-xs-12 mr-3 form-group pull-right top_search">
                  <form class="input-group" action="./action/sort-PN.php" method=post>
                    <select class="form-control" id="maphieunhap" placeholder="" name="sortmaphieunhap">
                    <?php $get_sort_MA_PN=mysqli_query($connect,"SELECT MA_PN from phieunhap ORDER BY MA_PN ASC ");
                      while($row_sort_PN= mysqli_fetch_array($get_sort_MA_PN)) {       ?>
                      <option value="<?php echo $row_sort_PN['MA_PN']?>"><?php echo "Mã Phiếu Nhập: ".$row_sort_PN['MA_PN']." "?></option>
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
                                 
                <form action="./action/add_detail_reciept.php" method="post" id="them-chi-tiet-phieu-nhap">
                    <label for="maphieunhap">MÃ PHIẾU NHẬP:</label>
                    <select class="form-control" id="maphieunhap" placeholder="" name="maphieunhap">
                    <?php $getMA_PN=mysqli_query($connect,"SELECT MA_PN from phieunhap ORDER BY MA_PN ASC ");
                      while($row_PN= mysqli_fetch_array($getMA_PN)) {       ?>
                      <option value="<?php echo $row_PN['MA_PN']?>"><?php echo $row_PN['MA_PN']?></option>
                    <?php  } ?>
                    </select>
                    <div class="form-group">
                    <label for="masanpham">MÃ SẢN PHẨM:</label>
                    <input type="text" class="form-control" id="masanpham" placeholder="Mã sản phẩm"  name="masanpham" disabled value="">
                    </div>
                    <div class="form-group">
                    <label for="tensanpham">TÊN SẢN PHẨM</label>
                    <input type="text" class="form-control" id="tensanpham" placeholder="Nhập tên sản phẩm" name="tensanpham" value="">
                    <span class="form-message" id="" style="color:red"></span>
                    </div>
                    <label for="loai">LOẠI</label>
                    <select class="form-control" id="loai" placeholder="Nhập loại sản phẩm" name="loai">
                      <option value="Tee">Tee</option>
                      <option value="Hoodie">Hoodie</option>
                      <option value="Sweatshirt">Sweatshirt</option>
                      <option value="Varsity">Varsity</option>
                      <option value="Jacket">Jacket</option>
                      <option value="T-Shirt">T-Shirt</option>
                      <option value="T-Shirt">Sweater</option>
                      <option value="T-Shirt">Cardian</option>
                    </select>
                    <label for="size">KÍCH THƯỚC</label>
                    <select class="form-control" id="size" placeholder="Nhập kích thước" name="size">
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      
                    </select>

                    <div class="form-group">
                    <label for="mota">MÔ TẢ</label>
                    <input type="text" class="form-control" id="mota" placeholder="Mô tả sản phẩm" name="mota" value="" require>
                    <span class="form-message" id="" style="color:red"></span>
                    </div>

                    <div class="form-group">
                    <label for="dongia">ĐƠN GIÁ</label>
                    <input  type="text" class="form-control" id="dongia" placeholder="Nhập đơn giá" name="dongia" value=""require>
                    <span class="form-message" id="" style="color:red"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="soluong">SỐ LƯỢNG</label>
                    <input type="text" class="form-control" id="soluong" placeholder="Nhập số lượng" name="soluong" value=""require>
                    <span class="form-message" id="" style="color:red"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="url">HÌNH ẢNH</label>
                    <input type="file" class="form-control" id="url" placeholder="Nhập Tổng Tiền" name="url" value="<?php echo $showTien ?>">
                    <span class="form-message" style="color:red"></span>
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
                  $show_CTMaPN=""; $showMaSP=""; $showDongia=""; $showSize="";$showSoLuong="";$showMaCTPN="";
                        if(isset($_GET['updateCTPN']) && !empty($_GET['updateCTPN']) ){
                                $id_CTPN=$_GET['updateCTPN'];
                                $showCTPN="SELECT * FROM chitietphieunhap WHERE MA_CTPN='$id_CTPN'"; 
                                $dataCTPN=mysqli_fetch_assoc(mysqli_query($connect,$showCTPN));
                                $showMaCTPN=$dataCTPN['MA_CTPN'];
                                $show_CTMaPN=$dataCTPN['MA_PN'];
                                $showMaSP=$dataCTPN['MA_SP'];
                                $showDongia=$dataCTPN['DON_GIA'];
                                $showSize=$dataCTPN['SIZE'];
                                $showSoLuong=$dataCTPN['SO_LUONG'];


                        }
                        if(isset($_GET['deleteCTPN']) && !empty($_GET['deleteCTPN']) ){
                          $id_CTPN=$_GET['deleteCTPN'];
                          if($_COOKIE['checkdeleteCTPN']=='true' ) 
                          mysqli_query($connect,"DELETE FROM chitietphieunhap  WHERE MA_CTPN='$id_CTPN'");
                  }

                    ?>   
                                 
                <form action="./action/update_detail_reciept.php" method="post" id='form-update-CTPN'>
                    <div class="form-group">
                    <input type="hidden" class="form-control" id="sua_machitietphieunhap"  placeholder="Không Được Phép Nhập" name="sua_machitietphieunhap" value="<?php echo $showMaCTPN ?> "  >
                    </div>
                    <label for="sua_maphieunhap">MÃ PHIẾU NHẬP:</label>
                    <select class="form-control" id="sua_maphieunhap" placeholder="Nhập mã tài khoản" name="sua_maphieunhap">
                    <?php $getMA_PN=mysqli_query($connect,"SELECT MA_PN from phieunhap ORDER BY MA_PN ASC ");
                      while($row_PN= mysqli_fetch_array($getMA_PN)) {       ?>
                      <option value="<?php echo $row_PN['MA_PN']?>"><?php echo $row_PN['MA_PN']?></option>
                    <?php  } ?>
                    </select>
                    <div class="form-group">
                    <label for="sua_masanpham">MÃ SẢN PHẨM:</label>
                    <input type="text" class="form-control" id="sua_masanpham" placeholder="Mã sản phẩm" name="sua_masanpham" value="<?php echo $showMaSP ?>">
                    </div>
                 
                    <label for="sua_size">KÍCH THƯỚC</label>
                    <select class="form-control" id="size" placeholder="Nhập kích thước" name="sua_size">
                      <option value="<?php echo $showSize  ?>"><?php echo $showSize  ?></option>
                    </select>
                
                    <div class="form-group">
                    <label for="sua_dongia">ĐƠN GIÁ</label>
                    <input  type="text" class="form-control" id="sua_dongia" placeholder="Nhập đơn giá" name="sua_dongia" value="<?php echo $showDongia?>">
                    <span class="form-message" style="color:red"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="sua_soluong">SỐ LƯỢNG</label>
                    <input type="text" class="form-control" id="sua_soluong" placeholder="Nhập số lượng" name="sua_soluong" value="<?php echo $showSoLuong ?>">
                    <span class="form-message" style="color:red"></span>
                    </div>                                     

                    <div id="button-update-PN" >
                    <button type="submit"  class="btn btn-warning">Sửa</button>
                    </div>

                </form>
                </div>
                </div>
                </div>
              </div>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Thông Tin Chi Tiết Phiếu Nhập </h2>
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
                          <th>MÃ CTPN</th>
                          <th>MÃ PHIẾU NHẬP</th>
                          <th>MÃ SẢN PHẨM</th>
                          <th>ĐƠN GIÁ</th>
                          <th>KÍCH THƯỚC</th>
                          <th>SỐ LƯỢNG</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                            $condition=1;
                            if(!empty($_GET['sortPN'])) $condition="MA_PN='".$_GET['sortPN']."'";
                            $get_CTPN="SELECT * FROM chitietphieunhap WHERE $condition";
                            $result_CTPN=mysqli_query($connect,$get_CTPN);
                            while($row_chi_tiet_phieu_nhap=mysqli_fetch_array($result_CTPN)){


                        ?>
                         <a href="">
                        <tr>
                        <th scope="row">

                            <button id="open-update-PN" type="button" class="btn btn-warning"onclick='' ><a href="index.php?manage=import&updateCTPN=<?php echo $row_chi_tiet_phieu_nhap['MA_CTPN'] ?>#table-chitiet-phieunhap">Sửa</a></button>
                            <button id="open-delete-PN"type="button" class="btn btn-danger" onclick=" askDeleteDetailReciept() "><a href="index.php?manage=import&deleteCTPN=<?php echo $row_chi_tiet_phieu_nhap['MA_CTPN'] ?>#table-chitiet-phieunhap">Xoá</a></button>
                            </th>
                            <td><?php echo $row_chi_tiet_phieu_nhap['MA_CTPN']  ?></td>
                          <td><?php echo $row_chi_tiet_phieu_nhap['MA_PN']  ?></td>
                          <td><?php echo $row_chi_tiet_phieu_nhap['MA_SP'] ?></td>
                          <td><?php echo $row_chi_tiet_phieu_nhap['DON_GIA'] ?></td>
                          <td><?php echo $row_chi_tiet_phieu_nhap['SIZE'] ?></td>
                          <td><?php echo $row_chi_tiet_phieu_nhap['SO_LUONG'] ?></td>
                          
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

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table design <small>Custom design</small></h2>
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

                    <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p>

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Invoice </th>
                            <th class="column-title">Invoice Date </th>
                            <th class="column-title">Order </th>
                            <th class="column-title">Bill to Name </th>
                            <th class="column-title">Status </th>
                            <th class="column-title">Amount </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000040</td>
                            <td class=" ">May 23, 2014 11:47:56 PM </td>
                            <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i></td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$7.45</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">May 23, 2014 11:30:12 PM</td>
                            <td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
                            </td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$741.20</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000038</td>
                            <td class=" ">May 24, 2014 10:55:33 PM</td>
                            <td class=" ">121000203 <i class="success fa fa-long-arrow-up"></i>
                            </td>
                            <td class=" ">Mike Smith</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$432.26</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000037</td>
                            <td class=" ">May 24, 2014 10:52:44 PM</td>
                            <td class=" ">121000204</td>
                            <td class=" ">Mike Smith</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$333.21</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000040</td>
                            <td class=" ">May 24, 2014 11:47:56 PM </td>
                            <td class=" ">121000210</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$7.45</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">May 26, 2014 11:30:12 PM</td>
                            <td class=" ">121000208 <i class="error fa fa-long-arrow-down"></i>
                            </td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$741.20</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000038</td>
                            <td class=" ">May 26, 2014 10:55:33 PM</td>
                            <td class=" ">121000203</td>
                            <td class=" ">Mike Smith</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$432.26</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000037</td>
                            <td class=" ">May 26, 2014 10:52:44 PM</td>
                            <td class=" ">121000204</td>
                            <td class=" ">Mike Smith</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$333.21</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>

                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000040</td>
                            <td class=" ">May 27, 2014 11:47:56 PM </td>
                            <td class=" ">121000210</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$7.45</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">May 28, 2014 11:30:12 PM</td>
                            <td class=" ">121000208</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$741.20</td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
							
						
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<script>
      document.addEventListener('DOMContentLoaded', function () {
        Validator({
          form: '#form-PN',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
           Validator.isRequired('#tongtien'),
           Validator.isRequired('#ngaynhap'),
            Validator.isNumber('#tongtien'),
          ],
        });
      });

      document.addEventListener('DOMContentLoaded', function () {
        Validator({
          form: '#them-chi-tiet-phieu-nhap',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
           Validator.isRequired('#tensanpham'),
           Validator.isRequired('#mota'),
           Validator.isRequired('#dongia'),
           Validator.isRequired('#soluong'),
           Validator.isRequired('#url'),
            Validator.isNumber('#dongia'),
            Validator.isNumber('#soluong'),
          ],
        });
      });

      document.addEventListener('DOMContentLoaded', function () {
        Validator({
          form: '#form-update-CTPN',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isNumber('#sua_dongia'),
            Validator.isNumber('#sua_soluong'),
          ],
        });
      });

</script>

 <script>
function askDeleteReciept() {
  var  checkdeletePN=  confirm("Khi xoá phiếu nhập sẽ xoá tất cả các chi tiết phiếu nhập tương ứng.Bạn có thật sự muốn xoá không?");
if(checkdeletePN==true) document.cookie="checkdeletePN=true";
else document.cookie="checkdeletePN=false";
}
function askDeleteDetailReciept() {
var  checkdeleteCTPN= confirm("Bạn có thật sự muốn xoá chi tiết phiếu nhập này không?");
if(checkdeleteCTPN==true) document.cookie="checkdeleteCTPN=true";
else document.cookie="checkdeleteCTPN=false";


}
</script>