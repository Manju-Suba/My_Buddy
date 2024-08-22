<header class="top-header">
    <?php if($this->session->userdata('role') !='RSSM'){ ?>
    <div class="sidebar-header">
        <div class="">
            <img src="<?php echo asset_url();?>images/mybuddy_logo.png" class="logo-icon-2" alt="" />
        </div>
        <div>
            <h4 class="logo-text">My Buddy</h4>
        </div>
    </div>
    <?php } ?>

    <nav class="navbar navbar-expand">
        <div class="left-topbar d-flex align-items-center">
            <a href="javascript:;" class="toggle-btn"> <i class="bx bx-menu"></i></a>
        </div>
        <div class="flex-grow-1" style="margin-left:5px;margin-top: 5px;">
            <?php if($this->session->userdata('role') !='RSSM' && $this->session->userdata('role') !='SI'){ ?>
                <a href="<?php echo tso_portal_home_url();?>"><h6><i class='bx bx-home-alt'></i> >SDE Dashboard</h6></a>
            <?php } ?>
        </div>

        <div class="right-topbar ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown dropdown-user-profile">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-toggle="dropdown">
                        <div class="media user-box align-items-center">
                            <div class="media-body user-info">
                                <p class="user-name mb-0"><?php echo $this->session->userdata('username'); ?></p>
                                <p class="designattion mb-0"><?php
                                    if(json_decode($this->session->userdata('business'))){
                                        $business =  json_decode($this->session->userdata('business'));
                                        $i =1;
                                        foreach ($business as $key => $value) {
                                            if($i > 1){
                                                echo "/";
                                            }
                                            echo $value;
                                            $i++;
                                        }
                                    }else{
                                        if($this->session->userdata('business') == '[]'){

                                        }else{
                                            echo $this->session->userdata('business');
                                        }
                                    }
                                  ?> | 
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
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a> -->
                        
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

                        <a class="dropdown-item" href="javascript:;" onclick="get_change_pass_pop();"><i class="bx bx-key"></i><span>Change Password</span></a>
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

	@media (min-width: 280px) and (max-width: 380px) {
		.only-small-device{
			display: block;
		}
		.bx.bx-home-alt{
			font-size: 24px;
		}
	}
	
    /* @media (min-width: 700px) and (max-width: 1000px) { */

        /* .logo-text{
            display:none;
        } */

        /* .sidebar-header {
            width: 66px;
        } */
    /* } */


</style>
