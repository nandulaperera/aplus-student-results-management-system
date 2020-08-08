<?php
if(!$this->session->userdata('loggedIn')){
	redirect("Home");
}else {
	?>
	<?php include('templates/header.php'); ?>
	<div class="container mt-5">
		<?php if ($this->session->flashdata("auth_error")!='') { ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Invalid credentials!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php } elseif ($this->session->flashdata("update_failed")!='') { ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Oops. Something went wrong!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php } ?>
		<div class="row flex-lg-nowrap">
			<div class="col">
				<div class="row">
					<div class="col mb-3">
						<div class="card">
							<div class="card-body">
								<div class="e-profile">
									<div class="row">
										<div class="col-12 col-sm-auto mb-3">
											<div class="mx-auto" style="width: 140px;">
												<div
													class="d-flex justify-content-center align-items-center rounded-circle"
													style="height: 140px; background-color: rgb(233, 236, 239);">
													<i class="fa fa-user fa-5x"></i>
												</div>
											</div>
										</div>
										<div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
											<div class="text-center text-sm-left mb-2 mb-sm-0">
												<h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $this->session->userdata('name'); ?></h4>
												<p class="mb-0 text-muted"><?php echo $this->session->userdata('email'); ?></p>
											</div>
										</div>
									</div>
									<?php echo form_open("UserProfile/saveChanges"); ?>
									<?php echo validation_errors(); ?>
									<div class="row">
										<div class="col">
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label>Full Name</label>
														<input class="form-control" type="text" name="name"
															   value="<?php echo $this->session->userdata('name'); ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label>Email</label>
														<input class="form-control" type="email" name="email"
															   value="<?php echo $this->session->userdata('email'); ?>"
															   readonly>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 col-sm-6 mb-3">
											<div class="mb-2"><b>Change Password</b></div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label>Current Password</label>
														<input class="form-control" type="password" name="old_password">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label>New Password</label>
														<input class="form-control" type="password" name="new_password">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label>Confirm <span class="d-none d-xl-inline">Password</span></label>
														<input class="form-control" type="password"
															   name="c_new_password"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col d-flex justify-content-end">
											<button class="btn btn-primary" type="submit">Save Changes</button>
										</div>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php include('templates/footer.php');
}?>
