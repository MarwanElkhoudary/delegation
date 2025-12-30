"use strict";
// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt
    // Private functions

    var initDatatable = function () {

        dt = $("#kt_ecommerce_report_sales_table").DataTable({
            // responsive: true,
            // searchDelay: 500,
            // processing: true,
            // serverSide: true,
            // order: [[5, 'desc']],
            // stateSave: true,
            // dom: 'Bftip',
            buttons: [
                'excel'
            ],

            ajax: {
                url: BASE_URL + '/missions/list',
                type:'POST',
                data : {"_token": TOKEN},
            },
            columns: [
                { data: 'id' },
                { data: 'id' },
                { data: 'hospital' },
                { data: 'target' },
                { data: 'priority' },
                { data: 'requestTarget' },
                { data: 'contact_name' },
                { data: 'contact_phone' },
                { data: 'start_date' },
                { data: 'end_date' },
                // { data: 'status' },
                { data: 'status_international' },
                // { data: 'medicalNeeds' },
            ],

            columnDefs: [

                {
                    targets: 2,
                    render: function (data, type, row) {

                        return `
                            <a href="`+ BASE_URL+`/missions/view_mission/`+row.id+`" class="text-gray-800 text-hover-primary mb-1" >`
                            +data+
                            `</a>
                            <!--end::Menu-->
                        `;
                    },
                },
                {
                    "targets": 4,
                    "className": 'text-end',
                    "render": function ( data, type, row ) {

                        switch ( data ) {
                            case 'low':
                                return '<span class="badge badge-light-warning">' + data + '</span>';
                            case 'medium':
                                return '<span class="badge badge-light-success">' + data + '</span>';
                            case 'high':
                                return '<span class="badge badge-light-danger">' + data + '</span>';
                            default: return '<span class="badge badge badge-light-warning">' + data + '</span>';
                        }

                    },


                },
                {
                    "targets": 10,
                    "className": 'text-end',

                    "render": function ( data, type, row ) {
                        switch (data) {
                            case 'Approved':
                                return '<span class="badge badge-light-success" data-bs-toggle="tooltip" data-bs-placement="top" '+ (row.note != null ? 'title="'+row.note +'"' : '') + '>' + data + '</span>';
                            case 'Reference':
                                return '<span class="badge badge-light-danger" data-bs-toggle="tooltip" data-bs-placement="top" '+ (row.note != null ? 'title="'+row.note +'"' : '') + '>' + data + '</span>';
                            case 'Under Review':
                                return '<span class="badge badge-light-info" data-bs-toggle="tooltip" data-bs-placement="top" '+ (row.note != null ? 'title="'+row.note +'"' : '') + '>' + data + '</span>';
                            case 'null':
                                return '<span class="badge badge-light-warning" data-bs-toggle="tooltip" data-bs-placement="top" '+ (row.note != null ? 'title="'+row.note +'"' : '') + '>' + data + '</span>';
                            // case 'Completed':
                            //     return '<span class="badge badge-light-success" data-bs-toggle="tooltip" data-bs-placement="top" '+ (row.note != null ? 'title="'+row.note +'"' : '') + '>' + data + '</span>';
                            // case 'Approved':
                            //     return '<span class="badge badge-light-warning" data-bs-toggle="tooltip" data-bs-placement="top" '+ (row.note != null ? 'title="'+row.note +'"' : '') + '>' + data + '</span>';
                        }

                    },

                }

            ],
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            KTMenu.createInstances();
        });
    }


    // Public methods
    return {
        init: function () {
            initDatatable();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
