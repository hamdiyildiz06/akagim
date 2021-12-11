<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Girişim kayıt Listesi
            <?php if(get_active_user()->user_role_id == 1) { ?>
              <a href="<?php echo base_url("users/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <form action="#" class="form-horizontal">
            <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="control-demo-6" class="col-sm-3">Girişim Seçin</label>
                        <div id="control-demo-6" class="col-sm-9">
                            <select name="girisim_category" id="girisim_category" class="form-control">
                                <?php foreach ($girisim_category as $grs_category): ?>
                                <option value="<?= $grs_category->id; ?>"> <?= $grs_category->title; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div><!-- .form-group -->

                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url("users/new_form"); ?>">tıklayınız</a></p>
                </div>

            <?php } else { ?>



                <table class="table table-hover table-striped table-bordered content-container">
                    <thead>
                        <th class="w50">#id</th>
                        <th>Kullanıcı Adı</th>
                        <th>Ad Soyad</th>
                        <th>E-posta</th>
                        <th>İşlem</th>
                    </thead>
                    <tbody>

                        <?php foreach($items as $item) { ?>

                            <tr>
                                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                <td><?php echo $item->user_name; ?></td>
                                <td><?php echo $item->full_name; ?></td>
                                <td class="text-center"><?php echo $item->email; ?></td>
                                <td class="text-center w50">
                                    <a href="<?php echo base_url("girisim/add_initiative/$item->id/{$kategori}"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Ekle</a>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } ?>

        </div><!-- .widget -->
    </div><!-- END column -->
</div>

<script>
    $( document ).ready(function() {
        $( "#girisim_category" ).on( "change", function() {
            console.log( $( this ).text() );
        });
    });
</script>