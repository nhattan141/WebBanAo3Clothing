<form action="XuLySuaChiTiet.php" method="get">

    <div id="dangki">
        <div style="width: 500px;height:50px;text-align: center; ">
            <label>Sửa Chi Tiết Hóa Đơn</label>
        </div>
        <div>
            <p>Mã Hóa Đơn</p>
            <input type="text" readonly="true" name="mahd" value="<?php 
                    $MAHD=$_GET['mahd'];
                    echo $MAHD;
                ?>">
        </div>
        <div>
            <p>Tình Trạng Hóa Đơn</p>
            <input type="text" readonly="true" name="tt" value="<?php 
                    if (isset($_GET['tt'])) {
                        $tt=$_GET['tt'];
                        echo $tt;
                    }
                ?>">
        </div>
        <div>
            <p>Mã Sản Phẩm</p>
            <select name="masp">
                <option value="<?php 
                    $MASP=$_GET['masp'];
                    echo $MASP;
                ?>"><?php 
                    $MASP=$_GET['masp'];
                    echo $MASP;
                ?></option>
            </select>
        </div>
        <div>
            <p>Số Lượng</p>
            <input type="text" name="sl" value="<?php 
                    $SL=$_GET['sl'];
                    echo $SL;
                ?>">
        </div>
        <div>
            <p>Đơn Giá</p>
            <select name="dg">
                <option value="<?php 
                    $DG=$_GET['dg'];
                    echo $DG;
                ?>"><?php 
                    $DG=$_GET['dg'];
                    echo $DG;
                ?></option>
            </select>
        </div>
        <div>
            <p>Tiền Giảm giá</p>
            <input type="text" name="tgg" value="<?php 
                    $TGG=$_GET['tgg'];
                    echo $TGG;
                ?>">
        </div>
        <div>
            <input type="submit" name="" id="bt1" value="Sửa">
            <input type="button" value="Đóng" id="bt2" onclick=dongthemhoadon()>
        </div>
    </div>
</form>
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
    overflow: auto;
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