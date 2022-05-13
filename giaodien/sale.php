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
    	<script>
			getresult("giaodien/getresult_sale.php<?php 
				$check=isset($_GET['type']);
				if($check){
					$type=$_GET['type'];
					echo "?type=$type";
				}
			?>");
		</script>
        <div id="pagination-result" class="col-md-12 col-sm-12 row product">
                <input type="hidden" name="rowcount" id="rowcount" /> 
        </div>
	</div>	
    
