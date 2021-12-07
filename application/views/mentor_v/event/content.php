<div class="row">

<!--<pre>-->
<?php
//print_r(get_active_user());
    $calendar = get_watch_list($event->start_event,$event->end_event); ?>
<!--</pre>-->
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="widget who-to-follow-widget">
                    <div class="widget-header p-h-lg p-v-md">
                        <h4 class="widget-title">Toplantı Deyatı</h4>
                    </div>
                    <hr class="widget-separator m-0">

                    <div class="media">
                        <div class="media-body text-center" style=" padding: 0 0 20px 20px">
                            <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"><?=  $calendar['tarih']; ?></a></h5>
                            <p> <?=  $calendar['baslangi'];  ?> - <?=  $calendar['bitis'];  ?> </p>
                            <p class="media-meta"> <?= $event->toplantiTuru; ?> </p>
                            <?php if ($event->toplantiTuru == "ozel"):  ?>
                            <p class="media-meta"> <?= $event->toplantiYeri; ?> </p>
                            <?php endif;  ?>
                        </div>

<!--                        <div class="media-right text-center" style="float: right; padding: 20px 20px 20px 0">-->
<!--                            <a  href="javascript:void(0);" type="button" class="btn rounded mw-md btn-warning">Rezerv Et</a>-->
<!--                        </div>-->
                    </div>
