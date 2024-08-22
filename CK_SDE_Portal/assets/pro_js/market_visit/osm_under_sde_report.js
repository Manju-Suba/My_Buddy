$(document).ready(function () {
    get_osm_details_under_sde();

    var mobil = $('#under_osm_mobile').val();

    get_osm_mv_details(mobil);
});


function get_osm_details_under_sde() {
    var example = $('#osm_report_view_under_sde').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true, 
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'market_visit/SdeMarket/get_osm_details_under_sde',
            'data': function (d) {
                d.osm_number =$('#osm_name').val();
                d.jc_type_year =$('#jc_type_year').val(); 
                d.jc_type =$('#jc_type').val();

            }
        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "osm" },
            { "data": "jc" },
            { "data": "count" },
            { "data": "action" },
        ],
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Applies the option to all columns
        ],
        "order": [
            [1, 'asc']
        ]
    });

}

$("#filterClearbtn").on('click', function () {
    $('#osm_name').val("");

	var currentYear = new Date().getFullYear();
	n = new Date().getMonth();
	if( (n+1) <= 3){
		var next = currentYear-1;
		var year = next + '-' + currentYear.toString().slice(-2);
	}else{
		var next = currentYear+1;
		var year = currentYear + '-' + next.toString().slice(-2);
	}

    $('#jc_type_year').val(year);

	var month_numeric = ['01','02','03','04','05','06','07','08','09','10','11','12'];
	var jc_s = ['JC10','JC11','JC12','JC01','JC02','JC03','JC04','JC05','JC06','JC07','JC08','JC09'];
	var obj = Object.assign({}, ...month_numeric.map((e, i) => ({[e]: jc_s[i]})));

	let date = new Date();
	var jc_month = ("0" + (date.getMonth() + 1)).slice(-2);
	var jc_typ = obj[jc_month];

    $('#jc_type').val(jc_typ);
    get_osm_details_under_sde();

});

$("#osm_name").on('change', function () {
    get_osm_details_under_sde();
});

$("#jc_type_year").on('change', function () {
    get_osm_details_under_sde();
});

$("#jc_type").on('change', function () {
    get_osm_details_under_sde();
});



function get_osm_mv_details(mobil) {
    var example = $('#mv_data').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true, 
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'market_visit/SdeMarket/get_osm_mv_details/'+mobil,
            'data': function (d) {
            }
        },
        createdRow: function (row, data, dataIndex) {
            $( row ).find('td:eq(0)').attr('data-label', 'S.No');
            $( row ).find('td:eq(1)').attr('data-label', 'RS');
            $( row ).find('td:eq(2)').attr('data-label', 'RSSM');
            $( row ).find('td:eq(3)').attr('data-label', 'Beat');
            $( row ).find('td:eq(4)').attr('data-label', 'Total Calls Made');
            $( row ).find('td:eq(5)').attr('data-label', 'Value');
            $( row ).find('td:eq(6)').attr('data-label', 'Billscut');
            $( row ).find('td:eq(7)').attr('data-label', 'TLSD');
            $( row ).find('td:eq(8)').attr('data-label', 'RSSM Morning Img');
            $( row ).find('td:eq(9)').attr('data-label', 'RSSM Evening Img');
            $( row ).find('td:eq(10)').attr('data-label', 'Created Date');

        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "m_rs" },
            { "data": "m_rssm" },
            { "data": "m_beat" },
            { "data": "total_calls_made" },
            { "data": "value" },
            { "data": "billut" },
            { "data": "tlsd" },
            { "data": "rssm_morn_image" },
            { "data": "rssm_eve_image" },
            { "data": "created_date" },
            { "data": "updated_date" },
        ],
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Applies the option to all columns
        ],
        "order": [
            [1, 'asc']
        ]
    });

    $('#mv_data tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = example.row( tr );
        var nester_tbl_id = row.data().auto_id;

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(format(row.data())).show();
            // format_new(row.child,nester_tbl_id);
            tr.addClass('shown');
        }
    } );

}
