<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->user_name</b> kaydını düzenliyorsunuz"; ?>
        </h4>
    </div><!-- END column -->

    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("girisim/update/$item->id"); ?>" method="post" enctype="multipart/form-data">

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
                        <input class="form-control" type="email" placeholder="E-posta Adresi" name="email" value="<?php echo isset($form_error) ? set_value("email") : $item->email; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("email"); ?></small>
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
                    <a href="<?php echo base_url("girisim"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>