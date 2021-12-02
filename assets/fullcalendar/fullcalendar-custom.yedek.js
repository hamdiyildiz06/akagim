$(document).ready(function () {
    $("#topNavDashboard").addClass('active');
    $("#calendar").fullCalendar({
        locale: 'tr',
        selectable: true,
        weekends: true,
        editable: true,
        scrollTime: '00:00',
        slotDuration: '00:15',
        slotLabelFormat: 'HH:mm',
        slotLabelInterval: '00:15',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay agendaWeek,agendaDay'
        },
        footer: {
            left: 'prev,next today',
            center: 'title',
            right: 'prevYear,nextYear'
        },
        firstDay: 1,
        buttonText: {
            agendaWeek: 'Saatli Hafta',
            agendaDay: 'Saatli Gün',
            prevYear: 'Önceki Yıl <<',
            nextYear: '>> Sonraki Yıl'
        },
        eventLimit: true,
        aspectRatio: 3,
        // height:500,
        // contentHeight:500,
        eventRender: function (event) {
            if (event.title == 'bu baska') {
                return false;
            }
            return true;
        },
        events: [
            {
                title: 'bu baska',
                start: new Date(2021, 9, 10, 12, 30),
                end: new Date(2021, 9, 10, 13, 30),
            },
            {
                title: 'deneme Olayı 2',
                start: new Date(2021, 9, 11, 17, 30),
                end: new Date(2021, 9, 11, 21, 30),
            },
            {
                title: 'deneme Olayı 4',
                start: new Date(2021, 9, 12, 10, 30),
                end: new Date(2021, 9, 12, 11, 30),
            },
            {
                title: 'deneme Olayı 5',
                start: new Date(2021, 9, 13, 17, 30),
                end: new Date(2021, 9, 13, 21, 30),
            },
            {
                title: 'deneme Olayı 6',
                start: new Date(2021, 9, 13),
                allDay: true
            }
        ]
    });
});
