		<!-- MAIN HEADER -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />		
		
		<h4 style="color: #fafafe;
					font-weight: 700;
					margin: 0 0 10px;
					padding-left: 21px;">DASHBOARD</h4>
<div id="nd">
		
		<?php 
			include('./connect_db.php');
			include('./function.php');	
		?>
		<div class="logout_top" style="margin-top: -8px;
    			padding-bottom: 5px;">
		<?php
			echo '<i class="fa-regular fa-user"></i>'. $text = " Hello: " . $_SESSION['nguoidung'];
			//echo '<div  style="text-transform:uppercase;margin-right:5px" >' .$text ."</div>";
		?>
		</div>
		<div class="logout_bottom">
		<a style="color: white; padding-top: 5px"href="./index.php?logout=yes" >  <i class="fa-solid fa-right-from-bracket"> </i> Logout</a>
		</div>
		
</div>
		