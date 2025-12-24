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
            height: 100%;
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

        .filter-card {
            background: #f9f9f9;
            border: 1px solid #e4e6ef;
        }
    </style>
@endsection

@section('role_user', 'Hospital Account')
@section('main-title', 'Health Staff')
@section('sub-title', 'Browse All Applications')

@section('content')
    <!--begin::Filter Card-->
    <div class="card filter-card mb-6">
        <div class="card-body">
            <form method="GET" action="{{ route('health_staff.doctors') }}" id="filterForm">
                <div class="row g-3 align-items-end">
                    <!--begin::Search-->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Search</label>
                        <div class="position-relative">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3 mt-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" name="search" class="form-control form-control-solid ps-12"
                                   placeholder="Search by name..." value="{{ request('search') }}" />
                        </div>
                    </div>
                    <!--end::Search-->

                    <!--begin::Status Filter-->
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select form-select-solid">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <!--end::Status Filter-->

                    <!--begin::Human Type Filter-->
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Type</label>
                        <select name="human_type" class="form-select form-select-solid">
                            <option value="">All Types</option>
                            @foreach($humanTypes as $type)
                                <option value="{{ $type->id }}" {{ request('human_type') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Human Type Filter-->

                    <!--begin::Task Filter-->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Mission</label>
                        <select name="task" class="form-select form-select-solid">
                            <option value="">All Missions</option>
                            @foreach($tasks as $task)
                                <option value="{{ $task->id }}" {{ request('task') == $task->id ? 'selected' : '' }}>
                                    Mission #{{ $task->id }} - {{ \Carbon\Carbon::parse($task->start_date)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Task Filter-->

                    <!--begin::Buttons-->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ki-duotone ki-filter fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Filter
                        </button>
                    </div>
                    <!--end::Buttons-->
                </div>

                <!--begin::Active Filters-->
                @if(request()->hasAny(['search', 'status', 'human_type', 'task']))
                    <div class="d-flex align-items-center mt-4 pt-4 border-top border-gray-300">
                        <span class="text-gray-700 fw-bold me-3">Active Filters:</span>
                        <div class="d-flex flex-wrap gap-2">
                            @if(request('search'))
                                <span class="badge badge-light-primary">Search: {{ request('search') }}</span>
                            @endif
                            @if(request('status'))
                                <span class="badge badge-light-warning">Status: {{ ucfirst(request('status')) }}</span>
                            @endif
                            @if(request('human_type'))
                                <span class="badge badge-light-info">Type: {{ $humanTypes->find(request('human_type'))->name ?? 'Unknown' }}</span>
                            @endif
                            @if(request('task'))
                                <span class="badge badge-light-success">Mission #{{ request('task') }}</span>
                            @endif
                            <a href="{{ route('health_staff.doctors') }}" class="badge badge-light-danger">
                                <i class="ki-duotone ki-cross fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Clear All
                            </a>
                        </div>
                    </div>
                @endif
                <!--end::Active Filters-->
            </form>
        </div>
    </div>
    <!--end::Filter Card-->

    <!--begin::Toolbar-->
    <div class="d-flex flex-wrap flex-stack mb-6">
        <h3 class="fw-bold my-2">
            Health Staff Applications
            <span class="fs-6 text-gray-500 fw-semibold ms-1">({{ $applications->total() }} Total)</span>
        </h3>

        <div class="d-flex flex-wrap my-2">
            <a href="{{ route('health_staff.export') }}" class="btn btn-sm btn-light-primary">
                <i class="ki-duotone ki-file-down fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                Export
            </a>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Row-->
    <div class="row g-6 g-xl-9">
        @forelse($applications as $app)
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <div class="card candidate-card">
                    <div class="card-body d-flex flex-center flex-column p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-75px symbol-circle mb-5 position-relative">
                            <span class="symbol-label symbol-label-custom bg-light-primary text-primary">
                                {{ strtoupper(substr($app->full_name, 0, 2)) }}
                            </span>
                            <div class="status-indicator bg-{{ $app->application_status == 'approved' ? 'success' : ($app->application_status == 'rejected' ? 'danger' : 'warning') }}"></div>
                        </div>
                        <!--end::Avatar-->

                        <!--begin::Name-->
                        <a href="{{ route('health_staff.personalDetail', $app->id) }}" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                            {{ $app->full_name }}
                        </a>
                        <!--end::Name-->

                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-500 mb-6">
                            {{ $app->humanType->name ?? 'N/A' }} - {{ $app->specialization->name ?? 'N/A' }}
                        </div>
                        <!--end::Position-->

                        <!--begin::Info-->
                        <div class="d-flex flex-column w-100 mb-6">
                            <div class="info-badge d-flex align-items-center mb-2">
                                <i class="ki-duotone ki-sms fs-3 text-primary me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span class="text-gray-700 fw-semibold">{{ $app->email }}</span>
                            </div>

                            <div class="info-badge d-flex align-items-center mb-2">
                                <i class="ki-duotone ki-phone fs-3 text-success me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <span class="text-gray-700 fw-semibold">{{ $app->phone }}</span>
                            </div>

                            <div class="info-badge d-flex align-items-center mb-2">
                                <i class="ki-duotone ki-geolocation fs-3 text-info me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span class="text-gray-700 fw-semibold">{{ $app->nationality }}</span>
                            </div>

                            <div class="info-badge d-flex align-items-center mb-2">
                                <i class="ki-duotone ki-calendar fs-3 text-warning me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span class="text-gray-700 fw-semibold">{{ $app->created_at->format('d M Y') }}</span>
                            </div>

                            <div class="info-badge d-flex align-items-center">
                                <i class="ki-duotone ki-rocket fs-3 text-danger me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span class="text-gray-700 fw-semibold">Mission #{{ $app->task_id }}</span>
                            </div>
                        </div>
                        <!--end::Info-->

                        <!--begin::Progress-->
                        <div class="d-flex justify-content-between w-100 mb-5">
                            <span class="text-gray-600 fw-semibold">Experience:</span>
                            <span class="fw-bold text-gray-800">{{ $app->clinical_experience_years }} years</span>
                        </div>
                        <!--end::Progress-->

                        <!--begin::Stats-->
                        <div class="d-flex justify-content-between w-100 mb-5">
                            <span class="text-gray-600 fw-semibold">Status:</span>
                            <span class="badge badge-{{ $app->status_color }} fs-7">{{ ucfirst($app->application_status) }}</span>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Actions-->
                        <div class="d-flex gap-2 w-100">
                            <a href="{{ route('health_staff.personalDetail', $app->id) }}" class="btn btn-sm btn-primary flex-fill">
                                <i class="ki-duotone ki-eye fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                View Details
                            </a>
                        </div>
                        <!--end::Actions-->
                    </div>
                </div>
            </div>
            <!--end::Col-->
        @empty
            <!--begin::Empty State-->
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-20">
                        <i class="ki-duotone ki-file-deleted fs-5x text-muted mb-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <h3 class="text-gray-800 fw-bold mb-3">No Applications Found</h3>
                        <p class="text-gray-600 fs-5 mb-0">Try adjusting your filters or search terms</p>
                    </div>
                </div>
            </div>
            <!--end::Empty State-->
        @endforelse
    </div>
    <!--end::Row-->

    <!--begin::Pagination-->
    @if($applications->hasPages())
        <div class="d-flex flex-stack flex-wrap pt-10">
            <div class="fs-6 fw-semibold text-gray-700">
                Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $applications->total() }} entries
            </div>

            <ul class="pagination">
                {{ $applications->appends(request()->query())->links() }}
            </ul>
        </div>
    @endif
    <!--end::Pagination-->

@endsection

@section('script')
    <script src="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.js"></script>
@endsection

@section('js')
@endsection
