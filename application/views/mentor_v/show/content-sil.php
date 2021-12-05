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
                                                    <!-- a single mail -->
                                                    <div class="mail-item">
                                                        <table class="mail-container">
                                                            <tr>
                                                                <td class="mail-left">
                                                                    <div class="avatar avatar-lg avatar-circle ">
                                                                        <a href="<?php echo base_url("mentor/courses/{$item->id}"); ?>">
                                                                            <img src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>"  alt="sender photo">
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td class="mail-center">
                                                                    <div class="mail-item-header">
                                                                        <h4 class="mail-item-title"><a href="<?php echo base_url("mentor/courses/{$item->id}"); ?>" class="title-color"><?= $item->full_name; ?></a></h4>
                                                                        <a href="#"><span class="label label-success">client</span></a>
                                                                        <a href="#"><span class="label label-primary">work</span></a>
                                                                    </div>
                                                                    <p class="mail-item-excerpt">Welcome To your dashboard. here you can manage and coordinate any activities</p>
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