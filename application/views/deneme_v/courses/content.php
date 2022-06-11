<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Mentor <strong><?php echo $item->full_name; ?></strong> Ders Program listesi
            <?php if(isAdmin()) { ?>
                <a href="<?php echo base_url("mentor/list"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Mentor Listesi</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->

    <div class="col-md-12">
        <div class="p-lg">

            <?php if(empty($courses)) { ?>

                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunmamaktadır. <a href="<?php echo base_url("mentor"); ?>">tıklayınız</a></p>
                </div>

            <?php }elseif (!$item->isActive){ ?>
                <div class="alert alert-info text-center">
                    <p>Böyle bir Mentor Bulunamadı <a href="<?php echo base_url("mentor"); ?>">tıklayınız</a></p>
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
                                                <?php foreach ($courses as $cours): ?>
                                                <?php $calendar = get_watch_list($cours->start_event,$cours->end_event); ?>


                                                    <!-- a single mail -->
                                                    <div class="mail-item">
                                                        <table class="mail-container">
                                                            <tr>
                                                                <td class="mail-left">
                                                                    <div class="avatar avatar-lg avatar-circle ">
                                                                        <a href="<?= base_url("mentor/lesson/{$item->id}/{$cours->id}") ?>">
                                                                            <img src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>"  alt="sender photo">
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td class="mail-center">
                                                                    <div class="mail-item-header">

                                                                        <a href="#"><span style="padding: 5px; font-size: 14px" class="label label-default"><?=  $calendar['tarih']; ?></span></a>
                                                                        <a href="#"><span style="padding: 5px; font-size: 14px" class="label label-success"><?=  $calendar['baslangic'];  ?></span></a>
                                                                        <a href="#"><span style="padding: 5px; font-size: 14px;" class="label label-primary"><?= $calendar['bitis']; ?></span></a>
                                                                        <br>
                                                                        <h4 style="margin-top: 10px" class="mail-item-title"><a href="mail-view.html" class="title-color"><?= $cours->title; ?></a></h4>
                                                                    </div>
                                                                    <p class="mail-item-excerpt">
                                                                        <?= $cours->description; ?>
                                                                    </p>
                                                                </td>
                                                                <td class="mail-right">
                                                                    <p class="mail-item-date">2 hours ago</p>
                                                                    <p class="mail-item-star starred">
                                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div><!-- END mail-item -->

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