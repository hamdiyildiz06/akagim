<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Mentor Listesi
            <?php if(isAdmin()) { ?>
                <a href="<?php echo base_url("mentor/list"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Mentor Listesi</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url("users/new_form"); ?>">tıklayınız</a></p>
                </div>

            <?php } else { ?>

                <div class="wrap">
                    <section class="app-content">
                        <div class="row">
                            <div class="col-md-10">

                                <div class="table-responsive">
                                    <table class="table mail-list">
                                        <tr>
                                            <td>
                                                <?php foreach ($items as $item): ?>
                                                    <div class="col-md-4 col-sm-6">
                                                        <div class="thumbnail white">
                                                            <img style="width: 50%" src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>"  alt="sender photo">
                                                            <div class="caption text-center">
                                                                <h4><strong><?= $item->full_name; ?></strong></h4>
                                                                <p><?= $item->unvan; ?></p>
                                                                <p>
                                                                    <a href="<?php echo base_url("mentor/courses/{$item->id}"); ?>" class="btn btn-primary" role="button">Toplantılar</a>
                                                                    <a href="<?php echo base_url("mentor/about/{$item->id}"); ?>" class="btn btn-default" role="button">Profil</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div><!-- END column -->
                                                <?php endforeach;?>
                                            </td>

                                        </tr>
                                    </table>
                                </div>

                            </div><!-- END column -->

                        </div><!-- .row -->
                    </section><!-- .app-content -->
                </div><!-- .wrap -->

            <?php } ?>

        </div><!-- .widget -->
    </div><!-- END column -->
</div>