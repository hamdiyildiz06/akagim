<?php $user = get_active_user(); ?>

<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)">
                        <img class="img-responsive"
                             src="<?= get_picture( "users_v", $user->img_url, '80x80'); ?>"
                             alt="<?php echo convertToSEO($user->full_name); ?>"/>
                    </a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username"><?php echo $user->full_name; ?></a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>İşlemler</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="<?php echo base_url(); ?>">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Anasayfa</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("users/profil_form/$user->id"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>Profilim</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("logout"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Çıkış</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">


                <?php if (isAllowedViewModule("dashboard")){ ?>
                    <li>
                        <a href="<?php echo base_url("dashboard"); ?>">
                            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                            <span class="menu-text">Toplantı Takvimi</span>
                        </a>
                    </li>
                <?php } ?>

                <?php  if ((strlen(get_active_user()->description) > 20 && get_active_user()->user_role_id == 3) || get_active_user()->user_role_id != 3 ){?>
                <li>
                    <a href="<?php echo base_url("program_info"); ?>">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">Program Bilgileri</span>
                    </a>
                </li>
                <?php } ?>
                <?php
                    if (get_active_user()->user_role_id == 2){
                        $actifUrl = "mentor/about/".get_active_user()->id;
                        $titleName = "Toplantılarım";
                    }else{
                        $actifUrl = "mentor";
                        $titleName = "Mentorler";
                    }
                ?>
                <?php  if ((strlen(get_active_user()->description) > 20 && get_active_user()->user_role_id == 3) || get_active_user()->user_role_id != 3 ){?>
                <li>
                    <a href="<?php echo base_url($actifUrl); ?>">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text"><?= $titleName ?></span>
                    </a>
                </li>
                <?php } ?>

                <?php
                    if (get_active_user()->user_role_id == 3){
                        $actifUrl = "menti/about/".get_active_user()->id;
                        $titleName = "Toplantılarım";
                    }else{
                        $actifUrl = "menti";
                        $titleName = "Mentiler";
                    }
                ?>
                <?php  if ((strlen(get_active_user()->description) > 20 && get_active_user()->user_role_id == 3) || get_active_user()->user_role_id != 3 ){?>
                <li>
                    <a href="<?php echo base_url($actifUrl); ?>">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text"><?= $titleName ?></span>
                    </a>
                </li>
                <?php } ?>

                <?php if (isAllowedViewModule("girisim_categories")){ ?>
                    <li>
                        <a href="<?php echo base_url("girisim_categories"); ?>">
                            <i class="menu-icon zmdi zmdi-email zmdi-hc-lg"></i>
                            <span class="menu-text">Girişim İşlemleri</span>
                        </a>
                    </li>
                <?php } ?>


                <li>
                    <a href="<?php echo base_url("users/profil_form/$user->id"); ?>">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">Bilgilerim</span>
                    </a>
                </li>



                <?php if (isAllowedViewModule("emailsettings")){ ?>
                    <li>
                        <a href="<?php echo base_url("emailsettings"); ?>">
                            <i class="menu-icon zmdi zmdi-email zmdi-hc-lg"></i>
                            <span class="menu-text">E-posta Ayarları</span>
                        </a>
                    </li>
                <?php } ?>




<!--                --><?php //if (isAllowedViewModule("girisim_categories") || isAllowedViewModule("girisim")){ ?>
<!--                    <li class="has-submenu">-->
<!--                        <a href="javascript:void(0)" class="submenu-toggle">-->
<!--                            <i class="menu-icon fa fa-asterisk"></i>-->
<!--                            <span class="menu-text">Girişim İşlemleri</span>-->
<!--                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>-->
<!--                        </a>-->
<!--                        <ul class="submenu">-->
<!--                            <li>-->
<!--                                <a href="--><?php //echo base_url("girisim_categories"); ?><!--">-->
<!--                                    <span class="menu-text">Girişim Oluştur</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="--><?php //echo base_url("girisim"); ?><!--">-->
<!--                                    <span class="menu-text">Girişimci Ekle</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                --><?php //} ?>
<!---->
<!--                --><?php //if (isAllowedViewModule("portfolio_categories") || isAllowedViewModule("portfolio")){ ?>
<!--                    <li class="has-submenu">-->
<!--                        <a href="javascript:void(0)" class="submenu-toggle">-->
<!--                            <i class="menu-icon fa fa-asterisk"></i>-->
<!--                            <span class="menu-text">Girişim İşlemleri</span>-->
<!--                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>-->
<!--                        </a>-->
<!--                        <ul class="submenu">-->
<!--                            <li>-->
<!--                                <a href="--><?php //echo base_url("portfolio_categories"); ?><!--">-->
<!--                                    <span class="menu-text">Girişim Oluştur</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="--><?php //echo base_url("portfolio"); ?><!--">-->
<!--                                    <span class="menu-text">Girişimci Ekle</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                --><?php //} ?>

                <?php if (isAllowedViewModule("user_roles")){ ?>
                    <li>
                        <a href="<?php echo base_url("user_roles"); ?>">
                            <i class="menu-icon fa fa-user-times"></i>
                            <span class="menu-text">Kullanıcı Rolü</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if (isAllowedViewModule("users")){ ?>
                    <li>
                        <a href="<?php echo base_url("users"); ?>">
                            <i class="menu-icon fa fa-user-secret"></i>
                            <span class="menu-text">Kullanıcılar</span>
                        </a>
                    </li>
                <?php } ?>

                <?php  if ((strlen(get_active_user()->description) > 20 && get_active_user()->user_role_id == 3) || get_active_user()->user_role_id != 3 ){?>
                    <li>
                        <a target="_blank" href="https://www.akagim.com/">
                            <i class="menu-icon zmdi zmdi-view-web zmdi-hc-lg"></i>
                            <span class="menu-text">Siteye Git</span>
                        </a>
                    </li>
                <?php  } ?>
            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>