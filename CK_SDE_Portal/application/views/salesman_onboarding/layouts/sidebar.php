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
        <li class="menu-label">RSSM Recruitment</li>

        <?php

        if($this->session->userdata('role_type') =='TSO'){
            ?>
                <li class="rform_m">
                    <a href="<?php echo base_url();?>index.php/add_rssm_rec_form">
                        <div class="parent-icon icon-color-2"><i class="lni lni-write"></i>
                        </div>
                        <div class="menu-title">Recruitment Form</div>
                    </a>
                </li>
                <li class="reform_m">
                    <a href="<?php echo base_url();?>index.php/rssm_entered_form">
                        <div class="parent-icon icon-color-3"><i class="bx bx-comment-edit"></i>
                        </div>
                        <div class="menu-title">Entered Form</div>
                    </a>
                </li>
                <li class="rfform_m">
                    <a href="<?php echo base_url();?>index.php/rssm_funnel_form">
                        <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                        </div>
                        <div class="menu-title">Funnel Form</div>
                    </a>
                </li>
                <li class="rejected_form">
                    <a href="<?php echo base_url();?>index.php/rssm_rejected_form">
                        <div class="parent-icon icon-color-8"><i class="bx bx-grid-alt"></i>
                        </div>
                        <div class="menu-title">RSSM Rejected Form</div>
                    </a>
                </li>
            <?php
        }
        elseif($this->session->userdata('role_type') =='ASM'){
            ?>
                <li class="va_vform_m">
                    <a href="<?php echo base_url();?>index.php/va_verified_forms">
                        <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Entered Forms</div>
                    </a>
                </li>
                <li class="asm_vform_m">
                    <a href="<?php echo base_url();?>index.php/asm_verified_forms">
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

                <!-- <li class="asm_eform_m">
                    <a href="<?php echo base_url();?>index.php/rssm_eform_asm">
                        <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                        </div>
                        <div class="menu-title">Entered Forms</div>
                    </a>
                </li> -->
                <li class="asm_fform_m">
                    <a href="<?php echo base_url();?>index.php/rssm_fform_asm">
                        <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                        </div>
                        <div class="menu-title">Funnel Form</div>
                    </a>
                </li>
                
                
            <?php
        }
        elseif($this->session->userdata('role_type') =='ZSM'){
            ?>
                <li class="va_vform_m">
                    <a href="<?php echo base_url();?>index.php/va_verified_forms_zsm">
                        <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Entered Forms</div>
                    </a>
                </li>
                <li class="asm_vform_m">
                    <a href="<?php echo base_url();?>index.php/zsm_verified_forms">
                        <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                        </div>
                        <div class="menu-title">Approved Forms</div>
                    </a>
                </li>
                <li class="asm_fprospect_m">
                    <a href="<?php echo base_url();?>index.php/zsm_future_prospect">
                        <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                        </div>
                        <div class="menu-title">Future Prospect</div>
                    </a>
                </li>

                <li class="asm_eform_m">
                    <a href="<?php echo base_url();?>index.php/rssm_eform_zsm">
                        <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                        </div>
                        <div class="menu-title">Entered Forms</div>
                    </a>
                </li>
                <li class="asm_fform_m">
                    <a href="<?php echo base_url();?>index.php/rssm_fform_zsm">
                        <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                        </div>
                        <div class="menu-title">Funnel Form</div>
                    </a>
                </li>
            <?php
        }
        elseif($this->session->userdata('role_type') =='LEADER' ||$this->session->userdata('role_type') =='MLEADER'){
            ?>
                <li class="va_vform_m">
                    <!-- <a href="<?php echo base_url();?>index.php/sde_submitted_forms_ldr"> -->
                    <a href="<?php echo base_url();?>index.php/rssm_eform_ldr">

                        <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Entered Forms</div>
                    </a>
                </li>
                <li class="asm_vform_m">
                    <a href="<?php echo base_url();?>index.php/ldr_verified_forms">
                        <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                        </div>
                        <div class="menu-title">ASM Approved Forms</div>
                    </a>
                </li>
                <li class="asm_fprospect_m">
                    <a href="<?php echo base_url();?>index.php/ldr_future_prospect">
                        <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                        </div>
                        <div class="menu-title">ASM Future Prospect</div>
                    </a>
                </li>

                <li class="rssm_verified_m">
                    <a href="<?php echo base_url();?>index.php/ldr_rssm_verified">
                        <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                        </div>
                        <div class="menu-title">RSSM  Verified Forms</div>
                    </a>
                </li>

                <li class="rssm_reject_m">
                    <a href="<?php echo base_url();?>index.php/ldr_rssm_reject">
                        <div class="parent-icon icon-color-5"><i class="bx  bx bx-grid-alt"></i>
                       
                        </div>
                        <div class="menu-title">RSSM Rejected Forms</div>
                    </a>
                </li>

                <!-- <li class="asm_eform_m">
                    <a href="<?php echo base_url();?>index.php/rssm_eform_ldr">
                        <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                        </div>
                        <div class="menu-title">Entered Forms</div>
                    </a>
                </li> -->
                <li class="asm_fform_m">
                    <a href="<?php echo base_url();?>index.php/rssm_fform_ldr">
                        <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                        </div>
                        <div class="menu-title">Funnel Form</div>
                    </a>
                </li>
            <?php
        }
        elseif ($this->session->userdata('role_type') =='VA') {
            ?>
            <li class="va_eform_m">
                    <a href="<?php echo base_url();?>index.php/rssm_eform_va">
                        <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                        </div>
                        <div class="menu-title">Entered Forms</div>
                    </a>
                </li>
            <?php
        }
        ?>
        
    </ul>
    <!--end navigation-->
</div>