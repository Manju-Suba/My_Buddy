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
        if($this->session->userdata('pro_id') =='PRO10'){
            if($this->session->userdata('role_type') =='admin'){
                ?>
                    <li class="eform_m">
                        <a href="<?php echo base_url();?>index.php/settings">
                            <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title">Settings</div>
                        </a>
                    </li>
                    <li class="rform_m">
                        <a href="<?php echo base_url();?>index.php/report">
                            <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title">Report</div>
                        </a>
                    </li>
        
                <?php
            }else if($this->session->userdata('role_type') =='LEADER' || $this->session->userdata('role_type') =='MLEADER'){
                ?>
                    <li class="eform_m">
                        <a href="<?php echo base_url();?>index.php/settings">
                            <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title">Settings</div>
                        </a>
                    </li>
                    <li class="rform_m">
                        <a href="<?php echo base_url();?>index.php/report">
                            <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title">Report</div>
                        </a>
                    </li>
                    <li class="mform_m">
                        <a href="<?php echo base_url();?>index.php/masters">
                            <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title">Masters upload</div>
                        </a>
                    </li>
        
                <?php
            }else if($this->session->userdata('role_type') =='SM'){
                // if($this->session->userdata('pro_id') =='PRO16'){
                ?>
                    <li class="eform_m">
                        <a href="<?php echo base_url();?>index.php/scorecard">
                            <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title">Entered Forms</div>
                        </a>
                    </li>
                <?php
                // }else if($this->session->userdata('pro_id') =='PRO02'){

                // }
            }
            else{
                ?>
                    <li class="eform_m">
                        <a href="<?php echo base_url();?>index.php/Competition/competition_watch">
                            <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title">Entered Forms</div>
                        </a>
                    </li>
        
                <?php
            }
        } else if($this->session->userdata('pro_id') =='PRO02'){
           

                if($this->session->userdata('role_type') =='SM'){
                    ?>
                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/Competition/competition_watch">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Entered Forms</div>
                            </a>
                        </li>

                    <?php
                }else{
                    ?>
                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/Competition/competition_watch_report">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Entered Forms</div>
                            </a>
                        </li>

                    <?php
                }
               
        } else if ($this->session->userdata('pro_id') =='PRO05'){

            
            if($this->session->userdata('role_type') =='TSO'){
                ?>
            <li class="menu-label">RSSM Recruitment</li>

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
                            <div class="menu-title">Raised Requests</div>
                        </a>
                    </li>
                    <!-- <li class="rfform_m">
                        <a href="<?php echo base_url();?>index.php/rssm_funnel_form">
                            <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                            </div>
                            <div class="menu-title">Funnel Form</div>
                        </a>
                    </li> -->
                    <li class="rejected_form">
                        <a href="<?php echo base_url();?>index.php/rssm_rejected_form">
                            <div class="parent-icon icon-color-8"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title">Rejected Forms</div>
                        </a>
                    </li>
                    <!-- <li class="rejected_fee_form">
                        <a href="<?php echo base_url();?>index.php/fee_rejection_forms">
                            <div class="parent-icon icon-color-5"><i class="bx bx-task-x"></i></div>
                            <div class="menu-title"> Rejected Fee</div>
                        </a>
                    </li> -->
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
            elseif($this->session->userdata('role_type') =='ZSM' ){
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
            }elseif($this->session->userdata('role_type') =='Division Head'){
                ?>
                 <!-- <li class="asm_eform_m">
                        <a href="<?php echo base_url();?>index.php/rssm_eform_zsm">
                            <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
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

                    
                    <li class="asm_fform_m">
                        <a href="<?php echo base_url();?>index.php/rssm_fform_zsm">
                            <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                            </div>
                            <div class="menu-title">Funnel Form</div>
                        </a>
                    </li> -->

                    <li id="asmver" class="asm_vform">
                        <a href="<?php echo base_url();?>index.php/revised_salary_approval">
                            <div class="parent-icon icon-color-6"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title">Revisied Fee Approval</div>
                        </a>
                    </li>
                    <li class="approved_sf">
                        <a href="<?php echo base_url();?>index.php/approved_revised_salary">
                            <div class="parent-icon icon-color-5"><i class="bx bx-task"></i>
                            </div>
                            <div class="menu-title">Approved Revisied Fee</div>
                        </a>
                    </li>
                    <li class="rejected_sf">
                        <a href="<?php echo base_url();?>index.php/rejected_revised_salary">
                            <div class="parent-icon icon-color-2"><i class="bx bx-task-x"></i>
                            </div>
                            <div class="menu-title">Rejected Revisied Fee </div>
                        </a>
                    </li>
                <?php
            }
            elseif($this->session->userdata('role_type') =='LEADER' ||$this->session->userdata('role_type') =='MLEADER' ){
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
        <?php } else  if($this->session->userdata('pro_id') =='PRO08'){
                    
                if($this->session->userdata('role_type') =='TSO'){
                    ?>    
        <li class="menu-label">RS Review</li>

        <li class="keyform_m">
            <a href="<?php echo base_url();?>index.php/list_rs_key_form">
                <div class="parent-icon icon-color-4"><i class="bx bx-comment-edit"></i>
                </div>
                <div class="menu-title">KEY Performance Indices</div>
            </a>
        </li>
        <?php
        }
        ?>
        <li class="scoreform_m">
            <a href="<?php echo base_url();?>index.php/monthly_score_card">
                <div class="parent-icon algolia"><i class="bx bx-comment-edit"></i>
                </div>
                <div class="menu-title">Weekly Score Card</div>
            </a>
        </li>
        <?php
            }
            else if($this->session->userdata('pro_id') =='PRO06'){
       
        if($this->session->userdata('role_type') =='TSO'){
            ?>
        <li class="menu-label">RS Recruitment</li>

        <li class="rsform_m">
            <a href="<?php echo base_url();?>index.php/add_rs_rec_form">
                <div class="parent-icon icon-color-2"><i class="lni lni-write"></i>
                </div>
                <div class="menu-title">Recruitment Form</div>
            </a>
        </li>
        <li class="ersform_m">
            <a href="<?php echo base_url();?>index.php/rs_entered_form">
                <div class="parent-icon icon-color-3"><i class="bx bx-comment-edit"></i>
                </div>
                <div class="menu-title">Entered Form</div>
            </a>
        </li>

        <li class="frsform_m">
            <a href="<?php echo base_url();?>index.php/rs_funnel_form">
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
            <a href="<?php echo base_url();?>index.php/rs_eform_va">
                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                </div>
                <div class="menu-title">Entered Forms</div>
            </a>
        </li>
        <?php
        }

        elseif($this->session->userdata('role_type') =='ASM'){
            ?>
        <li class="va_vform_m">
            <a href="<?php echo base_url();?>index.php/va_verified_forms_rs">
                <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">VSO Verified Forms</div>
            </a>
        </li>
        <li class="asm_vform_m">
            <a href="<?php echo base_url();?>index.php/asm_verified_forms_rs">
                <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                </div>
                <div class="menu-title">Approved Forms</div>
            </a>
        </li>
        <li class="asm_fprospect_m">
            <a href="<?php echo base_url();?>index.php/asm_future_prospect_rs">
                <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                </div>
                <div class="menu-title">Future Prospect</div>
            </a>
        </li>

        <li class="asm_eform_m">
            <a href="<?php echo base_url();?>index.php/rs_eform_asm">
                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                </div>
                <div class="menu-title">Entered Forms</div>
            </a>
        </li>
        <li class="asm_fform_m">
            <a href="<?php echo base_url();?>index.php/rs_fform_asm">
                <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                </div>
                <div class="menu-title">Funnel Form</div>
            </a>
        </li>


        <?php
        }
        elseif($this->session->userdata('role_type') =='ZSM' || $this->session->userdata('role_type') =='Division_Head'){
            ?>
        <li class="va_vform_m">
            <a href="<?php echo base_url();?>index.php/va_verified_forms_zsm_rs">
                <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">VSO Verified Forms</div>
            </a>
        </li>
        <li class="asm_vform_m">
            <a href="<?php echo base_url();?>index.php/asm_verified_forms_rs">
                <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                </div>
                <div class="menu-title">Approved Forms</div>
            </a>
        </li>
        <li class="asm_fprospect_m">
            <a href="<?php echo base_url();?>index.php/asm_future_prospect_rs">
                <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                </div>
                <div class="menu-title">Future Prospect</div>
            </a>
        </li>

        <li class="asm_eform_m">
            <a href="<?php echo base_url();?>index.php/rs_eform_zsm">
                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                </div>
                <div class="menu-title">Entered Forms</div>
            </a>
        </li>
        <li class="asm_fform_m">
            <a href="<?php echo base_url();?>index.php/rs_fform_zsm">
                <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                </div>
                <div class="menu-title">Funnel Form</div>
            </a>
        </li>
        <?php
        }
        elseif($this->session->userdata('role_type') =='LEADER' ||$this->session->userdata('role_type') =='MLEADER' || $this->session->userdata('role_type') =='MLEADER'){
            ?>
        <li class="va_vform_m">
            <a href="<?php echo base_url();?>index.php/va_verified_forms_ldr_rs">
                <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">VSO Verified Forms</div>
            </a>
        </li>
        <li class="asm_vform_m">
            <a href="<?php echo base_url();?>index.php/ldr_verified_forms_rs">
                <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                </div>
                <div class="menu-title">Approved Forms</div>
            </a>
        </li>
        <li class="asm_fprospect_m">
            <a href="<?php echo base_url();?>index.php/ldr_future_prospect_rs">
                <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                </div>
                <div class="menu-title">Future Prospect</div>
            </a>
        </li>

        <li class="asm_eform_m">
            <a href="<?php echo base_url();?>index.php/rs_eform_ldr">
                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                </div>
                <div class="menu-title">Entered Forms</div>
            </a>
        </li>
        <li class="asm_fform_m">
            <a href="<?php echo base_url();?>index.php/rs_fform_ldr">
                <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                </div>
                <div class="menu-title">Funnel Form</div>
            </a>
        </li>
        <?php
        }
        else{
            ?>
        <li class="eform_m">
            <a href="<?php echo base_url();?>index.php/Competition/competition_watch_report">
                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                </div>
                <div class="menu-title">Entered Forms</div>
            </a>
        </li>

        <?php
        }


        }else if($this->session->userdata('pro_id') =='PRO09'){
           
            if($this->session->userdata('role_type') =='TSO'){
                ?>  
            <li class="menu-label">SS Review</li>

            <li class="keyform_m">
                <a href="<?php echo base_url();?>index.php/list_ss_key_form">
                    <div class="parent-icon icon-color-4"><i class="bx bx-comment-edit"></i>
                    </div>
                    <div class="menu-title">KEY performance Indices</div>
                </a>
            </li>
            <?php
            }
            ?>
            <li class="scoreform_m">
                <a href="<?php echo base_url();?>index.php/monthly_score_card_ss">
                    <div class="parent-icon algolia"><i class="bx bx-comment-edit"></i>
                    </div>
                    <div class="menu-title">Weekly Score Card</div>
                </a>
            </li>
        <?php
        } else if($this->session->userdata('pro_id') =='PRO07'){
           
            if($this->session->userdata('role_type') =='TSO'){
                ?>
            <li class="menu-label">SS Recruitment</li>

            <li class="rform_m">
                <a href="<?php echo base_url();?>index.php/add_ss_rec_form">
                    <div class="parent-icon icon-color-2"><i class="lni lni-write"></i>
                    </div>
                    <div class="menu-title">Recruitment Form</div>
                </a>
            </li>
            <li class="reform_m">
                <a href="<?php echo base_url();?>index.php/ss_entered_form">
                    <div class="parent-icon icon-color-3"><i class="bx bx-comment-edit"></i>
                    </div>
                    <div class="menu-title">Entered Form</div>
                </a>
            </li>
            <li class="rfform_m">
                <a href="<?php echo base_url();?>index.php/ss_funnel_form">
                    <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                    </div>
                    <div class="menu-title">Funnel Form</div>
                </a>
            </li>



            <?php
            }
            elseif($this->session->userdata('role_type') =='ASM'){
                ?>
            <li class="va_vform_m">
                <a href="<?php echo base_url();?>index.php/ss_va_verified_forms">
                    <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">VSO Verified Forms</div>
                </a>
            </li>
            <li class="asm_vform_m">
                <a href="<?php echo base_url();?>index.php/ss_asm_verified_forms">
                    <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                    </div>
                    <div class="menu-title">Approved Forms</div>
                </a>
            </li>
            <li class="asm_fprospect_m">
                <a href="<?php echo base_url();?>index.php/ss_asm_future_prospect">
                    <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                    </div>
                    <div class="menu-title">Future Prospect</div>
                </a>
            </li>

            <li class="asm_eform_m">
                <a href="<?php echo base_url();?>index.php/ss_eform_asm">
                    <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                    </div>
                    <div class="menu-title">Entered Forms</div>
                </a>
            </li>
            <li class="asm_fform_m">
                <a href="<?php echo base_url();?>index.php/ss_fform_asm">
                    <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                    </div>
                    <div class="menu-title">Funnel Form</div>
                </a>
            </li>


            <?php
            }
            elseif($this->session->userdata('role_type') =='ZSM'  || $this->session->userdata('role_type') =='Division_Head'){
                ?>
            <li class="va_vform_m">
                <a href="<?php echo base_url();?>index.php/ss_va_verified_forms_zsm">
                    <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">VSO Verified Forms</div>
                </a>
            </li>
            <li class="asm_vform_m">
                <a href="<?php echo base_url();?>index.php/ss_asm_verified_forms">
                    <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                    </div>
                    <div class="menu-title">Approved Forms</div>
                </a>
            </li>
            <li class="asm_fprospect_m">
                <a href="<?php echo base_url();?>index.php/ss_asm_future_prospect">
                    <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                    </div>
                    <div class="menu-title">Future Prospect</div>
                </a>
            </li>

            <li class="asm_eform_m">
                <a href="<?php echo base_url();?>index.php/ss_eform_zsm">
                    <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                    </div>
                    <div class="menu-title">Entered Forms</div>
                </a>
            </li>
            <li class="asm_fform_m">
                <a href="<?php echo base_url();?>index.php/ss_fform_zsm">
                    <div class="parent-icon icon-color-9"><i class="lni lni-funnel"></i>
                    </div>
                    <div class="menu-title">Funnel Form</div>
                </a>
            </li>
            <?php
            }elseif($this->session->userdata('role_type') =='LEADER' ||$this->session->userdata('role_type') =='MLEADER' || $this->session->userdata('role_type') =='MLEADER'){
                ?>
            <li class="va_vform_m">
                <a href="<?php echo base_url();?>index.php/ss_va_verified_forms_ldr">
                    <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">VSO Verified Forms</div>
                </a>
            </li>
            <li class="asm_vform_m">
                <a href="<?php echo base_url();?>index.php/ss_ldr_verified_forms">
                    <div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
                    </div>
                    <div class="menu-title">Approved Forms</div>
                </a>
            </li>
            <li class="asm_fprospect_m">
                <a href="<?php echo base_url();?>index.php/ss_ldr_future_prospect">
                    <div class="parent-icon icon-color-5"><i class="bx bx-book-add"></i>
                    </div>
                    <div class="menu-title">Future Prospect</div>
                </a>
            </li>

            <li class="asm_eform_m">
                <a href="<?php echo base_url();?>index.php/ss_eform_ldr">
                    <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                    </div>
                    <div class="menu-title">Entered Forms</div>
                </a>
            </li>
            <li class="asm_fform_m">
                <a href="<?php echo base_url();?>index.php/ss_fform_ldr">
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
                <a href="<?php echo base_url();?>index.php/ss_eform_va">
                    <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                    </div>
                    <div class="menu-title">Entered Forms</div>
                </a>
            </li>
            <?php
            }

        } else if ($this->session->userdata('pro_id') =='PRO11'){
            

                if($this->session->userdata('role_type') =='TSO'){

                    ?>
                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/sde_market_report">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Entered Forms</div>
                            </a>
                        </li>
                        <li class="eform_report">
                            <a href="<?php echo base_url();?>index.php/market_report">
                                <div class="parent-icon icon-color-3"><i class="bx bx-calendar"></i>
                                </div>
                                <div class="menu-title">Calendar Report</div>
                            </a>
                        </li>
                        <li class="eform_osm">
                            <a href="<?php echo base_url();?>index.php/market_visit/SdeMarket/OSM_view">
                                <div class="parent-icon icon-color-4"><i class="bx bx-comment-edit"></i>
                                </div>
                                <div class="menu-title">Orange Salesman </div>
                            </a>
                        </li>
            
                    <?php
                
                }elseif($this->session->userdata('role_type') =='SM'){
                    ?>
                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/sde_market_report">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Entered Forms</div>
                            </a>
                        </li>
                        <li class="eform_report">
                            <a href="<?php echo base_url();?>index.php/market_report">
                                <div class="parent-icon icon-color-3"><i class="bx bx-calendar"></i>
                                </div>
                                <div class="menu-title">Calendar Report</div>
                            </a>
                        </li>
                        <!-- <li class="orange_salesmam_performance">
                            <a href="<?php echo base_url();?>index.php/SdeMarket/OSM_performance_view">
                                <div class="parent-icon icon-color-4"><i class="bx bx-comment-edit"></i>
                                </div>
                                <div class="menu-title">Orange Salesman Performance</div>
                            </a>
                        </li> -->
            
                    <?php
                
                }else{
                    ?>
                        <li class="eform_report">
                            <a href="<?php echo base_url();?>index.php/market_report">
                                <div class="parent-icon icon-color-3"><i class="bx bx-calendar"></i>
                                </div>
                                <div class="menu-title">Calendar Report</div>
                            </a>
                        </li>
                    <?php
                }
        
        }  else if($this->session->userdata('pro_id') =='PRO12'){
               

                if($this->session->userdata('role_type') =='ASM'){
                    ?>

                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/sde_incentive">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Incentive</div>
                            </a>
                        </li>
                        <li class="eform_slub">
                            <a href="<?php echo base_url();?>index.php/sde_incentive_slub">
                            <!-- <a href="<?php echo base_url();?>index.php/SdeIncentive/sde_incentive_urban"> -->
                            
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>

                                <div class="menu-title">Slab</div>
                            </a>
                        </li>


                    <?php
                }else{
                    ?>

                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/sde_incentive">
                            <!-- <a href="<?php echo base_url();?>index.php/SdeIncentive/sde_incentive_urban"> -->
                            
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Incentive</div>
                            </a>
                        </li>
                        <li class="eform_slub">
                            <a href="<?php echo base_url();?>index.php/sde_incentive_slub">
                            <!-- <a href="<?php echo base_url();?>index.php/SdeIncentive/sde_incentive_urban"> -->
                            
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>

                                <div class="menu-title">Slab</div>
                            </a>
                        </li>

                    <?php
                }
               
        } else if($this->session->userdata('pro_id') =='PRO13'){
           

                if($this->session->userdata('role_type') =='TSO' || $this->session->userdata('role_type') =='SM'){

                    ?>
                        <li class="eform_rm">
                            <a href="<?php echo base_url();?>index.php/beat_report">
                                <div class="parent-icon icon-color-4"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Report View</div>
                            </a>
                        </li>
                        <!-- <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/beat_optimize_report">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Table View</div>
                            </a>
                        </li> -->
                    <?php

                
                }else{
                    ?>
                        <li class="eform_rm">
                            <a href="<?php echo base_url();?>index.php/beat_report">
                                <div class="parent-icon icon-color-4"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Report View</div>
                            </a>
                        </li>
                        <!-- <li class="eform_report">
                            <a href="<?php echo base_url();?>index.php/beat_optimize_report">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Table View</div>
                            </a>
                        </li> -->

                    <?php
                }
        } else if($this->session->userdata('pro_id') =='PRO14'){ 

                if($this->session->userdata('role_type') =='SM'){
                    ?>
                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/five_sec_scorecard">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Report View</div>
                            </a>
                        </li>

                    <?php
                }
                else{
                    ?>

                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/five_sec_scorecard">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Report View</div>
                            </a>
                        </li>

                    <?php
                }
           
        }else if($this->session->userdata('pro_id') =='PRO15'){
            

                if($this->session->userdata('role_type') =='TSO' || $this->session->userdata('role_type') =='SM'){

                    ?>
                    
                        <li class="orange_salesmam_performance">
                            <a href="<?php echo base_url();?>index.php/osm_performance_report">
                                <!-- <div class="parent-icon icon-color-4"><i class="bx bx-comment-edit"></i>
                                </div> -->
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Report View</div>
                            </a>
                        </li>

                    <?php
                
                }else{
                    ?>
                        <li class="orange_salesmam_performance">
                            <a href="<?php echo base_url();?>index.php/osm_performance_report">
                                <!-- <div class="parent-icon icon-color-4"><i class="bx bx-comment-edit"></i>
                                </div> -->
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Report View</div>
                            </a>
                        </li>

                    <?php
                }
           
            } else if($this->session->userdata('pro_id') =='PRO17'){
                // if($this->session->userdata('role_type') =='SM'){
                    ?>
                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/scorecard">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">ScoreCard Report</div>
                            </a>
                        </li>
                    <?php
                    
                // }
           
            } else if($this->session->userdata('pro_id') =='PRO16'){
                // if($this->session->userdata('role_type') =='SM'){
                    ?>
                        <li class="eform_m">
                            <a href="<?php echo base_url();?>index.php/outlet_performance">
                                <div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title">Outlets Performance </div>
                            </a>
                        </li>
                        <li class="eform_m2">
                            <a href="<?php echo base_url();?>index.php/outlet_performance_chart">
                                <div class="parent-icon icon-color-2"><i class="bx bx-task"></i>
                                </div>
                                <div class="menu-title">Outlets Performance Chart</div>
                            </a>
                        </li>
                <?php
            } else if ($this->session->userdata('pro_id') =='PRO18'){
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
            <?php }  ?>
    </ul>
    <!--end navigation-->
</div>
<script>

</script>