<!--                    <hr class="widget-separator m-0">-->
<!--                    <div class="text-center" style="padding: 20px 20px 20px 0">-->
<!--                        <p> BİGG İTÜ ÇEKİRDEK tarafından oluşturuldu </p>-->
<!--                    </div>-->

                    <hr class="widget-separator m-0">

                    <div class="media-group">
                        <div class="media-group-item b-0 p-h-sm">
                            <div class="media white">
                                <div class="media-left">
                                    <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                        <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", $mentor->img_url, '80x80'); ?>" alt=""></a>
                                        <i class="status status-online"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= $mentor->full_name; ?> </a></h5>
                                    <small class="media-meta"> <?= $mentor->profession ?> </small>
                                </div>
                            </div>
                        </div><!-- .media-group-item -->

                        <?php if ($mentor->id != $menti->id): ?>
                        <div class="media-group-item b-0 p-h-sm">
                            <div class="media white">
                                <div class="media-left">
                                    <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                        <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", $menti->img_url, '80x80'); ?>" alt=""></a>
                                        <i class="status status-online"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= $menti->full_name; ?> </a></h5>
                                    <small class="media-meta"> <?= $menti->profession ?> </small>
                                </div>
                            </div>
                        </div><!-- .media-group-item -->
                        <?php endif; ?>

                    </div>
                </div><!-- .widget -->
            </div><!-- END column -->
        </div><!-- .row -->

    </div><!-- END column -->


    <div class="col-md-8">
        <div id="profile-tabs" class="nav-tabs-horizontal white m-b-lg">
            <!-- tabs list -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#profile-about" aria-controls="about" role="tab" data-toggle="tab">Hakkımda</a></li>
            </ul><!-- .nav-tabs -->

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" id="profile-about" class="tab-pane in active fade" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(empty($event->id)) { ?>

                                    <div class="alert alert-info text-center col-md-7"  style="margin-top: 30px">
                                        <p> Burada herhangi bir Bilgilendirme bulunmamaktadır. </p>
                                    </div>

                                <?php }else{ ?>







                                    <div class="col-md-12 col-sm-12" style="padding: 20px">
                                        <div class="user-card p-0 col-md-11">
                                            <div class="media white ">

                                                <div class="media-left">
                                                    <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                        <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", get_user_info($menti->id)->img_url, '80x80'); ?>" alt=""></a>
                                                        <i class="status status-online"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= get_user_info($menti->id)->full_name; ?> </a></h5>
                                                    <small class="media-meta"> <?= get_user_info($menti->id, true); ?> </small>
                                                </div>
                                                <?php if ($event->isActive === '1'): ?>
                                                    <div class="media-right text-center" style="padding: 20px 20px 20px 0">
                                                        <a href="javascript:void(0);" type="button" class="btn rounded mw-md btn-danger">rezerv</a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="media">
                                                <div class="media-left text-center col-md-6" style="float: left; padding: 0 0 20px 20px">
                                                    <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"><?=  $calendar['tarih']; ?></a></h5>
                                                    <p> <?=  $calendar['baslangi']; ?> - <?=  $calendar['bitis']; ?> </p>
                                                    <small class="media-meta"> <?=  $available->toplantiTuru; ?> </small>
                                                    <div class="media-body text-center" style="padding-top: 10px">
                                                        <div class="text-center">
                                                            <form action="<?= base_url("mentor/rezerv/{$event->id}") ?>" method="post">
                                                                <?php if ($event->isActive == '0'): ?>

                                                                    <a href="<?= base_url("mentor/rezerv/{$event->id}") ?>" type="submit" class="btn rounded btn-success"> REZERV ET</a>
                                                                <?php elseif($event->isActive == '1'): ?>

                                                                    <a href="javascript:void(0);" type="button" class="btn rounded mw-md btn-info">BEKLEMEDE</a>

                                                                    <?php if ((($event->isActive == '1') && ($event->teacher_id == get_active_user()->id)) || ( get_active_user()->user_role_id == 1) && ($event->isActive == '1') ): ?>
                                                                        <a href="<?= base_url("mentor/rezerv/{$event->id}/2") ?>" type="submit" class="btn rounded btn-success"> ONAYLA </a>
                                                                        <a href="<?= base_url("mentor/rezerv/{$event->id}/4") ?>" type="submit" class="btn rounded btn-danger"> İPTAL </a>
                                                                    <?php endif; ?>

                                                                <?php elseif($event->isActive == '3'): ?>

                                                                    <a href="javascript:void(0);" type="button" class="btn rounded mw-md btn-default">GEÇMİŞ TOPLANTILAR</a>
                                                                <?php elseif($event->isActive == '4'): ?>

                                                                    <a href="javascript:void(0);" type="button" class="btn rounded mw-md btn-default">İPTAL EDİLEN TOPLANTI</a>
                                                                <?php else: ?>

                                                                    <a href="javascript:void(0);" type="button" class="btn rounded mw-md btn-info">ONAYLANDI</a>
                                                                    <?php if ((($event->isActive == '2') && ($event->teacher_id == get_active_user()->id)) || ( get_active_user()->user_role_id == 1) && ($event->isActive == '2') ): ?>
                                                                        <a href="<?= base_url("mentor/rezerv/{$event->id}/3") ?>" type="submit" class="btn rounded btn-dark"> BİTTİ </a>
                                                                        <a href="<?= base_url("mentor/rezerv/{$event->id}/4") ?>" type="submit" class="btn rounded btn-danger"> İPTAL </a>
                                                                    <?php endif; ?>

                                                                <?php endif; ?>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <div class="media-left">
                                                            <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                                <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", $mentor->img_url, '80x80'); ?>" alt=""></a>
                                                                <i class="status status-online"></i>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= $mentor->full_name; ?> </a></h5>
                                                            <small class="media-meta"> <?= $mentor->profession ?> </small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="media-left">
                                                            <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                                <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", get_user_info($menti->id)->img_url, '80x80'); ?>" alt=""></a>
                                                                <i class="status status-online"></i>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= get_user_info($menti->id)->full_name; ?> </a></h5>
                                                            <small class="media-meta"> <?= get_user_info($menti->id, true); ?> </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- search-result -->
                                    </div><!-- END column -->





                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div> <!-- hakkımda -->
            </div><!-- .tab-content -->
        </div><!-- #profile-components -->
    </div><!-- END column -->


</div><!-- .row -->