//https://code.google.com/p/jquery-ui/source/browse/trunk/ui/i18n/ui.datepicker-ru.js?spec=svn3480&r=3004

$(function() {
    var dateList = null;
    var date1 = new Date;
    date1.setHours(0, 0, 0, 0);
    date1.setDate(1);
    var date2 = new Date;
    date2.setHours(0, 0, 0, 0);
    date2.setMonth(date2.getMonth() + 12, 0);
    $("#datepicker").datepicker({
        minDate: date1,
        maxDate: date2,
        beforeShowDay: function(date) {
            var r = [true, ""];
            if (dateList === null) {
                r[1] = "dp-highlight-unknown";
            } else {
                var key = $.datepicker.formatDate("yy-mm-dd", date);
                if (key in dateList) {
                    r[1] = "dp-highlight-holiday";
                    r[2] = dateList[key].join(", ");
                }
            }
            return r;
        }
    });
    $(this).prop("disabled", true);
    $.getJSON("http://www.google.com/calendar/feeds/usa__en@holiday.calendar.google.com/public/full", {
        "alt": "json",
        "start-min": $.datepicker.formatDate("yy-mm-dd", date1),
        "start-max": $.datepicker.formatDate("yy-mm-dd", new Date(date2.getTime() + 86400000)),
        "orderby": "starttime",
        "max-results": 100
    }, function(data) {
        dateList = {};
        $.each(data.feed.entry, function(i, entry) {
            var key = entry.gd$when[0].startTime.substr(0, 10);
            if (key in dateList == false) {
                dateList[key] = [];
            }
            dateList[key].push(entry.title.$t);
        });
        $("#datepicker").datepicker("refresh");
    });
});
$(function($){
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: '&#x3c;Пред',
        nextText: 'След&#x3e;',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
            'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
            'Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['ru']);
})  ;


