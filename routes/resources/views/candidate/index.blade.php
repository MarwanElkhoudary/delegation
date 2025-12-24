@extends('master')
@section('css')
    <link href="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        a[aria-disabled="true"] {
            color: gray;
            pointer-events: none;
            text-decoration: none;
        }

        .category-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #3E97FF 0%, #1BC5BD 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-icon-wrapper {
            position: relative;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-icon-wrapper {
            transform: scale(1.1) rotate(5deg);
        }

        .stats-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .trend-indicator {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .trend-up {
            background: #e8fff3;
            color: #50cd89;
        }

        .trend-down {
            background: #fff5f8;
            color: #f1416c;
        }

        .category-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .quick-action-btn {
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            transform: scale(1.05);
        }
    </style>
@endsection

@section('role_user', 'Hospital Account')
@section('main-title', 'Categories')
@section('sub-title', 'Browse All Categories')

@section('content')
    <!--begin::Header-->
    <div class="d-flex flex-wrap flex-stack mb-8">
        <h2 class="fw-bold my-2">
            Medical Staff Categories
            <span class="fs-6 text-gray-500 fw-semibold ms-2">(3 Categories)</span>
        </h2>

{{--        <div class="d-flex my-2">--}}
{{--            <button class="btn btn-sm btn-light-primary me-3">--}}
{{--                <i class="ki-duotone ki-filter fs-3">--}}
{{--                    <span class="path1"></span>--}}
{{--                    <span class="path2"></span>--}}
{{--                </i>--}}
{{--                Filter--}}
{{--            </button>--}}
{{--            <button class="btn btn-sm btn-primary">--}}
{{--                <i class="ki-duotone ki-plus fs-3"></i>--}}
{{--                Add Category--}}
{{--            </button>--}}
{{--        </div>--}}
    </div>
    <!--end::Header-->

    <!--begin::Row-->
    <div class="row g-6 g-xl-9 mb-8">
        <!--begin::Col - Doctors-->
        <div class="col-lg-4 col-md-6">
            <div class="card category-card h-100">
                <!--begin::Card header-->
                <div class="card-header flex-nowrap border-0 pt-9">
                    <div class="card-title m-0">
                        <div class="category-icon-wrapper symbol symbol-50px w-50px bg-light-primary me-4">
                            <i class="ki-duotone ki-user-tick fs-2x text-primary">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </div>
                        <div>
                            <a href="{{ route('candidate.doctors') }}" class="fs-3 fw-bold text-hover-primary text-gray-800">
                                Doctors
                            </a>
                            <div class="fs-7 text-muted fw-semibold mt-1">Medical Physicians</div>
                        </div>
                    </div>

                    <div class="card-toolbar m-0">
                        <button type="button" class="btn btn-sm btn-icon btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-dots-vertical fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </button>

                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Actions</div>
                            </div>
                            <div class="menu-item px-3">
                                <a href="{{ route('candidate.doctors') }}" class="menu-link px-3">
                                    <i class="ki-duotone ki-eye fs-5 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    View All
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">
                                    <i class="ki-duotone ki-file-down fs-5 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Export List
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">
                                    <i class="ki-duotone ki-chart-simple fs-5 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                    View Statistics
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-6 pb-8">
                    <div class="d-flex align-items-center mb-7">
                        <div class="category-number me-auto">48</div>
                        <div class="stats-badge">
                            <i class="ki-duotone ki-check-circle fs-5 me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Active
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-6">
                        <div class="trend-indicator trend-up me-3">
                            <i class="ki-duotone ki-arrow-up fs-4 me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            +40.5%
                        </div>
                        <span class="text-muted fs-7 fw-semibold">vs last month</span>
                    </div>

                    <div class="separator separator-dashed mb-6"></div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-gray-600 fw-semibold">Available:</span>
                        <span class="badge badge-light-success fw-bold">42</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-gray-600 fw-semibold">On Mission:</span>
                        <span class="badge badge-light-warning fw-bold">6</span>
                    </div>

                    <div class="d-flex justify-content-between mb-6">
                        <span class="text-gray-600 fw-semibold">Pending:</span>
                        <span class="badge badge-light-info fw-bold">12</span>
                    </div>

                    <a href="{{ route('candidate.doctors') }}" class="btn btn-primary w-100 quick-action-btn">
                        <i class="ki-duotone ki-eye fs-3 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View All Doctors
                    </a>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Nurses-->
        <div class="col-lg-4 col-md-6">
            <div class="card category-card h-100">
                <div class="card-header flex-nowrap border-0 pt-9">
                    <div class="card-title m-0">
                        <div class="category-icon-wrapper symbol symbol-50px w-50px bg-light-success me-4">
                            <i class="ki-duotone ki-heart-pulse fs-2x text-success">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </div>
                        <div>
                            <a href="#" class="fs-3 fw-bold text-hover-primary text-gray-800">
                                Nurses
                            </a>
                            <div class="fs-7 text-muted fw-semibold mt-1">Healthcare Providers</div>
                        </div>
                    </div>

                    <div class="card-toolbar m-0">
                        <button type="button" class="btn btn-sm btn-icon btn-light-success" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-dots-vertical fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </button>

                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Actions</div>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">
                                    <i class="ki-duotone ki-eye fs-5 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    View All
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">
                                    <i class="ki-duotone ki-file-down fs-5 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Export List
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">
                                    <i class="ki-duotone ki-chart-simple fs-5 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                    View Statistics
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-6 pb-8">
                    <div class="d-flex align-items-center mb-7">
                        <div class="category-number me-auto">63</div>
                        <div class="stats-badge">
                            <i class="ki-duotone ki-check-circle fs-5 me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Active
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-6">
                        <div class="trend-indicator trend-up me-3">
                            <i class="ki-duotone ki-arrow-up fs-4 me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            +17.62%
                        </div>
                        <span class="text-muted fs-7 fw-semibold">vs last month</span>
                    </div>

                    <div class="separator separator-dashed mb-6"></div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-gray-600 fw-semibold">Available:</span>
                        <span class="badge badge-light-success fw-bold">58</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-gray-600 fw-semibold">On Mission:</span>
                        <span class="badge badge-light-warning fw-bold">5</span>
                    </div>

                    <div class="d-flex justify-content-between mb-6">
                        <span class="text-gray-600 fw-semibold">Pending:</span>
                        <span class="badge badge-light-info fw-bold">8</span>
                    </div>

                    <a href="#" class="btn btn-success w-100 quick-action-btn">
                        <i class="ki-duotone ki-eye fs-3 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View All Nurses
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Others-->
        <div class="col-lg-4 col-md-6">
            <div class="card category-card h-100">
                <div class="card-header flex-nowrap border-0 pt-9">
                    <div class="card-title m-0">
                        <div class="category-icon-wrapper symbol symbol-50px w-50px bg-light-warning me-4">
                            <i class="ki-duotone ki-profile-user fs-2x text-warning">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </div>
                        <div>
                            <a href="#" class="fs-3 fw-bold text-hover-primary text-gray-800">
                                Others
                            </a>
                            <div class="fs-7 text-muted fw-semibold mt-1">Support Staff</div>
                        </div>
                    </div>

                    <div class="card-toolbar m-0">
                        <button type="button" class="btn btn-sm btn-icon btn-light-warning" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-dots-vertical fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </button>

                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Actions</div>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">
                                    <i class="ki-duotone ki-eye fs-5 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    View All
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">
                                    <i class="ki-duotone ki-file-down fs-5 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Export List
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">
                                    <i class="ki-duotone ki-chart-simple fs-5 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                    View Statistics
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-6 pb-8">
                    <div class="d-flex align-items-center mb-7">
                        <div class="category-number me-auto">28</div>
                        <div class="stats-badge">
                            <i class="ki-duotone ki-check-circle fs-5 me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Active
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-6">
                        <div class="trend-indicator trend-up me-3">
                            <i class="ki-duotone ki-arrow-up fs-4 me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            +10.45%
                        </div>
                        <span class="text-muted fs-7 fw-semibold">vs last month</span>
                    </div>

                    <div class="separator separator-dashed mb-6"></div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-gray-600 fw-semibold">Available:</span>
                        <span class="badge badge-light-success fw-bold">24</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-gray-600 fw-semibold">On Mission:</span>
                        <span class="badge badge-light-warning fw-bold">4</span>
                    </div>

                    <div class="d-flex justify-content-between mb-6">
                        <span class="text-gray-600 fw-semibold">Pending:</span>
                        <span class="badge badge-light-info fw-bold">5</span>
                    </div>

                    <a href="#" class="btn btn-warning w-100 quick-action-btn">
                        <i class="ki-duotone ki-eye fs-3 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View All Staff
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Summary Card-->
    <div class="card mb-6">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center">
                <div class="flex-grow-1 me-5">
                    <h3 class="fw-bold mb-2">Total Staff Overview</h3>
                    <p class="text-muted mb-0">Complete statistics across all categories</p>
                </div>

                <div class="d-flex flex-wrap gap-5">
                    <div class="border border-dashed border-gray-300 rounded px-6 py-4 text-center">
                        <div class="fs-1 fw-bold text-primary mb-1">139</div>
                        <div class="fs-7 text-muted fw-semibold">Total Members</div>
                    </div>

                    <div class="border border-dashed border-gray-300 rounded px-6 py-4 text-center">
                        <div class="fs-1 fw-bold text-success mb-1">124</div>
                        <div class="fs-7 text-muted fw-semibold">Available</div>
                    </div>

                    <div class="border border-dashed border-gray-300 rounded px-6 py-4 text-center">
                        <div class="fs-1 fw-bold text-warning mb-1">15</div>
                        <div class="fs-7 text-muted fw-semibold">On Mission</div>
                    </div>

                    <div class="border border-dashed border-gray-300 rounded px-6 py-4 text-center">
                        <div class="fs-1 fw-bold text-info mb-1">25</div>
                        <div class="fs-7 text-muted fw-semibold">Pending</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Summary Card-->

@endsection

@section('script')
    <script src="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/apps/ecommerce/reports/sales/sales_1.js"></script>
@endsection

@section('js')
    <script src="{{ asset('assets')  }}/javascript/pages/list-tasks.js"></script>
@endsection
