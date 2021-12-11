<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->user_name</b> Profil bilgilerini düzenliyorsunuz"; ?>
        </h4>
    </div><!-- END column -->

    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("users/profil_upload/$item->id"); ?>" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-1 image_upload_container">
                            <img src="<?php echo get_picture($viewFolder, $item->img_url, "80x80"); ?>" alt="" class="img-responsive">
                        </div>

                        <div class="col-md-9 form-group image_upload_container">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input class="form-control" placeholder="Kullanıcı Adı" name="user_name" value="<?php echo isset($form_error) ? set_value("user_name") : $item->user_name ; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("user_name"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <input class="form-control" placeholder="Ad Soyad" name="full_name" value="<?php echo isset($form_error) ? set_value("full_name") : $item->full_name; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("full_name"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>E-posta Adresi</label>
                        <input class="form-control" type="email" placeholder="E-posta Adresi" name="email" value="<?php echo isset($form_error) ? set_value("email") : $item->email; ?>" disabled >
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("email"); ?></small>
                        <?php } ?>
                    </div>

                    <?php if (get_active_user()->user_role_id == 2 || get_active_user()->user_role_id == 1 ){ ?>
                        <div class="form-group">
                            <label>Uzmanlık Alanlarınız ( <small style="color: red">Uzmanlık Alanlarınızı ( , )'ile ayırarak giriniz</small> )</label>
                            <input class="form-control" type="text" placeholder="Uzmanlık Alanlarınızı ( , )'ile ayırarak giriniz" name="profession" value="<?php echo isset($form_error) ? set_value("profession") : $item->profession; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("profession"); ?></small>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (get_active_user()->user_role_id == 3 || get_active_user()->user_role_id == 1 ){ ?>
                        <div class="form-group">
                            <label>Girişimin Adı</label>
                            <input class="form-control" type="text" placeholder="Girişimin Adı" name="topic_name" value="<?php echo isset($form_error) ? set_value("topic_name") : $item->topic_name; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("topic_name"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label>Girişimin Konusu</label>
                            <input class="form-control" type="text" placeholder="Girişimin Konusu" name="topic" value="<?php echo isset($form_error) ? set_value("topic") : $item->topic; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("topic"); ?></small>
                            <?php } ?>
                        </div>

                    <?php } ?>
                    <div class="form-group">
                        <label>Hakkımda</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $item->description; ?></textarea>
                    </div>

                    <hr>
                    <div class="form-group">
                        <small class="input-form-error">Sosyal Media</small>
                    </div>

                    <div class="form-group">
                        <label>Linkedin</label>
                        <input class="form-control" type="text" placeholder="Linkedin Profili" name="linkedin" value="<?php echo isset($form_error) ? set_value("linkedin") : $item->linkedin; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("linkedin"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Facebook</label>
                        <input class="form-control" type="text" placeholder="Facebook Profili" name="facebook" value="<?php echo isset($form_error) ? set_value("facebook") : $item->facebook; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("facebook"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Instagram</label>
                        <input class="form-control" type="text" placeholder="Instagram Profili" name="instagram" value="<?php echo isset($form_error) ? set_value("instagram") : $item->instagram; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("instagram"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Zoom Link</label>
                        <input class="form-control" type="text" placeholder="Zoom Link" name="zoom" value="<?php echo isset($form_error) ? set_value("zoom") : $item->zoom; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("zoom"); ?></small>
                        <?php } ?>
                    </div>



                    <div class="form-group">
                        <label>Kullanıcı Yetkisi</label>
                        <select name="user_role_id" class="form-control">
                            <?php foreach($user_roles as $user_role) { ?>
                                <option
                                        <?= $item->user_role_id == $user_role->id ? "selected" : null; ?>
                                        value="<?php echo $user_role->id; ?>"><?php echo $user_role->title; ?></option>
                            <?php } ?>
                        </select>
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("user_role"); ?></small>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?php echo base_url("users"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>