<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="">
            <img src="<?php echo asset_url();?>images/mybuddy_logo.png" class="logo-icon-2" alt="" />
        </div>
        <div>
            <h4 class="logo-text">My Buddy</h4>
        </div>
        <a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <!-- <li class="dash_m"> 
            <a href="<?php echo base_url();?>index.php/PageController/dashboard">
                <div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li> -->

        <?php   if ($this->session->userdata('role_type') =='COMMERCIAL'){ ?>
            <li id="asmver" class="pending_comercial">
                <a href="<?php echo base_url();?>index.php/pending_form_comercial?type=Pending">
                    <div class="parent-icon icon-color-6"><i class="bx bx-grid-alt"></i>
                    </div>
                    <div class="menu-title">Pending</div>
                </a>
            </li>
            <li class="approved_comercial">
                <a href="<?php echo base_url();?>index.php/approved_form_comercial?type=Approved">
                    <div class="parent-icon icon-color-5"><i class="bx bx-task"></i>
                    </div>
                    <div class="menu-title">Approved</div>
                </a>
            </li>
        <?php } ?>
        

        <?php
            if($this->session->userdata('role_type') =='TSO'){
        ?>
                <li class="menu-label">RS onboarding</li>

                    <li class="rform_m">
                        <a href="<?php echo base_url();?>index.php/rs_appointment_form">
                            <div class="parent-icon icon-color-2"><i class="lni lni-write"></i>
                            </div>
                            <div class="menu-title">RS Appointment Form</div>
                        </a>
                    </li>
                    <li class="reform_m">
                        <a href="<?php echo base_url();?>index.php/rs_entered_form">
                            <div class="parent-icon icon-color-3"><i class="bx bx-comment-edit"></i>
                            </div>
                            <div class="menu-title">Entered Forms</div>
                        </a>
                    </li>
                <?php
            }
            elseif($this->session->userdata('role_type') =='ASM'){
                ?>
                    <li class="asm_form">
                        <a href="<?php echo base_url();?>index.php/asm_pending_form">
                            <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                            </div>
                            <div class="menu-title">Entered Forms</div>
                        </a>
                    </li>
                    <li class="asm_vform_m">
                        <a href="<?php echo base_url();?>index.php/asm_approved_forms">
                            <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                            </div>
                            <div class="menu-title">Approved Forms</div>
                        </a>
                    </li>
                    <li class="asm_fprospect_m">
                        <a href="<?php echo base_url();?>index.php/asm_future_prospect">
                            <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                            </div>
                            <div class="menu-title">Future Prospect</div>
                        </a>
                    </li>
                <?php
            }
            else if($this->session->userdata('role_type') =='ZSM' ){
                ?>
                    <li class="zsm_form">
                        <a href="<?php echo base_url();?>index.php/zsm_pending_form">
                            <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                            </div>
                            <div class="menu-title">Entered Forms</div>
                        </a>
                    </li>
                    <li class="zsm_vform_m">
                        <a href="<?php echo base_url();?>index.php/zsm_approved_forms">
                            <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                            </div>
                            <div class="menu-title">Approved Forms</div>
                        </a>
                    </li>
                    <li class="zsm_fprospect_m">
                        <a href="<?php echo base_url();?>index.php/zsm_future_prospect">
                            <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                            </div>
                            <div class="menu-title">Future Prospect</div>
                        </a>
                    </li>
                <?php
            }
            ?>
    </ul>
    <!--end navigation-->
</div>