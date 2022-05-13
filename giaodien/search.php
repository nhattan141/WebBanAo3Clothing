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
	if(isset($_POST['search_submit']) ){
        $tukhoa=$_POST['search_product']; 
        $query2=" SELECT * from sanpham WHERE TEN_SP LIKE '%$tukhoa%' GROUP BY TEN_SP ORDER BY DON_GIA ASC";
    }
    $img="";$title_result="";
    if(mysqli_fetch_array(mysqli_query($connect,$query2))==null) { $img="./images/no-result.png";$title_result="KHÔNG TÌM THẤY SẢN PHẨM  ";}

   
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
<div class="ads-grid py-sm-5 py-4 all-product ">
        <div class="title_search ">
            <span class="keyword_search">TÌM KIẾM THEO TỪ KHOÁ:  <strong><?php echo $tukhoa ?></strong></span>
        </div>
        <h1 class="no_result_search" ><?php echo $title_result ?> </h1>
        <img class="no_result_search_img"  style="width: 50%;margin: 0 25%;"   src="<?php echo$img?>">
        <div class="row">
        	<script>
				getresult("giaodien/getresult_search.php<?php echo "?search_product=$tukhoa" ?>");
			</script>
            <div id="pagination-result" class="col-md-12 col-sm-12 row product ">
                <input type="hidden" name="rowcount" id="rowcount" />
            </div>

        </div>
</div>

