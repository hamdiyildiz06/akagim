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
        $this->load->model("girisim_category_model");



        $viewData->totalGirisim = count($this->girisim_category_model->get_all(
            array(
                "isActive"  => 1
            )
        ));

        $viewData->totalMentor = count($this->user_model->get_all(
            array(
                "isActive"     =>  1,
                "user_role_id" =>  2
            )
        ));

        $viewData->totalMenti = count($this->user_model->get_all(
            array(
                "isActive"     =>  1,
                "user_role_id" =>  3
            )
        ));



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

        if ($this->input->post()){

            $fullName = $this->input->post("fullName");
            $daterange =  $this->input->post("daterange");

            $tarih = explode('/', $daterange);
            if (!empty($fullName) AND !empty($daterange) ){

                $data = [
                    "teacher_id" => $fullName,
                    "start_event >" => $tarih[0],
                    "end_event <" => $tarih[1]
                ];

            }elseif (!empty($daterange)){

                $data = [
                    "start_event >" => $tarih[0],
                    "end_event <" => $tarih[1]
                ];
                $link = "?fullName={$fullName}&daterange={$daterange}";
            }else{

                $data = [
                    "teacher_id" => $fullName
                ];

            }

            $items = $this->fullcalendar_model->get_all($data);

        }else{
            $items = $this->fullcalendar_model->get_all();
        }

        /** Tablodan Verilerin Getirilmesi.. */


        $users =  $this->user_model->get_all(
            array(
                "user_role_id !=" => 3,
            )
        );


        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "show";
        $viewData->items = $items;
        $viewData->users = $users;
        $viewData->fullName = $fullName;
        $viewData->daterange = $daterange;




        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function excel(){

        $viewData = new stdClass();

        $user = get_active_user();

        if ($this->input->post()){

            $fullName = $this->input->post("fullNamee");
            $daterange =  $this->input->post("daterangee");

            $tarih = explode('/', $daterange);
            if (!empty($fullName) AND !empty($daterange) ){

                $data = [
                    "teacher_id" => $fullName,
                    "start_event >" => $tarih[0],
                    "end_event <" => $tarih[1]
                ];

            }elseif (!empty($daterange)){

                $data = [
                    "start_event >" => $tarih[0],
                    "end_event <" => $tarih[1]
                ];

            }elseif (!empty($fullName)){

                $data = [
                    "teacher_id" => $fullName
                ];

            }else{
                $data = [];
            }

            $items = $this->fullcalendar_model->get_all($data);

        }else{
            redirect("dashboard/show");
        }

        /** Tablodan Verilerin Getirilmesi.. */


        $users =  $this->user_model->get_all(
            array(
                "user_role_id !=" => 3,
            )
        );

        $this->load->library("Excel");

        $myExcell = new PHPExcel();
        $myExcell->getActiveSheet()->setTitle("Mentor");
        $myExcell->getActiveSheet()->setCellValue("A1","Id");
        $myExcell->getActiveSheet()->setCellValue("B1","Mentor");
        $myExcell->getActiveSheet()->setCellValue("C1","Menti");
        $myExcell->getActiveSheet()->setCellValue("D1","Tarih");
        $myExcell->getActiveSheet()->setCellValue("E1","başlangıç");
        $myExcell->getActiveSheet()->setCellValue("F1","Bitiş");
        $myExcell->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
        $myExcell->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
        $myExcell->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
        $myExcell->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
        $myExcell->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
        $myExcell->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
        $myExcell->getActiveSheet()->getRowDimension("1")->setRowHeight(22);
        $myExcell->getActiveSheet()->getStyle("A1:F1")
            ->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB("E5AB9E");
        $myExcell->getActiveSheet()->getStyle("A1:F1")->getFont()->setBold(true);
        $borderStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $myExcell->getActiveSheet()->getStyle("A1:F1")->getFont()->setSize(13);
        $myExcell->getActiveSheet()->getStyle("A1:F1")->applyFromArray($borderStyle);



        $i = 2;
        foreach ($items as $item):
            $calendar = get_watch_list($item->start_event, $item->end_event);
            $myExcell->getActiveSheet()->getRowDimension($i)->setRowHeight(20);
            $myExcell->getActiveSheet()->getStyle("A$i:F$i")->applyFromArray($borderStyle);
            $myExcell->getActiveSheet()->getStyle("A$i:F$i")->getFont()->setSize(11);
            $myExcell->getActiveSheet()->setCellValue("A".$i,$item->id);
            $myExcell->getActiveSheet()->setCellValue("B".$i,get_user_info($item->teacher_id)->full_name);
            $myExcell->getActiveSheet()->setCellValue("C".$i,get_user_info($item->student_id)->full_name);
            $myExcell->getActiveSheet()->setCellValue("D".$i,$calendar['tarih']);
            $myExcell->getActiveSheet()->setCellValue("E".$i,$calendar['baslangic']);
            $myExcell->getActiveSheet()->setCellValue("F".$i,$calendar['bitis']);
            $i++;
        endforeach;

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="MentorList.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($myExcell, 'Excel2007');
        $objWriter->save('php://output');
        exit;

    }

    public function update_form($id){
        $viewData = new stdClass();
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
//        if ($this->input->post("toplanti_turu") == 'ozel'){
//            $this->form_validation->set_rules("toplantiYeri", "Toplantı Yeri", "required|trim");
//        }
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


        $validate = $this->form_validation->run();
        if($validate){

            $tarih = explode('-', $this->input->post("event_date"));
            $tarih = $tarih["2"] ."-". $tarih["1"] ."-". $tarih["0"];

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
                    "start_event"       => $tarih . " " . $this->input->post("start_event"),
                    "end_event"         => $tarih . " " . $this->input->post("end_event"),
                    "description"       => $this->input->post("description"),
                    "status"            => ($this->input->post("student_id") == 0) ? '1' : '2',
                    "isActive"          => ($this->input->post("student_id") == 0) ? '0' : '1'
                )
            );

            // TODO Alert sistemi eklenecek...
            if($update){

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text"  => "Güncelleme başarılı bir şekilde eklendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text"  => "Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }


            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("dashboard/update_form/{$id}"));
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
