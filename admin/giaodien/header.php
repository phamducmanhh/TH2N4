		<!-- MAIN HEADER -->
		
		<div id="nd">
			
			<?php 
				include('./connect_db.php');
				include('./function.php');	
				$text = "Hello: " . $_SESSION['nguoidung'];
				echo '<div style="text-transform:uppercase;margin-right:5px">' .$text ."</div>";
				
			?>
		</div>
		<a style="float: left;
				  color: white;
				  margin-left: 20px;" 
		   href="./index.php?logout=yes" ><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
		