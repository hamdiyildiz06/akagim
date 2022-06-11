<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h4 class="m-b-lg">
            Yeni Toplantı Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-8 col-md-offset-2">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("dashboard/save"); ?>" method="post">

                    <div class="form-group col-md-12">
                        <label for="control-demo-6">Mentor</label>
                        <div id="control-demo-6">
                            <select name="teacher_id" id="teacher_id" class="form-control">
                                <?php foreach ($teachers as $teacher): ?>
                                    <option value="<?= $teacher->id ?>"> <?= $teacher->full_name ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group tyeri col-md-12">
                                <label for="control-demo-6">Menti Veya Girisim</label>
                                <div id="control-demo-6">
                                    <select name="mentiGirisim" id="mentiGirisim" class="form-control mentiGirisim">
                                        <option value="0">Seçim Yapınız</option>
                                        <option value="menti">Menti</option>
                                        <option value="girisim">Girisim</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12 menti" style="display: none">
                                <label for="control-demo-6">Menti</label>
                                <div id="control-demo-6">
                                    <select name="student_id" id="student_id" class="form-control mentiVal">
                                        <option value="0">Seçim Yapınız</option>
                                        <?php foreach ($students as $student): ?>
                                            <option value="<?= $student->id ?>"> <?= $student->full_name ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12 girisim" style="display: none">
                                <label for="control-demo-6">Girisim</label>
                                <div id="control-demo-6">
                                    <select name="girisim_category_id" id="girisim_category_id" class="form-control girisimVal">
                                        <option value="0">Seçim Yapınız</option>
                                        <?php foreach ($girisim_categorys as $girisim_category): ?>
                                            <option value="<?= $girisim_category->id ?>"> <?= $girisim_category->title ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                        </div><!-- END column -->
                    </div>


                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="color">Arka Plan Rengi</label>
                            <input name="listColor" type="color" id="listColor" value="#0275d8" class="form-control" placeholder="Renk">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="color">Yazı Rengi</label>
                            <input name="listTextColor" type="color" id="listTextColor" class="form-control" placeholder="Renk">
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <label for="datetimepicker1">Başlangıç Tarihi</label>
                            <input type="hidden" name="event_date" id="datetimepicker1" data-plugin="datetimepicker" data-options="{inline: true, viewMode: 'days', format : 'YYYY-MM-DD'}" />
                        </div><!-- END column -->
                        <div class="col-md-8">

                            <div class="form-group col-md-6">
                                <label for="start_time">Başlangıç saati</label>
                                <input name="start_event" type="text" id="listStart_time" class="form-control hamdi" placeholder="Başlangıç saati">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="end_time">Bitiş saati</label>
                                <input name="end_event"  type="text"  id="listEnd_time" class="form-control hamdi"  placeholder="Bitiş saati">
                            </div>

                            <div class="form-group tyeri col-md-12">
                                <label for="control-demo-6">Toplantı Türü</label>
                                <div id="control-demo-6">
                                    <select name="toplanti_turu" id="toplantiTuru" class="form-control toplanti">
                                        <option value="zoom">Zoom</option>
                                        <option value="ozel">Akagim</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group location col-md-12" style="display: none">
                                <label for="end_time">Toplantı Yeri</label>
                                <input name="toplanti_yeri" id="toplantiYeri" type="text"  class="form-control"  placeholder="Toplantı Yeri" >
                            </div>

                        </div><!-- END column -->
                    </div>

                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url("dashboard/new_form"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>

<script>
    $(document).ready(function() {

        $('.menti').css("display", "none");
        $('.girisim').css("display", "none");

        if ($('.toplanti').val() == "zoom") {
            $('.location').css("display", "none");
        }

        $('.toplanti').on('change', function () {

            if (this.value == 'ozel') {
                // alert(this.value);
                $('.location').css("display", "block");
            } else {
                // alert(this.value);
                $('.location').css("display", "none");
            }
        });

        $('.mentiGirisim').on('change', function(){
            if (this.value == "menti" ){
                $('.menti').css("display", "block");
                $('.girisim').css("display", "none");
            } else {
                $('.menti').css("display", "none");
                $('.girisim').css("display", "block");
            }
        })

        $('.hamdi').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            minTime: '00:00',
            maxTime: '23:59',
            defaultTime: '11',
            startTime: '01:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>
















