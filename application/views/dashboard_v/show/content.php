<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Toplantı Listesi
            <?php if(get_active_user()->user_role_id == 1) { ?>
              <a href="<?php echo base_url("dashboard/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->

    <div class="col-md-12">
        <div class="widget p-lg">
            <header class="widget-header">
                <h4 class="widget-title">Arama Kriterleri</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                <form action="<?php echo base_url("dashboard/show"); ?>" method="POST" class="form-horizontal">

                    <div class="form-group">
                        <label for="select2-demo-1" class="col-sm-4 control-label">İsim Soyisim</label>
                        <div class="col-sm-6">
                            <select id="select2-demo-1" class="form-control" data-plugin="select2" name="fullName">
                                <option value="0">İsime Göre Ara</option>
                                <?php foreach ($users as $user): ?>
                                <option value="<?= $user->id; ?>"><?= $user->full_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><!-- END column -->
                    </div><!-- .form-group -->

                    <div class="form-group" id="demo">
                        <label for="select2-demo-6" class="col-sm-4 control-label">Tarih Aralığı Seçiniz</label>
                        <div class="col-sm-6">
                            <input type="text" id="config-demo" class="form-control" name="daterange"  value="" placeholder="Tarih Aralığı Seçiniz"  />
                        </div><!-- END column -->
                    </div><!-- .form-group -->

                    <button type="submit" class="btn btn-primary btn-md btn-outline pull-right">Uygula</button>
                    <br>
                </form>
            </div><!-- .widget-body -->

        </div><!-- .widget -->
    </div>

    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url("users/new_form"); ?>">tıklayınız</a></p>
                </div>

            <?php } else { ?>

                <form action="<?= base_url("dashboard/excel"); ?>"  method="post">
                <input type="hidden" name="fullNamee" value="<?= $fullName; ?>">
                <input type="hidden" name="daterangee" value="<?= $daterange; ?>">

                    <div class="col-sm-12 pull-right m-b-md">
                        <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-file-excel-o fa-2x"> </i></button>
                    </div>
                </form>
                <table class="table table-hover table-striped table-bordered content-container">
                    <thead>
                        <th class="w50">#id</th>
                        <th>Mentor</th>
                        <th>Menti</th>
                        <th>Tarih</th>
                        <th>başlangıç</th>
                        <th>Bitiş</th>
                        <th>Durumu</th>
                        <th>İşlem</th>
                    </thead>
                    <tbody>

                        <?php foreach($items as $item) { ?>
                <?php $calendar = get_watch_list($item->start_event,$item->end_event); ?>
                            <tr>
                                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                <td><?php echo get_user_info($item->teacher_id)->full_name; ?></td>
                                <td><?php echo get_user_info($item->student_id)->full_name; ?></td>
                                <td><?php echo $calendar['tarih']; ?></td>
                                <td><?php echo $calendar['baslangic']; ?></td>
                                <td><?php echo $calendar['bitis']; ?></td>

                                <td class="text-center w100">
                                    <input
                                        data-url="<?php echo base_url("dashboard/isActiveSetter/$item->id"); ?>"
                                        class="isActive"
                                        type="checkbox"
                                        data-switchery
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                                    />
                                </td>
                                <td class="text-center w200">
                                    <button
                                        data-url="<?php echo base_url("dashboard/deleted/$item->id"); ?>"
                                        class="btn btn-sm btn-danger btn-outline remove-btn">
                                        <i class="fa fa-trash"></i> Sil
                                    </button>
                                    <a href="<?php echo base_url("dashboard/update_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } ?>

        </div><!-- .widget -->
    </div>
    <!-- END column -->
</div>

<script>

    $(function() {

        moment.locale('tr');
        $('input[name="daterange"]').daterangepicker({
            "timePicker": true,
            "autoUpdateInput": false,
            "timePicker24Hour": true,
            "showDropdowns" : true,
            "minYear": 2010,
            "maxYear": 2040,
            "opens": 'center',
            locale: {

                cancelLabel: 'Vazgeç',
                applyLabel: 'Uygula',
            }
        });

        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' / ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
        });

        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });


</script>