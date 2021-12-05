<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view("includes/head"); ?>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

    <!-- APP NAVBAR ==========-->
    <?php $this->load->view("includes/navbar"); ?>
    <!--========== END app navbar -->

    <!-- APP ASIDE ==========-->
    <?php $this->load->view("includes/aside"); ?>
    <!--========== END app aside -->

    <!-- navbar search -->
    <?php $this->load->view("includes/navbar-search"); ?>
    <!-- .navbar-search -->



    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">

        <div class="profile-header">
            <div class="profile-cover">
                <div class="cover-user m-b-lg">
                    <div style="visibility: hidden">
                        <span class="cover-icon"><i class="fa fa-heart-o"></i></span>
                    </div>
                    <div>
                        <div class="avatar avatar-xl avatar-circle">
                            <a href="javascript:void(0)">
                                <img class="img-responsive" src="<?= get_picture( "users_v", $item->img_url, '80x80'); ?>" alt="avatar"/>
                            </a>
                        </div><!-- .avatar -->
                    </div>
                    <div style="visibility: hidden">
                        <span class="cover-icon"><i class="fa fa-envelope-o"></i></span>
                    </div>
                </div>
                <div class="text-center">
                    <h4 class="profile-info-name m-b-lg"><a href="javascript:void(0)" class="title-color"><?= $item->full_name; ?></a></h4>
                    <p><?= $item->unvan; ?></p>
                    <div>
                        <?php foreach (get_profession($item->profession) as $profession): ?>
                            <a href="javascript:void(0)" class="m-r-xl theme-color"><i class="fa fa-bolt m-r-xs"></i> <strong><?= $profession ?></strong> </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="media-body text-center p-t-lg">
                    <small class="media-meta">Sosyal İconlar</small>
                    <div class="contact-links m-t-sm">
                        <a href="javascript:void(0)" class="icon icon-circle icon-sm m-b-0" data-toggle="tooltip" title="Phone" data-placement="top"><i class="fa fa-phone"></i></a>
                        <a href="javascript:void(0)" class="icon icon-circle icon-sm m-b-0" data-toggle="tooltip" title="Mobile" data-placement="top"><i class="fa fa-mobile"></i></a>
                        <a href="mailto:example@rathemes.com" class="icon icon-circle icon-sm m-b-0" data-toggle="tooltip" title="example@rathemes.com" data-placement="top"><i class="fa fa-envelope-o"></i></a>
                        <a href="javascript:void(0)" class="icon icon-circle icon-sm m-b-0" data-toggle="tooltip" title="rathemes" data-placement="top"><i class="fa fa-skype"></i></a>
                        <a href="https://facebook.com/rathemes" class="icon icon-circle icon-sm m-b-0" data-toggle="tooltip" title="Facebook" data-placement="top"><i class="fa fa-facebook"></i></a>
                        <a href="https://twitter.com/rathemes" class="icon icon-circle icon-sm m-b-0" data-toggle="tooltip" title="Twitter" data-placement="top"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div><!-- .profile-cover -->

            <div class="promo-footer">
                <div class="row no-gutter">
                    <div class="col-sm-2  col-sm-offset-2 col-xs-6 promo-tab">
                        <div class="text-center">
                            <small>Total Toplantılarım</small>
                            <h4 class="m-0 m-t-xs">150 Toplantı</h4>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6 promo-tab">
                        <div class="text-center">
                            <small>Toplantılarım</small>
                            <h4 class="m-0 m-t-xs">15 Toplantı</h4>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6 promo-tab">
                        <div class="text-center">
                            <small>Geçmiş toplantılarım</small>
                            <h4 class="m-0 m-t-xs">135 Toplantı</h4>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6 promo-tab">
                        <div class="text-center">
                            <small>İptal Edilen toplantılarım</small>
                            <h4 class="m-0 m-t-xs">135 Toplantı</h4>
                        </div>
                    </div>
                </div>
            </div><!-- .promo-footer -->
        </div><!-- .profile-header -->

        <div class="wrap">
            <section class="app-content">
                <?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>
            </section><!-- #dash-content -->
        </div><!-- .wrap -->

        <!-- APP FOOTER -->
        <?php $this->load->view("includes/footer"); ?>
        <!-- /#app-footer -->
    </main>
    <!--========== END app main -->

    <?php $this->load->view("includes/include_script"); ?>
    <?php $this->load->view("{$viewFolder}/{$subViewFolder}/page_script"); ?>

</body>
</html>