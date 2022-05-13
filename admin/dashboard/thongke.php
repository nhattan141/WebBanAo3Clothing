<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title">
        <h3>Bảng Thống Kê <small>Chứa thông tin tình hình kinh doanh cửa hàng</small></h3>
      </div>
      <div class="col-md-6 col-sm-12 form-group">
      <form action="./action/pushdata.php" method="get">
            <label for="Day_Start">NGÀY BẮT ĐẦU</label>
            <input type="date" class="form-control" id="Day_Start" placeholder="yyyy-mm-dd" name="Day_Start">
            <span class="form-message" style="color:red"></span>
          </div>
          <div class="col-md-6 col-sm-12 form-group">
            <label for="Day_End">NGÀY KẾT THÚC</label>
            <input type="date" class="form-control" id="Day_End" placeholder="yyyy-mm-dd" name="Day_End">
            <span class="form-message" style="color:red"></span>
          </div>
          <div class="col-md-6 col-sm-12">
          <label for="count">Hiển thị số lượng top sản phẩm bán chạy:</label>
              <select id="count" name="count">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6" selected>6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            <div id="button-add-PN">
            <button type="submit"  class="btn btn-success">Lọc</button>
          </div>
        </div>
    </form>
    </div>
    

    <div class="clearfix"></div>
    <div class="row">
      <!-- Phieu Nhap-->
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sản Phẩm Bán Chạy</h2>
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
                          <th>MÃ SẢN PHẨM</th>
                          <th>TÊN SẢN PHẨM</th>
                          <th>SÔ LƯỢNG BÁN ĐƯỢC</th>
                          <th>DOANH THU</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      if(!empty($_GET['Day_Start']) && !empty($_GET['Day_End']) && !empty($_GET['count'])){
                        $StartDay= $_GET['Day_Start'];
                        $EndDay= $_GET['Day_End'];
                        $Count=$_GET['count'];
                            $getDoanhThu="SELECT p.MA_SP, p.TEN_SP,SUM(od.SO_LUONG) AS TotalQuantity,SUM(od.THANH_TIEN) AS THANHTIEN
                            from(( sanpham as p inner join chitiethoadon as od on p.MA_SP = od.MA_SP 
                                 INNER JOIN hoadon as hd on hd.MA_HD = od.MA_HD))
                                 where  '$StartDay' <= hd.NGAY_LAP AND hd.NGAY_LAP <= '$EndDay'
                                 GROUP BY p.TEN_SP ORDER BY SUM(od.SO_LUONG) DESC , SUM(od.DON_GIA) LIMIT $Count";
                            $Bestsaler = mysqli_query($connect,$getDoanhThu);
                            while($BS=mysqli_fetch_array($Bestsaler)){
                        ?>
                        <tr>
                          <th scope="row"><?php echo $BS['MA_SP']  ?></th>
                          <td><?php echo $BS['TEN_SP'] ?></td>
                          <td><?php echo $BS['TotalQuantity'] ?></td>
                          <td><?php echo $BS['THANHTIEN'] ?></td>
                        </tr>
                       <?php
                            }}
                        ?>
                      </tbody>
                    </table>
                                
          </div>
        </div>
      </div>
      <!-- Input Phieu Nhap-->
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tình Hình Kinh Doanh </h2>
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
                          <th>LOẠI SẢN PHẨM</th>
                          <th>TÊN SẢN PHẨM</th>
                          <th>SÔ LƯỢNG BÁN ĐƯỢC</th>
                          <th>DOANH THU</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      if(!empty($_GET['Day_Start']) && !empty($_GET['Day_End']) && !empty($_GET['count'])){
                        $StartDay= $_GET['Day_Start'];
                        $EndDay= $_GET['Day_End'];
                        $Count=$_GET['count'];
                            $getTinhhinhKinhDoanh="SELECT p.LOAI_SP, p.TEN_SP,SUM(od.SO_LUONG) AS TotalQuantity,SUM(od.THANH_TIEN) AS THANHTIEN
                            from(( sanpham as p inner join chitiethoadon as od on p.MA_SP = od.MA_SP 
                                 INNER JOIN hoadon as hd on hd.MA_HD = od.MA_HD))
                                 where  '$StartDay' <= hd.NGAY_LAP AND hd.NGAY_LAP <= '$EndDay'
                                 GROUP BY p.LOAI_SP ORDER BY SUM(od.SO_LUONG) DESC , SUM(od.DON_GIA) LIMIT $Count";
                            $TinhhinhKinhDoanh = mysqli_query($connect,$getTinhhinhKinhDoanh);
                            while($THKD=mysqli_fetch_array($TinhhinhKinhDoanh)){
                        ?>
                        <tr>
                          <th scope="row"><?php echo $THKD['LOAI_SP']  ?></th>
                          <td><?php echo $THKD['TEN_SP'] ?></td>
                          <td><?php echo $THKD['TotalQuantity'] ?></td>
                          <td><?php echo $THKD['THANHTIEN'] ?></td>
                        </tr>
                       <?php
                            }}
                        ?>
                      </tbody>
                    </table>

          </div>
        </div>
      </div>