<?php

class Girisim_categories extends HY_Controller
{
    public $viewFolder = "";

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "girisim_categories_v";

        $this->load->model("girisim_category_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $viewData->items = $this->girisim_category_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "show";


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function list(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $viewData->items = $this->girisim_category_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){

        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();
        if($validate){

            $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "-" . rand(1000,99999) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
            $image_200x200 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",200,200, $file_name);

            if($image_200x200){

                $data = array(
                    "title"         => $this->input->post("title"),
                    "url"           => convertToSEO($this->input->post("title")),
                    "img_url"       => $file_name,
                    "isActive"      => 1,
                    "createdAt"     => date("Y-m-d H:i:s")
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Görsel yüklenirken bir problem oluştu",
                    "type"  => "error"
                );

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("girisim_categories/new_form"));
                die();
            }

            $insert = $this->girisim_category_model->add($data);

            // TODO Alert sistemi eklenecek...
            if($insert){

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde eklendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Kayıt Ekleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("girisim_categories"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function update_form($id){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->girisim_category_model->get(
            array(
                "id"    => $id,
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function update($id){

        $this->load->library("form_validation");

        // Kurallar yazilir..

        $this->form_validation->set_rules("title", "Başlık", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();
        if($validate){

            // Upload Süreci...
            if($_FILES["img_url"]["name"] !== "") {
                delete_picture("girisim_category_model", $id, "200x200");

                $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME))  . "-" . rand(1000,99999) . "." .  pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $image_200x200 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",200,200, $file_name);
//                $image_555x343 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",555,343, $file_name);

                if($image_200x200 ){

                    $data = array(
                        "title" => $this->input->post("title"),
                        "url" => convertToSEO($this->input->post("title")),
                        "img_url" => $file_name,
                    );

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Görsel yüklenirken bir problem oluştu",
                        "type" => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("girisim_categories/update_form/$id"));

                    die();

                }

            } else {

                $data = array(
                    "title" => $this->input->post("title"),
                    "url" => convertToSEO($this->input->post("title")),
                );
            }

            $update = $this->girisim_category_model->update(array("id" => $id), $data);

            // TODO Alert sistemi eklenecek...
            if($update){

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde güncellendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Kayıt Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("girisim_categories/update_form/$id"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->girisim_category_model->get(
                array(
                    "id"    => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function delete($id){
        delete_picture("girisim_category_model", $id, "200x200");
        $delete = $this->girisim_category_model->delete(
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
                "title" => "İşlem Başarılı",
                "text" => "Kayıt silme sırasında bir problem oluştu",
                "type"  => "error"
            );


        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("girisim_categories"));


    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->girisim_category_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }

    public function about($id){

        $viewData = new stdClass();

        $this->load->model("user_model");
        /** Tablodan Verilerin Getirilmesi.. */
        $viewData->itemUser = $this->user_model->get_all(
            array(
                "isActive"    => 1,
                "girisim_category_id" => $id
            )
        );

        $viewData->itemGirisim = $this->girisim_category_model->get_all(
            array(
                "id" => $id,
                "isActive" => 1
            )
        );


//        $viewData->total = count($this->fullcalendar_model->get_all(array("teacher_id" => $id)));

//        $viewData->sonBes = $this->fullcalendar_model->get_all_list(
//            array(
//                "teacher_id" => $id,
//                "student_id !=" => 0,
//                "status" => '2'
//            ),"start_event ASC", array("start" => 0, "count" => 5)
//        );

//        $viewData->available_meetings = $this->fullcalendar_model->get_all(
//            array(
//                "teacher_id" => $id,
//                "student_id" => 0,
//                "status" => '1'
//            ),"start_event ASC"
//        );

//        $viewData->my_meetings = $this->fullcalendar_model->get_all(
//            array(
//                "teacher_id" => $id,
//                "student_id !=" => 0,
//                "status" => '2'
//            ),"start_event ASC"
//        );

//        $viewData->past_meetings = $this->fullcalendar_model->get_all(
//            array(
//                "teacher_id" => $id,
//                "student_id !=" => 0,
//                "status" => '3'
//            ),"start_event ASC"
//        );

//        $viewData->cancelled = $this->fullcalendar_model->get_all(
//            array(
//                "teacher_id" => $id,
//                "status" => '4'
//            ),"start_event ASC"
//        );


        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "about";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

}
