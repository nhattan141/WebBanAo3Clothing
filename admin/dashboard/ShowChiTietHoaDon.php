<div class="form_chitiet" id="chitiethoadon">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 style="margin-left: 20px">Mã Hóa Đơn: <?php echo $_GET['mahd'];?></h3>
            </div>
            <div style="margin-right: 20px">
                <a class="close-link" style="cursor: pointer;padding-right: 50px;float: right;" onclick="dongchitiethoadon()">
                    <i class="fa fa-close" ></i>
                </a>
            </div>
        </div>         
        <div class="clearfix"></div>
        
        <?php
            $MAHD;
            $con = mysqli_connect("localhost", "root", "", "doanweb2");
        $div='<div class="th"></div>
        <div class="th">Mã Sản Phẩm</div>
        <div class="th">Số Lượng</div>
        <div class="th">Tiền Giảm Giá</div>
        <div class="th">Đơn Giá</div>
        <div class="th">Thành Tiền</div>';
        if (isset($_GET['chitiet']) && isset($_GET['mahd'])) {
            $Chitiet = $_GET['chitiet'];
            $MAHD = $_GET['mahd'];
            $tt;
            if (isset($_GET['tt'])) {
                $tt=$_GET['tt'];
            }
            if ($Chitiet == 'true') {
                $sql = "SELECT * FROM chitiethoadon WHERE MA_HD = '$MAHD' ";
        
                mysqli_query($con, "SET NAMES 'utf8");
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                    // Load dữ liệu lên website
                    while ($row = $result->fetch_assoc()) {
                        $tien=($row["DON_GIA"]*$row["SO_LUONG"])-$row["TIEN_GIAM_GIA"];
                        $msp=$row["MA_SP"];
                        $div .= '<div class="th"><a href="index.php?manage=orders&suachitiet=true&mahd=' . $row["MA_HD"] . 
                        '&masp=' . $row["MA_SP"] .
                        '&sl=' . $row["SO_LUONG"] .
                        '&tgg=' . $row["TIEN_GIAM_GIA"] .
                        '&dg=' . $row["DON_GIA"] .
                        '&thanhtien=' . $row["THANH_TIEN"] . 
                        '&tt=' . $tt .'">Sửa' .
                        '</a><a href="index.php?manage=orders&xoachitiet=true&mahd='. $row["MA_HD"] .
                        '&masp='. $row["MA_SP"] .
                        '&tt='.$tt.'">Xóa' .
                        '</a>
                        </div><div class="th">' . $row["MA_SP"] .
                        '</div><div class="th">' . $row["SO_LUONG"] . 
                        '</div><div class="th">' . $row["TIEN_GIAM_GIA"] .
                        'vnđ</div><div class="th">' . $row["DON_GIA"] .
                        'vnđ</div><div class="th">' . $tien .
                        'vnđ</div>';
                        $sql2="UPDATE chitiethoadon SET THANH_TIEN ='$tien' WHERE MA_HD = '$MAHD' AND MA_SP='$msp'";
                        mysqli_query($con, $sql2);
                    }
                }
            }
            echo  $div;
        }
        
        
    ?>
    <p>Tổng:-----------------------------------------------------------------------------------------------------------------------------<?php
        $con = mysqli_connect("localhost", "root", "", "doanweb2");
        $sum = 0;
        if (isset($_GET['chitiet']) && isset($_GET['mahd'])) {
            
            $MAHD = $_GET['mahd'];
            
            if ($Chitiet == 'true') {
                $sql2 = "SELECT SUM(THANH_TIEN) AS TONG FROM chitiethoadon WHERE MA_HD='$MAHD'";
                $result2 = mysqli_query($con, $sql2);
                    if ($result2->num_rows > 0) {
                        // Load dữ liệu lên website
                        while ($row = $result2->fetch_assoc()) {
                            $sum += $row["TONG"];
                        }
                    }
            }
            
        }
                
        echo  $sum.'vnđ';
        
    ?></p>     
    </div>
    <button id="btthem"><a href="index.php?manage=orders&themchitiet=true&mahd=<?php echo $MAHD;?>
    &tt=<?php if (isset($_GET['tt'])) {
                    $tt=$_GET['tt'];
                    echo $tt;
                }
            ?>
    ">Thêm</a></button>
</div>

<style>
    #btthem {
        height: 25px;
        width: 50px;
        margin-left: 650px;
    }
    .form_chitiet {
        width: 740px;
        height: 300px;
        position: absolute;
        top: 150px;
        left: 25%;
        background-color: rgb(230, 228, 228);
        z-index: 200;
        overflow-y: auto;
    }
    .tbchitiet {
        text-align: center;
        overflow-x: auto;
        table-layout: fixed;
    }
    .tr {
        text-align: center;
        height: 40px;
        float: left;
    }
    
    .th {
        text-align: center;
        width: 120px;
        height: 40px;
        float: left;
        border-right: #73879C dotted 2px;
    }
    .th :last-child{
        text-align: center;
        width: 120px;
        height: 40px;
        float: left;
        border-right: none;
    }

    h1 {
        text-align: center;
        color: rgba(123, 86, 253, 0.685);
    }
    .form_chitiet p{
        margin-left: 50px;
    }
</style>
