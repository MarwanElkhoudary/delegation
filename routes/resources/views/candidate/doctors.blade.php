@extends('master')
@section('css')
    <link href="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        a[aria-disabled="true"] {
            color: gray;
            pointer-events: none;
            text-decoration: none;
        }

        .candidate-card {
            transition: all 0.3s ease;
            border: 1px solid #e4e6ef;
        }

        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .status-indicator {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid #fff;
        }

        .info-badge {
            background: #f1f3f8;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.2s ease;
        }

        .info-badge:hover {
            background: #e8eaf6;
            transform: scale(1.05);
        }

        .symbol-label-custom {
            font-size: 1.5rem;
            font-weight: 700;
        }
    </style>
@endsection

@section('role_user', 'Hospital Account')
@section('main-title', 'Candidates')
@section('sub-title', 'Browse All Candidates')

@section('content')
    <!--begin::Toolbar-->
    <div class="d-flex flex-wrap flex-stack mb-6">
        <h3 class="fw-bold my-2">All Candidates
            <span class="fs-6 text-gray-500 fw-semibold ms-1">(45 Total)</span>
        </h3>

        <div class="d-flex flex-wrap my-2">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative me-4">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" class="form-control form-control-solid w-250px ps-12" placeholder="Search candidates..." />
            </div>
            <!--end::Search-->

            <!--begin::Filter-->
            <select class="form-select form-select-solid w-150px" data-control="select2" data-placeholder="Filter by">
                <option></option>
                <option value="1">All Specializations</option>
                <option value="2">General Surgery</option>
                <option value="3">Orthopedic Surgery</option>
                <option value="4">Pediatrics</option>
                <option value="5">Emergency Medicine</option>
            </select>
            <!--end::Filter-->
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Row-->
    <div class="row g-6 g-xl-9">
        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <div class="card candidate-card">
                <div class="card-body d-flex flex-center flex-column p-9">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                        <span class="symbol-label symbol-label-custom bg-light-primary text-primary">MW</span>
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <!--end::Avatar-->

                    <!--begin::Name-->
                    <a href="{{ route('candidate.personalDetail') }}" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                        Marwan Elkhoudary
                    </a>
                    <!--end::Name-->

                    <!--begin::Position-->
                    <div class="fs-5 fw-semibold text-muted mb-6">Orthopedic Surgeon</div>
                    <!--end::Position-->

                    <!--begin::Info-->
                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-4 text-primary me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">Egypt</span>
                        </div>

                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-phone fs-4 text-primary me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">+20-156-8555</span>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <span class="badge badge-light-success">9 Years Exp.</span>
                        <span class="badge badge-light-info">Available</span>
                    </div>
                    <!--end::Info-->

                    <!--begin::Actions-->
                    <a href="{{ route('candidate.personalDetail') }}" class="btn btn-sm btn-primary w-100">
                        <i class="ki-duotone ki-eye fs-4 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View Profile
                    </a>
                    <!--end::Actions-->
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <div class="card candidate-card">
                <div class="card-body d-flex flex-center flex-column p-9">
                    <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                        <span class="symbol-label symbol-label-custom bg-light-success text-success">SA</span>
                        <div class="status-indicator bg-success"></div>
                    </div>

                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                        Sarah Ahmed
                    </a>

                    <div class="fs-5 fw-semibold text-muted mb-6">Pediatric Specialist</div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-4 text-success me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">Jordan</span>
                        </div>

                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-phone fs-4 text-success me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">+962-789-1234</span>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <span class="badge badge-light-success">12 Years Exp.</span>
                        <span class="badge badge-light-info">Available</span>
                    </div>

                    <a href="#" class="btn btn-sm btn-primary w-100">
                        <i class="ki-duotone ki-eye fs-4 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <div class="card candidate-card">
                <div class="card-body d-flex flex-center flex-column p-9">
                    <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                        <span class="symbol-label symbol-label-custom bg-light-warning text-warning">AH</span>
                        <div class="status-indicator bg-warning"></div>
                    </div>

                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                        Ahmed Hassan
                    </a>

                    <div class="fs-5 fw-semibold text-muted mb-6">General Surgery</div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-4 text-warning me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">Lebanon</span>
                        </div>

                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-phone fs-4 text-warning me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">+961-3-456789</span>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <span class="badge badge-light-success">8 Years Exp.</span>
                        <span class="badge badge-light-warning">Busy</span>
                    </div>

                    <a href="#" class="btn btn-sm btn-primary w-100">
                        <i class="ki-duotone ki-eye fs-4 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <div class="card candidate-card">
                <div class="card-body d-flex flex-center flex-column p-9">
                    <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                        <span class="symbol-label symbol-label-custom bg-light-info text-info">FN</span>
                        <div class="status-indicator bg-success"></div>
                    </div>

                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                        Fatima Al-Najjar
                    </a>

                    <div class="fs-5 fw-semibold text-muted mb-6">Emergency Medicine</div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-4 text-info me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">Palestine</span>
                        </div>

                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-phone fs-4 text-info me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">+970-59-2345678</span>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <span class="badge badge-light-success">15 Years Exp.</span>
                        <span class="badge badge-light-info">Available</span>
                    </div>

                    <a href="#" class="btn btn-sm btn-primary w-100">
                        <i class="ki-duotone ki-eye fs-4 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <div class="card candidate-card">
                <div class="card-body d-flex flex-center flex-column p-9">
                    <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                        <span class="symbol-label symbol-label-custom bg-light-danger text-danger">KM</span>
                        <div class="status-indicator bg-success"></div>
                    </div>

                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                        Khaled Mahmoud
                    </a>

                    <div class="fs-5 fw-semibold text-muted mb-6">Cardiology</div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-4 text-danger me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">Syria</span>
                        </div>

                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-phone fs-4 text-danger me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">+963-11-3456789</span>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <span class="badge badge-light-success">11 Years Exp.</span>
                        <span class="badge badge-light-info">Available</span>
                    </div>

                    <a href="#" class="btn btn-sm btn-primary w-100">
                        <i class="ki-duotone ki-eye fs-4 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <div class="card candidate-card">
                <div class="card-body d-flex flex-center flex-column p-9">
                    <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                        <span class="symbol-label symbol-label-custom bg-light-primary text-primary">LK</span>
                        <div class="status-indicator bg-danger"></div>
                    </div>

                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                        Layla Khalil
                    </a>

                    <div class="fs-5 fw-semibold text-muted mb-6">Anesthesiology</div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-4 text-primary me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">UAE</span>
                        </div>

                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-phone fs-4 text-primary me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">+971-50-1234567</span>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <span class="badge badge-light-success">7 Years Exp.</span>
                        <span class="badge badge-light-danger">Not Available</span>
                    </div>

                    <a href="#" class="btn btn-sm btn-primary w-100">
                        <i class="ki-duotone ki-eye fs-4 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <div class="card candidate-card">
                <div class="card-body d-flex flex-center flex-column p-9">
                    <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                        <span class="symbol-label symbol-label-custom bg-light-success text-success">OA</span>
                        <div class="status-indicator bg-success"></div>
                    </div>

                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                        Omar Abdullah
                    </a>

                    <div class="fs-5 fw-semibold text-muted mb-6">Neurosurgery</div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-4 text-success me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">Turkey</span>
                        </div>

                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-phone fs-4 text-success me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">+90-555-123-4567</span>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <span class="badge badge-light-success">14 Years Exp.</span>
                        <span class="badge badge-light-info">Available</span>
                    </div>

                    <a href="#" class="btn btn-sm btn-primary w-100">
                        <i class="ki-duotone ki-eye fs-4 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <div class="card candidate-card">
                <div class="card-body d-flex flex-center flex-column p-9">
                    <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                        <span class="symbol-label symbol-label-custom bg-light-warning text-warning">RY</span>
                        <div class="status-indicator bg-success"></div>
                    </div>

                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                        Rana Youssef
                    </a>

                    <div class="fs-5 fw-semibold text-muted mb-6">Obstetrics & Gynecology</div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-4 text-warning me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">Saudi Arabia</span>
                        </div>

                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-phone fs-4 text-warning me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">+966-50-1234567</span>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <span class="badge badge-light-success">10 Years Exp.</span>
                        <span class="badge badge-light-info">Available</span>
                    </div>

                    <a href="#" class="btn btn-sm btn-primary w-100">
                        <i class="ki-duotone ki-eye fs-4 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <div class="card candidate-card">
                <div class="card-body d-flex flex-center flex-column p-9">
                    <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                        <span class="symbol-label symbol-label-custom bg-light-info text-info">YS</span>
                        <div class="status-indicator bg-warning"></div>
                    </div>

                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                        Yasser Sami
                    </a>

                    <div class="fs-5 fw-semibold text-muted mb-6">Internal Medicine</div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-4 text-info me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">Iraq</span>
                        </div>

                        <div class="info-badge d-flex align-items-center">
                            <i class="ki-duotone ki-phone fs-4 text-info me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-bold text-gray-700 fs-7">+964-770-1234567</span>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap gap-2 mb-7">
                        <span class="badge badge-light-success">6 Years Exp.</span>
                        <span class="badge badge-light-warning">Busy</span>
                    </div>

                    <a href="#" class="btn btn-sm btn-primary w-100">
                        <i class="ki-duotone ki-eye fs-4 me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Pagination-->
    <div class="d-flex flex-stack flex-wrap pt-10">
        <div class="fs-6 fw-semibold text-gray-700">Showing 1 to 9 of 45 entries</div>

        <ul class="pagination">
            <li class="page-item previous disabled">
                <a href="#" class="page-link"><i class="previous"></i></a>
            </li>

            <li class="page-item active">
                <a href="#" class="page-link">1</a>
            </li>

            <li class="page-item">
                <a href="#" class="page-link">2</a>
            </li>

            <li class="page-item">
                <a href="#" class="page-link">3</a>
            </li>

            <li class="page-item">
                <a href="#" class="page-link">4</a>
            </li>

            <li class="page-item">
                <a href="#" class="page-link">5</a>
            </li>

            <li class="page-item next">
                <a href="#" class="page-link"><i class="next"></i></a>
            </li>
        </ul>
    </div>
    <!--end::Pagination-->

@endsection

@section('script')
    <script src="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/apps/ecommerce/reports/sales/sales_1.js"></script>
@endsection

@section('js')
    <script src="{{ asset('assets')  }}/javascript/pages/list-tasks.js"></script>
@endsection
