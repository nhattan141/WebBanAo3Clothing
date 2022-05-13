<div id="thongbaoxoa">
    <h1>Bạn có muốn xóa chi tiết có msp là <?php
        if(isset($_GET['masp'])){
            $msp=$_GET['masp'];
            echo $msp;
        }
        ?>
         của hóa đơn <?php
        if(isset($_GET['mahd'])){
            $mhd=$_GET['mahd'];
            echo $mhd;
        }
    ?> không</h1>
    <button id='bt1' ><a href="XuLyXoaChiTietHoaDon.php?xoa=true&mahd=<?php
        if(isset($_GET['mahd'])){
            $mhd=$_GET['mahd'];
            echo $mhd;
        }
        ?>&masp=<?php
        if(isset($_GET['masp'])){
            $msp=$_GET['masp'];
            echo $msp;
        }
        ?>&tt=<?php
        if(isset($_GET['tt'])){
            $msp=$_GET['tt'];
            echo $msp;
        }
        ?>">Có</a></button>
    <button id='bt2' ><a href="index.php?manage=orders&chitiet=true&mahd=
        <?php
            if(isset($_GET['mahd'])){
                $mhd=$_GET['mahd'];
            echo $mhd;
        }?>&tt=<?php
        if(isset($_GET['tt'])){
            $msp=$_GET['tt'];
            echo $msp;
        }
        ?>">Hủy</a></button>
</div>
<style>
    #thongbaoxoa{
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
    #bt1{
        width: 50px;
        height: 50px;
        position: absolute;
        bottom: 20px;
        left: 50px;
    }
    #bt2{
        width: 50px;
        height: 50px;
        position: absolute;
        bottom: 20px;
        right: 50px;
    }
</style>