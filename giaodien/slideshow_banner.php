<div class="slideshow-container">
			<?php
			$i=0;
			$result=mysqli_query($connect,"SELECT * FROM slider WHERE active = '1' LIMIT 6 " );
			while($row_slider=mysqli_fetch_array($result)){
				$i++;
			?>
			<div class="mySlides fade">
						  <img class="img-fluid" src="images/banner/<?php echo $row_slider['src']?>" >
			</div>
			<?php
			}
			?>
		</div>
		<br>

		<div style="text-align:center">
		<?php 
			for($j=0;$j<$i;$j++){
				echo '<span class="dot"></span> ';
			}
		?>
		</div>