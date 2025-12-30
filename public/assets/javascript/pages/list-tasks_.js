console.log(
    'sfsfsfjlkjkljkdlgs'
)
"use strict";

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;

    // Private functions
    var initDatatable = function () {
        dt = $("#tasks_datatable").DataTable({
            // responsive: true,
            // searchDelay: 500,
            // processing: true,
            // serverSide: true,
            // order: [[5, 'desc']],
            // stateSave: true,
            ajax: {
                url: BASE_URL + '/missions/list',
                type:'POST',
                data : {"_token": TOKEN},
            },
            columns: [
                { data: 'id' },
                { data: 'id' },
                { data: 'target' },
                { data: 'priority' },
                { data: 'requestTarget' },
                { data: 'contact_name' },
                { data: 'contact_phone' },
                { data: 'start_date' },
                { data: 'end_date' },
                { data: 'status' },
                // { data: 'medicalNeeds' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon fs-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="`+BASE_URL+`/missions/delete_mission/`+row.id+`" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
                {
                    targets: 0,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
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
                    "targets": 3,
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
                    "targets": 9,
                    "className": 'text-end',

                    "render": function ( data, type, row ) {

                        switch ( data ) {
                            case 'Recently':
                                return '<span class="badge badge-light-primary">' + data + '</span>';
                            case 'Suspended':
                                return '<span class="badge badge-light-info">' + data + '</span>';
                            case 'Canceled':
                                return '<span class="badge badge-light-danger">' + data + '</span>';
                            case 'Completed':
                                return '<span class="badge badge-light-success">' + data + '</span>';
                            default: return '<span class="badge badge-light-warning">' + data + '</span>';
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
