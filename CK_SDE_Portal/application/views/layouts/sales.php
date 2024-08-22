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


        <?php

            if($this->session->userdata('role_type') =='RSSM'){
        ?>
            <li class="kyc_form_m">
                <a href="<?php echo base_url();?>index.php/kyc_update">
                    <div class="parent-icon icon-color-3"><i class="bx bx-comment-edit"></i>
                    </div>
                    <div class="menu-title">KYC Update</div>
                </a>
            </li>

            <li class="rssm_form_m">
                <a href="<?php echo base_url();?>index.php/rssm_verified">
                    <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                    </div>
                    <div class="menu-title">Rssm Verified</div>
                </a>
            </li>
            <li class="rejected_rssm">
                <a href="<?php echo base_url();?>index.php/rssm_rejected">
                    <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                    </div>
                    <div class="menu-title">Rssm Rejected</div>
                </a>
            </li>
        <?php
            }else if($this->session->userdata('role_type') =='RSSM_Head'){
        ?>
            <li class="kyc_form_m">
                <a href="<?php echo base_url();?>index.php/entered_forms">

                    <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Entered Forms</div>
                </a>
            </li>

            <li class="rssm_form_m">
                <a href="<?php echo base_url();?>index.php/rssm_verified">
                    <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                    </div>
                    <div class="menu-title">Rssm Verified Form</div>
                </a>
            </li>
            <li class="rejected_rssm">
                <a href="<?php echo base_url();?>index.php/rssm_rejected">
                    <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                    </div>
                    <div class="menu-title">Rssm Rejected Form</div>
                </a>
            </li>

        <?php
            }else if($this->session->userdata('role_type') =='QC'){
        ?>
            <!-- <li class="qc_verification">
                <a href="<?php echo base_url();?>index.php/qc_verification">

                    <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Entered Forms</div>
                </a>
            </li> -->
        <?php
            } 
        ?>
    </ul>
    <!--end navigation-->
</div>