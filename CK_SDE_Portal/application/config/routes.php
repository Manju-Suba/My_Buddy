<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dashboard']='PageController/dashboard';
$route['settings']='PageController/settings';
$route['report']='PageController/report';
$route['masters']='PageController/masters';
$route['logout']='Login/logout';
$route['kyc_update']='PageController/kyc_update';
$route['rssm_verified']='PageController/rssm_verified';
$route['rssm_rejected']='PageController/rssm_rejected';
$route['entered_forms']='PageController/entered_forms';


//QC verification
$route['qc_verification']='PageController/qc_verification';


//scorecard
$route['scorecard_report']='scorecard/ScoreCardController/scorecard_tab';
$route['hygienic_scorecard']='scorecard/ScoreCardController/hygienic_scorecard';
$route['npd_scorecard']='scorecard/ScoreCardController/npd_scorecard';

//Market visit
$route['sde_market_report']='market_visit/SdeMarket/sde_market_report';
$route['add_sde_market']='market_visit/SdeMarket/add_sde_market';
$route['market_report']='market_visit/SdeMarket/market_report';
$route['my-calendar'] = "market_visit/CalendarController";


// Incentive Urban
$route['sde_incentive']='incentive/SdeIncentive/sde_incentive_urban';
$route['sde_incentive_slub']='incentive/SdeIncentive/sde_incentive_slub';


//Beat Optimization 
$route['beat_report']='beat_optimize/BeatOptimizationController/beat_report';

// OSM Performance
$route['osm_performance_report']='osm/OsmPerformance/osm_performance_report';

//Five Sec Scorecard
$route['five_sec_scorecard']='fivesec_scorecard/FivesecScorecard/five_sec_scorecard';

//SS Recruitment
$route['add_ss_rec_form']='ss_recruitment/SSController/add_ss_rec_form';
$route['ss_entered_form']='ss_recruitment/SSController/ss_entered_form';
$route['ss_funnel_form']='ss_recruitment/SSController/ss_funnel_form';

$route['ss_eform_va']='ss_recruitment/VAController/ss_eform_va';
$route['ss_va_verified_forms']='ss_recruitment/ASMController/va_verified_forms';

$route['ss_asm_verified_forms']='ss_recruitment/ASMController/asm_verified_forms';
$route['ss_asm_future_prospect']='ss_recruitment/ASMController/asm_future_prospect';
$route['ss_eform_asm']='ss_recruitment/ASMController/ss_eform_asm';
$route['ss_fform_asm']='ss_recruitment/ASMController/ss_fform_asm';

$route['ss_va_verified_forms_zsm']='ss_recruitment/ZSMController/va_verified_forms_zsm';
$route['ss_eform_zsm']='ss_recruitment/ZSMController/ss_eform_zsm';
$route['ss_fform_zsm']='ss_recruitment/ZSMController/ss_fform_zsm';

$route['ss_va_verified_forms_ldr']='ss_recruitment/LeaderController/va_verified_forms_ldr';
$route['ss_ldr_verified_forms']='ss_recruitment/LeaderController/ldr_verified_forms';
$route['ss_ldr_future_prospect']='ss_recruitment/LeaderController/ldr_future_prospect';
$route['ss_eform_ldr']='ss_recruitment/LeaderController/ss_eform_ldr';
$route['ss_fform_ldr']='ss_recruitment/LeaderController/ss_fform_ldr';

$route['list_ss_key_form']='ss_recruitment/SSController/list_ss_key_form';
$route['add_ss_key_form']='ss_recruitment/SSController/add_ss_key_form';
$route['edit_ss_key_form']='ss_recruitment/SSController/edit_ss_key_form';

$route['monthly_score_card_ss']='ss_recruitment/SSController/monthly_score_card_ss';


//ck_competition_watch
$route['competition_watch']='Competition/competition_watch';
$route['competition_watch_report']='Competition/competition_watch_report';

//CK_rs_funnel

$route['add_rs_rec_form']='rsfunnel/RSController/add_rs_rec_form';
$route['rs_entered_form']='rsfunnel/RSController/rs_entered_form';
$route['rs_funnel_form']='rsfunnel/RSController/rs_funnel_form';

$route['va_verified_forms_rs']='rsfunnel/ASMController/va_verified_forms';
$route['asm_verified_forms_rs']='rsfunnel/ASMController/asm_verified_forms';
$route['asm_future_prospect_rs']='rsfunnel/ASMController/asm_future_prospect';
$route['rs_eform_asm']='rsfunnel/ASMController/rs_eform_asm';
$route['rs_fform_asm']='rsfunnel/ASMController/rs_fform_asm';

$route['rs_eform_va'] = 'rsfunnel/VAController/rs_eform_va';

$route['va_verified_forms_zsm_rs']='rsfunnel/ZSMController/va_verified_forms_zsm';
$route['rs_eform_zsm']='rsfunnel/ZSMController/rs_eform_zsm';
$route['rs_fform_zsm']='rsfunnel/ZSMController/rs_fform_zsm';

