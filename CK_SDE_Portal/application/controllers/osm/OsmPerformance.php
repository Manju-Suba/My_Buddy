<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	

class OsmPerformance extends CI_Controller {	
	/**	
	 * Index Page for this controller.	
	 *	
	 * Maps to the following URL	
	 * 		http://example.com/index.php/welcome	
	 *	- or -	
	 * 		http://example.com/index.php/welcome/index	
	 *	- or -	
	 * Since this controller is set as the default controller in	
	 * config/routes.php, it's displayed at http://example.com/	
	 *	
	 * So any other public methods not prefixed with an underscore will	
	 * map to /index.php/welcome/<method_name>	
	 * @see https://codeigniter.com/user_guide/general/urls.html	
	 */	
	public function __construct()	
    {	
        parent::__construct();	
        $this->load->helper(array(	
            'form',	
            'html',	
            'file',	
            'url'	
        ));	
        $this->load->library('session');	
        $this->load->library('form_validation');	
        $this->load->library('javascript');	
        $this->load->library('email');	

        $this->load->model('Common_model', 'cmodel');
        $this->load->model('Osm_model', 'osmmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(tso_portal_base_url(), 'refresh');	
			// redirect('http://localhost/CK_TSO_Portal/');
				
        }	
        	
    }	

	
	public function osm_performance_report(){	
		$role_type=$this->session->userdata('role_type');
		
		if($role_type =='ASM' ){
			$this->load->view('osm/osm_performance_report_asm');	
		}elseif($role_type =='TSO'){

			$this->load->view('osm/osm_performance_report_sde');		
		}elseif($role_type =='ZSM' || $role_type =='LEADER' || $role_type =='MLEADER' || $role_type =='Division Head'){

			$this->load->view('osm/osm_performance_report_zm');		
		}else{
			$this->load->view('osm/osm_performance_report');	
		}
	}




	

