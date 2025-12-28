@extends('unauthorized.index')

@section('title', 'Mission Details')

@section('css')
    <style>
        .mission-detail-card {
            transition: all 0.3s ease;
        }

        .mission-detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .info-label {
            font-weight: 600;
            color: #5E6278;
            margin-bottom: 0.25rem;
        }

        .info-value {
            color: #181C32;
            font-size: 1rem;
        }

        .badge-custom {
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            border-radius: 0.475rem;
        }

        .requirement-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 0.375rem;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin: 0.25rem;
        }
    </style>
@endsection

@section('content')
    <!--begin::Main Container-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Mission Details
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('calendar') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Mission #{{ $mission->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <!--begin::Mission Header Card-->
                <div class="card mission-detail-card mb-8">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title flex-column">
                            <h2 class="fw-bold mb-3">Mission #{{ $mission->id }}</h2>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light-primary badge-custom me-3">
                                    <i class="ki-duotone ki-calendar fs-4 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ \Carbon\Carbon::parse($mission->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($mission->end_date)->format('d M Y') }}
                                </span>
                                @if($mission->hospital)
                                    <span class="badge badge-light-info badge-custom">
                                        <i class="ki-duotone ki-hospital fs-4 me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        {{ $mission->hospital->name }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="row g-5">
                            <!--begin::Mission Info-->
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="info-label">Contact Person</label>
                                    <div class="info-value">{{ $mission->contact_name ?? 'N/A' }}</div>
                                </div>

                                <div class="mb-5">
                                    <label class="info-label">Contact Phone</label>
                                    <div class="info-value">{{ $mission->contact_phone ?? 'N/A' }}</div>
                                </div>

                                @if($mission->target)
                                    <div class="mb-5">
                                        <label class="info-label">Target</label>
                                        <div class="info-value">{{ $mission->target->name }}</div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="info-label">Start Date</label>
                                    <div class="info-value">{{ \Carbon\Carbon::parse($mission->start_date)->format('d M Y, h:i A') }}</div>
                                </div>

                                <div class="mb-5">
                                    <label class="info-label">End Date</label>
                                    <div class="info-value">{{ \Carbon\Carbon::parse($mission->end_date)->format('d M Y, h:i A') }}</div>
                                </div>

                                <div class="mb-5">
                                    <label class="info-label">Duration</label>
                                    <div class="info-value">
                                        {{ \Carbon\Carbon::parse($mission->start_date)->diffInDays(\Carbon\Carbon::parse($mission->end_date)) }} days
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Mission Header Card-->

                <!--begin::Medical Needs Card-->
                @if($mission->medicalNeeds && $mission->medicalNeeds->count() > 0)
                    <div class="card mission-detail-card mb-8">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title fw-bold">
                                <i class="ki-duotone ki-user-tick fs-2 text-primary me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                Required Medical Staff
                            </h3>
                        </div>

                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-4">
                                    <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-200px rounded-start">Staff Type</th>
                                        <th class="min-w-200px">Specialization</th>
                                        <th class="min-w-100px text-center rounded-end">Required Count</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mission->medicalNeeds as $need)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="badge badge-light-primary fs-6">
                                                    {{ $need->specialization->humanType->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-gray-800 fw-semibold">
                                                    {{ $need->specialization->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-light-success fs-5">
                                                    {{ $need->pivot->count ?? 'N/A' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                <!--end::Medical Needs Card-->

                <!--begin::Requirements Card-->
                @if($mission->requirementNeeds && $mission->requirementNeeds->count() > 0)
                    <div class="card mission-detail-card mb-8">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title fw-bold">
                                <i class="ki-duotone ki-file-added fs-2 text-success me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Mission Requirements
                            </h3>
                        </div>

                        <div class="card-body pt-0">
                            <div class="d-flex flex-wrap">
                                @foreach($mission->requirementNeeds as $requirement)
                                    <span class="requirement-badge">
                                        <i class="ki-duotone ki-check-circle fs-5 me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        {{ $requirement->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <!--end::Requirements Card-->

                <!--begin::Notice Card-->
                <div class="card bg-light-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-information-5 fs-3x text-info me-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <div>
                                <h4 class="text-info mb-2">Information Notice</h4>
                                <p class="text-gray-700 mb-0">
                                    This mission is only available for health staff members (Doctors, Nurses, Technicians).
                                    If you are health staff and want to apply, please register or login with a health staff account.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Notice Card-->

                <!--begin::Back Button-->
                <div class="mt-8 text-center">
                    <a href="{{ route('calendar') }}" class="btn btn-lg btn-light-primary">
                        <i class="ki-duotone ki-arrow-left fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Back to Calendar
                    </a>
                </div>
                <!--end::Back Button-->

            </div>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Main Container-->
@endsection

@section('script')
@endsection
