<?php

function convertToSEO($text)
{

    $turkce = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "İ", "ş", "Ş", ".", ",", "!", "'", "\"", " ", "?", "*", "_", "|", "=", "(", ")", "[", "]", "{", "}");
    $convert = array("c", "c", "g", "g", "u", "u", "o", "o", "i", "i", "s", "s", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-");

    return strtolower(str_replace($turkce, $convert, $text));

}

function get_readable_date($date)
{
    return strftime('%e %B %Y', strtotime($date));
}

function get_active_user(){

    $t = &get_instance();

    $user = $t->session->userdata("user");

    if($user)
        return $user;
    else
        return false;
}

function isAdmin(){
    $t = &get_instance();

    $user = $t->session->userdata("user");

    if($user->user_role == "admin")
        return true;
    else
        return false;
}

function get_user_roles(){
    $t = &get_instance();
    return $t->session->userdata('user_roles');
}

function setUserRoles(){
    $t = &get_instance();
    $t->load->model("user_role_model");

    $user_roles = $t->user_role_model->get_all(
        array(
            "isActive" => '1'
        )
    );

    $roles = array();
    foreach ($user_roles as $role){
        $roles[$role->id] = $role->permissions;
    }

    //  return $roles;
    $t->session->set_userdata('user_roles', $roles);

}

function getControllerList(){

    $t = &get_instance();

    $controllers = array();
    $t->load->helper("file");

    $files = get_dir_file_info(APPPATH. "controllers", FALSE);

    foreach (array_keys($files) as $file){
        if($file !== "index.html"){
            $controllers[] = strtolower(str_replace(".php", '', $file));
        }
    }

    return $controllers;

}

function send_email($toEmail = "", $subject = "", $message = ""){

    $t = &get_instance();

    $t->load->model("emailsettings_model");

    $email_settings = $t->emailsettings_model->get(
        array(
            "isActive"  => 1
        )
    );

    $config = array(

        "protocol"   => $email_settings->protocol,
        "smtp_host"  => $email_settings->host,
        "smtp_port"  => $email_settings->port,
        "smtp_user"  => $email_settings->user,
        "smtp_pass"  => $email_settings->password,
        "starttls"   => true,
        "charset"    => "utf-8",
        "mailtype"   => "html",
        "wordwrap"   => true,
        "newline"    => "\r\n"
    );

    $t->load->library("email", $config);

    $t->email->from($email_settings->from, $email_settings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);

    return $t->email->send();

}

function get_settings(){

    $t = &get_instance();

    $t->load->model("settings_model");

    if($t->session->userdata("settings")){
        $settings = $t->session->userdata("settings");
    } else {

        $settings = $t->settings_model->get();

        if(!$settings) {

            $settings = new stdClass();
            $settings->company_name = "YildizTurk";
            $settings->logo         = "default";

        }

        $t->session->set_userdata("settings", $settings);

    }

    return $settings;

}

function get_category_title($category_id = 0){

    $t = &get_instance();

    $t->load->model("portfolio_category_model");

    $category = $t->portfolio_category_model->get(
        array(
            "id"    => $category_id
        )
    );

    if($category)
        return $category->title;
    else
        return "<b style='color:red'>Tanımlı Değil</b>";

}

function upload_picture($file, $uploadPath, $width, $height, $name){

    $t = &get_instance();
    $t->load->library("simpleimagelib");


    if(!is_dir("{$uploadPath}/{$width}x{$height}")){
        mkdir("{$uploadPath}/{$width}x{$height}");
    }

    $upload_error = false;
    try {

        $simpleImage = $t->simpleimagelib->get_simple_image_instance();

        $simpleImage
            ->fromFile($file)
            ->thumbnail($width,$height,'center')
            ->toFile("{$uploadPath}/{$width}x{$height}/$name", null, 75);

    } catch(Exception $err) {
        $error =  $err->getMessage();
        $upload_error = true;
    }

    if($upload_error){
        echo $error;
    } else {
        return true;
    }


}

function get_picture($path = "", $picture = "", $resolution = "50x50"){

    if($picture != ""){

        if(file_exists(FCPATH . "uploads/$path/$resolution/$picture")){
            $picture = base_url("uploads/$path/$resolution/$picture");
        } else {
            $picture = base_url("assets/assets/images/default_image.png");
        }

    } else {
        $picture = base_url("assets/assets/images/default_image.png");
    }

    return $picture;
}

