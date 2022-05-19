
<script>
    $(document).ready(function(){

        $("#topNavDashboard").addClass('active');
        $('#calendar').fullCalendar({
            locale:'tr',
            selectable:true,
            selectHelper:true,
            weekends:true,
            scrollTime:'00:00',
            slotDuration:'00:15',
            slotLabelFormat: 'HH:mm',
            slotLabelInterval:'00:15',
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,basicWeek,basicDay agendaWeek,agendaDay'
            },
            footer:{
                left:'prev,next today',
                center:'title',
                right:'prevYear,nextYear'
            },
            firstDay: 1,
            buttonText:{
                agendaWeek:'Saatli Hafta',
                agendaDay:'Saatli Gün',
                prevYear:'Önceki Yıl <<',
                nextYear:'>> Sonraki Yıl'
            },
            eventLimit:true,
            aspectRatio:3,
            // height:500,
            // contentHeight:500,
            // eventRender: function(event){
            //     if (event.title == 'bu baska'){
            //         return false;
            //     }
            //     return true;
            // },
            dayClick:function (date,jsEvent,view){

                // alert("burada birşeyler yazacak :" + date.format());
                // alert(" vista actual: " + view.name);
                // $(this).css('background-color','red');
                $('#listID').val("");
                $('#listTitle').val("");
                $('#listColor').val("#3a87ad");
                $('#listTextColor').val("");
                $('#toplantiTuru').val("zoom");
                $('#toplantiYeri').val("");
                $('#listStart').val(date.format());
                $('.hamdi').val("11:00");
                $('#listDescription').val("");

                // $('#insert #title').val("hamdiden selamlar");


                // button controls
                $('#listInsert').attr("style","display:true");
                $('#listUpdate').attr("style","display:none");
                $('#listDelete').attr("style","display:none");
                if ($('#toplantiTuru').val() == 'ozel'){
                    $('.location').attr("style","display:true");
                }else{
                    $('.location').attr("style","display:none");
                }

                $('#insert').val(date.format());
                $("#insert").modal();
                // $('#myModal').val(date.format());
                // $("#myModal").modal();
            },
            events:"<?php echo base_url(); ?>dashboard/load",

            eventClick:function (calEvent,jsEvent,view){

                $('#listID').val(calEvent.id);
                $('#listTitle').val(calEvent.title);
                $('#listColor').val(calEvent.color);
                $('#listTextColor').val(calEvent.textColor);
                $('#listDescription').val(calEvent.description);
                $('#toplantiTuru').val(calEvent.toplantiTuru);
                $('#toplantiYeri').val(calEvent.toplantiYeri);
                // $('#listStart').val($.fullCalendar.formatDate(calEvent.start, "DD-MM-Y"));
                $('#listStart').val(calEvent.start.format("YYYY-MM-DD"));
                $('#listEnd').val(calEvent.end);
                $('#listTeacher_id').html(calEvent.teacher_id);
                $('#listStart_time').val(calEvent.start_time);
                $('#listEnd_time').val(calEvent.end_time);

                // button controls
                $('#listInsert').attr("style","display:none");
                $('#listUpdate').attr("style","display:true");
                $('#listDelete').attr("style","display:true");
                if ($('#toplantiTuru').val() == 'ozel'){
                    $('.location').attr("style","display:true");
                }else{
                    $('.location').attr("style","display:none");
                }

                // alert(calEvent.start.format());
                $("#insert").modal();
            },
            editable:true,
            eventDrop:function(calEvent)
            {
                var id = calEvent.id;
                var title = calEvent.title;
                var color = calEvent.color;
                var textColor = calEvent.textColor;
                var description = calEvent.description;
                var toplantiTuru = calEvent.toplantiTuru;
                var toplantiYeri = calEvent.toplantiYeri;
                var start = $.fullCalendar.formatDate(calEvent.start, "YYYY-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(calEvent.end, "YYYY-MM-DD HH:mm:ss");
                $.ajax({
                    url:"<?php echo base_url(); ?>dashboard/update",
                    type:"POST",
                    data:{title:title, color:color, textColor:textColor, description:description, toplantiTuru:toplantiTuru, toplantiYeri:toplantiYeri, start:start, end:end, id:id},
                    success:function()
                    {
                        alert("dropdown işlemi yapıldı");
                        calendar.fullCalendar('refetchEvents');
                    }
                });

            },
            eventResize:function(calEvent)
            {
                var id = calEvent.id;
                var title = calEvent.title;
                var color = calEvent.color;
                var textColor = calEvent.textColor;
                var description = calEvent.description;
                var toplantiTuru = calEvent.toplantiTuru;
                var toplantiYeri = calEvent.toplantiYeri;
                var start = $.fullCalendar.formatDate(calEvent.start, "YYYY-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(calEvent.end, "YYYY-MM-DD HH:mm:ss");
                $.ajax({
                    url:"<?php echo base_url(); ?>dashboard/ResizeUpdate",
                    type:"POST",
                    data:{title:title, color:color, textColor:textColor, description:description, toplantiTuru:toplantiTuru, toplantiYeri:toplantiYeri, start:start, end:end, id:id},
                    success:function(cevap)
                    {
                        alert(cevap + " resize işlemi yapıldı");
                        calendar.fullCalendar('refetchEvents');

                    }
                });
            },

        });


    });




</script>
