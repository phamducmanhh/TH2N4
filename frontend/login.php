<div class="row">
    
		<form action='index.php?act=login'style="text-align:center;" class="dangnhap" method='POST'> 
		<br><h3 class="title">ĐĂNG NHẬP TÀI KHOẢN</h3><br><br>
		<input style="width:250px"class="input"type='text1' name='username' placeholder="Username" /> <br><br>
		<input style="width:250px"class="input" type='password' name='password' placeholder="Password" /> <br><br>
        <input class="btn btn-danger" type='submit' class="button" name="dangnhap" value='Đăng nhập' /> 
		<br><br><span>Bạn chưa có tài khoản?</span> <a href='index.php?act=register' title='Đăng ký'>Đăng ký</a><br>
		<?php require 'xulydangnhap.php';?> 
		<form>

</div><br><br><br><br>