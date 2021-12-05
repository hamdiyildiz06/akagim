<?php $this->load->view ('dashboard_v/list/fullcalendar-custom');  ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading text-center" style="background-color: #9e2462">
                <span style="color:white; text-decoration:none;">
                    Toplantı Oluşturmak için Aşağıdaki Boş Takvim Alanlarını Tıklayabilirsiniz ...
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <a href="student?opt=mgst" style="color:white; text-decoration:none;">
                    Toplam Girişimci : <span class="badge"><?php echo $countTotalStudent; ?></span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-primary text-center">
            <div class="panel-heading">
                <a href="teacher" style="color:white; text-decoration:none;">
                    Toplam Mentor : <span class="badge"><?php echo $countTotalTeacher; ?></span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <a href="classes" style="color:white; text-decoration:none;">
                    Toplam Girişim : <span class="badge"><?php echo $countTotalClasses; ?></span>
                </a>

            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Takvim</div>
            <div class="panel-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

<!--    <div class="col-md-4">-->
<!--        <div class="panel panel-default">-->
<!--            <div class="panel-heading"> <i class="fa fa-dollar-sign"></i> Lifetime Income </div>-->
<!--            <div class="panel-body">-->
<!--                <center>-->
<!--                    <h3><b>--><?php //echo '$'.$totalIncome; ?><!-- </b></h3>-->
<!--                </center>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="panel panel-default">-->
<!--            <div class="panel-heading"><i class="fa fa-money-check-alt"></i> Lifetime Expenses </div>-->
<!--            <div class="panel-body">-->
<!--                <center>-->
<!--                    <h3><b>--><?php //echo '$'.$totalExpenses; ?><!--</b></h3>-->
<!--                </center>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="panel panel-default">-->
<!--            <div class="panel-heading "><i class="fa fa-dollar-sign"></i> Current Budget </div>-->
<!--            <div class="panel-body">-->
<!--                <center>-->
<!--                    <h3><b>--><?php //echo '$'.$totalBudget; ?><!--</b></h3>-->
<!--                </center>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    -->
</div>

<style>
    .modal-header, h4, .close {
        background-color: #5cb85c;
        color:white !important;
        text-align: center;
        font-size: 30px;
    }
    .modal-footer {
        background-color: #f9f9f9;
    }
    .ui-timepicker-container {
        z-index: 99999!important;
    }
</style>
<div class="modal fade" id="insert" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="listHeader"><span class="glyphicon glyphicon-calendar"></span> List Formu</h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Başlık</label>
                        <input name="title" type="text" id="listTitle"   class="form-control title" placeholder="Başlık" >
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="color">Arka Plan Rengi</label>
                            <input name="color" type="color" id="listColor" value="#0275d8" class="form-control" placeholder="Renk">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="color">Yazı Rengi</label>
                            <input name="color" type="color" id="listTextColor" class="form-control" placeholder="Renk">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="start_time">Başlangıç saati</label>
                            <input name="start_time" type="text" id="listStart_time" class="form-control hamdi" placeholder="Başlangıç saati">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end_time">Bitiş saati</label>
                            <input name="end_time"  type="text"  id="listEnd_time" class="form-control hamdi"  placeholder="Bitiş saati">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="end_time">Tarih</label>
                        <input name="end_time"  type="text" id="listStart" class="form-control"  placeholder="Tarih" >
                    </div>

                    <div class="form-group tyeri">
                        <label for="control-demo-6">Toplantı Türü</label>
                        <div id="control-demo-6">
                            <select name="toplanti_turu" id="toplantiTuru" class="form-control toplanti">
                                <option value="zoom">Zoom</option>
                                <option value="ozel">Özel</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group location" style="display: none">
                        <label for="end_time">Toplantı Yeri</label>
                        <input name="toplanti_yeri" id="toplantiYeri" type="text" id="listStart" class="form-control"  placeholder="Toplantı Yeri" >
                    </div>

                    <div class="form-group">
                        <label for="description">Açıklama</label>
                        <textarea name="description" class="form-control" id="listDescription" placeholder="Açıklama"  cols="30" rows="4"></textarea>
                        <input name="title" type="hidden" id="listID"   class="form-control title" placeholder="Başlık" >
                    </div>
                </form>

            </div>

            <div class="modal-footer" >
                <button id="listInsert" type="button" class="btn btn-success btn-default pull-right" ><span class="glyphicon glyphicon-check"></span> Kaydet</button>
                <button id="listUpdate" type="button" class="btn btn-info btn-default pull-right" ><span class="glyphicon glyphicon-pencil"></span> Düzenle</button>
                <button id="listDelete" type="submit" class="btn btn-danger btn-default pull-right" ><span class="glyphicon glyphicon-trash"></span> Sil</button>
                <button id="listInsert" type="submit" class="btn btn-warning btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Kapat</button>
            </div>

        </div>

    </div>
</div>

<script>
    $(document).ready(function(){

        if ($('.toplanti').val() == "zoom"){
            $('.location').css("display","none");
        }

        $('.toplanti').on('change', function() {

            if (this.value == 'ozel'){
                // alert(this.value);
                $('.location').css("display","block");
            }else{
                // alert(this.value);
                $('.location').css("display","none");
            }
        });


        var yeniEtkinlik;

        $('#listInsert').click(function (){
            RecolectarDatosGUI();
            EnviarInformacion('insert',yeniEtkinlik);
        });
        $('#listDelete').click(function (){
            RecolectarDatosGUI();
            EnviarInformacion('delete',yeniEtkinlik);
        });
        $('#listUpdate').click(function (){
            RecolectarDatosGUI();
            EnviarInformacion('update',yeniEtkinlik);
        });

        function RecolectarDatosGUI(){
            yeniEtkinlik = {
                id:$('#listID').val(),
                title:$('#listTitle').val(),
                color:$('#listColor').val(),
                textColor:$('#listTextColor').val(),
                toplantiTuru:$('#toplantiTuru').val(),
                toplantiYeri:$('#toplantiYeri').val(),
                start:$('#listStart').val() + " " + $('#listStart_time').val(),
                end:$('#listStart').val() + " " + $('#listEnd_time').val(),
                start_time:$('#listStart_time').val(),
                end_time:$('#listEnd_time').val(),
                description:$('#listDescription').val()
            };
        }

        function EnviarInformacion(action,objEvento){
            $.ajax({
                type:'POST',
                url:"<?php echo base_url(); ?>dashboard/"+action,
                data:objEvento,
                success:function (msg){
                    if(msg) {
                        $('#calendar').fullCalendar('refetchEvents');
                        $("#insert").modal('toggle');

                    }
                },
                error:function(){
                    alert("insert kısmında bir hata var");
                }
            });
        }


        $('.hamdi').timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
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


