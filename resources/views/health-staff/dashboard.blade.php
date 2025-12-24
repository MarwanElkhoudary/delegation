@extends('unauthorized.index')

@section('css')
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 40px auto;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .welcome-banner h1 {
            color: white;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .welcome-banner p {
            opacity: 0.9;
            font-size: 16px;
            margin-bottom: 0;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .info-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .info-card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .info-card-icon i {
            color: white;
            font-size: 24px;
        }

        .info-card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0;
        }

        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            flex: 0 0 200px;
            font-weight: 600;
            color: #64748b;
        }

        .info-value {
            flex: 1;
            color: #1e293b;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-action {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .btn-logout {
            background: #ef4444;
            border: none;
            color: white;
        }

        .btn-logout:hover {
            background: #dc2626;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-container">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <h1>
                <i class="fas fa-hand-sparkles me-2"></i>
                مرحباً، {{ $healthStaff->full_name }}!
            </h1>
            <p>نتمنى لك يوماً سعيداً. هذه هي لوحة التحكم الخاصة بك.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Personal Information -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-icon">
                    <i class="fas fa-user"></i>
                </div>
                <h2 class="info-card-title">المعلومات الشخصية</h2>
            </div>

            <div class="info-row">
                <div class="info-label">الاسم الكامل:</div>
                <div class="info-value">{{ $healthStaff->full_name }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">البريد الإلكتروني:</div>
                <div class="info-value">{{ $healthStaff->email }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">اسم المستخدم:</div>
                <div class="info-value">{{ $healthStaff->username }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">الجنس:</div>
                <div class="info-value">{{ $healthStaff->gender == 1 ? 'ذكر' : 'أنثى' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">تاريخ الميلاد:</div>
                <div class="info-value">{{ $healthStaff->birth_date->format('Y-m-d') }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">الجنسية:</div>
                <div class="info-value">{{ $healthStaff->nationality }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">رقم الهاتف:</div>
                <div class="info-value">{{ $healthStaff->phone }}</div>
            </div>
        </div>

        <!-- Professional Information -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-icon">
                    <i class="fas fa-briefcase-medical"></i>
                </div>
                <h2 class="info-card-title">المعلومات المهنية</h2>
            </div>

            <div class="info-row">
                <div class="info-label">نوع الكادر:</div>
                <div class="info-value">{{ $healthStaff->humanType->name ?? 'غير محدد' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">التخصص:</div>
                <div class="info-value">{{ $healthStaff->specialization->name ?? 'غير محدد' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">أعلى مؤهل:</div>
                <div class="info-value">{{ $healthStaff->highest_qualification ?? 'غير محدد' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">الجامعة المانحة:</div>
                <div class="info-value">{{ $healthStaff->granting_university ?? 'غير محدد' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">سنوات الخبرة:</div>
                <div class="info-value">{{ $healthStaff->clinical_experience_years ?? 0 }} سنة</div>
            </div>
        </div>

        <!-- Account Status -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h2 class="info-card-title">حالة الحساب</h2>
            </div>

            <div class="info-row">
                <div class="info-label">حالة التطبيق:</div>
                <div class="info-value">
                    @if($healthStaff->application_status == 'pending')
                        <span class="status-badge status-pending">
                            <i class="fas fa-clock me-1"></i>
                            قيد المراجعة
                        </span>
                    @elseif($healthStaff->application_status == 'approved')
                        <span class="status-badge status-approved">
                            <i class="fas fa-check-circle me-1"></i>
                            مقبول
                        </span>
                    @else
                        <span class="status-badge status-rejected">
                            <i class="fas fa-times-circle me-1"></i>
                            مرفوض
                        </span>
                    @endif
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">تاريخ التسجيل:</div>
                <div class="info-value">{{ $healthStaff->created_at->format('Y-m-d H:i') }}</div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ url('/calendar') }}" class="btn btn-primary btn-action">
                <i class="fas fa-home me-2"></i>
                الصفحة الرئيسية
            </a>

            <form action="{{ route('health-staff.logout') }}" method="POST" style="flex: 1;">
                @csrf
                <button type="submit" class="btn btn-logout btn-action w-100">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    تسجيل الخروج
                </button>
            </form>
        </div>
    </div>
@endsection
