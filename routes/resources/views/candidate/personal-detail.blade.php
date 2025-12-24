@extends('master')
@section('css')
    <link href="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        a[aria-disabled="true"] {
            color: gray;
            pointer-events: none;
            text-decoration: none;
        }
        .info-label {
            color: #7e8299;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .info-value {
            color: #181c32;
            font-weight: 500;
            font-size: 1rem;
        }
        .section-divider {
            border-top: 1px dashed #e4e6ef;
            margin: 1.5rem 0;
        }
    </style>
@endsection

@section('role_user', 'Hospital Account')
@section('main-title', 'Application Details')
@section('sub-title', 'View Application Information')

@section('content')
    <!--begin::Toolbar-->
    <div class="d-flex flex-wrap flex-stack mb-6">
        <h3 class="fw-bold my-2">Application Information
            <span class="fs-6 text-gray-500 fw-semibold ms-1">Complete Profile</span>
        </h3>
        <div class="d-flex flex-wrap my-2">
            <button class="btn btn-sm btn-primary me-3">
                <i class="ki-duotone ki-printer fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
                Print
            </button>
            <button class="btn btn-sm btn-light-primary">
                <i class="ki-duotone ki-file-down fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                Export PDF
            </button>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    <i class="ki-duotone ki-profile-circle fs-1 text-primary me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Personal Information
                </h3>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Content-->
        <div class="card-body border-top p-9">
            <div class="row mb-7">
                <label class="col-lg-4 info-label">Full Name</label>
                <div class="col-lg-8">
                    <span class="info-value">Marwan Mohammed Saleh Elkhoudary</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Mission Applied For</label>
                <div class="col-lg-8">
                    <span class="badge badge-light-primary fs-7 fw-bold">Gaza #1</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Role</label>
                <div class="col-lg-8">
                    <span class="info-value">Orthopedic Surgeon</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Specialization</label>
                <div class="col-lg-8">
                    <span class="info-value">Orthopedic Surgery</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Contact Phone</label>
                <div class="col-lg-8">
                    <span class="info-value">
                        <i class="ki-duotone ki-phone fs-5 text-primary me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        001 3276 454 935
                    </span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Gender</label>
                <div class="col-lg-8">
                    <span class="info-value">Male</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Date of Birth</label>
                <div class="col-lg-8">
                    <span class="info-value">19/12/1986 (38 years old)</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Nationality</label>
                <div class="col-lg-8">
                    <span class="info-value">Egyptian</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Current Address</label>
                <div class="col-lg-8">
                    <span class="info-value">
                        <i class="ki-duotone ki-geolocation fs-5 text-primary me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Egypt - Cairo City
                    </span>
                </div>
            </div>

            <div class="row mb-0">
                <label class="col-lg-4 info-label">Languages Spoken</label>
                <div class="col-lg-8">
                    <span class="badge badge-light me-2">Arabic</span>
                    <span class="badge badge-light me-2">English</span>
                    <span class="badge badge-light">French</span>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

    <!--begin::Academic Qualifications-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    <i class="ki-duotone ki-award fs-1 text-success me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Academic Qualifications
                </h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <div class="row mb-7">
                <label class="col-lg-4 info-label">Highest Academic Qualification</label>
                <div class="col-lg-8">
                    <span class="info-value">Master's Degree in Orthopedic Surgery</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Granting University</label>
                <div class="col-lg-8">
                    <span class="info-value">Cairo University Medical School</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Degree Granting Country</label>
                <div class="col-lg-8">
                    <span class="info-value">Egypt</span>
                </div>
            </div>

            <div class="row mb-0">
                <label class="col-lg-4 info-label">Date of Graduation</label>
                <div class="col-lg-8">
                    <span class="info-value">June 15, 2015</span>
                </div>
            </div>
        </div>
    </div>
    <!--end::Academic Qualifications-->

    <!--begin::Professional Experience-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    <i class="ki-duotone ki-brifecase-tick fs-1 text-info me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Professional Experience
                </h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <div class="row mb-7">
                <label class="col-lg-4 info-label">Years of Clinical Experience</label>
                <div class="col-lg-8">
                    <span class="badge badge-light-success fs-7 fw-bold">9 Years</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Previous Employers</label>
                <div class="col-lg-8">
                    <div class="info-value">
                        <div class="mb-2">• Cairo General Hospital (2015-2018)</div>
                        <div class="mb-2">• Al-Salam Medical Center (2018-2020)</div>
                        <div>• International Medical Corps (2020-Present)</div>
                    </div>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Countries Previously Served In</label>
                <div class="col-lg-8">
                    <span class="badge badge-light me-2">Egypt</span>
                    <span class="badge badge-light me-2">Jordan</span>
                    <span class="badge badge-light me-2">Lebanon</span>
                    <span class="badge badge-light">Turkey</span>
                </div>
            </div>

            <div class="section-divider"></div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Disaster/Emergency Experience</label>
                <div class="col-lg-8">
                    <span class="badge badge-light-success me-2">
                        <i class="ki-duotone ki-check-circle fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Yes
                    </span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Disaster Experience Details</label>
                <div class="col-lg-8">
                    <div class="info-value bg-light-primary p-4 rounded">
                        Worked with Doctors Without Borders in earthquake response in Turkey (2023), providing emergency surgical care for 6 months. Also participated in flood relief operations in Sudan (2022) for 3 months, performing trauma surgeries and training local medical staff.
                    </div>
                </div>
            </div>

            <div class="section-divider"></div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Volunteer Work Experience</label>
                <div class="col-lg-8">
                    <span class="badge badge-light-success">
                        <i class="ki-duotone ki-check-circle fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Yes
                    </span>
                </div>
            </div>

            <div class="row mb-0">
                <label class="col-lg-4 info-label">Volunteer Experience Details</label>
                <div class="col-lg-8">
                    <div class="info-value bg-light-info p-4 rounded">
                        Volunteered with Red Crescent Society in Egypt (2016-2018), providing free medical consultations and surgeries for underprivileged communities. Led medical camps in rural areas reaching over 500 patients annually.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Professional Experience-->

    <!--begin::Gaza Experience-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    <i class="ki-duotone ki-map fs-1 text-warning me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Gaza Experience
                </h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <div class="row mb-7">
                <label class="col-lg-4 info-label">Previously Visited Gaza</label>
                <div class="col-lg-8">
                    <span class="badge badge-light-success">
                        <i class="ki-duotone ki-check-circle fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Yes
                    </span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Place of Work During Previous Visit</label>
                <div class="col-lg-8">
                    <span class="info-value">Al-Shifa Hospital, Gaza City</span>
                </div>
            </div>

            <div class="row mb-0">
                <label class="col-lg-4 info-label">Doctors Worked With</label>
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-150px">Doctor Name</th>
                                <th class="min-w-120px">Last Visit Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <span class="text-gray-800 fw-bold">Dr. Ahmed Hassan</span>
                                </td>
                                <td>
                                    <span class="text-gray-600">March 15, 2023</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="text-gray-800 fw-bold">Dr. Fatima Al-Najjar</span>
                                </td>
                                <td>
                                    <span class="text-gray-600">March 15, 2023</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="text-gray-800 fw-bold">Dr. Mohammed Abu Sittah</span>
                                </td>
                                <td>
                                    <span class="text-gray-600">April 10, 2023</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Gaza Experience-->

    <!--begin::Academic Contributions-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    <i class="ki-duotone ki-book fs-1 text-danger me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                    Academic & Research Contributions
                </h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <div class="row mb-7">
                <label class="col-lg-4 info-label">Educational Contributions</label>
                <div class="col-lg-8">
                    <div class="info-value bg-light-success p-4 rounded">
                        Conducted surgical training workshops for 50 medical staff in 2023, led emergency response training in Gaza. Developed training curriculum for orthopedic trauma management adopted by 3 regional hospitals.
                    </div>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Published Scientific Papers</label>
                <div class="col-lg-8">
                    <div class="info-value">
                        <div class="bg-light p-4 rounded mb-3">
                            <div class="fw-bold text-gray-800 mb-1">"Advanced Trauma Management in Resource-Limited Settings"</div>
                            <div class="text-muted fs-7">Journal of Orthopedic Surgery (2023)</div>
                        </div>
                        <div class="bg-light p-4 rounded">
                            <div class="fw-bold text-gray-800 mb-1">"Emergency Response Protocols for Mass Casualty Events"</div>
                            <div class="text-muted fs-7">Global Health Review (2024)</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <label class="col-lg-4 info-label">Conference Participation</label>
                <div class="col-lg-8">
                    <div class="info-value">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bullet bullet-vertical h-40px bg-primary me-3"></span>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold d-block">International Orthopedic Conference 2023</span>
                                <span class="text-muted fs-7">Presenter - Dubai, UAE</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <span class="bullet bullet-vertical h-40px bg-success me-3"></span>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold d-block">Emergency Medicine Workshop 2022</span>
                                <span class="text-muted fs-7">Participant - Cairo, Egypt</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="bullet bullet-vertical h-40px bg-info me-3"></span>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold d-block">Medical Humanitarian Response Summit 2024</span>
                                <span class="text-muted fs-7">Speaker - Istanbul, Turkey</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Academic Contributions-->

    <!--begin::Uploaded Documents-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    <i class="ki-duotone ki-file fs-1 text-primary me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Uploaded Documents
                </h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-file-down fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            CV_Marwan_Elkhoudary.pdf
                        </a>
                        <a href="#" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-file-down fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Medical_License.pdf
                        </a>
                        <a href="#" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-file-down fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Masters_Certificate.pdf
                        </a>
                        <a href="#" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-file-down fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Recommendation_Letter.pdf
                        </a>
                        <a href="#" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-file-down fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Passport_Copy.pdf
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Uploaded Documents-->

    <!--begin::Actions-->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted">Application submitted on:</span>
                    <span class="fw-bold ms-2">December 10, 2024</span>
                </div>
                <div class="d-flex gap-3">
                    <button class="btn btn-light-danger">
                        <i class="ki-duotone ki-cross-circle fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Reject Application
                    </button>
                    <button class="btn btn-success">
                        <i class="ki-duotone ki-check-circle fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Approve Application
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Actions-->

@endsection

@section('script')
    <script src="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.js"></script>
@endsection