function delete_picture($model,$id,$resolution,$img_url = ""){
    $t = get_instance();
    $fileName =  $t->$model->get(
        array(
            "id" => $id
        )
    );

    if (($img_url != "noAvatar.png") || $img_url == "")
        return unlink("uploads/{$t->viewFolder}/{$resolution}/{$fileName->img_url}");
}

function delete_picture_user($model,$id,$resolution){
    $t = get_instance();
    $fileName =  $t->$model->get(
        array(
            "id" => $id
        )
    );
//    if (($img_url != "noAvatar.png") || $img_url == null)
    return unlink("uploads/{$t->viewFolder}/{$resolution}/{$fileName->img_url}");
}

function get_page_list($page = ""){

    $page_list = array(
        "home_v"                => "Anasayfa",
        "about_v"               => "Hakkımızda Sayfası",
        "news_list_v"           => "Haberler Sayfası",
        "galleries"             => "Galeri Sayfası",
        "portfolio_list_v"      => "Portfolyo Sayfası",
        "reference_list_v"      => "Referanslar Sayfası",
        "service_list_v"        => "Hizmetler Sayfası",
        "course_list_v"         => "Eğitimler Sayfası",
        "brand_list_v"          => "Markalar Sayfası",
        "contact_v"             => "İletişim Sayfası",
    );

    return (empty($page)) ? $page_list : $page_list[$page];
}

function get_watch_list($baslangic , $bitis){

    $baslangic = explode(' ', $baslangic);
    $bitis = explode(' ', $bitis);

    // Tarih yazım karakteri dünelemeiri = 17-10-2021
    $baslangict = explode('-',$baslangic[0]);

    // Başlangıç Saat yazım karakteri dünelemeiri = 11:00
    $baslangics = explode(':',$baslangic[1]);

    // Bitiş Saat yazım karakteri dünelemeiri = 11:00
    $bitiss = explode(':',$bitis[1]);

    $calendar = [
        "tarih" => $baslangict[2] .'-'. $baslangict[1] .'-'. $baslangict[0],
        "baslangic" => $baslangics[0] .':'.$baslangics[1],
        "bitis" => $bitiss[0] .':'.$bitiss[1]
    ];

    return $calendar;
}

function get_profession($profession){

    $uzmanlik = explode(',', $profession);

    return $uzmanlik;
}

function get_user_info($id, $topic = false){
    $t = &get_instance();

    $t->load->model("user_model");

    $user = $t->user_model->get(
        array(
            "id"    => $id
        )
    );

    if ($topic){
        if ($user->topic_name != "")
            return  $user->topic_name;
        else
            return $user->topic;
    }

    if($user)
        return $user ;
    else
        return false;
}

function get_notification($calendar_id,$student_id,$teacher_id,$status,$isActive){
    $t = get_instance();
    $insert =  $t->notification_model->add(
        array(
            "calendar_id"  =>$calendar_id,
            "student_id"   =>$student_id,
            "teacher_id"   =>$teacher_id,
            "status"       =>$status,
            "isActive"     =>$isActive,
        )
    );
}

function get_user_roles_title($id){
    $t = get_instance();
    $t->load->model("user_role_model");

    $user_roles = $t->user_role_model->get(
        [
            "isActive" => 1,
            "id" => $id
        ]
    );

    return $user_roles->title;
}

function get_meeting_status($status, $isActive){

    if ($status ==  "1" && $isActive == "0"){
        $value = "Müsait";
    } elseif ($status ==  "2" && $isActive == "1"){
        $value = "Rezerv";
    } elseif ($status ==  "2" && $isActive == "2"){
        $value = "Onaylandı";
    } elseif ($status ==  "3" && $isActive == "3"){
        $value = "Bitti";
    } elseif ($status ==  "4" && $isActive == "4"){
        $value = "İptal";
    } else{
        $value = "bilinmiyor";
    }

    /*
        şuanda bu şekilde

             müsait                   = status "1" , isActive 0
             toplantılarım->rezerv    = status "2" , isActive 1
             Toplantılarım            = status "2" , isActive 2
             Bitti                    = status "3" , isActive 3
             iptal                    = status "4" , isActive 4
    */
    /*
        Dünzenlemeden sonra bu şekilde olacak

             müsait                   = status "1",
             toplantılarım->rezerv    = status "2",
             Toplantılarım            = status "3",
             Bitti                    = status "4",
             iptal                    = status "5",
    */

    return $value;

}


