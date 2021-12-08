<div class="row">
    <div class="col-md-2">
        <div class="widget">
            <div class="media-group">

                <div class="media-group-item b-0 p-h-sm">
                    <div class="media">
                        <div class="media-left">
                            <div class="avatar avatar-md avatar-circle">
                                <img src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>" alt="">
                            </div>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="javascript:void(0)"><?= $item->full_name ?></a></h5>
                            <small class="media-meta">Software Engineer</small>
                        </div>
                    </div>
                </div><!-- .media-group-item -->

                <div class="media-group-item b-0 p-h-sm">
                    <div class="media">
                        <div class="media-left">
                            <div class="avatar avatar-md avatar-circle">
                                <img src="../assets/images/101.jpg" alt="">
                            </div>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="javascript:void(0)">Adam Khaury</a></h5>
                            <small class="media-meta">Web Designer</small>
                        </div>
                    </div>
                </div><!-- .media-group-item -->

            </div>
        </div>
    </div><!-- END column -->

    <div class="col-md-10">


        <?php $calendar = get_watch_list($cours->start_event,$cours->end_event); ?>

        <div class="table-responsive">
            <table class="table mail-list">
                <tr>
                    <td>

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
                                            <a href="#"><span style="padding: 5px; font-size: 14px" class="label label-success"><?=  $calendar['baslangi'];  ?></span></a>
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

                    </td>
                </tr>
            </table>
        </div>
    </div><!-- END column -->
</div>