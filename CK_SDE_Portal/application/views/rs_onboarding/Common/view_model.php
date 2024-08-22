<style>
      @media only screen and (max-width: 768px) {
        #rs_appoinment_modal b {
            font-size: 12px;
            }

            #rs_appoinment_modal span {
                font-size: 12px;
            }

            #rs_appoinment_modal h5 b {
                font-size: 14px;
            }
            }

            .th{
                padding :5px;
            }
</style>

<!-- Approve Reject Model Popup Start -->
<div class="modal fade" id="rs_appoinment_modal" tabindex="-1"
                        aria-labelledby="add_additional_detailslabel" aria-hidden="true" data-backdrop="static"
                        data-keyboard="false">

                        <!-- closes on outside click -->
                        <div class="modal-dialog modal-dialog modal-xl modal-lg modal-md modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" >RS Onboarding Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Basic Details :</b></h5>
                                    </div>
                                    <div class="row pl-3 pt-2 pb-2">
                                        <div class=" col-md-3 col-6 th">
                                            <b>Distributor Type</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="rs_type"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Reason for Appoinment </b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="reason_for_appoinment"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="pb-2 pt-2 appointmentReason" style="padding-left: 5px;">
                                        <h5><b>Reason for the Replacement/Bifurcation</b></h5>
                                    </div>
                                    <div class="row pl-3 pt-2 appointmentReason">
                                        <div class=" col-md-3 col-6  th">
                                            <b>Existing Party's SAP RS / SS Code</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="saprssscode"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Collected all the Claims</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="collected_claims"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>NOC with Pending Claims Details</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="noc_pending_claims"></span>
                                        </div>
                                    </div>
                                    <hr class = "appointmentReason">
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Additional Details</b></h5>
                                    </div>
                                    <div class="row pl-3 pt-2 ">
                                        <div class=" col-md-3 col-6  th">
                                            <b>Name of the firm</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="firm_title"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>GST Number</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="gst_no"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>GST Registration Certificate</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="gst_copy"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>FSSAI Number</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="fssai_number"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>FSSAI Copy</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="fssai_copy"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Owenership Status</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="ownership_status"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Name of the contact Person</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="contact_person"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Mobile Number</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="mobile_no"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Email Id</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="email_id"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Pan Card Number</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="pan_number"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Pan Card</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="pan_copy"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Aadhar Card Number</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="aadhar_number"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Aadhar Card Front</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="aadhar_copy_front"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Aadhar Card Back</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="aadhar_copy_back"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Address 1</b>
                                        </div>
                                        <div class=" col-md-9 col-6 th">
                                            <span id="address_1"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Address 2</b>
                                        </div>
                                        <div class=" col-md-9 col-6  th">
                                            <span id="address_2"></span>
                                        </div>
                                      
                                        
                                    </div>
                                    <hr>
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Bank Details</b></h5>
                                    </div>
                                    <div class="row pl-3 pt-2 ">
                                        <div class=" col-md-3 col-6  th">
                                            <b>Bank Name</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="bank_name"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Name of the Account Owner</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="account_owner"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Bank Account Number</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="account_number"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Account Typer</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="account_type"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Branch Name</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="branch_name"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>IFSC Code</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="ifsc_code"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Authorised Signatory Name</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="signatory_name"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>NATCH Limit</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="natch_limit"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Cancelled Cheque</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="cancelled_cheque"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Financial Details</b></h5>
                                    </div>
                                    <div class="row pl-3 pt-2 ">
                                        <div class=" col-md-3 col-6  th">
                                            <b>Avarege Monthly Turnover</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="avg_monthly"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Total Investment In business</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="investment_business"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Own Investment funds</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="investment_funds"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Total borrowed funds</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="borrowed_funds"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Required Working Capital for CKPL</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="capital_for_ckpl"></span>
                                        </div>
                                        
                                    </div>
                                    <hr>
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Current Infrastructure</b></h5>
                                    </div>
                                    <div class="row pl-3 pt-2 ">
                                        <div class=" col-md-3 col-6  th">
                                            <b>Companies Handled</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="company_handled"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Outlets Covered</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="outlets_covered"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>No.of Company Paid Salesman</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="company_paid"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>No.of Distributor's Salesman</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="distributor_salesman"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Total Godown Size</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="total_godown_size"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Godown Picture 1</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="godown_picture_1"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Godown Picture 2</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="godown_picture_2"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Office Main Gate</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="office_main_gate"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Owner Picture</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="owner_picture"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Computer Billing</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="computer_billing"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Printer compatible for CSNG Billing</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="csng_billing"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Unit Type</b>
                                        </div>
                                        <div class=" col-md-3 col-6   th">
                                            <span  id="unit_type"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Delivery Van Picture</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="delievery_van_pic"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Delivery Van RC</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="rc_copy"></span>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <b>Invoice Copy of Existing Company</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="invoice_copy"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Proposed Infrastructure</b></h5>
                                    </div>
                                    <div class="row pl-3 pt-2 ">
                                        <div class=" col-md-3 col-6  th">
                                            <b>Proposed Outlets to be Covered for CKPL</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="proposed_outlets"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>No. of Approved field Force Count </b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="force_count"></span>
                                        </div>

                                        <div class=" col-md-3 col-6  th">
                                            <b>Expected Monthly Turnover from CavinKare</b>
                                        </div>
                                        <div class=" col-md-3 col-6  th">
                                            <span id="expected_turnover"></span>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type=hidden id="approve_id" name="approve_id" >
                                    <button id="approve_rs_appoinment" type="button" class="btn btn-info"  data-dismiss="modal">Approve</button>
                                    <button id="reject_rs_appoinment" type="button" class="btn btn-info"  data-dismiss="modal">Future Prospect</button>
                                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

        <!-- Approve Reject Model Popup End -->


        <script>
            var imgUrl = "<?php echo base_url(); ?>";
        </script>