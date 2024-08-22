$(document).ready(function () {
    get_slub_data();
});

function get_slub_data() {
    var example = $('#slab_table').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'incentive/SdeIncentive/get_slub_datas',
            'data': function (d) {

            }
        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },

            { "data": "parameters" },
            { "data": "slabs" },
            { "data": "amount" },
            { "data": "measurement" },
            // { "data": "remarks" },
        ],
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Applies the option to all columns
        ],
        "order": [
            [1, 'asc']
        ]
    });

}
