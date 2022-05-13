<style>
html{
	scroll-behavior: smooth;
}
.link{
	padding: 10px 15px;
	background: transparent;
	border:#bccfd8 1px solid;
	border-left:0px;
	cursor:pointer;
	color:#607d8b
}
.disabled{
	cursor:not-allowed;
	color: #bccfd8;
}
.current{
	background: #bccfd8;
}
.first{
	border-left:#bccfd8 1px solid;
}
#pagination{
	margin-top: 20px;

	padding-top: 30px;
	border-top: #F0F0F0 1px solid;
}
#pagination a{
	text-decoration:none;
}
#paginationWrapper{
	width:100%;
	text-align:center
}
.dotSign{
	padding:10px 13px;
	background:none;
	border-right: #bccfd8 1px solid;
}
</style>
<?php
    // Xu Lý Số Liệu HIện Thị Cho Danh Mục//
    $querySize="SELECT DISTINCT KICH_THUOC  FROM `sanpham` ";
    $queryLoai="SELECT DISTINCT LOAI_SP  FROM `sanpham` ";
    $getSize=mysqli_query($connect,$querySize);
    $getLoai=mysqli_query($connect,$queryLoai);
?>
<script>
function getresult(url) {
	$.ajax({
		url: url,
		type: "GET",
		data:  {rowcount:$("#rowcount").val()},
		success: function(data){
			$("#pagination-result").html(data);
		}        
   });
}
</script>
	<!-- top Products -->
<div class="ads-grid py-sm-5 py-4 all-product ">
			<div class="row">
            	<script>
					getresult("giaodien/getresult.php<?php 
						$check=isset($_GET['type']);
						if($check){
							$type=$_GET['type'];
							echo "?type=$type";
						}
					?>");
				</script>
				<!-- product right -->
				<div class="product-right col-md-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						<div class="search-hotel border-bottom py-2 row">
							<h4 class="agileits-sear-head mb-3 col-md-12 col-sm-12" style="font-weight: bold;text-shadow: 2px 2px #eee; color: #f1a80a;"
							>TÌM KIẾM SẢN PHẨM</h4>

								<input  class="col-md-8 col-sm-8 mr-1 ml-3 form-control" type="text" id="name">
								<button class="col-md-3 col-sm-3 btn btn-outline-success" id="submitSearch" onclick="validatePrice()">Tìm Kiếm</button>
						</div>
						<!-- price -->
						<div class="range border-bottom py-2" style="font-weight: bold;" >
							<h4 class="agileits-sear-head mb-3" style="font-weight: bold;text-shadow: 2px 2px #eee; color: #3bb137;">Khoảng Giá</h4>
							Từ:
                            <p><input class="form-control" id="min_price" type="text"placeholder="VD: 0" /></p>
                            Đến:
                            <p><input  class="form-control" id="max_price" type="text" placeholder="VD: 100000"  /></p>
						</div>
					
						<div class="left-side border-bottom py-2">
							<h4 class="agileits-sear-head mb-3" style="font-weight: bold;text-shadow: 2px 2px #eee; color: #ad1010;">Loại Sản Phẩm</h4>
							<ul>
                                <?php
                                    while($row_type_product=mysqli_fetch_array($getLoai)){ 
                                ?>
								<li>
									<input type="checkbox" class="type" value="<?php echo $row_type_product['LOAI_SP']; ?>" >
									<span class="span" style="font-weight: bold;" ><?php echo $row_type_product['LOAI_SP']  ?></span>
								</li>
                                <?php
                                    }
                                ?>							
							</ul>
						</div>
						<div class="left-side border-bottom py-2">
							<h4 class="agileits-sear-head mb-3" style="font-weight: bold;text-shadow: 2px 2px #fff; color: #1a26c9">Kích Thước</h4>
							<ul>
                                <?php
                                    while($row_size_product=mysqli_fetch_array($getSize)){ 
                                ?>
								<li>
									<input type="checkbox" class="size" value="<?php echo $row_size_product['KICH_THUOC']; ?>">
									<span class="span" style="font-weight: bold;" ><?php echo $row_size_product['KICH_THUOC']  ?></span>
								</li>
                                <?php
                                    }
                                ?>							
							</ul>
						</div>
					
					</div>
					<!-- //product right -->
				</div>
                <!-- product left -->
				
				<div id="pagination-result" class="col-md-9 col-sm-12 row product ">
                			<input type="hidden" name="rowcount" id="rowcount" />
                </div>
			</div>
		
	</div>
	<!-- //top products -->
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>


    function filter_data()
    {
        $('#pagination-result').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
		var name = $('#name').val();
        var minimum_price = $('#min_price').val();
        var maximum_price = $('#max_price').val();
        var type = get_filter('type');
        var size = get_filter('size');
        $.ajax({
            url:"giaodien/fetch_data.php<?php 
						$check=isset($_GET['type']);
						if($check){
							$type=$_GET['type'];
							echo "?type=$type";
						}
					?>",
            method:"POST",
            data:{action:action, name:name, minimum_price:minimum_price, maximum_price:maximum_price, typePro:type, size:size},
            success:function(data){
                $('#pagination-result').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
	function validatePrice(){
		var patt=/^\d+/;
		var minPrice=$("#min_price").val();
		var maxPrice=$("#max_price").val();
		if(minPrice!="" || maxPrice!="")
			if(!minPrice.match(patt) || !maxPrice.match(patt)){
			alert("Khoảng giá không hợp lệ");
			return 0;
			}
		if(minPrice==0)
			$("#min_price").val('00');	
		if(maxPrice==0)
			$("#max_price").val('00');
		filter_data();
	}
</script>