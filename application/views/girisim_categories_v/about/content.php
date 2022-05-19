<div class="row">
    <div class="col-md-12">
        <div id="profile-tabs" class="nav-tabs-horizontal white m-b-lg">
            <!-- tabs list -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#profile-about" aria-controls="about" role="tab" data-toggle="tab">Mentiler</a></li>
            </ul><!-- .nav-tabs -->

            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" id="profile-about" class="tab-pane in active fade" >
                    <div class="container">
                        <div class="row">

                            <?php foreach ($itemUser as $menti): ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="thumbnail white">
                                        <img style="width: 50%" src="<?= get_picture( "users_v", $menti->img_url, '80x80'); ?>"  alt="sender photo">
                                        <div class="caption text-center">
                                            <h4><strong><?= $menti->full_name; ?></strong></h4>
                                            <p><?= !empty($item->unvan) ? $item->unvan : "-"; ?></p>
                                            <p>
                                                <a href="<?php echo base_url("menti/about/{$menti->id}"); ?>" class="btn btn-primary" role="button">Profil</a>
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- END column -->
                            <?php endforeach;?>

                        </div>
                    </div>
                </div><!-- hakkımda -->

            </div><!-- .tab-content -->
        </div><!-- #profile-components -->
    </div><!-- END column -->

</div><!-- .row -->