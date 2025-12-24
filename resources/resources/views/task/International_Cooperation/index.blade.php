@extends('master')
@section('css')
    <link href="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

@endsection
@section('role_user', 'International Cooperation Account')
@section('main-title', 'Missions')
@section('sub-title', 'Show Missions')
@section('content')
    <!--begin::Toolbar-->
    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">

        <!--begin::Add customer-->
        {{--        <a href="{{url('tasks/add')}}" class="btn btn-primary" data-bs-toggle="add new task">--}}
        {{--            <i class="ki-duotone ki-plus fs-2"></i>--}}
        {{--            Add Task--}}
        {{--        </a>--}}
        <!--end::Add customer-->
    </div>
    <!--end::Toolbar-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Card-->

        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                        <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Missions" />
                        <div id="kt_ecommerce_report_sales_export" class="d-none"></div>

                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <!--begin::Export dropdown-->
                        <form action="{{route('task.export')}}" method="GET">
                            <button type="submit" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
                                Export Report
                            </button>
                        </form>

                        <!--begin::Menu-->
                        <div id="kt_ecommerce_report_sales_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="copy">
                                    Copy to clipboard
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="excel">
                                    Export as Excel
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="csv">
                                    Export as CSV
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                    Export as PDF
                                </a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--end::Export dropdown-->

                        <!--begin::Hide default export buttons-->
                        <div id="kt_datatable_example_buttons" class="d-none"></div>
                    </div>
                    <!--end::Toolbar-->



                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                        <div class="fw-bold me-5">
                            <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
                        <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
                    </div>
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_report_sales_table">
                    <thead>
                    <tr class="fw-semibold fs-6 text-gray-800">
                        <th class="min-w-50px" data-priority="2">#</th>
                        <th class="min-w-50px" >Mission ID</th>
                        <th class="min-w-50px" >Hospital Name</th>
                        <th class="min-w-150px">Specialization</th>
                        <th class="min-w-70px">Priority</th>
                        <th class="min-w-150px">Target Specialization</th>
                        <th class="min-w-150px">Contact Name</th>
                        <th class="min-w-150px">Contact Phone</th>
                        <th  class="min-w-150px">Start Date</th>
                        <th  class="min-w-150px">End Date</th>
                        <th class="min-w-120px">Status</th>
                    </tr>

                    </thead>
                    <tbody class="fw-semibold text-gray-600">

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

    </div>

@endsection
@section('script')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets')  }}/js/custom/apps/ecommerce/reports/sales/sales_1.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Custom Javascript-->
@endsection

@section('js')
    <script src="{{ asset('assets')  }}/javascript/pages/International_Cooperation/list-tasks.js"></script>
@endsection


