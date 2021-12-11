<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Mentor Listesi
            <?php if(get_active_user()->user_role_id == 1) { ?>
                <a href="<?php echo base_url("girisim_categories/list"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Girişim Listesi</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url("girisim_categories/new_form"); ?>">tıklayınız</a></p>
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
                                                            <img style="width: 80%; padding: 5px; border-radius: 20px" src="<?= get_picture( $viewFolder, $item->img_url, '200x200'); ?>"  alt="sender photo">
                                                            <div class="caption text-center">
                                                                <h4><strong><?= $item->title; ?></strong></h4>
                                                                <p><?= $item->title; ?></p>
                                                                <p>
                                                                    <a href="<?php echo base_url("girisim_categories/about/{$item->id}"); ?>" class="btn btn-primary" role="button">Detaylar</a>
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