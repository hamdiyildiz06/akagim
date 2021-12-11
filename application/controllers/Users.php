<?php

class Users extends HY_Controller
{
    public $viewFolder = "";

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "users_v";

        $this->load->model("user_model");
        $this->load->model("user_role_model");
        $this->load->model("girisim_category_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        $user = get_active_user();



        if($user->user_role_id == 1){

            $where = array();

        } else {

            $where = array(
                "id"    => $user->id
            );

        }



        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->user_model->get_all(
            $where
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){
        $viewData = new stdClass();

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

        $viewData->girisim_category = $this->girisim_category_model->get_all(
            array(
                "isActive" => 1
            )
        );



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
        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("user_role_id", ",Kullanıcı Rolü", "required|trim");
        $this->form_validation->set_rules("girisim_category_id", ",Girişim Categori", "required|trim");
        $this->form_validation->set_rules("email", "E-posta", "required|trim|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[4]|max_length[8]|matches[password]");

        $this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz",
                "is_unique"   => "<b>{field}</b> alanı daha önceden kullanılmış",
                "matches"     => "Şifreler birbirlerini tutmuyor",
                "min_length"  => "<b>{field}</b> 4 karakterden az olamaz",
                "max_length"  => "<b>{field}</b> 8 karakterden fazla olamaz",
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
                    "girisim_category_id"  => $this->input->post("girisim_category_id"),
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

            $viewData->user_roles = $this->user_role_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_form($id){

        $viewData = new stdClass();

        $user = get_active_user();
        if (($user->user_role_id != 1) || $user->id == $id){
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Bu İşlem için yetkiniz yok",
                "type"  => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("program_info"));
            die();
        }

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

        $viewData->girisim_category = $this->girisim_category_model->get_all(
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
        $this->form_validation->set_rules("girisim_category_id", ",Girişim Categori", "required|trim");

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
            if($_FILES["img_url"]["name"] !== "") {

                $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $image_80x80 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",80,80, $file_name);

                if($image_80x80){
                    delete_picture("user_model" , $id, "80x80", $oldUser->img_url);
                    $data = array(
                        "user_name"             => $this->input->post("user_name"),
                        "full_name"             => $this->input->post("full_name"),
                        "email"                 => $this->input->post("email"),
                        "user_role_id"          => $this->input->post("user_role_id"),
                        "girisim_category_id"   => $this->input->post("girisim_category_id"),
                        "img_url"               => $file_name,
                    );

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Görsel yüklenirken bir problem oluştu",
                        "type" => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("user/update_form/$id"));

                    die();

                }

            } else {

                $data =array(
                    "user_name"             => $this->input->post("user_name"),
                    "full_name"             => $this->input->post("full_name"),
                    "email"                 => $this->input->post("email"),
                    "user_role_id"          => $this->input->post("user_role_id"),
                    "girisim_category_id"   => $this->input->post("girisim_category_id"),
                );

            }

            $update = $this->user_model->update(array("id" => $id), $data);

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

//            redirect(base_url("users"));
            redirect(base_url("users/update_form/$id"));
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

            $viewData->girisim_category = $this->girisim_category_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function profil_form($id){

        $viewData = new stdClass();

        $user = get_active_user();
        if (($user->user_role_id != 1) && $user->id != $id){
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Bu İşlem için yetkiniz yok",
                "type"  => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("program_info"));
            die();
        }



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
        $viewData->subViewFolder = "profil";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function profil_upload($id){

        $this->load->library("form_validation");

        $oldUser = $this->user_model->get(
            array(
                "id"    => $id
            )
        );

        if($oldUser->user_name != $this->input->post("user_name")){
            $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        }

        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("user_role_id", "Kullanıcı Rolü", "required|trim");
        $this->form_validation->set_rules("linkedin", "linkedin", "trim");
        $this->form_validation->set_rules("facebook", "facebook", "trim");
        $this->form_validation->set_rules("instagram", "instagram", "trim");


        $this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz",
                "is_unique"   => "<b>{field}</b> alanı daha önceden kullanılmış",
                "trim"        => "<b>{field}</b> alanında boşluk kullanılamaz",
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();


        if($validate){

            // Upload Süreci...
            if($_FILES["img_url"]["name"] !== "") {

                $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) ." - " . rand(1000,99999) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $image_80x80 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",80,80, $file_name);

                if($image_80x80){
                    delete_picture("user_model" , $id, "80x80", $oldUser->img_url);
                    $data = array(
                        "user_name"     => $this->input->post("user_name"),
                        "full_name"     => $this->input->post("full_name"),
                        "user_role_id"  => $this->input->post("user_role_id"),
                        "img_url"       => $file_name,
                        "profession"    => $this->input->post("profession"),
                        "topic"         => $this->input->post("topic"),
                        "topic_name"    => $this->input->post("topic_name"),
                        "description"   => $this->input->post("description"),
                        "linkedin"      => $this->input->post("linkedin"),
                        "facebook"      => $this->input->post("facebook"),
                        "instagram"     => $this->input->post("instagram"),
                        "zoom"          => $this->input->post("zoom"),
                    );

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Görsel yüklenirken bir problem oluştu",
                        "type" => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("user/update_form/$id"));

                    die();

                }

            } else {

                $data =array(
                    "user_name"     => $this->input->post("user_name"),
                    "full_name"     => $this->input->post("full_name"),
                    "user_role_id"  => $this->input->post("user_role_id"),
                    "profession"    => $this->input->post("profession"),
                    "description"   => $this->input->post("description"),
                    "topic"         => $this->input->post("topic"),
                    "topic_name"    => $this->input->post("topic_name"),
                    "linkedin"      => $this->input->post("linkedin"),
                    "facebook"      => $this->input->post("facebook"),
                    "instagram"     => $this->input->post("instagram"),
                    "zoom"          => $this->input->post("zoom"),
                );

            }

            $update = $this->user_model->update(array("id" => $id), $data);

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

//            redirect(base_url("users"));
            redirect(base_url("users/profil_form/$id"));
        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "profil";
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

}
