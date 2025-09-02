/**
 * Created by alienware on 1/4/2018.
 */

var buku = {
    config: {
        table: null
    },
    init: function(settings){
        $.extend(buku.config,settings);
        buku.setup();
        $('#sample_1 thead').css('display:none');
    },
    setup: function(){

        buku.config.table = $('#sample_1');

        // begin first table
        buku.config.table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": [0,1],
                "orderable": false,
                "searchable": true
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "order": [
                [1,'asc']
            ], // set first column as a default sort by asc
            "fnInitComplete": function(oSettings) {
                $('.dataTables_scrollHead thead').hide();
            }
        });

        $("#selJudul").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

jQuery(document).ready(function() {
    buku.init();
});

$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading"); },
    ajaxStop: function() { $body.removeClass("loading"); }
});

$('#new').on('click',function(){
    buku.redirectToPage(host+'/admin/buku/create');
});

$('#selJudul').on('change',function(){
    buku.redirectToPage(host+'/general/kategori/'+$('#kategori').val()+'/'+$('#selJudul').val());
});

function findBuku(alphabet){
    buku.redirectToPage(host+'/general/kategori/'+$('#kategori').val()+'/'+$('#selJudul').val()+'/'+alphabet);
}