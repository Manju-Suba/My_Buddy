<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fullcalendar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Osm_model');
    }

    function load()
    {
		$tso = $this->input->post('tso_filter');
        $asm  = $this->input->post('asm_filter');
        $sm  = $this->input->post('sm_filter');

		if($tso !=""){
            $datas['tso_number'] = $this->input->post('tso_filter');
        }else{
            $datas['tso_number'] ="";
        }

        if( $asm !=""){
            $datas['asm_number'] = $this->input->post('asm_filter');
        }else{
            $datas['asm_number'] = "";
        }
 
        if( $sm !=""){
            $datas['sm_number'] = $this->input->post('sm_filter');

			$event_data = $this->Osm_model->fetch_all_event($datas);
			
			foreach($event_data as $row)
			{
				$val = $row['OVERALL_VALUE_Actual_FTD_'] * 100000;
				$value = round($val);

				$cal_ = 'TC :'.$row['Outlet_Visit_Actual_FTD'].'
						Value :'.$value.'
						Billcut :'.$row['Billcuts_D__1'].'
						TLSD :'.$row['TLSD_D__1'].'
						';
				$data[] = array(
					'id' => $row['id'],
					'title' => $cal_,
					'start' => $row['REPORT_DATE'],
					'end' => $row['REPORT_DATE'], 
				);
			}
		
        }else{
            $datas['sm_number'] = "";

			$event_data = $this->Osm_model->fetch_all_event($datas);
			foreach($event_data as $row)
			{
				$data[] = array(
					'id' => $row['id'],
					'title' => $row['SM_NAME'],
					'start' => $row['REPORT_DATE'],
					'end' => $row['REPORT_DATE'], 
				);
			}
			
        }

       
        echo json_encode($data);
    }

    function insert()
    {
        if($this->input->post('title'))
        {
        $data = array(
            'title'  => $this->input->post('title'),
            'start_event'=> $this->input->post('start'),
            'end_event' => $this->input->post('end')
        );
        $this->fullcalendar_model->insert_event($data);
        }
    }
   

    function view(){
        $id = $this->input->post('id'); 

        if($this->input->post('id'))
        {
            $data['get_data'] = $this->Osm_model->fetch_data($id);
        }
       
        echo json_encode($data);
    }

    
    function delete()
    {
        if($this->input->post('id'))
        {
        $this->fullcalendar_model->delete_event($this->input->post('id'));
        }
    }

}

?>
