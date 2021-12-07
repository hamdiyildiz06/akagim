<div class="row">
    <div class="col-md-8">
        <div id="profile-tabs" class="nav-tabs-horizontal white m-b-lg">
            <!-- tabs list -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#profile-about" aria-controls="about" role="tab" data-toggle="tab">Hakkımda</a></li>
                <li role="presentation"><a href="#profile-my_available_meetings" aria-controls="my_available_meetings" role="tab" data-toggle="tab">Müsait Toplantılarım</a></li>
                <li role="presentation"><a href="#profile-my_meetings" aria-controls="my_meetings" role="tab" data-toggle="tab">Toplantılarım</a></li>
                <li role="presentation"><a href="#profile-my_past_meetings" aria-controls="my_past_meetings" role="tab" data-toggle="tab">Geçmiş Toplantılar</a></li>
                <li role="presentation"><a href="#profile-cancelled" aria-controls="cancelled" role="tab" data-toggle="tab">İptal Edilenler</a></li>
            </ul><!-- .nav-tabs -->

            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" id="profile-about" class="tab-pane in active fade" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(empty($item->description)) { ?>

                                    <div class="alert alert-info text-center col-md-7"  style="margin-top: 30px">
                                        <p> Burada herhangi bir Bilgilendirme bulunmamaktadır. </p>
                                    </div>

                                <?php }else{ ?>

                                    <div>
                                        <?=  $item->description; ?>
                                    </div>

                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" id="profile-my_available_meetings" class="tab-pane fade p-md">
                    <div class="row">


                        <?php
                        foreach ($available_meetings as $available):
                        $calendar = get_watch_list($available->start_event,$available->end_event);
                        ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="user-card p-0">
                                <div class="media white">
                                    <div class="media-left">
                                        <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                            <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>" alt=""></a>
                                            <i class="status status-online"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= $item->full_name; ?> </a></h5>
                                        <small class="media-meta"> <?= $item->profession ?> </small>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left text-center" style="float: left; padding: 0 0 20px 20px">
                                        <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"><?=  $calendar['tarih']; ?></a></h5>
                                        <p> <?=  $calendar['baslangi'];  ?> - <?=  $calendar['bitis'];  ?> </p>
                                        <small class="media-meta"> <?= $available->toplantiTuru; ?> </small>
                                    </div>

                                    <div class="media-right text-center" style="float: right; padding: 20px 20px 20px 0">
                                         <a  href="javascript:void(0);" type="button" class="btn rounded mw-md btn-warning">RANDEVU AL</a>
                                    </div>
                                </div>
                            </div><!-- search-result -->
                        </div><!-- END column -->
                        <?php  endforeach; ?>
                    </div><!-- .row -->
                </div><!-- .tab-pane -->

                <div role="tabpanel" id="profile-my_meetings" class="tab-pane fade p-md">
                    <div class="row">

                        <?php

                        foreach ($my_meetings as $available):
                        $calendar = get_watch_list($available->start_event,$available->end_event);
                        ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="user-card p-0">
                                <div class="media white">

                                    <div class="media-left">
                                        <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                            <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", get_user_info($available->student_id)->img_url, '80x80'); ?>" alt=""></a>
                                            <i class="status status-online"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= get_user_info($available->student_id)->full_name; ?> </a></h5>
                                        <small class="media-meta"> <?= get_user_info($available->student_id, true); ?> </small>
                                    </div>
                                    <?php if ($available->isActive == '1'): ?>
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
                                                <?php if ($available->isActive == '1'): ?>
                                                <a href="javascript:void(0);" type="button" class="btn rounded btn-success"> REZERV EDİLDİ</a>
                                                <?php else: ?>
                                                <a href="javascript:void(0);" type="button" class="btn rounded btn-warning"> TOPLANTI SAYFASI</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="col-md-12">
                                           <div class="media-left">
                                               <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                   <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>" alt=""></a>
                                                   <i class="status status-online"></i>
                                               </div>
                                           </div>
                                           <div class="media-body">
                                               <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= $item->full_name; ?> </a></h5>
                                               <small class="media-meta"> <?= $item->profession ?> </small>
                                           </div>
                                       </div>
                                        <div class="col-md-12">
                                            <div class="media-left">
                                                <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                    <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", get_user_info($available->student_id)->img_url, '80x80'); ?>" alt=""></a>
                                                    <i class="status status-online"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= get_user_info($available->student_id)->full_name; ?> </a></h5>
                                                <small class="media-meta"> <?= get_user_info($available->student_id, true); ?> </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- search-result -->
                        </div><!-- END column -->
                        <?php endforeach; ?>
                    </div><!-- .row -->
                </div><!-- .tab-pane -->

                <div role="tabpanel" id="profile-my_past_meetings" class="tab-pane fade p-md" >
                    <div class="row">

                        <?php
                        foreach ($past_meetings as $available):
                        $calendar = get_watch_list($available->start_event,$available->end_event);
                        ?>
                            <div class="col-md-12 col-sm-12">
                                <div class="user-card p-0">
                                    <div class="media white">

                                        <div class="media-left">
                                            <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", get_user_info($available->student_id)->img_url, '80x80'); ?>" alt=""></a>
                                                <i class="status status-online"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= get_user_info($available->student_id)->full_name; ?> </a></h5>
                                            <small class="media-meta"> <?= get_user_info($available->student_id, true); ?> </small>
                                        </div>

                                    </div>
                                    <div class="media">
                                        <div class="media-left text-center col-md-6" style="float: left; padding: 0 0 20px 20px">
                                            <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"><?=  $calendar['tarih']; ?></a></h5>
                                            <p> <?=  $calendar['baslangi']; ?> - <?=  $calendar['bitis']; ?> </p>
                                            <small class="media-meta"> <?=  $available->toplantiTuru; ?> </small>
                                            <div class="media-body text-center" style="padding-top: 10px">
                                                <div class="text-center">
                                                    <a href="javascript:void(0);" type="button" class="btn rounded btn-warning"> TOPLANTI SAYFASI</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="media-left">
                                                    <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                        <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>" alt=""></a>
                                                        <i class="status status-online"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= $item->full_name; ?> </a></h5>
                                                    <small class="media-meta"> <?= $item->profession ?> </small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="media-left">
                                                    <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                        <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", get_user_info($available->student_id)->img_url, '80x80'); ?>" alt=""></a>
                                                        <i class="status status-online"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= get_user_info($available->student_id)->full_name; ?> </a></h5>
                                                    <small class="media-meta"> <?= get_user_info($available->student_id, true); ?> </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- search-result -->
                            </div><!-- END column -->
                        <?php endforeach; ?>
                    </div><!-- .row -->
                </div><!-- .tab-pane -->

                <div role="tabpanel" id="profile-cancelled" class="tab-pane fade p-md" >
                    <div class="row">

                        <?php
                        foreach ($cancelled as $available):
                            $calendar = get_watch_list($available->start_event,$available->end_event);
                        if ($available->student_id == 0):
                            ?>
                            <div class="col-md-12 col-sm-12">
                                <div class="user-card p-0">
                                    <div class="media white">
                                        <div class="media-left">
                                            <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>" alt=""></a>
                                                <i class="status status-online"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= $item->full_name; ?> </a></h5>
                                            <small class="media-meta"> <?= $item->profession ?> </small>
                                        </div>
                                        <?php if ($available->status == 4): ?>
                                            <div class="media-right text-center" style="padding: 20px 20px 20px 0">
                                                <a href="javascript:void(0);" type="button" class="btn rounded mw-md btn-danger">İPTAL EDİLDİ</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="media">
                                        <div class="media-left text-center" style="float: left; padding: 0 0 20px 20px">
                                            <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"><?=  $calendar['tarih']; ?></a></h5>
                                            <p> <?=  $calendar['baslangi'];  ?> - <?=  $calendar['bitis'];  ?> </p>
                                            <small class="media-meta"> <?= $available->toplantiTuru; ?> </small>
                                        </div>

                                        <div class="media-right text-center" style="float: right; padding: 20px 20px 20px 0">
                                            <a  href="javascript:void(0);" type="button" class="btn rounded mw-md btn-warning">TOPLANTI SAYFASI</a>
                                        </div>
                                    </div>
                                </div><!-- search-result -->
                            </div><!-- END column -->
                            <?php else: ?>
                            <div class="col-md-12 col-sm-12">
                                <div class="user-card p-0">
                                    <div class="media white">

                                        <div class="media-left">
                                            <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", get_user_info($available->student_id)->img_url, '80x80'); ?>" alt=""></a>
                                                <i class="status status-online"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= get_user_info($available->student_id)->full_name; ?> </a></h5>
                                            <small class="media-meta"> <?= get_user_info($available->student_id, true); ?> </small>
                                        </div>

                                        <div class="media-right text-center" style="padding: 20px 20px 20px 0">
                                            <a href="javascript:void(0);" type="button" class="btn rounded mw-md btn-danger">İPTAL EDİLDİ</a>
                                        </div>

                                    </div>
                                    <div class="media">
                                        <div class="media-left text-center col-md-6" style="float: left; padding: 0 0 20px 20px">
                                            <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"><?=  $calendar['tarih']; ?></a></h5>
                                            <p> <?=  $calendar['baslangi']; ?> - <?=  $calendar['bitis']; ?> </p>
                                            <small class="media-meta"> <?=  $available->toplantiTuru; ?> </small>
                                            <div class="media-body text-center" style="padding-top: 10px">
                                                <div class="text-center">
                                                    <a href="javascript:void(0);" type="button" class="btn rounded btn-warning"> TOPLANTI SAYFASI</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="media-left">
                                                    <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                        <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>" alt=""></a>
                                                        <i class="status status-online"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= $item->full_name; ?> </a></h5>
                                                    <small class="media-meta"> <?= $item->profession ?> </small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="media-left">
                                                    <div class="avatar avatar-lg avatar-circle" style="padding: 5px;">
                                                        <a href="javascript:void(0)"><img src="<?= get_picture( "users_v", get_user_info($available->student_id)->img_url, '80x80'); ?>" alt=""></a>
                                                        <i class="status status-online"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading"><a href="javascript:void(0)" class="title-color"> <?= get_user_info($available->student_id)->full_name; ?> </a></h5>
                                                    <small class="media-meta"> <?= get_user_info($available->student_id, true); ?> </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- search-result -->
                            </div><!-- END column -->
                            <?php endif; ?>
                        <?php  endforeach; ?>
                    </div><!-- .row -->
                </div><!-- .tab-pane -->
            </div><!-- .tab-content -->
        </div><!-- #profile-components -->
    </div><!-- END column -->

    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="widget who-to-follow-widget">
                    <div class="widget-header p-h-lg p-v-md">
                        <h4 class="widget-title">son 5 Toplantım</h4>
                    </div>
                    <hr class="widget-separator m-0">
                    <div class="media-group">
                        <div class="media-group-item b-0 p-h-sm">
                            <div class="media">
                                <div class="media-left">
                                    <div class="avatar avatar-md avatar-circle">
                                        <img src="../assets/images/221.jpg" alt="">
                                        <i class="status status-online"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="javascript:void(0)">John Doe</a></h5>
                                    <small class="media-meta">Software Engineer</small>
                                </div>
                            </div>
                        </div><!-- .media-group-item -->

                        <div class="media-group-item b-0 p-h-sm">
                            <div class="media">
                                <div class="media-left">
                                    <div class="avatar avatar-md avatar-circle">
                                        <img src="../assets/images/101.jpg" alt="">
                                        <i class="status status-offline"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="javascript:void(0)">Adam Khaury</a></h5>
                                    <small class="media-meta">Web Designer</small>
                                </div>
                            </div>
                        </div><!-- .media-group-item -->

                        <div class="media-group-item b-0 p-h-sm">
                            <div class="media">
                                <div class="media-left">
                                    <div class="avatar avatar-md avatar-circle">
                                        <img src="../assets/images/209.jpg" alt="">
                                        <i class="status status-offline"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="javascript:void(0)">John Doe</a></h5>
                                    <small class="media-meta">Web Developer</small>
                                </div>
                            </div>
                        </div><!-- .media-group-item -->

                        <div class="media-group-item b-0 p-h-sm">
                            <div class="media">
                                <div class="media-left">
                                    <div class="avatar avatar-md avatar-circle">
                                        <img src="../assets/images/203.jpg" alt="">
                                        <i class="status status-away"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="javascript:void(0)">Sara Smith</a></h5>
                                    <small class="media-meta">UI/UX Designer</small>
                                </div>
                            </div>
                        </div><!-- .media-group-item -->

                        <div class="media-group-item b-0 p-h-sm">
                            <div class="media">
                                <div class="media-left">
                                    <div class="avatar avatar-md avatar-circle">
                                        <img src="../assets/images/204.jpg" alt="">
                                        <i class="status status-away"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="javascript:void(0)">Dani Smith</a></h5>
                                    <small class="media-meta">Teacher Assistant</small>
                                </div>
                            </div>
                        </div><!-- .media-group-item -->

                        <div class="media-group-item b-0 p-h-sm">
                            <div class="media">
                                <div class="media-left">
                                    <div class="avatar avatar-md avatar-circle">
                                        <img src="../assets/images/202.jpg" alt="">
                                        <i class="status status-away"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="javascript:void(0)">Sally Sally</a></h5>
                                    <small class="media-meta">Teacher Assistant</small>
                                </div>
                            </div>
                        </div><!-- .media-group-item -->
                    </div>
                </div><!-- .widget -->
            </div><!-- END column -->

            <div class="col-md-12 col-sm-6">
                <div class="widget navigation-widget">
                    <div class="widget-header p-h-lg p-v-md">
                        <h4 class="widget-title">Navigation</h4>
                    </div>
                    <hr class="widget-separator m-0">
                    <div class="list-group">
                        <a href="javascript:void(0)" class="list-group-item"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>My Profile</a>
                        <a href="javascript:void(0)" class="list-group-item"><i class="zmdi m-r-md zmdi-hc-lg zmdi-balance-wallet"></i>Balance</a>
                        <a href="javascript:void(0)" class="list-group-item">
                            <i class="zmdi m-r-md zmdi-hc-lg zmdi-globe"></i>Connection
                            <span class="badge bg-primary">20</span>
                        </a>
                        <a href="javascript:void(0)" class="list-group-item"><i class="zmdi m-r-md zmdi-hc-lg zmdi-male"></i>Friends</a>
                        <hr>
                        <a href="javascript:void(0)" class="list-group-item"><i class="zmdi m-r-md zmdi-hc-lg zmdi-calendar"></i>Events</a>
                        <a href="javascript:void(0)" class="list-group-item"><i class="zmdi m-r-md zmdi-hc-lg zmdi-help"></i>Support</a>
                    </div>
                </div><!-- .widget -->
            </div><!-- END column -->
        </div><!-- .row -->

    </div><!-- END column -->
</div><!-- .row -->