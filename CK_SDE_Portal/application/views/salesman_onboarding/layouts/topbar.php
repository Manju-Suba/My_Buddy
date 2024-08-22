<header class="top-header">
	<nav class="navbar navbar-expand">
		<div class="left-topbar d-flex align-items-center">
			<a href="javascript:;" class="toggle-btn">	<i class="bx bx-menu"></i>
			</a>
		</div>
		<div class="flex-grow-1" style="margin-left:5px;margin-top: 5px;">
			<a href="<?php echo tso_portal_home_url();?>"><h6><i class='bx bx-home-alt'></i> > SDE Portal</h6></a>
		
		</div>

		<div class="right-topbar ml-auto">
			<ul class="navbar-nav">
				
				<li class="nav-item dropdown dropdown-user-profile">
					<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
						<div class="media user-box align-items-center">
							<div class="media-body user-info">
								<p class="user-name mb-0"><?php echo $this->session->userdata('username'); ?></p>
								<p class="designattion mb-0"><?php echo $this->session->userdata('business'); ?> | 
									<?php 
										if($this->session->userdata('role_type') =='TSO'){ 
											echo "SDE";
										}elseif($this->session->userdata('role_type') =='VA'){
											echo "VSO";
										}else{
											echo $this->session->userdata('role_type'); 
										}
									?>
								</p>
							</div>
							<img src="<?php echo asset_url();?>images/user.png" class="user-img" alt="user avatar">
							<!-- <img src="https://via.placeholder.com/110x110" class="user-img" alt="user avatar"> -->
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right">	
						<a class="dropdown-item only-small-device" style="cursor:none;">
							<span><?php echo $this->session->userdata('username'); ?></span>
							-(<?php 
								if($this->session->userdata('role_type') =='TSO'){ 
									echo "SDE";
								}elseif($this->session->userdata('role_type') =='VA'){
									echo "VSO";
								}else{
									echo $this->session->userdata('role_type'); 
								}
							?>)
						</a>
					
						<a class="dropdown-item" href="<?php echo base_url();?>index.php/logout"><i
								class="bx bx-power-off"></i><span>Logout</span></a>
					</div>
				</li>
				
			</ul>
		</div>
	</nav>
</header>

<style>
	.only-small-device{
		display: none;
	}

	@media (min-width: 334px) and (max-width: 380px) {
		.only-small-device{
			display: block;
		}
		.bx.bx-home-alt{
			font-size: 24px;
		}
	}
	
</style>