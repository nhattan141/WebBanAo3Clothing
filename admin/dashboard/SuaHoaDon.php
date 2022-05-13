<?php
    $connect = mysqli_connect("localhost", "root", "", "doanweb2");
?>
<div id="dangki">
    <form action="XuLySuaHoaDon.php" method="get">
        <div style="width: 500px;height:50px;text-align: center; ">
            <label>Sửa Hóa Đơn</label>
        </div>
        <div class="form-group">           
            <input type="hidden" id="mahd" readonly="true" name="mahd" value="<?php
                                                                    $MAHD = $_GET['mahd'];
                                                                    echo $MAHD;
                                                                    ?>">

        </div>
        <div class="form-group">
            <p>Mã Nhân Viên<span style="color: red"></p>
            <select name="manv" id="manv">
                <option value="<?php
                                $MANV = $_GET['manv'];
                                echo $MANV;
                                ?>"><?php
                                    $MANV = $_GET['manv'];
                                    echo $MANV;
                                    ?> </option>
                <?php
                $option = '';
                $con = mysqli_connect("localhost", "root", "", "doanweb2");
                $sql = "SELECT MA_NV from nhanvien";
                mysqli_query($con, "SET NAMES 'utf8");
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                    // output dữ liệu trên trang
                    while ($row = $result->fetch_assoc()) {
                        $option .= '<option value="' . $row["MA_NV"] . '">' . $row["MA_NV"] . '</option>';
                    }
                }
                echo $option;
                ?>
            </select>
        </div>
        <div class="form-group">
            <p>Mã Khách Hàng</p>
            <select name="makh" id="makh">
                <option value="<?php
                                $MAKH = $_GET['makh'];
                                echo $MAKH;
                                ?>"><?php
                                    $MAKH = $_GET['makh'];
                                    echo $MAKH;
                                    ?></option>
                <?php
                $option = '';
                $con = mysqli_connect("localhost", "root", "", "doanweb2");
                $sql = "SELECT MA_KH from khachhang";
                mysqli_query($con, "SET NAMES 'utf8");
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                    // output dữ liệu trên trang
                    while ($row = $result->fetch_assoc()) {
                        $option .= '<option value="' . $row["MA_KH"] . '">' . $row["MA_KH"] . '</option>';
                    }
                }
                echo $option;
                ?>
            </select>
        </div>
        <div class="form-group">
            <p>Địa Chỉ</p>
            <input type="text" id="dc" name="dc" value="<?php
                                                $DC = $_GET['dc'];
                                                echo $DC;
                                                ?>">
            <span class="form-message" style="color:red"></span>
        </div>
        <div class="form-group">
            <p>Số Điện Thoại</p>
            <input type="text" id="sdt" name="sdt" value="<?php
                                                $DC = $_GET['sdt'];
                                                echo $DC;
                                                ?>">
            <span class="form-message" style="color:red"></span>
        </div>
        <div class="form-group">
            <p>Tình Trạng</p>
            <?php
            $checked = "";
            $unchecked = "";
            $MA_HD = $_GET['mahd'];
            $gettt = mysqli_query($connect, "SELECT TINH_TRANG from hoadon WHERE MA_HD='$MA_HD'");
            if ($gettt->num_rows > 0) {
                while ($row = $gettt->fetch_assoc()) {
                    if ($row["TINH_TRANG"] == '1') {
                        $checked = "checked";
                        $unchecked = "";
                    } else if ($row["TINH_TRANG"] == '0') {
                        $unchecked = "checked";
                        $checked = "";
                    }
                }
            }
            ?>
            <input type="radio" <?php echo $checked; ?> class="form-control" id="trangthai" name="tt" value="1" require>Đã Xử Lý
            <input type="radio" <?php echo $unchecked; ?> class="form-control" id="trangthai" name="tt" value="0" require>Chưa Xử Lý
        </div>
        <div class="form-group">
            <p>Ngày Lập</p>
            <input type="datetime-local" name="ngaylap" id="ngaylap" value="<?php
                                                                            $Nl = $_GET['ngaylap'];
                                                                            echo $Nl;
                                                                            ?>">
                                                                                  <span class="form-message" style="color:red"></span>
        </div>
      
        <div>
            <input type="submit" name="" id="bt1" value="Sửa">
        </div>
    </form>
</div>

<script>
      document.addEventListener('DOMContentLoaded', function () {
        Validator({
          form: '#dangki',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
           Validator.isRequired('#tgg'),
           Validator.isRequired('#dc'),
           Validator.isRequired('#tt'),
           Validator.isRequired('#ngaylap'),
          // Validator.isRequired('#tongtien'),
           // Validator.isNumber('#tongtien'),
            Validator.isNumber('#tgg'),
          ],
        });
      });

    
</script>
<script>
    function dongthemhoadon() {
        document.getElementById("dangki").style.display = "none";
    }
</script>

<style>
    #dangki {
        display: block;
        width: 500px;
        height: 600px;
        position: absolute;
        top: 20px;
        left: 35%;
        color: #73879C;
        background: rgb(230, 228, 228);
        z-index: 500;
        overflow-x: auto;
    }

    #dangki label {
        font-size: 30px;
    }

    #dangki input {
        border-radius: 5px;
        width: 450px;
        height: 40px;
        border: solid 2px;
    }

    #dangki input:active {
        border: solid 2px red;
    }

    #dangki div {
        padding-left: 20px;
        padding-bottom: 10px;
    }

    #bt1 {
        margin-top: 30px;
        color: white;
        cursor: pointer;
        width: 450px;
        height: 40px;
        background-color: red;
        text-align: center;
    }

    #bt1:hover {
        opacity: 0.7;
        border: ridge 1px #00BFFF;
    }

    #dangki p {
        font-size: 20px;
    }
</style>