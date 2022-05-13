<?php
    if(isset($_GET['ngaybatdau']) && isset($_GET['ngayketthuc'])){
        $Timestart = $_GET['ngaybatdau'];
        $Timesend = $_GET['ngayketthuc'];
    }
    header('location: index.php?manage=orders&ngaybatdau='.$Timestart.'&ngayketthuc='. $Timesend);
?>