<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div>
				<?php echo validation_errors(); ?>
			</div>
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<a href="<?php echo site_url('login');?>" class="active" id="login-form-link">Login</a>
						</div>
						<div class="col-xs-6">
							<a href="<?php echo site_url('signin');?>" id="register-form-link">Register</a>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-login">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo form_open('Login/verifyLogin'); ?>
								<div class="form-group">
									<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
								</div>
								<div class="form-group">
									<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
										</div>
									</div>
								</div>
								<center> - OR - </center>
								<br>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6 col-sm-offset-3">
											<div class="text-center">
												<a href="<?php echo $login_url; ?>"><button class="form-control btn btn-primary">Connect With FB</button></a>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>