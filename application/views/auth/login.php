<?php 
			$username = isset($_POST['username']) ? sanitize($_POST['username']) : '';
			$username = trim($username);
			$password = isset($_POST['password']) ? sanitize($_POST['password']) : '';
			$password = trim($password);
			
			
			$errors = array();
			
?>

    
	
	<section class="login-content">
			<p class="text-aja"> KASIRKU <i class="fa fa-cart-arrow-down"></i></p>
		<div class="logo"></div>
		<div class="col-md-6 col-sm-6 col-xs-8">
			<?php if($this->session->flashdata('error')){ echo $this->session->flashdata('error');} ?>
		</div>
        <div class="row">
        <div class="col-md-6 ">
            <img class="img-goyang" src="https://i0.wp.com/capitalsoutsider.com/wp-content/uploads/2012/01/LegoVechkinLARGEtransparent.gif?resize=400%2C404&ssl=1" width="370px  vertical-center justify-content-center">
        </div>
        <div class="col-md-6">
		    <div class="login-box">
			
		<form class="login-form" method="POST" action="<?= base_url('auth/login');?>">
			<h3 class="login-head"><i class="fa fa-user-circle-o"></i> Login</h3>
				<div class="form-group">
					<label class="control-label">Username</label>
					<input class="form-control" name="username" onkeyup="this.value = this.value.toUpperCase()" type="text" placeholder="Username" value="<?= $username; ?>" autofocus required>
					<?= form_error('username', '<small class="text-danger">', '<small>');?>
				</div>
				<div class="form-group">
					<label class="control-label">Password</label>
    					<div class="input-group">
					        <input class="form-control" type="password" id="password"  name="password" placeholder="Password" value="<?= $password; ?>" required>
							<?= form_error('password', '<small class="text-danger">', '<small>');?>

							<div class="input-group-append mb-3">
								<span class="input-group-text" id="basic-addon2" style="background-color:white;">
									<i style="font-size:22px;" id="show" onclick="show()" class="fa fa-eye-slash pont"></i>
									<i style="font-size:22px;color: orange;" id="hide" onclick="hide()" class="fa fa-eye pont" hidden=""></i></span>
							</div>
						</div>
                    <!-- <p class="semibold-text mb-2"><a style="text-decoration: none;" href="#" data-toggle="flip">Belum Punya Akun ?</a></p> -->

				</div>
				
				
				<div class="form-group btn-container">
					<button type="submit" class="btn btn-warning btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Login</button><br><br>
					</div>
					<br>

			</form>

           
         </div>
		</div>
	</section>


</div>
</body>


