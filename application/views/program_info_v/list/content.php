<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Program Bilgileri
            <?php if (isAllowedWriteModule()): ?>
                <a href="<?php echo base_url("program_info/update_form/19"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Düzenle</a>
            <?php endif; ?>
        </h4>
    </div><!-- END column -->






   <?php if ((strlen(get_active_user()->description) > 20 && get_active_user()->user_role_id == 3) || get_active_user()->user_role_id != 3) { ?>
       <?php foreach ($items as $item): ?>
           <div class="container-fluid widget p-lg">

               <img style="width: 140%;
                                             background-size: cover;
                                             background-repeat: no-repeat;"
                    src="<?php echo get_picture($viewFolder,$item->img_url, "940x313"); ?>"
                    alt="" class="img-rounded">

           </div>
           <div class="col-md-12">
               <?= $item->description; ?>
           </div>

       <?php endforeach; ?>
    <?php }else{ ?>

       <div class="container-fluid widget p-lg">

           <div class="alert alert-info fade in alert-dismissible" style="margin-top:18px;">
               <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
               <strong> Dikkat! </strong> Paneli Kullanabilmeniz için Bilgilerim linkinde Hakkımda kısmını Doldurmanız Zorunludur...
           </div>

       </div>



    <?php } ?>
    </div>
</div>