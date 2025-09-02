/**
 * Created by alienware on 12/26/2017.
 */

var kalendarKegiatan = function(){

    var showKegiatan = function (){
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            defaultDate: '2017-12-12',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-01',
                },
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-07',
                    end: '2017-12-10'
                },
                {
                    id: 999,
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-16T16:00:00'
                },
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-11',
                    end: '2017-12-13'
                },
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-12T10:30:00',
                    end: '2017-12-12T12:30:00'
                },
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-12T12:00:00'
                },
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-12T14:30:00'
                },
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-12T17:30:00'
                },
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-12T20:00:00'
                },
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-13T07:00:00'
                },
                {
                    title: 'Judul kegiatan pertama',
                    url: '/bic_new/general/home',
                    start: '2017-12-28'
                }
            ]
        });
    };

    return {
        init: function() {
            showKegiatan();
        }
    };
}();

jQuery(document).ready(function() {
    kalendarKegiatan.init();
});
