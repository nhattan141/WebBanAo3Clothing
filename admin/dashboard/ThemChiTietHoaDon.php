

<form action="XuLyThemChiTiet.php" method="get">

    <div id="dangki">
        <div style="width: 480px;height:50px;text-align: center;line-height: 50px; ">
            <label>Thêm Chi Tiết Hóa Đơn</label>
        </div>
        <div>
            <p>Mã Hóa Đơn</p>
            <input type="text" readonly="true" name="mahd" value="<?php 
                    $MAHD=$_GET['mahd'];
                    echo $MAHD;
                ?>">
        </div>
        
        <div>
          <p>Mã Sản Phẩm<span style="color: red"></p>
            <select name="masp">
                <option value="">--Chọn--</option>
                <?php
                    $option='';
                    $con = mysqli_connect("localhost", "root", "", "doanweb2");
                    $sql = "SELECT MA_SP from sanpham";
                    mysqli_query($con, "SET NAMES 'utf8");
                    $result = mysqli_query($con, $sql);
                    if ($result->num_rows > 0) {
                        // output dữ liệu trên trang
                        while ($row = $result->fetch_assoc()) {
                            $option .= '<option value="'.$row["MA_SP"].'">'.$row["MA_SP"].'</option>';
                        }
                    }
                    echo $option;
                ?>
            </select>
        </div>
        <div>
          <p>Số Lượng</p>
            <input type="text" name="sl" placeholder="Nhập số lượng. . .">
        </div>
        <div>
          <p>Đơn Giá</p>
            <select name="dg">
                <option value="">--Chọn--</option>
                <?php
                    $masp;
                    if(isset($_GET['masp'])){
                        $masp=$_GET['masp'];
                    }
                    $option='';
                    $con = mysqli_connect("localhost", "root", "", "doanweb2");
                    $sql = "SELECT DISTINCT DON_GIA FROM sanpham ";
                    mysqli_query($con, "SET NAMES 'utf8");
                    $result = mysqli_query($con, $sql);
                    if ($result->num_rows > 0) {
                        // output dữ liệu trên trang
                        while ($row = $result->fetch_assoc()) {
                            $option .= '<option value="'.$row["DON_GIA"].'">'.$row["DON_GIA"].'</option>';
                        }
                    }
                    echo $option;
                ?>
            </select>
        </div>
        <div>
          <p>Tiền Giảm giá</p>
            <input type="text" name="tgg" placeholder="Nhập tiền giảm giá . . .">
        </div>
        <div>
            <input type="submit" name="" id="bt1" value="Thêm">
            <input type="button" value="Đóng" id="bt2" onclick=dongthemhoadon()>
        </div>
    </div>  
</form>
<script>
function dongthemhoadon(){
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
}
#dangki label{
    font-size: 30px;
}
#dangki input
{
    border-radius: 5px;
    width: 450px;
    height: 40px;
    border: solid 2px;
}
#dangki input:active{
    border: solid 2px red;
}
#dangki div{
padding-left: 20px;
padding-bottom: 10px;
}
#bt1{
    margin-top: 30px;
    color: white;
    cursor: pointer;
    width: 450px;
    height: 40px;
    background-color:red; 
    text-align:center;
}
#bt1:hover{
    opacity: 0.7;
    border:ridge 1px #00BFFF;
}

#dangki p{
    font-size: 20px;
}
</style>
