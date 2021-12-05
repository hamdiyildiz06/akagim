<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends HY_Controller {

    public $viewFolder = "";
//    public $user;

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "dashboard_v";
        $this->user = get_active_user();

        $this->load->model('fullcalendar_model');

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index()
	{
	    $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

    function load()
    {

        $event_data = $this->fullcalendar_model->fetch_all_event(
            array(
                "teacher_id" => $this->user->id
            )
        );

        foreach($event_data->result_array() as $row)
        {
            $starttime = explode(' ', $row['start_event']);
            $endtime = explode(' ', $row['end_event']);

            $data[] = array(
                'id'	        =>	$row['id'],
                'title'	        =>	$row['title'],
                'start'	        =>	$row['start_event'],
                'end'	        =>	$row['end_event'],
                'color'	        =>	$row['color'],
                'textColor'	    =>	$row['textColor'],
                'description'   =>	$row['description'],
                'toplantiTuru'   =>	$row['toplantiTuru'],
                'toplantiYeri'   =>	$row['toplantiYeri'],
                'teacher_id'    =>	$row['teacher_id'],
                'start_time'    =>	$starttime['1'],
                'end_time'	    =>	$endtime['1'],
            );
        }

        echo json_encode($data);
    }



    function insert()
    {
        if($this->input->post('title'))
        {

            $data = array(
                'title'		    =>	$this->input->post('title'),
                'color'	        =>	$this->input->post('color'),
                'textColor'	    =>	$this->input->post('textColor'),
                'description'	=>	$this->input->post('description'),
                'toplantiTuru'	=>	$this->input->post('toplantiTuru'),
                'toplantiYeri'	=>	$this->input->post('toplantiYeri'),
                'start_event'   =>	$this->input->post('start'),
                'end_event'	    =>	$this->input->post('end'),
                'teacher_id'    =>	$this->user->id,
            );
            $insert = $this->fullcalendar_model->insert_event($data);
            echo json_encode($insert);
        }

    }

    function update()
    {
        if($this->input->post('id'))
        {
            $data = array(
                'title'		    =>	$this->input->post('title'),
                'color'	        =>	$this->input->post('color'),
                'textColor'	    =>	$this->input->post('textColor'),
                'description'	=>	$this->input->post('description'),
                'toplantiTuru'	=>	$this->input->post('toplantiTuru'),
                'toplantiYeri'	=>	$this->input->post('toplantiYeri'),
                'start_event'   =>	$this->input->post('start'),
                'end_event'	    =>	$this->input->post('end'),
            );

            $update = $this->fullcalendar_model->update_event($data, $this->input->post('id'));
            echo json_encode($update);
        }
    }

    function delete()
    {
        if($this->input->post('id'))
        {
            $delete = $this->fullcalendar_model->delete_event($this->input->post('id'));
            echo json_encode($delete);
        }
    }

    function ResizeUpdate()
    {
        if($this->input->post('id'))
        {
            $data = array(
                'title'		    =>	$this->input->post('title'),
                'color'	        =>	$this->input->post('color'),
                'textColor'	    =>	$this->input->post('textColor'),
                'description'	=>	$this->input->post('description'),
                'toplantiTuru'	=>	$this->input->post('toplantiTuru'),
                'toplantiYeri'	=>	$this->input->post('toplantiYeri'),
                'start_event'   =>	$this->input->post('start'),
                'end_event'	    =>	$this->input->post('end'),
            );

            $this->fullcalendar_model->update_resize_event($data, $this->input->post('id'));

            echo "resize döndü";
        }
    }


}
