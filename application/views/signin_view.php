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
							<a href="<?php echo site_url('login');?>" id="login-form-link">Login</a>
						</div>
						<div class="col-xs-6">
							<a href="<?php echo site_url('signin');?>" class="active" id="register-form-link">Register</a>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-login">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo form_open('signin/validate'); ?>
								<div class="form-group">
									<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>">
								</div>
								<div class="form-group">
									<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
								</div>
								<div class="form-group">
									<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
								</div>
								<div class="form-group">
									<input type="password" name="cpassword" id="cpassword" tabindex="2" class="form-control" placeholder="Confirm Password">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
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