$route['va_verified_forms_ldr_rs']='rsfunnel/LeaderController/va_verified_forms_ldr';
$route['ldr_verified_forms_rs']='rsfunnel/LeaderController/ldr_verified_forms';
$route['ldr_future_prospect_rs']='rsfunnel/LeaderController/ldr_future_prospect';
$route['rs_eform_ldr']='rsfunnel/LeaderController/rs_eform_ldr';
$route['rs_fform_ldr']='rsfunnel/LeaderController/rs_fform_ldr';

$route['list_rs_key_form']='rsfunnel/RSController/list_rs_key_form';
$route['add_rs_key_form']='rsfunnel/RSController/add_rs_key_form';
$route['edit_rs_key_form']='rsfunnel/RSController/edit_rs_key_form';

$route['monthly_score_card']='rsfunnel/RSController/monthly_score_card';

// salesman onboarding 

$route['add_rssm_rec_form']='salesman_onboarding/RSSMController/add_rssm_rec_form';
$route['rssm_entered_form']='salesman_onboarding/RSSMController/rssm_entered_form';
$route['rssm_funnel_form']='salesman_onboarding/RSSMController/rssm_funnel_form';
$route['rssm_rejected_form']='salesman_onboarding/RSSMController/rssm_rejected_form';
$route['fee_rejection_forms']='salesman_onboarding/RSSMController/fee_rejection_forms';


$route['va_verified_forms']='salesman_onboarding/ASMController/va_verified_forms';
$route['asm_verified_forms']='salesman_onboarding/ASMController/asm_verified_forms';
$route['asm_future_prospect']='salesman_onboarding/ASMController/asm_future_prospect';
$route['rssm_eform_asm']='salesman_onboarding/ASMController/rssm_eform_asm';
$route['rssm_fform_asm']='salesman_onboarding/ASMController/rssm_fform_asm';


$route['rssm_eform_va']='salesman_onboarding/VAController/rssm_eform_va';

$route['va_verified_forms_zsm']='salesman_onboarding/ZSMController/va_verified_forms_zsm';
$route['zsm_verified_forms']='salesman_onboarding/ZSMController/zsm_verified_forms';
$route['zsm_future_prospect']='salesman_onboarding/ZSMController/zsm_future_prospect';
$route['rssm_eform_zsm']='salesman_onboarding/ZSMController/rssm_eform_zsm';
$route['rssm_fform_zsm']='salesman_onboarding/ZSMController/rssm_fform_zsm';


$route['sde_submitted_forms_ldr']='salesman_onboarding/LeaderController/va_verified_forms_ldr';
$route['ldr_rssm_verified']="salesman_onboarding/LeaderController/rssm_verified_ldr";
$route['ldr_rssm_reject']="salesman_onboarding/LeaderController/rssm_rejected_ldr";

$route['ldr_verified_forms']='salesman_onboarding/LeaderController/ldr_verified_forms';
$route['ldr_future_prospect']='salesman_onboarding/LeaderController/ldr_future_prospect';
$route['rssm_eform_ldr']='salesman_onboarding/LeaderController/rssm_eform_ldr';
$route['rssm_fform_ldr']='salesman_onboarding/LeaderController/rssm_fform_ldr';

$route['approved_revised_salary']='salesman_onboarding/ZSMController/approved_revised_salary';
$route['rejected_revised_salary']='salesman_onboarding/ZSMController/rejected_revised_salary';
$route['revised_salary_approval']='salesman_onboarding/ZSMController/revised_salary_approval';

//outlet_performance

$route['outlet_performance'] ="outlet_performance/OutletController/view_outlet";
$route['outlet_performance_chart'] ="outlet_performance/OutletController/view_outlet_chart";

// RS onboarding 
$route['rs_appointment_form']='rs_onboarding/RSController/rs_appointment_form';
$route['rs_entered_form']='rs_onboarding/RSController/rs_entered_form';

$route['asm_pending_form']='rs_onboarding/CommonController/asm_pending_form';
$route['asm_approved_forms']='rs_onboarding/CommonController/asm_approved_form';
$route['asm_future_prospect']='rs_onboarding/CommonController/asm_future_prospect';

$route['zsm_pending_form']='rs_onboarding/CommonController/zsm_pending_form';
$route['zsm_approved_forms']='rs_onboarding/CommonController/zsm_approved_form';
$route['zsm_future_prospect']='rs_onboarding/CommonController/zsm_future_prospect';


// Comercial onboarding
$route['pending_form_comercial']='rs_onboarding/ComercialController/pending_form';
$route['approved_form_comercial']='rs_onboarding/ComercialController/approved_form';
$route['rejected_form_comercial']='rs_onboarding/ComercialController/rejected_form';

// Sap onboarding
$route['pending_form_sap']='rs_onboarding/SapController/pending_form';
$route['approved_form_sap']='rs_onboarding/SapController/approved_form';
$route['rejected_form_sap']='rs_onboarding/SapController/rejected_form';
