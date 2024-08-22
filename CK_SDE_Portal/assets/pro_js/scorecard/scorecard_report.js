$(document).ready(function () {
    get_rural_npd_tb();
});

function get_rural_npd_tb() {
    var example = $('#rural_npd_tb').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'scorecard/ScoreCardController/get_rural_npd_details',
            'data': function (d) {
                // d.from_date =$('#from_date').val();
            }
        },
        "columns": [ 
            { "data": "header" },
            { "data": "day1_tar" },
            { "data": "day2_tar" },
            { "data": "day3_tar" },
            { "data": "day4_tar" },
            { "data": "day5_tar" },
            { "data": "day6_tar" },
            { "data": "day7_tar" },
            { "data": "day1_act" },
            { "data": "day2_act" },
            { "data": "day3_act" },
            { "data": "day4_act" },
            { "data": "day5_act" },
            { "data": "day6_act" },
            { "data": "day7_act" },
        ],
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Applies the option to all columns
        ],
        // "order": [
        //     [1, 'asc']
        // ]
    });

}