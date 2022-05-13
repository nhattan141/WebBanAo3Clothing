<?php
        if(isset($_GET['id_order']) ) {
            $id_order=$_GET['id_order'];
        $query1="SELECT p.MA_SP,p.TEN_SP,od.DON_GIA,SUM(od.SO_LUONG) AS SO_LUONG ,od.THANH_TIEN,p.KICH_THUOC,p.HINH_ANH_URL 
        from sanpham as p inner join chitiethoadon as od on p.MA_SP = od.MA_SP WHERE od.MA_HD='$id_order' GROUP BY od.MA_SP ORDER BY SUM(od.SO_LUONG)";
        
        $result=mysqli_query($connect,$query1);
        }

?>
<div class="detail-order-table">
<div class="wrapper table-responsive-lg ">
	<table class="table table-bordered order_summary">
        <thead>
            <tr>
                <th>STT</th>
                <th class="order_product">HÌNH ẢNH</th>
                <th>SẢN PHẨM</th>
                <th>SỐ LƯỢNG</th>
                <th>ĐƠN GIÁ</th>               
                <th>TỔNG CỘNG</th>

            </tr>
        </thead>
        <tbody>
            <?php
             $stt=1;$paywithoutendow=0;$endow=0;
                while($row_detail_order=mysqli_fetch_array($result)){                 
                    $idproduct=$row_detail_order['MA_SP'];
                    $url=$row_detail_order['HINH_ANH_URL'];
                    $nameproduct=$row_detail_order['TEN_SP'];
                    $amount=$row_detail_order['SO_LUONG'];
                    $price=$row_detail_order['DON_GIA'];
                    $totalprice=$row_detail_order['THANH_TIEN'];
                    $size=$row_detail_order['KICH_THUOC'];
                    
                    $paywithoutendow= $paywithoutendow + $totalprice;
                    $endow=0;
                    $pay=$paywithoutendow-$endow;

            ?>
            <tr>
            <td class="number_list"><span class="label label-success"><?php echo $stt ; ?></span>
                </td>
                <td class="order_product">
                    <a href="index.php?quanly=detail&id=<?php echo $idproduct ?>"><img  class="img_order" src="./images/product-items/<?php echo $url ?>" alt="Sản Phẩm">
                    </a>
                </td>
                <td class="order_description">
                    <p class="product-name"><a href="index.php?quanly=detail&id=<?php echo $idproduct ?>"><?php echo $nameproduct ?> </a>
                    </p>
                    <small class="order_ref">MÃ SP: <?php echo $idproduct ?></small>
                    <br>
                    <br>
                    <small class="order_ref"> KÍCH THƯỚC :<?php echo $size?></small>
                </td>
                <td class="order_avail"><?php echo $amount ?>
                </td>
                <td class="price"><span><?php echo number_format($price) ?> VNĐ</span>
                </td>    
                <td class="price">
                    <span><?php echo number_format($totalprice) ?> VNĐ</span>
                </td>
                
            </tr>
            <?php
                    $stt+=1;
                }
            ?>
          
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" rowspan="3"></td>
                <td colspan="2"><strong>Tổng Tiền Chưa Ưu Đãi: </strong></td>
                <td colspan="2"><?php echo number_format($paywithoutendow) ?> VNĐ</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Tiền Ưu Đãi (nếu có):</strong>
                </td>
               
                <td colspan="2"><strong><?php echo number_format($endow) ?> VNĐ </strong>
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong>Tiền Thanh Toán:</strong>
                </td>
                <td colspan="2"><strong><?php echo number_format($pay) ?> VNĐ </strong>
                </td>
            </tr>
        </tfoot>
    </table>	
   
</div>
</div>