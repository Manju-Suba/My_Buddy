<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fullcalendar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fullcalendar_model');
    }

    function index()
    {
        $this->load->view('market_visit/fullcalendar');
    }

    function load()
    {

        $event_data = $this->fullcalendar_model->fetch_all_event();
        foreach($event_data as $row)
        {
            $rssm_id = $row['rssm_mkt'];

            $dataa = $this->fullcalendar_model->get_rsm($rssm_id);

			if($dataa){
				$background_color = '#df6d0b4a';
                $border_color = '#ef7308f5';
			}else{
				$background_color = '#3ab11c40';
                $border_color = 'green';
			}

            $data[] = array(
                'id' => $row['id'],
                'title' => $row['auto_id'],
                'start' => $row['created_on'],
                'end' => $row['created_on'],
                'color' => $background_color,
                'borderColor' => $border_color
            );

        }
        echo json_encode($data);
    }

    public function load2()
    {
       
        $busi = $this->input->post('business_filter');
        $tso = $this->input->post('tso_filter');
        $asm  = $this->input->post('asm_filter');
        $zsm  = $this->input->post('zsm_filter');
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

        if( $zsm !=""){
            $datas['zsm_number'] = $this->input->post('zsm_filter');
        }else{
            $datas['zsm_number'] = "";
        }

        if( $sm !=""){
            $datas['sm_number'] = $this->input->post('sm_filter');
        }else{
            $datas['sm_number'] = "";
        }

        
        $event_data = $this->fullcalendar_model->fetch_filter_event($busi ,$datas);
        foreach($event_data as $row)
        {
            $rssm_id = $row['rssm_mkt'];
            $dataa = $this->fullcalendar_model->get_rsm($rssm_id);

			if($dataa){
				$background_color = '#df6d0b4a';
                $border_color = '#ef7308f5';
			}else{
				$background_color = '#3ab11c40';
                $border_color = 'green';
			}

            $data[] = array(
                'id' => $row['id'],
                'title' => $row['auto_id'],
                'start' => $row['created_on'],
                'end' => $row['created_on'],
                'color' => $background_color,
                'borderColor' => $border_color
            );
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


    function update()
    {
        if($this->input->post('id'))
        {
        $data = array(
            'title'   => $this->input->post('title'),
            'start_event' => $this->input->post('start'),
            'end_event'  => $this->input->post('end')
        );

        $this->fullcalendar_model->update_event($data, $this->input->post('id'));
        }
    }

    function view(){
        $id = $this->input->post('id');
        if($this->input->post('id'))
        {
            $data['get_data'] = $this->fullcalendar_model->fetch_data($id);
			$rssm_id = $data['get_data'][0]->rssm_mkt;
			$rs_code = $data['get_data'][0]->rs_mkt;

            if (count( $data['get_data'] ) > 0) {
                $data['rssm_name'] = $this->fullcalendar_model->get_rsm($rssm_id);
                $data['rs_name'] = $this->fullcalendar_model->get_rssm('rs_code',$rs_code,'rs_mkt_master');
                // $data['rssm_name'] = $get_rssm_name[0]['rssm_name'];

				if (count( $data['rssm_name'] ) > 0) {
				}else{
					$data['out_rssm_name'] = $this->fullcalendar_model->get_rssm('mobile',$rssm_id,'users');
				}
            }else{
                $data['rssm_name'] ='';
				$data['out_rssm_name'] = '';
            }

            $timestamp = $data['get_data'][0]->created_on;
            $splitTimeStamp = explode(" ",$timestamp);
            // $date = $splitTimeStamp[0];
            $time = $splitTimeStamp[1];

            $data['cret_time'] = date('h:i A', strtotime($time));
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
