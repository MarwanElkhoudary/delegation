@include('layouts.head')
</head>

<body id="kt_body" class="app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->

<style>
    body {
        background: #f5f7fa;
    }

    .login-container {
        min-height: 100vh;
    }

    .login-card {
        background: #ffffff;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .brand-section {
        background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 50%, #2563eb 100%);
        position: relative;
        overflow: hidden;
    }

    .brand-section::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background:
            radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.08) 0%, transparent 40%),
            radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
        animation: subtle-move 20s ease-in-out infinite;
    }

    @keyframes subtle-move {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(-20px, -20px); }
    }

    .logo-container {
        background: #ffffff;
        border-radius: 15px;
        padding: 15px;
        display: inline-block;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
    }

    .brand-title {
        font-size: 1.85rem;
        font-weight: 700;
        color: #ffffff;
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        margin-bottom: 0.6rem;
        letter-spacing: -0.5px;
    }

    .brand-subtitle {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.95);
        font-weight: 500;
        line-height: 1.5;
    }

    .divider-line {
        width: 70px;
        height: 2.5px;
        background: rgba(255, 255, 255, 0.4);
        margin: 1rem auto;
        border-radius: 2px;
    }

    .form-section {
        padding: 4rem 3.5rem;
    }

    .sign-in-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
    }

    .sign-in-subtitle {
        color: #64748b;
        font-size: 1.05rem;
        margin-bottom: 3rem;
        font-weight: 400;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 0.95rem;
        margin-bottom: 0.6rem;
        display: block;
    }

    .form-control {
        height: 54px;
        border: 2px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.875rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #1e293b;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        background: #ffffff;
        outline: none;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .btn-sign-in {
        height: 54px;
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        border: none;
        border-radius: 0.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(37, 99, 235, 0.3);
        letter-spacing: 0.3px;
    }

    .btn-sign-in:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4);
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    }

    .btn-sign-in:active {
        transform: translateY(0);
    }

    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.25rem;
        color: rgba(255, 255, 255, 0.95);
    }

    .feature-icon {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.1rem;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .security-badge {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        border: 1px solid #cbd5e1;
        border-left: 4px solid #2563eb;
        padding: 1rem 1.1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        color: #475569;
        margin-top: 1.5rem;
    }

    .official-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.15);
        padding: 0.5rem 1.15rem;
        border-radius: 50px;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.95);
        margin-top: 1.25rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    @media (max-width: 991px) {
        .brand-section {
            padding: 3rem 2rem !important;
        }
        .form-section {
            padding: 3rem 2rem;
        }
        .brand-title {
            font-size: 2rem;
        }
        .sign-in-title {
            font-size: 1.75rem;
        }
    }
</style>

<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication-->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid login-container">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 brand-section">
            <div class="d-flex flex-column flex-center py-8 px-5 px-md-10 w-100 position-relative" style="z-index: 1;">
                <!--begin::Logo-->
                <div class="mb-5 text-center">
                    <div class="logo-container">
                        <img alt="Ministry of Health Logo" src="assets/images/logos/logo.svg" class="h-80px" />
                    </div>
                </div>
                <!--end::Logo-->

                <!--begin::Divider-->
                <div class="divider-line"></div>
                <!--end::Divider-->

                <!--begin::Title-->
                <h1 class="brand-title text-center">
                    Ministry of Health
                </h1>
                <!--end::Title-->

                <!--begin::Description-->
                <div class="brand-subtitle text-center mb-3 px-3">
                    Medical Delegation Management System
                </div>
                <!--end::Description-->

                <!--begin::Official Badge-->
                <div class="official-badge">
                    <i class="ki-outline ki-verify fs-5 me-2"></i>
                    <span class="fw-semibold" style="font-size: 0.85rem;">Official Government Portal</span>
                </div>
                <!--end::Official Badge-->

                <!--begin::Features-->
                <div class="mt-6" style="max-width: 380px;">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ki-outline ki-shield-tick"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size: 0.9rem;">Secure Platform</div>
                            <div style="font-size: 0.8rem; color: rgba(255, 255, 255, 0.75);">Advanced security protocols</div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ki-outline ki-people"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size: 0.9rem;">Staff Management</div>
                            <div style="font-size: 0.8rem; color: rgba(255, 255, 255, 0.75);">Comprehensive delegation tracking</div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ki-outline ki-document"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size: 0.9rem;">Application Processing</div>
                            <div style="font-size: 0.8rem; color: rgba(255, 255, 255, 0.75);">Streamlined workflow system</div>
                        </div>
                    </div>
                </div>
                <!--end::Features-->
            </div>
        </div>
        <!--end::Aside-->

        <!--begin::Body-->
        <div class="d-flex flex-center w-lg-50 p-10">
            <div class="card shadow-sm rounded-4 w-md-600px login-card">
                <div class="card-body form-section">
                    <!--begin::Form-->
                    <form class="form w-100" method="POST" action="{{route('login')}}" novalidate>
                        @csrf

                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <h1 class="sign-in-title">Sign In</h1>
                            <div class="sign-in-subtitle">
                                Access your account with your credentials
                            </div>
                        </div>
                        <!--end::Heading-->

                        <!--begin::Session Status-->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <!--end::Session Status-->

                        <!--begin::Input group - Username-->
                        <div class="mb-8">
                            <label class="form-label">Username</label>
                            <input type="text"
                                   placeholder="Enter your username"
                                   name="username"
                                   value="{{old('username')}}"
                                   autocomplete="off"
                                   class="form-control"
                                   required />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group - Password-->
                        <div class="mb-10">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   placeholder="Enter your password"
                                   name="password"
                                   autocomplete="current-password"
                                   class="form-control"
                                   required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Submit button-->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-sign-in">
                                <span class="indicator-label">
                                    Sign In
                                    <i class="ki-outline ki-arrow-right fs-3 ms-2"></i>
                                </span>
                                <span class="indicator-progress">
                                    Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Submit button-->

                        <!--begin::Security Info-->
                        <div class="security-badge text-center">
                            <i class="ki-outline ki-lock-2 text-primary fs-4 me-2"></i>
                            <strong>Protected Connection</strong> - Your information is encrypted and secure
                        </div>
                        <!--end::Security Info-->
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication-->
</div>
<!--end::Root-->

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<script src="assets/js/custom/authentication/sign-in/general.js"></script>
<!--end::Javascript-->
</body>
</html>
