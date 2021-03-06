<?php

class Mentor extends HY_Controller
{
    public $viewFolder = "";

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "mentor_v";

        $this->load->model("user_model");
        $this->load->model("user_role_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        $user = get_active_user();

//        if(isAdmin()){
//
//            $where = array();
//
//        } else {
//
//            $where = array(
//                "id"    => $user->id,
//            );
//
//        }

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->user_model->get_all(
            array(
                "id !="    => $user->id,
                "user_role_id" => 2,
                "isActive" => 1
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "show";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function list(){

        $viewData = new stdClass();

        $user = get_active_user();

//        if(isAdmin()){
//
//            $where = array();
//
//        } else {
//
//            $where = array(
//                "id"    => $user->id,
//            );
//
//        }

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->user_model->get_all(
            array(
                "user_role_id" => 2,
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    
    public function new_form(){

        $viewData = new stdClass();



        $viewData->user_roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){

        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("user_role_id", ",Kullanıcı Rolü", "required|trim");
        $this->form_validation->set_rules("email", "E-posta", "required|trim|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|max_length[8]|matches[password]");

        $this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz",
                "is_unique"   => "<b>{field}</b> alanı daha önceden kullanılmış",
                "matches"     => "Şifreler birbirlerini tutmuyor"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            $insert = $this->user_model->add(
                array(
                    "user_name"     => $this->input->post("user_name"),
                    "full_name"     => $this->input->post("full_name"),
                    "email"         => $this->input->post("email"),
                    "password"      => md5($this->input->post("password")),
                    "user_role_id"  => $this->input->post("user_role_id"),
                    "isActive"      => 1,
                    "createdAt"     => date("Y-m-d H:i:s")
                )
            );

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


            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("users"));

            die();

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
        $item = $this->user_model->get(
            array(
                "id"    => $id,
            )
        );


        $viewData->user_roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );
        
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function update_password_form($id){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->user_model->get(
            array(
                "id"    => $id,
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "password";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function update($id){

        $this->load->library("form_validation");

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


        $this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz",
                "is_unique"   => "<b>{field}</b> alanı daha önceden kullanılmış",
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...
            $update = $this->user_model->update(
                array("id" => $id),
                array(
                    "user_name"     => $this->input->post("user_name"),
                    "full_name"     => $this->input->post("full_name"),
                    "email"         => $this->input->post("email"),
                    "user_role_id"  => $this->input->post("user_role_id"),
                )
            );

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

            redirect(base_url("users"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->user_model->get(
                array(
                    "id"    => $id,
                )
            );

            $viewData->user_roles = $this->user_role_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function update_password($id){

        $this->load->library("form_validation");

        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|max_length[8]|matches[password]");

        $this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> alanı doldurulmalıdır",
                "matches"     => "Şifreler birbirlerini tutmuyor"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...
            $update = $this->user_model->update(
                array("id" => $id),
                array(
                    "password"      => md5($this->input->post("password")),
                )
            );

            // TODO Alert sistemi eklenecek...
            if($update){

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Şifreniz başarılı bir şekilde güncellendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Şifre Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("users"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "password";
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->user_model->get(
                array(
                    "id"    => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function delete($id){

        $delete = $this->user_model->delete(
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
        redirect(base_url("users"));


    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->user_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }

    public function courses($id){

        $this->load->model('fullcalendar_model');

        $viewData = new stdClass();

        $user = get_active_user();


        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->user_model->get(
            array(
                "id" => $id,
            )
        );

        $event_data = $this->fullcalendar_model->fetch_all_event_result(
            array(
                "teacher_id" => $id
            )
        );

//        $event_data = $this->fullcalendar_model->fetch_all_event(
//            array(
//                "teacher_id" => $id
//            )
//        );


//echo "<pre>";
//        print_r($event_data);
//        print_r($items);
//die();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "courses";
        $viewData->item = $item;
//        $viewData->courses = $event_data->result_array();
        $viewData->courses = $event_data;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function lesson($id,$lesson){

        $this->load->model('fullcalendar_model');

        $viewData = new stdClass();

        $user = get_active_user();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->user_model->get(
            array(
                "id" => $id,
            )
        );

        $event_data = $this->fullcalendar_model->get(
            array(
                "id" => $lesson,
                "teacher_id" => $id
            )
        );

//        $event_data = $this->fullcalendar_model->fetch_all_event(
//            array(
//                "teacher_id" => $id
//            )
//        );


//echo "<pre>";
//        print_r($event_data);
//        print_r($items);
//die();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "lesson";
        $viewData->item = $item;
//        $viewData->courses = $event_data->result_array();
        $viewData->cours = $event_data;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function about($id){

        $viewData = new stdClass();

        $this->load->model("course_model");
        $this->load->model('fullcalendar_model');

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->user_model->get(
            array(
                "id"    => $id,
            )
        );

        $viewData->user_roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $viewData->total = count($this->fullcalendar_model->get_all(array("teacher_id" => $id)));

        $viewData->sonBes = $this->fullcalendar_model->get_all_list(
            array(
                "teacher_id" => $id,
                "student_id !=" => 0,
                "status" => '2'
            ),"start_event ASC", array("start" => 0, "count" => 5)
        );

        $viewData->available_meetings = $this->fullcalendar_model->get_all(
            array(
                "teacher_id" => $id,
                "student_id" => 0,
                "status" => '1'
            ),"start_event ASC"
        );

        $viewData->my_meetings = $this->fullcalendar_model->get_all(
            array(
                "teacher_id" => $id,
                "student_id !=" => 0,
                "status" => '2'
            ),"start_event ASC"
        );

        $viewData->past_meetings = $this->fullcalendar_model->get_all(
            array(
                "teacher_id" => $id,
                "student_id !=" => 0,
                "status" => '3'
            ),"start_event ASC"
        );

        $viewData->cancelled = $this->fullcalendar_model->get_all(
            array(
                "teacher_id" => $id,
                "status" => '4'
            ),"start_event ASC"
        );


        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "about";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function event($id){

        $viewData = new stdClass();

        $this->load->model("course_model");
        $this->load->model('fullcalendar_model');
        $this->load->model('girisim_category_model');

        /** Tablodan Verilerin Getirilmesi.. */
//        $viewData->courses = $this->course_model->get_all(
//            array(), "rank ASC"
//        );

        $viewData->user_roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $viewData->event = $this->fullcalendar_model->get(
            array(
                "id" => $id
            )
        );


        if ($viewData->event->status == 1){

            $viewData->mentor = $this->user_model->get(
                array(
                    "id"    => $viewData->event->teacher_id,
                )
            );

            $viewData->menti = $this->user_model->get(
                array(
                    "id"    => get_active_user()->id
                )
            );

            $viewData->item= $this->fullcalendar_model->get(
                array(
                    "id" => $viewData->event->teacher_id,
                    "student_id" => 0,
                )
            );

            $viewData->girisim_category = $this->girisim_category_model->get(
                array(
                    "id" => $viewData->menti->girisim_category_id,
                    "isActive" => 1
                )
            );


        }

        if ($viewData->event->status == 2){

            $viewData->mentor = $this->user_model->get(
                array(
                    "id"    => $viewData->event->teacher_id,
                )
            );

            $viewData->menti = $this->user_model->get(
                array(
                    "id"    => $viewData->event->student_id
                )
            );

            $viewData->item= $this->fullcalendar_model->get(
                array(
                    "id" => $viewData->event->teacher_id,
                    "student_id" => 0,
                )
            );

            $viewData->girisim_category = $this->girisim_category_model->get(
                array(
                    "id" => $viewData->menti->girisim_category_id,
                    "isActive" => 1
                )
            );
        }

        if ($viewData->event->status == 3){

            $viewData->mentor = $this->user_model->get(
                array(
                    "id"    => $viewData->event->teacher_id,
                )
            );

            $viewData->menti = $this->user_model->get(
                array(
                    "id"    => $viewData->event->student_id
                )
            );

            $viewData->item= $this->fullcalendar_model->get(
                array(
                    "id" => $viewData->event->teacher_id,
                    "student_id" => 0,
                )
            );

            $viewData->girisim_category = $this->girisim_category_model->get(
                array(
                    "id" => $viewData->menti->girisim_category_id,
                    "isActive" => 1
                )
            );
        }

        if ($viewData->event->status == 4){

            $viewData->mentor = $this->user_model->get(
                array(
                    "id"    => $viewData->event->teacher_id,
                )
            );

            $viewData->menti = $this->user_model->get(
                array(
                    "id"    => $viewData->event->student_id
                )
            );

            $viewData->item= $this->fullcalendar_model->get(
                array(
                    "id" => $viewData->event->teacher_id,
                    "student_id" => 0,
                )
            );

            $viewData->girisim_category = $this->girisim_category_model->get(
                array(
                    "id" => $viewData->menti->girisim_category_id,
                    "isActive" => 1
                )
            );
        }


        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "event";


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function rezerv($id,$di = ""){
        $viewData = new stdClass();

        $user = get_active_user();

        $this->load->model('fullcalendar_model');
        $this->load->model('user_model');

        $rezerv = $this->fullcalendar_model->get(
            array(
                "id" => $id,
            )
        );

        // teacher bilgilerini aldık
        $teacher = $this->user_model->get([
            "id" => $rezerv->teacher_id
        ]);

        // student bilgilerini aldık




//        print_r($user);
//        die();


        if ($rezerv->status === '1'){
            // menti iptal edemeyecek
            $isActive = ($rezerv->isActive === '0' ) ? '1' : '0';
            if (($user->user_role_id == 3) && $isActive === 1){
                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text"  => "Bu işlem için yetkiniz yok",
                    "type"  => "error"
                );

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("mentor/event/{$id}"));
                die();
            }

            $data = array(
                "student_id" => $user->id,
                "status"  => '2',
                "isActive"  => $isActive
            );

            $mesaj_data = [
                "toEmail" => $user->email,
                "subject" => "Akagim Meeting İşlemleri Bilgilendirme",
                "message_student" => "Merhaba; Toplantıyı rezerv isteğiniz Mentör’ümüze iletildi. Onaylanması durumunda sizlere bilgi veriyor olacağız. Teşekkür ederiz.",
                "message_teacher" => "Merhaba; müsait toplantınız Menti’miz tarafından rezerve edildi. Toplantıyı onaylamak için lütfen tıklayınız.",
            ];

        }
        elseif ($rezerv->status === '2'){

            $isActive = $di;
            // menti iptal edemeyecek
            if (($user->user_role_id == 1) && $isActive === 1){
                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text"  => "Bu işlem için yetkiniz yok",
                    "type"  => "error"
                );

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("mentor/event/{$id}"));
                die();
            }

            if ($di == 2){
                $data =   array(
                    "status"  => '2',
                    "isActive"  => '2'
                );
                $mesaj_data = [
                    "toEmail" => $user->email,
                    "subject" => "Akagim Meeting İşlemleri Bilgilendirme",
                    "message_student" => "Merhaba; Mentör’ümüz tarafından toplantınız onaylandı. Toplantı saatinde portalımız üzerinden kullanıcı adı ve şifresini girerek görüşme sağlayabilirsiniz. Teşekkür ederiz.",
                    "message_teacher" => "Merhaba; Toplantı onayınız Menti’ye iletildi. Toplantı saatinde portalımız üzerinden kullanıcı adı ve şifresini girerek görüşme sağlayabilirsiniz. Teşekkür ederiz.",
                ];
            }elseif($di == 3){
                $data =   array(
                    "status"  => '3',
                    "isActive"  => '3'
                );
                $mesaj_data = [
                    "toEmail" => $user->email,
                    "subject" => "Akagim Meeting İşlemleri Bilgilendirme",
                    "message_student" =>  "Toplantıya katıldığınız için teşekkür ederiz.",
                    "message_teacher" => "Toplantıya katıldığınız için teşekkür ederiz. ",
                ];
            }elseif ($di == 4){
                $data =   array(
                    "status"  => '4',
                    "isActive"  => '4'
                );
                $mesaj_data = [
                    "toEmail" => $user->email,
                    "subject" => "Akagim Meeting İşlemleri Bilgilendirme",
                    "message_student" =>  "Toplantınız iptal edilmiştir. Mentörlerimizin müsaitlik durumuna göre tekrardan portalımıza girip randevu oluşturabilirsiniz, Teşekkür ederiz.",
                    "message_teacher" => "Toplantınız Başarıyla iptal edilmiştir. Müsaitlik durumunuza göre tekrar toplantı oluşturabilirsiniz. Teşekkür ederiz.",
                ];
            }
        }

        $update = $this->fullcalendar_model->update(array("id" => $id), $data);


        if($update){

//            send_email($mesaj_data["toEmail"],$mesaj_data["subject"],$mesaj_data["message"]);
//            send_email($teacher->email,$mesaj_data["subject"],$mesaj_data["message"]);


            send_email("hamdiyildiz06@gmail.com",$mesaj_data["subject"],$mesaj_data["message_student"]);
            send_email("hamdiyildiz06@gmail.com",$mesaj_data["subject"],$mesaj_data["message_teacher"]);

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


        $this->session->set_flashdata("alert", $alert);

//        redirect(base_url("mentor/about/{$rezerv->teacher_id}#profile-my_meetings"));
        redirect(base_url("mentor/event/{$id}"));

        die();
    }

}
