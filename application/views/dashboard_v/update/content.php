<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h4 class="m-b-lg">
            <strong> <?php echo get_user_info($item->teacher_id)->full_name; ?>  </strong>  'adlı mentörün toplantısını düzenliyorsunuz
        </h4>
    </div><!-- END column -->
    <div class="col-md-8 col-md-offset-2">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("dashboard/updated/$item->id"); ?>" method="post">

                    <div class="form-group col-md-12">
                        <label for="control-demo-6">Mentor</label>
                        <div id="control-demo-6">
                            <select name="teacher_id" id="teacher_id" class="form-control ">
                                <?php foreach ($teachers as $teacher): ?>
                                    <option
                                            <?= $item->teacher_id == $teacher->id ? 'selected' : "null" ?>
                                            value="<?= $teacher->id ?>"> <?= $teacher->full_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="control-demo-6">Menti</label>
                        <div id="control-demo-6">
                            <select name="student_id" id="student_id" class="form-control ">
                                <option value="0">Seçim Yapınız</option>
                                <?php foreach ($students as $student): ?>
                                    <option
                                            <?= $item->student_id == $student->id ? 'selected' : "null" ?>
                                            value="<?= $student->id ?>"> <?= $student->full_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title" value="<?php echo isset($form_error) ? set_value("title") : $item->title; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="color">Arka Plan Rengi</label>
                            <input name="listColor" type="color" id="listColor"  class="form-control" placeholder="Renk" value="<?php echo isset($form_error) ? set_value("color") : $item->color; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="color">Yazı Rengi</label>
                            <input name="listTextColor" type="color" id="listTextColor" class="form-control" placeholder="Renk" value="<?php echo isset($form_error) ? set_value("textColor") : $item->textColor; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <?php $calendar = get_watch_list($item->start_event,$item->end_event)  ?>
                        <?= $calendar['tarih']; ?>
                        <div class="col-md-4">
                            <label for="datetimepicker1">Başlangıç Tarihi</label>
                            <input type="hidden" value="<?= $calendar['tarih']; ?>" name="event_date" id="datetimepicker1" data-plugin="datetimepicker" data-options="{inline: true, viewMode: 'days', format : 'DD-MM-YYYY'}" />
                        </div><!-- END column -->
                        <div class="col-md-8">

                            <div class="form-group col-md-6">
                                <label for="start_time">Başlangıç saati</label>
                                <input  name="start_event" type="time" id="listStart_time" class="form-control" placeholder="Başlangıç saati" value="<?php echo $calendar['baslangic']; ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="end_time">Bitiş saati</label>
                                <input name="end_event"  type="time"  id="listEnd_time" class="form-control"  placeholder="Bitiş saati"  value="<?php echo $calendar['bitis']; ?>">
                            </div>

                            <div class="form-group tyeri col-md-12">
                                <label for="control-demo-6">Toplantı Türü</label>
                                <div id="control-demo-6">
                                    <select name="toplanti_turu" id="toplantiTuru" class="form-control toplanti">
                                        <option <?= $item->toplantiTuru == "zoom" ? 'selected' : null; ?> value="zoom">Zoom</option>
                                        <option <?= $item->toplantiTuru == "ozel" ? 'selected' : null; ?> value="ozel">Akagim</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group location col-md-12" style="display: none">
                                <label for="end_time">Toplantı Yeri</label>
                                <input name="toplanti_yeri" id="toplantiYeri" type="text"  class="form-control"  placeholder="Toplantı Yeri" value="<?php echo isset($form_error) ? set_value("toplanti_yeri") : $item->toplantiYeri; ?>">
                            </div>

                        </div><!-- END column -->
                    </div>

                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo isset($form_error) ? set_value("description") : $item->description; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url("dashboard/show"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>

<script>
    $(document).ready(function() {

        if ($('.toplanti').val() == "zoom") {
            $('.location').css("display", "none");
        }

        if ($('.toplanti').val() == "ozel") {
            $('.location').css("display", "block");
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

        $('.hamdi').timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            minTime: '00:00',
            maxTime: '23:59',
            defaultTime: '11',
            startTime: '01:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });

    });
</script>
















