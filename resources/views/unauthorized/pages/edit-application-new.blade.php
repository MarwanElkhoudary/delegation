@extends('unauthorized.index')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <style>
        .mission-info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .mission-info-card h2 {
            color: white;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .mission-detail {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: rgba(255,255,255,0.1);
            border-radius: 5px;
        }

        .mission-detail i {
            font-size: 24px;
            margin-right: 15px;
            opacity: 0.9;
        }

        .mission-detail-content {
            flex: 1;
        }

        .mission-detail-label {
            font-size: 12px;
            opacity: 0.8;
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .mission-detail-value {
            font-size: 16px;
            font-weight: 500;
        }

        .status-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
        }

        .status-active {
            background: #10b981;
        }

        .status-pending {
            background: #f59e0b;
        }

        .status-completed {
            background: #6366f1;
        }

        .form-section {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .form-section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f5f9;
        }

        .required:after {
            content: " *";
            color: #ef4444;
        }

        /* File upload styling */
        .file-upload-wrapper {
            position: relative;
        }

        .file-upload-info {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
            display: none;
        }

        .file-upload-info.active {
            display: block;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px;
            background: white;
            border-radius: 4px;
            margin-bottom: 5px;
            border: 1px solid #e9ecef;
        }

        .file-item-name {
            flex: 1;
            font-size: 13px;
            color: #495057;
        }

        .file-item-size {
            font-size: 12px;
            color: #6c757d;
            margin: 0 10px;
        }

        .file-item-remove {
            cursor: pointer;
            color: #dc3545;
            font-size: 18px;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="container-xxl">
            <!-- Mission Info Card -->
            <div class="mission-info-card">
                <h2>{{ $mission->title ?? 'Mission Details' }}</h2>

                <div class="row">
                    <div class="col-md-3">
                        <div class="mission-detail">
                            <i class="ki-outline ki-information"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Status</div>
                                <div class="mission-detail-value">
                                    <span class="status-badge status-{{ $mission->duration_state == 1 ? 'active' : ($mission->duration_state == 0 ? 'pending' : 'completed') }}">
                                        {{ $mission->duration_state == 1 ? 'Active' : ($mission->duration_state == 0 ? 'Pending' : 'Completed') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mission-detail">
                            <i class="ki-outline ki-calendar"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Start Date</div>
                                <div class="mission-detail-value">{{ $mission->start_date ? date('d M Y', strtotime($mission->start_date)) : 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mission-detail">
                            <i class="ki-outline ki-calendar-tick"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">End Date</div>
                                <div class="mission-detail-value">{{ $mission->end_date ? date('d M Y', strtotime($mission->end_date)) : 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mission-detail">
                            <i class="ki-outline ki-geolocation"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Contact</div>
                                <div class="mission-detail-value">{{ $mission->contact_name ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($mission->description)
                    <div class="mission-detail" style="margin-top: 15px;">
                        <i class="ki-outline ki-abstract-26"></i>
                        <div class="mission-detail-content">
                            <div class="mission-detail-label">Description</div>
                            <div class="mission-detail-value">{{ $mission->description }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Application Form -->
            <form class="form" action="/apply_to_mission" method="POST" id="apply_mission_form" enctype="multipart/form-data">
