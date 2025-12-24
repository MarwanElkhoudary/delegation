@extends('unauthorized.index')

@section('css')
<style>
    .application-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #3F4254;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #F3F6F9;
    }

    .info-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #F3F6F9;
    }

    .info-label {
        font-weight: 600;
        color: #7E8299;
        width: 200px;
        flex-shrink: 0;
    }

    .info-value {
        color: #3F4254;
        flex: 1;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
    }

    .status-pending {
        background: #FFF4DE;
        color: #F1BC00;
    }

    .status-approved {
        background: #E8FFF3;
        color: #50CD89;
    }

    .status-rejected {
        background: #FFE2E5;
        color: #F1416C;
    }

    .file-item {
        display: flex;
        align-items: center;
        padding: 10px;
        background: #F9F9F9;
        border-radius: 6px;
        margin-bottom: 8px;
    }

    .file-item i {
        font-size: 24px;
        margin-right: 10px;
        color: #009EF7;
    }

    .mission-info-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }
</style>
@endsection

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-lg-12">
            <!-- Mission Info -->
            <div class="mission-info-box">
                <h2 class="mb-3">{{ $application->task->task_name ?? 'Mission Application' }}</h2>
                <div class="d-flex align-items-center">
                    <i class="ki-outline ki-calendar fs-2 me-2"></i>
                    <span>Mission Period: {{ $application->task->start_date->format('M d, Y') }} - {{ $application->task->end_date->format('M d, Y') }}</span>
                </div>
            </div>

            <!-- Application Status -->
            <div class="application-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-2">Application Status</h3>
                        <p class="text-muted mb-0">Submitted on: {{ $application->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                    <div>
                        <span class="status-badge status-{{ $application->application_status }}">
                            {{ ucfirst($application->application_status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="application-card">
                <h3 class="section-title">Personal Information</h3>
                
                <div class="info-row">
                    <div class="info-label">Full Name:</div>
                    <div class="info-value">{{ $application->full_name }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Role:</div>
                    <div class="info-value">{{ $application->humanType->name ?? 'N/A' }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Specialization:</div>
                    <div class="info-value">{{ $application->specialization->name ?? 'N/A' }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Gender:</div>
                    <div class="info-value">{{ $application->gender_text }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Birth Date:</div>
                    <div class="info-value">{{ $application->birth_date->format('M d, Y') }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Nationality:</div>
                    <div class="info-value">{{ $application->nationality }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Phone:</div>
                    <div class="info-value">{{ $application->phone }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value">{{ $application->email }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Languages:</div>
                    <div class="info-value">
                        @if($application->languages->count() > 0)
                            {{ $application->languages->pluck('name')->join(', ') }}
                        @else
                            N/A
                        @endif
                    </div>
                </div>
            </div>

            <!-- Educational Background -->
            <div class="application-card">
                <h3 class="section-title">Educational Background</h3>
                
                <div class="info-row">
                    <div class="info-label">Highest Qualification:</div>
                    <div class="info-value">{{ $application->highest_qualification }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Granting University:</div>
                    <div class="info-value">{{ $application->granting_university }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Country:</div>
                    <div class="info-value">{{ $application->degree_granting_country }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Graduation Date:</div>
                    <div class="info-value">{{ $application->date_of_graduation->format('M d, Y') }}</div>
                </div>
            </div>

            <!-- Professional Experience -->
            <div class="application-card">
                <h3 class="section-title">Professional Experience</h3>
                
                <div class="info-row">
                    <div class="info-label">Clinical Experience:</div>
                    <div class="info-value">{{ $application->clinical_experience_years }} years</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Countries Previously Served:</div>
                    <div class="info-value">{{ $application->countries_previously_served }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Previous Employers:</div>
                    <div class="info-value">{{ $application->previous_employers }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Disaster Experience:</div>
                    <div class="info-value">
                        {{ ucfirst($application->disaster_experience) }}
                        @if($application->disaster_experience === 'yes' && $application->disaster_experience_description)
                            <br><small class="text-muted">{{ $application->disaster_experience_description }}</small>
                        @endif
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Volunteer Experience:</div>
                    <div class="info-value">
                        {{ ucfirst($application->volunteer_experience) }}
                        @if($application->volunteer_experience === 'yes' && $application->volunteer_experience_description)
                            <br><small class="text-muted">{{ $application->volunteer_experience_description }}</small>
                        @endif
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Visited Gaza:</div>
                    <div class="info-value">{{ ucfirst($application->visited_gaza) }}</div>
                </div>

                @if($application->place_of_work_previous_visit)
                <div class="info-row">
                    <div class="info-label">Place of Work in Previous Visit:</div>
                    <div class="info-value">{{ $application->place_of_work_previous_visit }}</div>
                </div>
                @endif
            </div>

            <!-- Academic Contributions -->
            <div class="application-card">
                <h3 class="section-title">Academic Contributions</h3>
                
                <div class="info-row">
                    <div class="info-label">Educational Contributions:</div>
                    <div class="info-value">{{ $application->educational_contributions }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Published Scientific Papers:</div>
                    <div class="info-value">{{ $application->published_scientific_papers }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Conference Participation:</div>
                    <div class="info-value">{{ $application->conference_participation }}</div>
                </div>
            </div>

            <!-- Doctors Worked With -->
            @if($application->workedWithDoctors->count() > 0)
            <div class="application-card">
                <h3 class="section-title">Doctors Previously Worked With</h3>
                
                @foreach($application->workedWithDoctors as $doctor)
                <div class="info-row">
                    <div class="info-label">{{ $doctor->doctor_name }}</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($doctor->visited_date)->format('M d, Y') }}</div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Uploaded Files -->
            @if($application->files->count() > 0)
            <div class="application-card">
                <h3 class="section-title">Uploaded Documents</h3>
                
                @foreach($application->files as $file)
                <div class="file-item">
                    <i class="ki-outline ki-file"></i>
                    <div class="flex-grow-1">
                        <div>{{ $file->file_name }}</div>
                        <small class="text-muted">{{ number_format($file->file_size / 1024, 2) }} KB</small>
                    </div>
                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-sm btn-light-primary">
                        <i class="ki-outline ki-eye"></i> View
                    </a>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="/calendar" class="btn btn-light">
                    <i class="ki-outline ki-arrow-left"></i>
                    Back to Calendar
                </a>
                
                @if($application->application_status === 'pending')
                <a href="{{ route('application.edit', $application->id) }}" class="btn btn-primary">
                    <i class="ki-outline ki-pencil"></i>
                    Edit Application
                </a>
                @endif

                <button onclick="window.print()" class="btn btn-light-primary">
                    <i class="ki-outline ki-printer"></i>
                    Print
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