	public function get_osm_per_report(){
		$where_cond = array();
		$type="where";
		if($this->session->userdata('role_type') == 'ASM'){
			$type="where";

			if ($this->input->post('tso_number') !='' && $this->input->post('sm_number') =='') {
				$where_cond_no['tso_number'] = $this->input->post('tso_number');
				// $tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
				$tsolist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						// array_push($where_cond,$tsolist_result[$i]->tso_number);
						array_push($where_cond,$tsolist_result[$i]->sm_number,$this->input->post('tso_number'));
					}
				}
			}
			elseif($this->input->post('sm_number') !='') {
				$where_cond[] = $this->input->post('sm_number');
	
			}
			else{
				$where_cond_no['asm_number'] = $this->session->userdata('mobile');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond,$smlist_result[$i]->sm_number);
					}
				}
			}
		}
		elseif( $this->session->userdata('role_type') == 'SM'){
			$type="where";
			$where_cond = $this->session->userdata('mobile');
		}
		elseif( $this->session->userdata('role_type') == 'TSO' ){
			$type="where";

			if($this->input->post('sm_number') !='') {
				$where_cond[] = $this->input->post('sm_number');
	
			}else{
				$where_cond_tso['TSO_Number'] = $this->session->userdata('mobile');
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_tso,'sm_number','sm');
	
				if(count($smlist_result) !=0){
					
					for ($i=0; $i < count($smlist_result); $i++) { 
						array_push($where_cond, $smlist_result[$i]->sm_number ,$this->session->userdata('mobile'));
					}
				}
			} 
		}else{
			$type="where";

			if ($this->input->post('tso_number') !='' && $this->input->post('sm_number') =='') {
				$where_cond_no['tso_number'] = $this->input->post('tso_number');
				// $tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
				$tsolist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						// array_push($where_cond,$tsolist_result[$i]->tso_number);
						array_push($where_cond,$tsolist_result[$i]->sm_number,$this->input->post('tso_number'));
					}
				}
			}
			elseif($this->input->post('sm_number') !='') {
				$where_cond[] = $this->input->post('sm_number');
	
			}
			else{
				$where_cond_no['asm_number'] = $this->session->userdata('mobile');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond,$smlist_result[$i]->sm_number);
					}
				}
			}
		}
		
		$postData = $this->input->post();
        
		$get_osm_performance_details = $this->osmmodel->osm_performance_report($postData,$where_cond,$type);
		// print_r($get_osm_performance_details);
		// exit();
		echo json_encode($get_osm_performance_details);
	}
	
	
	public function get_osm_weekly_report(){
		$where_cond = array();

		if($this->session->userdata('role_type') =='LEADER' ||$this->session->userdata('role_type') =='MLEADER' || $this->session->userdata('role_type') =='admin' || $this->session->userdata('role_type') =='VA'){
			if($this->input->post('zsm_number') !='' && $this->input->post('asm_number') =='' && $this->input->post('tso_number') =='' && $this->input->post('sm_number') ==''){
				// echo "1";
				$where_cond_no['zsm_number'] = $this->input->post('zsm_number');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond,$smlist_result[$i]->sm_number);
					}
				}
				$type="where";
				
				
			}
			elseif ($this->input->post('asm_number') !='' && $this->input->post('zsm_number') !='' &&  $this->input->post('tso_number') =='' && $this->input->post('sm_number') =='') {
				// echo "2";
				$where_cond_no['asm_number'] = $this->input->post('asm_number');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
				
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond,$smlist_result[$i]->sm_number);
					}
				}
				
				$type="where";
			}
			elseif ($this->input->post('tso_number') !='' && $this->input->post('sm_number') =='') {
				// echo "3";
				$where_cond_no['tso_number'] = $this->input->post('tso_number');
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				
				$type="where";
				
			}
			elseif($this->input->post('sm_number') !='') {
				// echo "4";
				$where_cond[] = $this->input->post('sm_number');
				$type="where";
	
			}
			else{
				$type="not_where";
			}
		}
		elseif($this->session->userdata('role_type') == 'ZSM'){
			$type="where";

			if($this->input->post('asm_number') !='' && $this->input->post('tso_number') =='' && $this->input->post('sm_number') ==''){
				$where_cond_no['asm_number'] = $this->input->post('asm_number');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond,$smlist_result[$i]->sm_number);
					}
				}
			}
			elseif ($this->input->post('tso_number') !='' && $this->input->post('sm_number') =='') {
				$where_cond_no['tso_number'] = $this->input->post('tso_number');
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
				// $tsolist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
						// array_push($where_cond,$tsolist_result[$i]->sm_number,$this->input->post('tso_number'));
					}
				}
			}
			elseif($this->input->post('sm_number') !='') {
				$where_cond[] = $this->input->post('sm_number');
	
			}
			else{

				$where_cond_no['zsm_number'] = $this->session->userdata('mobile');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond,$smlist_result[$i]->sm_number);
					}
				}
			}
		}
		elseif($this->session->userdata('role_type') == 'ASM'){
			$type="where";

			if ($this->input->post('tso_number') !='' && $this->input->post('sm_number') =='') {
				$where_cond_no['tso_number'] = $this->input->post('tso_number');
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
			}
			elseif($this->input->post('sm_number') !='') {
				$where_cond[] = $this->input->post('sm_number');
	
			}
			else{
				$where_cond_no['asm_number'] = $this->session->userdata('mobile');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond,$smlist_result[$i]->sm_number);
					}
				}
			}
		}elseif( $this->session->userdata('role_type') == 'SM'){
			$type="where";
			$where_cond = $this->session->userdata('mobile');
		}

		elseif( $this->session->userdata('role_type') == 'TSO' ){
			$type="where";

			if($this->input->post('sm_number') !='') {
				$where_cond[] = $this->input->post('sm_number');
	
			}else{
				$where_cond_tso['TSO_Number'] = $this->session->userdata('mobile');
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_tso,'sm_number','sm');
	
				if(count($smlist_result) !=0){
					
					for ($i=0; $i < count($smlist_result); $i++) { 
						array_push($where_cond, $smlist_result[$i]->sm_number ,$this->session->userdata('mobile'));
					}
				}
			}
		}
		
		$postData = $this->input->post();
        
		$get_osm_performance_ = $this->osmmodel->osm_weekly_performance_report($postData,$where_cond,$type);
		// print_r($get_osm_performance_details);
		// exit();
		echo json_encode($get_osm_performance_);
	}


	public function get_tso_list(){

        $where_cond['asm_number'] = $this->input->post('asm_number');

		$tsolist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'tso_number','tso');

        echo json_encode($tsolist_result);
	}

	public function get_asm_list(){

        $where_cond['zsm_number'] = $this->input->post('zsm_number');
		if( $this->session->userdata('role_type') == 'LEADER' ){
			$where_cond['division'] = $this->input->post('business_value');
		}

		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'asm_number','asm');

        echo json_encode($asmlist_result);
	}

	public function get_zsm_list(){

        $where_cond['division'] = $this->input->post('business_value');

		$asmlist_result = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'zsm_number','zsm');

        echo json_encode($asmlist_result);
	}

	public function get_sm_list(){

		if($this->input->post('asm_number') !="" ){
			$where_cond['asm_number'] = $this->input->post('asm_number');
		}else{
			$where_cond['tso_number'] = $this->input->post('tso_number');

		}
		$data['smlist_result'] = $this->cmodel->get_table_user_list_wc('masters',$where_cond,'sm_number','sm');
		
		$sm_number = array();
		foreach($data['smlist_result'] as $each_row){ 
			$sm_number[] = $each_row->sm_number;
		}

		$data['get_osm_list'] = $this->osmmodel->get_OSM(array_filter($sm_number),'osm_performance');
		$ssfa_id = [];
		foreach($data['get_osm_list'] as $_row){
			$ssfa_id[] = $_row->ssfa_id;
		}

		function compare_objects($obj_a, $obj_b) {
			return $obj_a - $obj_b;
		}
		$diff = array_udiff(array_filter($sm_number), $ssfa_id, 'compare_objects');
		$data['get_without_OSM'] = $this->osmmodel->get_without_OSM($diff,'masters',$where_cond,'sm_number','sm');

		// print_r($sm_number);
		// print_r($ssfa_id);
		// print_r($diff);
		// exit;
		echo json_encode($data);
	}

	public function get_osm_per_report_zm(){
		$where_cond = array();
		
		// if($this->session->userdata('role_type') == 'ZSM'){
			$type="where";

			if($this->input->post('asm_number') !='' && $this->input->post('tso_number') =='' && $this->input->post('sm_number') ==''){
				$where_cond_no['asm_number'] = $this->input->post('asm_number');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond,$smlist_result[$i]->sm_number);
					}
				}
			}
			elseif ($this->input->post('tso_number') !='' && $this->input->post('sm_number') =='') {
				$where_cond_no['tso_number'] = $this->input->post('tso_number');
				// $tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
				$tsolist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
	
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						// array_push($where_cond,$tsolist_result[$i]->sm_number);
						array_push($where_cond,$tsolist_result[$i]->sm_number,$this->input->post('tso_number'));
					}
				}
			}
			elseif($this->input->post('sm_number') !='') {
				$where_cond[] = $this->input->post('sm_number');
	
			}
			else{
				
				$where_cond_no['zsm_number'] = $this->session->userdata('mobile');
	
				$tsolist_result = $this->cmodel->get_role_list_id('masters','tso_number',$where_cond_no,'tso_number','tso');
	
				$smlist_result = $this->cmodel->get_role_list_id('masters','sm_number',$where_cond_no,'sm_number','sm');
				if(count($tsolist_result) !=0){
					for ($i=0; $i < count($tsolist_result); $i++) { 
						array_push($where_cond,$tsolist_result[$i]->tso_number);
					}
				}
				if(count($smlist_result) !=0){
					for ($i=0; $i < count($smlist_result); $i++) { 
	
						array_push($where_cond,$smlist_result[$i]->sm_number);
					}
				}

			}
		// }
		// print_r(count($where_cond));die;
		$postData = $this->input->post();
        if(count($where_cond)){
			$get_osm_performance_details = $this->osmmodel->osm_performance_report($postData,$where_cond,$type);
		}else{
			$get_osm_performance_details = array(
				"draw" => 1,
				"iTotalRecords" =>0,
				"iTotalDisplayRecords" => 0,
				"aaData" => array()
			);;
		}
		// print_r($get_osm_performance_details);
		// exit();
		echo json_encode($get_osm_performance_details);
	}


	public function get_weekly_current_jc(){
 
		$asm = $this->input->post('asm_number');
		$tso = $this->input->post('tso_number');
		$sm = $this->input->post('sm_number');

		$dataa = $this->osmmodel->get_weekly_current_jc($asm,$tso,$sm,'last');
		$dataa1 = $this->osmmodel->get_weekly_current_jc($asm,$tso,$sm,'before');
		$dataa2 = $this->osmmodel->get_weekly_current_jc($asm,$tso,$sm,'two_before');
		
		// print_r($dataa['result']);
		// exit;
		if( !empty($dataa['result']) ){
			$htmlcurr_jc='';
			$htmlcurr_jc.='<tr><td class="tta weekly" rowspan='.$dataa['current_jc_count'].' style="padding-top: 20px;vertical-align: unset;"> <b>'.$dataa['last_jc'].'(Current JC)</b> </td>';
			// $htmlcurr_jc.='<tr><td class="tta weekly" rowspan='.$dataa['current_jc_count'].' style="padding-bottom: 9500px;"> <b>'.$dataa['last_jc'].'(Current JC)</b> </td>';
			foreach($dataa['result'] as $row){

				$htmlcurr_jc.='
				<td> '.$row['ASM_Name'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk1'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk2'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk3'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk4'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk1'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk2'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk3'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk4'].' </td>
				</tr>';
			}
		}else{
			$htmlcurr_jc='<tr><td class="tta" colspan="10" >no data found!</td></tr>';
		}


		$htmlcurr_jc1='<div class="table table-bordered table-responsive" style="height:auto; max-height:300px;"><table>';
			$htmlcurr_jc1.='<thead>';
				$htmlcurr_jc1.='<tr class="" style="position: sticky; top: -1px; z-index: 1; ">';
					$htmlcurr_jc1.='<th rowspan="2" class="weekly tta">JC</th>';
					$htmlcurr_jc1.='<th class="weekly_row" colspan="1"></th>';
					$htmlcurr_jc1.='<th class="weekly_row" colspan="4" class="tta">Mandays %</th>';
					$htmlcurr_jc1.='<th class="weekly_row" colspan="4" class="tta">Productivity %</th>';
				$htmlcurr_jc1.='</tr>';

				$htmlcurr_jc1.='<tr class="weekly_row" style="position: sticky; top: 45px; z-index: 1; ">';
					$htmlcurr_jc1.='<th>ASM Name</th>';
					$htmlcurr_jc1.='<th>WK1</th>';
					$htmlcurr_jc1.='<th>WK2</th>';
					$htmlcurr_jc1.='<th>WK3</th>';
					$htmlcurr_jc1.='<th>WK4</th>';
					$htmlcurr_jc1.='<th>WK1</th>';
					$htmlcurr_jc1.='<th>WK2</th>';
					$htmlcurr_jc1.='<th>WK3</th>';
					$htmlcurr_jc1.='<th>WK4</th>';
				$htmlcurr_jc1.='</tr>';

			$htmlcurr_jc1.='</thead>';
			$htmlcurr_jc1.='<tbody>';

			if( !empty($dataa1['result']) ){
				$htmlcurr_jc1.='<tr>';
				$htmlcurr_jc1.='<td class="weekly"  style="padding-top: 20px;vertical-align: unset;" rowspan='.$dataa1['current_jc_count'].'> '.$dataa1['last_jc'].' </td>';
					
				foreach($dataa1['result'] as $row1){
					$htmlcurr_jc1.='<td> '.$row1['ASM_Name'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk1'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk2'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk3'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk4'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk1'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk2'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk3'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk4'].' </td>';
					$htmlcurr_jc1.='</tr>';
				}

			}else{
				$htmlcurr_jc1.='<tr><td class="tta" colspan="10" >no data found!</td></tr>';
			}

			$htmlcurr_jc1.='</tbody>';
		$htmlcurr_jc1.='</table></div>';

		
		$htmlcurr_jc2='<div class="table table-bordered table-responsive" style="height:auto; max-height:300px;"><table>';
			$htmlcurr_jc2.='<thead>';
				$htmlcurr_jc2.='<tr class="weekly" style="position: sticky; top: -1px; z-index: 1; ">';
					$htmlcurr_jc2.='<th rowspan="8"  class="tta">JC</th>';
				$htmlcurr_jc2.='</tr>';

				$htmlcurr_jc2.='<tr class="weekly_row" style="position: sticky; top: -1px; z-index: 1; ">';
					$htmlcurr_jc2.='<td colspan="1"></td>';
					$htmlcurr_jc2.='<td colspan="4" class="tta"><b>Mandays %</b></td>';
					$htmlcurr_jc2.='<td colspan="4" class="tta"><b>Productivity %</b></td>';
				$htmlcurr_jc2.='</tr>';

				$htmlcurr_jc2.='<tr class="weekly_row" style="position: sticky; top: 45px; z-index: 1;">';
					$htmlcurr_jc2.='<td><b>ASM Name</b></td>';
					$htmlcurr_jc2.='<td><b>WK1</b></td>';
					$htmlcurr_jc2.='<td><b>WK2</b></td>';
					$htmlcurr_jc2.='<td><b>WK3</b></td>';
					$htmlcurr_jc2.='<td><b>WK4</b></td>';
					$htmlcurr_jc2.='<td><b>WK1</b></td>';
					$htmlcurr_jc2.='<td><b>WK2</b></td>';
					$htmlcurr_jc2.='<td><b>WK3</b></td>';
					$htmlcurr_jc2.='<td><b>WK4</b></td>';
				$htmlcurr_jc2.='</tr>';

			$htmlcurr_jc2.='</thead>';
			$htmlcurr_jc2.='<tbody>';

				if( !empty($dataa2['result']) ){
					$htmlcurr_jc2.='<tr>';
					$htmlcurr_jc2.='<td class="weekly" style="padding-top: 20px;vertical-align: unset;" rowspan='.$dataa2['current_jc_count'].'> '.$dataa2['last_jc'].' </td>';
						
					foreach($dataa2['result'] as $row2){
						$htmlcurr_jc2.='<td>'.$row2['ASM_Name'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk1'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk2'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk3'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk4'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk1'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk2'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk3'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk4'].' </td>';
						$htmlcurr_jc2.='</tr>';
					}

				}else{
					$htmlcurr_jc2.='<tr><td class="tta" colspan="10" >no data found!</td></tr>';
				}
			$htmlcurr_jc2.='</tbody>';
		$htmlcurr_jc2.='</table></div>';

		$response = array(
			"htmlcurr_jc" => $htmlcurr_jc,
			"htmlcurr_jc1" => $htmlcurr_jc1,
			"htmlcurr_jc2" => $htmlcurr_jc2,
		); 
		echo json_encode($response);
	}

	public function get_weekly_current_jc_asm(){

		$asm = "";
		$tso = $this->input->post('tso_number');
		$sm = $this->input->post('sm_number');

		$dataa = $this->osmmodel->get_weekly_current_jc($asm,$tso,$sm,'last');
		$dataa1 = $this->osmmodel->get_weekly_current_jc($asm,$tso,$sm,'before');
		$dataa2 = $this->osmmodel->get_weekly_current_jc($asm,$tso,$sm,'two_before');
	
		if( !empty($dataa['result']) ){
			$htmlcurr_jc='';
			$htmlcurr_jc.='<tr><td class="tta weekly" rowspan='.$dataa['current_jc_count'].' style="padding-top: 20px;vertical-align: unset;"> <b>'.$dataa['last_jc'].'(Current JC)</b> </td>';
			// $htmlcurr_jc.='<tr><td class="tta weekly" rowspan='.$dataa['current_jc_count'].' style="padding-bottom: 9500px;"> <b>'.$dataa['last_jc'].'(Current JC)</b> </td>';
			foreach($dataa['result'] as $row){

				$htmlcurr_jc.='
				<td> '.$row['SDE_Name'].' </td>
				<td> '.$row['SM_Name'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk1'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk2'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk3'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk4'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk1'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk2'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk3'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk4'].' </td>
				</tr>';
			}
		}else{
			$htmlcurr_jc='<tr><td class="tta" colspan="11" >no data found!</td></tr>';
		}


		$htmlcurr_jc1='<div class="table table-bordered table-responsive" style="height:auto; max-height: 250px;"><table>';
			$htmlcurr_jc1.='<thead>';
				$htmlcurr_jc1.='<tr class="" style="position: sticky; top: -1px; z-index: 1; ">';
					$htmlcurr_jc1.='<th rowspan="2" class="weekly tta">JC</th>';
					$htmlcurr_jc1.='<th class="weekly_row" colspan="2"></th>';
					$htmlcurr_jc1.='<th class="weekly_row" colspan="4" class="tta">Mandays %</th>';
					$htmlcurr_jc1.='<th class="weekly_row" colspan="4" class="tta">Productivity %</th>';
				$htmlcurr_jc1.='</tr>';

				$htmlcurr_jc1.='<tr class="weekly_row" style="position: sticky; top: 45px; z-index: 1; ">';
					$htmlcurr_jc1.='<th>SDE Name</th>';
					$htmlcurr_jc1.='<th>OSM Name</th>';
					$htmlcurr_jc1.='<th>WK1</th>';
					$htmlcurr_jc1.='<th>WK2</th>';
					$htmlcurr_jc1.='<th>WK3</th>';
					$htmlcurr_jc1.='<th>WK4</th>';
					$htmlcurr_jc1.='<th>WK1</th>';
					$htmlcurr_jc1.='<th>WK2</th>';
					$htmlcurr_jc1.='<th>WK3</th>';
					$htmlcurr_jc1.='<th>WK4</th>';
				$htmlcurr_jc1.='</tr>';

			$htmlcurr_jc1.='</thead>';
			$htmlcurr_jc1.='<tbody>';

			if( !empty($dataa1['result']) ){
				$htmlcurr_jc1.='<tr>';
				$htmlcurr_jc1.='<td class="weekly" style="padding-top: 20px;vertical-align: unset;" rowspan='.$dataa1['current_jc_count'].'> '.$dataa1['last_jc'].' </td>';
					
				foreach($dataa1['result'] as $row1){
					$htmlcurr_jc1.='<td> '.$row1['SDE_Name'].' </td>';
					$htmlcurr_jc1.='<td> '.$row1['SM_Name'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk1'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk2'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk3'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk4'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk1'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk2'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk3'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk4'].' </td>';
					$htmlcurr_jc1.='</tr>';
				}

			}else{
				$htmlcurr_jc1.='<tr><td class="tta" colspan="11" >no data found!</td></tr>';
			}

			$htmlcurr_jc1.='</tbody>';
		$htmlcurr_jc1.='</table></div>';

		
		$htmlcurr_jc2='<div class="table table-bordered table-responsive" style="height:auto;max-height: 250px;"><table>';
			$htmlcurr_jc2.='<thead>';
				$htmlcurr_jc2.='<tr class="weekly" style="position: sticky; top: -1px; z-index: 1; ">';
					$htmlcurr_jc2.='<th rowspan="8"  class="tta">JC</th>';
				$htmlcurr_jc2.='</tr>';

				$htmlcurr_jc2.='<tr class="weekly_row" style="position: sticky; top: -1px; z-index: 1; ">';
					$htmlcurr_jc2.='<td colspan="2"></td>';
					$htmlcurr_jc2.='<td colspan="4" class="tta"><b>Mandays %</b></td>';
					$htmlcurr_jc2.='<td colspan="4" class="tta"><b>Productivity %</b></td>';
				$htmlcurr_jc2.='</tr>';

				$htmlcurr_jc2.='<tr class="weekly_row" style="position: sticky; top: 45px; z-index: 1; ">';
					$htmlcurr_jc2.='<td><b>SDE Name</b></td>';
					$htmlcurr_jc2.='<td><b>OSM Name</b></td>';
					$htmlcurr_jc2.='<td><b>WK1</b></td>';
					$htmlcurr_jc2.='<td><b>WK2</b></td>';
					$htmlcurr_jc2.='<td><b>WK3</b></td>';
					$htmlcurr_jc2.='<td><b>WK4</b></td>';
					$htmlcurr_jc2.='<td><b>WK1</b></td>';
					$htmlcurr_jc2.='<td><b>WK2</b></td>';
					$htmlcurr_jc2.='<td><b>WK3</b></td>';
					$htmlcurr_jc2.='<td><b>WK4</b></td>';
				$htmlcurr_jc2.='</tr>';

			$htmlcurr_jc2.='</thead>';
			$htmlcurr_jc2.='<tbody>';

				if( !empty($dataa1['result']) ){
					$htmlcurr_jc2.='<tr>';
					$htmlcurr_jc2.='<td class="weekly" style="padding-top: 20px;vertical-align: unset;" rowspan='.$dataa2['current_jc_count'].'> '.$dataa2['last_jc'].' </td>';
						
					foreach($dataa2['result'] as $row2){
						$htmlcurr_jc2.='<td> '.$row2['SDE_Name'].' </td>';
						$htmlcurr_jc2.='<td> '.$row2['SM_Name'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk1'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk2'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk3'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk4'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk1'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk2'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk3'].' </td>';
						$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk4'].' </td>';
						$htmlcurr_jc2.='</tr>';
					}

				}else{
					$htmlcurr_jc2.='<tr><td class="tta" colspan="11" >no data found!</td></tr>';
				}

			$htmlcurr_jc2.='</tbody>';
		$htmlcurr_jc2.='</table></div>';

		$response = array(
			"htmlcurr_jc" => $htmlcurr_jc,
			"htmlcurr_jc1" => $htmlcurr_jc1,
			"htmlcurr_jc2" => $htmlcurr_jc2,
		); 
		echo json_encode($response);
	}

	public function get_sde_weekly_current_jc(){

		$asm = '';
		$tso = '';
		$sm = $this->input->post('sm_number');

		$dataa = $this->osmmodel->get_weekly_current_jc($asm,$tso,$sm,'last');
		$dataa1 = $this->osmmodel->get_weekly_current_jc($asm,$tso,$sm,'before');
		$dataa2 = $this->osmmodel->get_weekly_current_jc($asm,$tso,$sm,'two_before');
		
		// print_r($dataa['result']);
		// exit;

		if( !empty($dataa['result']) ){
			$htmlcurr_jc='';
			$htmlcurr_jc.='<tr><td class="tta weekly" rowspan='.$dataa['current_jc_count'].' style="padding-top: 20px;vertical-align: unset;"> <b>'.$dataa['last_jc'].'(Current JC)</b> </td>';
			foreach($dataa['result'] as $row){

				$htmlcurr_jc.='
				<td> '.$row['SM_Name'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk1'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk2'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk3'].' </td>
				<td style="text-align: center;"> '.$row['mandays_wk4'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk1'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk2'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk3'].' </td>
				<td style="text-align: center;"> '.$row['productive_wk4'].' </td>
				</tr>';
			}
		}else{
			$htmlcurr_jc='<tr><td class="tta" colspan="10" >no data found!</td></tr>';
		}


		$htmlcurr_jc1='<div class="table table-bordered table-responsive" style="height:auto; max-height:250px;"><table>';
			$htmlcurr_jc1.='<thead>';
				$htmlcurr_jc1.='<tr class="" style="position: sticky; top: -1px; z-index: 1; ">';
					$htmlcurr_jc1.='<th rowspan="2" class="weekly tta">JC</th>';
					$htmlcurr_jc1.='<th class="weekly_row" colspan="1"></th>';
					$htmlcurr_jc1.='<th colspan="4" class="weekly_row tta">Mandays %</th>';
					$htmlcurr_jc1.='<th colspan="4" class="weekly_row tta">Productivity %</th>';
				$htmlcurr_jc1.='</tr>';

				$htmlcurr_jc1.='<tr class="weekly_row" style="position: sticky; top: 45px; z-index: 1; ">';
					$htmlcurr_jc1.='<th>Orange Salesman Name</th>';
					$htmlcurr_jc1.='<th>WK1</th>';
					$htmlcurr_jc1.='<th>WK2</th>';
					$htmlcurr_jc1.='<th>WK3</th>';
					$htmlcurr_jc1.='<th>WK4</th>';
					$htmlcurr_jc1.='<th>WK1</th>';
					$htmlcurr_jc1.='<th>WK2</th>';
					$htmlcurr_jc1.='<th>WK3</th>';
					$htmlcurr_jc1.='<th>WK4</th>';
				$htmlcurr_jc1.='</tr>';

			$htmlcurr_jc1.='</thead>';
			$htmlcurr_jc1.='<tbody>';

			if( !empty($dataa1['result']) ){
				$htmlcurr_jc1.='<tr>';
				$htmlcurr_jc1.='<td class="weekly" style="padding-top: 20px;vertical-align: unset;" rowspan='.$dataa1['current_jc_count'].'> '.$dataa1['last_jc'].' </td>';
					
				foreach($dataa1['result'] as $row1){
					$htmlcurr_jc1.='<td> '.$row1['SM_Name'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk1'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk2'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk3'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['mandays_wk4'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk1'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk2'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk3'].' </td>';
					$htmlcurr_jc1.='<td style="text-align: center;"> '.$row1['productive_wk4'].' </td>';
					$htmlcurr_jc1.='</tr>';
				}

			}else{
				$htmlcurr_jc1.='<tr><td class="tta" colspan="10" >no data found!</td></tr>';
			}

			$htmlcurr_jc1.='</tbody>';
		$htmlcurr_jc1.='</table></div>';

		
		$htmlcurr_jc2='<div class="table table-bordered table-responsive" style="height:auto; max-height:250px;"><table>';
			$htmlcurr_jc2.='<thead>';
				$htmlcurr_jc2.='<tr class="weekly" style="position: sticky; top: -1px; z-index: 1; ">';
					$htmlcurr_jc2.='<th rowspan="8"  class="tta">JC</th>';
				$htmlcurr_jc2.='</tr>';

				$htmlcurr_jc2.='<tr class="weekly_row" style="position: sticky; top: -1px; z-index: 1; ">';
					$htmlcurr_jc2.='<th colspan="1"></th>';
					$htmlcurr_jc2.='<th colspan="4" class="tta">Mandays %</th>';
					$htmlcurr_jc2.='<th colspan="4" class="tta">Productivity %</th>';
				$htmlcurr_jc2.='</tr>';

				$htmlcurr_jc2.='<tr class="weekly_row" style="position: sticky; top: 45px; z-index: 1; ">';
					$htmlcurr_jc2.='<th>Orange Salesman Name</th>';
					$htmlcurr_jc2.='<th>WK1</th>';
					$htmlcurr_jc2.='<th>WK2</th>';
					$htmlcurr_jc2.='<th>WK3</th>';
					$htmlcurr_jc2.='<th>WK4</th>';
					$htmlcurr_jc2.='<th>WK1</th>';
					$htmlcurr_jc2.='<th>WK2</th>';
					$htmlcurr_jc2.='<th>WK3</th>';
					$htmlcurr_jc2.='<th>WK4</th>';
				$htmlcurr_jc2.='</tr>';

			$htmlcurr_jc2.='</thead>';
			$htmlcurr_jc2.='<tbody>';
			
			if( !empty($dataa2['result']) ){
				$htmlcurr_jc2.='<tr>';
				$htmlcurr_jc2.='<td class="weekly" style="padding-top: 20px;vertical-align: unset;" rowspan='.$dataa2['current_jc_count'].'> '.$dataa2['last_jc'].' </td>';
					
				foreach($dataa2['result'] as $row2){
					$htmlcurr_jc2.='<td> '.$row2['SM_Name'].' </td>';
					$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk1'].' </td>';
					$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk2'].' </td>';
					$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk3'].' </td>';
					$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['mandays_wk4'].' </td>';
					$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk1'].' </td>';
					$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk2'].' </td>';
					$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk3'].' </td>';
					$htmlcurr_jc2.='<td style="text-align: center;"> '.$row2['productive_wk4'].' </td>';
					$htmlcurr_jc2.='</tr>';
				}

			}else{
				$htmlcurr_jc2.='<tr><td class="tta" colspan="10" >no data found!</td></tr>';
			}
			$htmlcurr_jc2.='</tbody>';
		$htmlcurr_jc2.='</table></div>';

		$response = array(
			"htmlcurr_jc" => $htmlcurr_jc,
			"htmlcurr_jc1" => $htmlcurr_jc1,
			"htmlcurr_jc2" => $htmlcurr_jc2,
		); 
		echo json_encode($response);
	}


	// public function demo(){
	// 	$this->load->view('osm/datepicker');
	// }



}	
