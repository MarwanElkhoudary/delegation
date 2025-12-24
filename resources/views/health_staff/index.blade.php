@extends('master')
@section('css')
    <link href="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        a[aria-disabled="true"] {
            color: gray;
            pointer-events: none;
            text-decoration: none;
        }

        .stats-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
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
@section('main-title', 'Health Staff Management')
@section('sub-title', 'Applications Dashboard')

@section('content')
    <!--begin::Header-->
    <div class="d-flex flex-wrap flex-stack mb-8">
        <h2 class="fw-bold my-2">
            Health Staff Applications
            <span class="fs-6 text-gray-500 fw-semibold ms-2">({{ $stats['total'] }} Total Applications)</span>
        </h2>
    </div>
    <!--end::Header-->

    <!--begin::Statistics Row-->
    <div class="row g-5 g-xl-10 mb-8">
        <!--begin::Total-->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-4">
                        <div class="symbol symbol-50px me-3 bg-light-primary">
                            <i class="ki-duotone ki-profile-user fs-2x text-primary">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </div>
                        <div>
                            <span class="text-gray-600 fw-semibold fs-6 d-block">Total Applications</span>
                            <span class="text-gray-800 fw-bold fs-2">{{ $stats['total'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Total-->

        <!--begin::Pending-->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card h-100 bg-light-warning">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-4">
                        <div class="symbol symbol-50px me-3 bg-warning">
                            <i class="ki-duotone ki-time fs-2x text-white">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div>
                            <span class="text-gray-700 fw-semibold fs-6 d-block">Pending Review</span>
                            <span class="text-gray-900 fw-bold fs-2">{{ $stats['pending'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Pending-->

        <!--begin::Approved-->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card h-100 bg-light-success">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-4">
                        <div class="symbol symbol-50px me-3 bg-success">
                            <i class="ki-duotone ki-check-circle fs-2x text-white">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div>
                            <span class="text-gray-700 fw-semibold fs-6 d-block">Approved</span>
                            <span class="text-gray-900 fw-bold fs-2">{{ $stats['approved'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Approved-->

        <!--begin::Rejected-->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card h-100 bg-light-danger">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-4">
                        <div class="symbol symbol-50px me-3 bg-danger">
                            <i class="ki-duotone ki-cross-circle fs-2x text-white">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div>
                            <span class="text-gray-700 fw-semibold fs-6 d-block">Rejected</span>
                            <span class="text-gray-900 fw-bold fs-2">{{ $stats['rejected'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Rejected-->
    </div>
    <!--end::Statistics Row-->

    <!--begin::Recent Applications Table-->
    <div class="card mb-8">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold">Recent Applications</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('health_staff.doctors') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-eye fs-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    View All Applications
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-4">
                    <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="ps-4 min-w-50px rounded-start">ID</th>
                        <th class="min-w-200px">Name</th>
                        <th class="min-w-150px">Email</th>
                        <th class="min-w-100px">Type</th>
                        <th class="min-w-100px">Specialization</th>
                        <th class="min-w-100px">Mission</th>
                        <th class="min-w-100px">Status</th>
                        <th class="min-w-100px">Applied Date</th>
                        <th class="min-w-100px text-end rounded-end pe-4">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($applications as $app)
                        <tr>
                            <td class="ps-4">
                                <span class="text-gray-800 fw-bold">#{{ $app->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-primary text-primary fw-bold fs-6">
                                            {{ strtoupper(substr($app->full_name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold">{{ $app->full_name }}</span>
                                        <span class="text-muted fw-semibold fs-7">{{ $app->nationality }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-gray-700">{{ $app->email }}</span>
                            </td>
                            <td>
                                <span class="badge badge-light-info">{{ $app->humanType->name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span class="text-gray-700 fw-semibold">{{ $app->specialization->name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span class="text-gray-700">Mission #{{ $app->task_id }}</span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $app->status_color }}">
                                    {{ ucfirst($app->application_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-gray-700">{{ $app->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('health_staff.personalDetail', $app->id) }}" class="btn btn-sm btn-light btn-active-primary">
                                    <i class="ki-duotone ki-eye fs-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-10">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ki-duotone ki-file-deleted fs-5x text-muted mb-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <span class="text-gray-600 fs-5">No applications found</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!--begin::Pagination-->
            <div class="d-flex justify-content-between align-items-center mt-5">
                <div class="text-gray-600">
                    Showing {{ $applications->firstItem() ?? 0 }} to {{ $applications->lastItem() ?? 0 }} of {{ $applications->total() }} entries
                </div>
                <div>
                    {{ $applications->links() }}
                </div>
            </div>
            <!--end::Pagination-->
        </div>
    </div>
    <!--end::Recent Applications Table-->

@endsection

@section('script')
    <script src="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.js"></script>
@endsection

@section('js')
@endsection
