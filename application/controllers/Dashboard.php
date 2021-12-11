<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends HY_Controller {

    public $viewFolder = "";

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "dashboard_v";
        $this->user = get_active_user();

        $this->load->model('fullcalendar_model');
        $this->load->model('user_model');

        if(!get_active_user()){
            redirect(base_url("login"));
        }

        if(get_active_user()->user_role_id == 3 ){
            redirect(base_url("program_info"));
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

    public function new_form(){
        $viewData = new stdClass();

        $user = $this->user = get_active_user();


        if ($user->user_role_id != 1){
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Bu İşlem için yetkiniz yok",
                "type"  => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("program_info"));
            die();
        }
        $viewData->user = $user;

        $viewData->teachers = $this->user_model->get_all(
            array(
                "isActive"     =>  1,
                "user_role_id" =>  2
            )
        );

        $viewData->students = $this->user_model->get_all(
            array(
                "isActive"     =>  1,
                "user_role_id" =>  3
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){
        $user = get_active_user();
        if ($user->user_role_id != 1){
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Bu İşlem için yetkiniz yok",
                "type"  => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("program_info"));
            die();
        }

        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("teacher_id", "Mentor", "required|trim");
//        $this->form_validation->set_rules("toplantiTuru", "Toplantı Türü", "required|trim");

//        $this->form_validation->set_rules("listColor", "Arka Plan Rengi", "required|trim");
//        $this->form_validation->set_rules("listTextColor", "Yazı Rengi", "required|trim");
//        $this->form_validation->set_rules("event_date", "Eğitim Tarihi", "required|trim");
//        $this->form_validation->set_rules("start_event", "Başlangıç Saati", "required|trim");
//        $this->form_validation->set_rules("end_event", "Bitiş Saati", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır",
                "trim"  => "<b>{field}</b> alanı trime takılıyor",
            )
        );


        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            $insert = $this->fullcalendar_model->add(
                array(
                    "title"             => $this->input->post("title"),
                    "teacher_id"        => $this->input->post("teacher_id"),
                    "student_id"        => $this->input->post("student_id"),
                    "toplantiTuru"      => $this->input->post("toplanti_turu"),
                    "toplantiYeri"      => $this->input->post("toplanti_yeri"),
                    "color"             => $this->input->post("listColor"),
                    "textColor"         => $this->input->post("listTextColor"),
                    "start_event"       => $this->input->post("event_date") . " " . $this->input->post("start_event"),
                    "end_event"         => $this->input->post("event_date") . " " . $this->input->post("end_event"),
                    "description"       => $this->input->post("description"),
                    "status"            => ($this->input->post("student_id") == 0) ? '1' : '2',
                    "isActive"          => ($this->input->post("student_id") == 0) ? '0' : '1'

                )
            );

            // TODO Alert sistemi eklenecek...
            if($insert){

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text"  => "Kayıt başarılı bir şekilde eklendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text"  => "Kayıt Ekleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }


            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("dashboard/new_form"));
            die();
        } else {

            $viewData = new stdClass();
            $viewData->teachers = $this->user_model->get_all(
                array(
                    "isActive"     =>  1,
                    "user_role_id" =>  2
                )
            );

            $viewData->students = $this->user_model->get_all(
                array(
                    "isActive"     =>  1,
                    "user_role_id" =>  3
                )
            );

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function show(){
        $viewData = new stdClass();

        $user = get_active_user();

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->fullcalendar_model->get_all(
            array()
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "show";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update_form($id){
;
        $user = get_active_user();

        $viewData->item = $this->fullcalendar_model->get(
            array(
                "id" => $id
            )
        );



        if ($user->user_role_id != 1){
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Bu İşlem için yetkiniz yok",
                "type"  => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("program_info"));
            die();
        }

        $viewData->teachers = $this->user_model->get_all(
            array(
                "isActive"     =>  1,
                "user_role_id" =>  2
            )
        );

        $viewData->students = $this->user_model->get_all(
            array(
                "isActive"     =>  1,
                "user_role_id" =>  3
            )
        );




        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updated($id){



        $user = get_active_user();
        $this->load->library("form_validation");

        if ($user->user_role_id != 1){
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Bu İşlem için yetkiniz yok",
                "type"  => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("program_info"));
            die();
        }



        $oldUser = $this->user_model->get(
            array(
                "id"    => $id
            )
        );



        if($oldUser->user_name != $this->input->post("user_name")){
            $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        }

        if($oldUser->email != $this->input->post("email")){
            $this->form_validation->set_rules("email", "E-posta", "required|trim|valid_email|is_unique[users.email]");
        }


        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("user_role_id", "Kullanıcı Rolü", "required|trim");









        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("teacher_id", "Mentor", "required|trim");
//        $this->form_validation->set_rules("toplantiTuru", "Toplantı Türü", "required|trim");

//        $this->form_validation->set_rules("listColor", "Arka Plan Rengi", "required|trim");
//        $this->form_validation->set_rules("listTextColor", "Yazı Rengi", "required|trim");
//        $this->form_validation->set_rules("event_date", "Eğitim Tarihi", "required|trim");
//        $this->form_validation->set_rules("start_event", "Başlangıç Saati", "required|trim");
//        $this->form_validation->set_rules("end_event", "Bitiş Saati", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır",
                "trim"      => "<b>{field}</b> alanı trime takılıyor",
            )
        );


        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();
        if($validate){




            $update = $this->fullcalendar_model->update(
                array("id" => $id),
                array(
                    "title"             => $this->input->post("title"),
                    "teacher_id"        => $this->input->post("teacher_id"),
                    "student_id"        => $this->input->post("student_id"),
                    "toplantiTuru"      => $this->input->post("toplanti_turu"),
                    "toplantiYeri"      => $this->input->post("toplanti_yeri"),
                    "color"             => $this->input->post("listColor"),
                    "textColor"         => $this->input->post("listTextColor"),
                    "start_event"       => $this->input->post("event_date") . " " . $this->input->post("start_event"),
                    "end_event"         => $this->input->post("event_date") . " " . $this->input->post("end_event"),
                    "description"       => $this->input->post("description"),
                    "status"            => ($this->input->post("student_id") == 0) ? '1' : '2',
                    "isActive"          => ($this->input->post("student_id") == 0) ? '0' : '1'
                )
            );

            // TODO Alert sistemi eklenecek...
            if($insert){

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text"  => "Kayıt başarılı bir şekilde eklendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text"  => "Kayıt Ekleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }


            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("dashboard/new_form"));
            die();
        } else {

            $viewData = new stdClass();
            $viewData->teachers = $this->user_model->get_all(
                array(
                    "isActive"     =>  1,
                    "user_role_id" =>  2
                )
            );

            $viewData->students = $this->user_model->get_all(
                array(
                    "isActive"     =>  1,
                    "user_role_id" =>  3
                )
            );

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function deleted($id){
        $user = get_active_user();
        if ($user->user_role_id != 1){
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Bu İşlem için yetkiniz yok",
                "type"  => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("program_info"));
            die();
        }

        $delete = $this->fullcalendar_model->delete(
            array(
                "id"    => $id
            )
        );

        // TODO Alert Sistemi Eklenecek...
        if($delete){

            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Kayıt başarılı bir şekilde silindi",
                "type"  => "success"
            );

        } else {

            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Kayıt silme sırasında bir problem oluştu",
                "type"  => "error"
            );


        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("dashboard/show"));

    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->fullcalendar_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }


}
