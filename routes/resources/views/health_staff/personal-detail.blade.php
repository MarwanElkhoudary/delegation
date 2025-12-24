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
        <h3 class="fw-bold my-2">Application #{{ $application->id }}
            <span class="fs-6 text-gray-500 fw-semibold ms-1">Complete Profile</span>
        </h3>
        <div class="d-flex flex-wrap my-2">
            <a href="{{ route('health_staff.doctors') }}" class="btn btn-sm btn-light-primary me-3">
                <i class="ki-duotone ki-arrow-left fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                Back to List
            </a>
            <button class="btn btn-sm btn-primary" onclick="window.print()">
                <i class="ki-duotone ki-printer fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
                Print
            </button>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Status Management Card-->
    <div class="card mb-5">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-2">Application Status:
                        <span class="badge badge-{{ $application->status_color }} fs-3">
                            {{ ucfirst($application->application_status) }}
                        </span>
                    </h3>
                    <p class="text-muted mb-0">
                        <i class="ki-duotone ki-calendar fs-5 text-primary me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Submitted on: {{ $application->created_at->format('d M Y, h:i A') }}
                    </p>
                    @if($application->state_date)
                        <p class="text-muted mb-0 mt-1">
                            <i class="ki-duotone ki-time fs-5 text-success me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Last updated: {{ \Carbon\Carbon::parse($application->state_date)->format('d M Y, h:i A') }}
                        </p>
                    @endif
                </div>

                @if($application->application_status == 'pending')
                    <div class="btn-group">
                        <button type="button" class="btn btn-success" onclick="updateStatus({{ $application->id }}, 'approved')">
                            <i class="ki-duotone ki-check fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Approve
                        </button>
                        <button type="button" class="btn btn-danger" onclick="showRejectModal({{ $application->id }})">
                            <i class="ki-duotone ki-cross fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Reject
                        </button>
                    </div>
                @endif
            </div>

            @if($application->reason)
                <div class="alert alert-warning d-flex align-items-center mt-4">
                    <i class="ki-duotone ki-information-5 fs-2hx text-warning me-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <div class="d-flex flex-column">
                        <h5 class="mb-1">Rejection Reason</h5>
                        <span>{{ $application->reason }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!--end::Status Management Card-->

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
                    <span class="info-value">{{ $application->full_name }}</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Mission Applied For</label>
                <div class="col-lg-8">
                    <span class="badge badge-light-primary fs-7 fw-bold">Mission #{{ $application->task_id }}</span>
                    @if($application->task)
                        <span class="text-muted ms-2">({{ \Carbon\Carbon::parse($application->task->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($application->task->end_date)->format('d M Y') }})</span>
                    @endif
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Role</label>
                <div class="col-lg-8">
                    <span class="info-value">{{ $application->humanType->name ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Specialization</label>
                <div class="col-lg-8">
                    <span class="info-value">{{ $application->specialization->name ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Email</label>
                <div class="col-lg-8">
                    <span class="info-value">
                        <i class="ki-duotone ki-sms fs-5 text-primary me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        {{ $application->email ?? 'N/A' }}
                    </span>
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
                        {{ $application->phone }}
                    </span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Gender</label>
                <div class="col-lg-8">
                    <span class="info-value">{{ $application->gender_text }}</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Date of Birth</label>
                <div class="col-lg-8">
                    <span class="info-value">{{ \Carbon\Carbon::parse($application->birth_date)->format('d M Y') }} ({{ \Carbon\Carbon::parse($application->birth_date)->age }} years old)</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Nationality</label>
                <div class="col-lg-8">
                    <span class="info-value">{{ $application->nationality }}</span>
                </div>
            </div>

            <div class="row mb-0">
                <label class="col-lg-4 info-label">Languages Spoken</label>
                <div class="col-lg-8">
                    @forelse($application->languages as $language)
                        <span class="badge badge-light me-2">{{ $language->name }}</span>
                    @empty
                        <span class="text-muted">N/A</span>
                    @endforelse
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
                    <span class="info-value">{{ $application->highest_qualification }}</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Granting University</label>
                <div class="col-lg-8">
                    <span class="info-value">{{ $application->granting_university }}</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Degree Granting Country</label>
                <div class="col-lg-8">
                    <span class="info-value">{{ $application->degree_granting_country }}</span>
                </div>
            </div>

            <div class="row mb-0">
                <label class="col-lg-4 info-label">Date of Graduation</label>
                <div class="col-lg-8">
                    <span class="info-value">{{ \Carbon\Carbon::parse($application->date_of_graduation)->format('F d, Y') }}</span>
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
                    <i class="ki-duotone ki-briefcase fs-1 text-info me-2">
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
                    <span class="badge badge-light-success fs-7 fw-bold">{{ $application->clinical_experience_years }} Years</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Previous Employers</label>
                <div class="col-lg-8">
                    <div class="info-value">{{ $application->previous_employers }}</div>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Countries Previously Served In</label>
                <div class="col-lg-8">
                    <div class="info-value">{{ $application->countries_previously_served }}</div>
                </div>
            </div>

            <div class="section-divider"></div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Disaster/Emergency Experience</label>
                <div class="col-lg-8">
                    @if($application->disaster_experience == 'yes')
                        <span class="badge badge-light-success">
                            <i class="ki-duotone ki-check-circle fs-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Yes
                        </span>
                    @else
                        <span class="badge badge-light-danger">
                            <i class="ki-duotone ki-cross-circle fs-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            No
                        </span>
                    @endif
                </div>
            </div>

            @if($application->disaster_experience == 'yes' && $application->disaster_experience_description)
                <div class="row mb-7">
                    <label class="col-lg-4 info-label">Disaster Experience Details</label>
                    <div class="col-lg-8">
                        <div class="info-value bg-light-primary p-4 rounded">
                            {{ $application->disaster_experience_description }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="section-divider"></div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Volunteer Work Experience</label>
                <div class="col-lg-8">
                    @if($application->volunteer_experience == 'yes')
                        <span class="badge badge-light-success">
                            <i class="ki-duotone ki-check-circle fs-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Yes
                        </span>
                    @else
                        <span class="badge badge-light-danger">
                            <i class="ki-duotone ki-cross-circle fs-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            No
                        </span>
                    @endif
                </div>
            </div>

            @if($application->volunteer_experience == 'yes' && $application->volunteer_experience_description)
                <div class="row mb-0">
                    <label class="col-lg-4 info-label">Volunteer Experience Details</label>
                    <div class="col-lg-8">
                        <div class="info-value bg-light-info p-4 rounded">
                            {{ $application->volunteer_experience_description }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!--end::Professional Experience-->

    <!--begin::Gaza Experience-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    <i class="ki-duotone ki-geolocation fs-1 text-warning me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Gaza Experience
                </h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <div class="row mb-7">
                <label class="col-lg-4 info-label">Previously Visited Gaza</label>
                <div class="col-lg-8">
                    @if($application->visited_gaza == 'yes')
                        <span class="badge badge-light-success">
                            <i class="ki-duotone ki-check-circle fs-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Yes
                        </span>
                    @else
                        <span class="badge badge-light-danger">
                            <i class="ki-duotone ki-cross-circle fs-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            No
                        </span>
                    @endif
                </div>
            </div>

            @if($application->visited_gaza == 'yes' && $application->place_of_work_previous_visit)
                <div class="row mb-0">
                    <label class="col-lg-4 info-label">Place of Work During Previous Visit</label>
                    <div class="col-lg-8">
                        <div class="info-value">{{ $application->place_of_work_previous_visit }}</div>
                    </div>
                </div>
            @endif
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
                    Academic Contributions
                </h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <div class="row mb-7">
                <label class="col-lg-4 info-label">Educational Contributions</label>
                <div class="col-lg-8">
                    <div class="info-value">{{ $application->educational_contributions }}</div>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 info-label">Published Scientific Papers</label>
                <div class="col-lg-8">
                    <div class="info-value">{{ $application->published_scientific_papers }}</div>
                </div>
            </div>

            <div class="row mb-0">
                <label class="col-lg-4 info-label">Conference Participation</label>
                <div class="col-lg-8">
                    <div class="info-value">{{ $application->conference_participation }}</div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Academic Contributions-->

    <!--begin::Doctors Worked With-->
    @if($application->workedWith->count() > 0)
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">
                        <i class="ki-duotone ki-people fs-1 text-primary me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                        Doctors Worked With
                    </h3>
                </div>
            </div>

            <div class="card-body border-top p-9">
                <div class="table-responsive">
                    <table class="table table-row-bordered align-middle gy-4">
                        <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="min-w-200px">Doctor Name</th>
                            <th class="min-w-150px">Date of Collaboration</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($application->workedWith as $doctor)
                            <tr>
                                <td>
                                    <span class="text-gray-800 fw-bold">{{ $doctor->doctor_name }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700">{{ \Carbon\Carbon::parse($doctor->visited_date)->format('F Y') }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    <!--end::Doctors Worked With-->

    <!--begin::Uploaded Files-->
    @if($application->files->count() > 0)
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">
                        <i class="ki-duotone ki-folder fs-1 text-success me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Uploaded Documents
                    </h3>
                </div>
            </div>

            <div class="card-body border-top p-9">
                <div class="table-responsive">
                    <table class="table table-row-bordered align-middle gy-4">
                        <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="min-w-300px">File Name</th>
                            <th class="min-w-100px">Size</th>
                            <th class="min-w-100px">Type</th>
                            <th class="min-w-100px text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($application->files as $file)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-file fs-2x text-primary me-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="text-gray-800 fw-bold">{{ $file->file_name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-gray-700">{{ number_format($file->file_size / 1024, 2) }} KB</span>
                                </td>
                                <td>
                                    <span class="badge badge-light">{{ strtoupper(pathinfo($file->file_name, PATHINFO_EXTENSION)) }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-sm btn-light-primary">
                                        <i class="ki-duotone ki-eye fs-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    <!--end::Uploaded Files-->

@endsection

@section('script')
    <script src="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.js"></script>
@endsection

@section('js')
    <script>
        function updateStatus(id, status, reason = null) {
            if (!confirm('Are you sure you want to ' + status + ' this application?')) {
                return;
            }

            fetch(`/health_staff/update-status/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    application_status: status,
                    reason: reason
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Application status updated successfully',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message || 'Failed to update status',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating the status',
                        confirmButtonText: 'OK'
                    });
                    console.error('Error:', error);
                });
        }

        function showRejectModal(id) {
            Swal.fire({
                title: 'Reject Application',
                input: 'textarea',
                inputLabel: 'Please enter the rejection reason:',
                inputPlaceholder: 'Type the reason here...',
                inputAttributes: {
                    'aria-label': 'Type the reason here'
                },
                showCancelButton: true,
                confirmButtonText: 'Reject',
                confirmButtonColor: '#f1416c',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to provide a reason for rejection!'
                    }
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    updateStatus(id, 'rejected', result.value);
                }
            });
        }
    </script>
@endsection
