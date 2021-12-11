<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Program Bilgileri
            <?php if (isAllowedWriteModule()): ?>
                <a href="<?php echo base_url("program_info/update_form/19"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Düzenle</a>
            <?php endif; ?>
        </h4>
    </div><!-- END column -->


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

    </div>
</div>