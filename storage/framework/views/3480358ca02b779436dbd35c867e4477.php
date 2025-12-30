<?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body id="kt_body" class="app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->

<style>
    body {
        background: #f5f7fa;
    }

    .register-container {
        min-height: 100vh;
        padding: 3rem 0;
    }

    .register-card {
        background: #ffffff;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        max-width: 950px;
        margin: 0 auto;
    }

    .brand-section {
        background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 50%, #2563eb 100%);
        position: relative;
        overflow: hidden;
        padding: 4rem 3rem;
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

    .register-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
    }

    .register-subtitle {
        color: #64748b;
        font-size: 1.05rem;
        margin-bottom: 2.5rem;
        font-weight: 400;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 0.95rem;
        margin-bottom: 0.6rem;
        display: block;
    }

    .form-label.required::after {
        content: " *";
        color: #dc2626;
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
        width: 100%;
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

    .form-control.is-invalid {
        border-color: #dc2626;
    }

    .invalid-feedback {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }

    .password-hint {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 0.4rem;
    }

    select.form-control {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23334155' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1.25rem center;
        background-size: 16px 12px;
        padding-right: 3rem;
    }

    .btn-register {
        height: 54px;
        width: 100%;
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        border: none;
        border-radius: 0.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(37, 99, 235, 0.3);
        letter-spacing: 0.3px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4);
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    }

    .btn-register:active {
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

    .login-link {
        text-align: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
    }

    .login-link p {
        margin: 0;
        color: #64748b;
        font-size: 1rem;
    }

    .login-link a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .login-link a:hover {
        color: #1e40af;
        text-decoration: underline;
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
            font-size: 1.65rem;
        }
        .register-title {
            font-size: 1.85rem;
        }
    }

    @media (max-width: 767px) {
        .brand-section {
            padding: 2.5rem 1.5rem !important;
        }
        .form-section {
            padding: 2.5rem 1.5rem;
        }
        .brand-title {
            font-size: 1.5rem;
        }
        .register-title {
            font-size: 1.65rem;
        }
        .form-control {
            height: 50px;
            font-size: 0.95rem;
        }
        .btn-register {
            height: 50px;
            font-size: 1rem;
        }
        .register-container {
            padding: 1.5rem 0;
        }
    }
</style>

<div class="register-container d-flex align-items-center">
    <div class="container">
        <div class="row register-card rounded-3 overflow-hidden">
            <!-- Left Side - Brand Section -->
            <div class="col-lg-5 p-0">
                <div class="brand-section d-flex flex-column justify-content-center align-items-center text-center h-100" style="min-height: 500px;">
                    <div class="position-relative" style="z-index: 1;">
                        <div class="logo-container">
                            <img src="<?php echo e(asset('assets/images/logos/logo.svg')); ?>"
                                 alt="Ministry of Health"
                                 style="height: 75px; display: block;">
                        </div>

                        <div class="divider-line"></div>

                        <h2 class="brand-title">Ministry of Health</h2>
                        <p class="brand-subtitle px-3">
                            Medical Delegation System
                        </p>

                        <div class="official-badge">
                            <i class="ki-duotone ki-shield-tick fs-4 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Official Registration Portal
                        </div>

                        <div class="mt-5">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ki-duotone ki-check-circle">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <div class="text-start">
                                    <div style="font-weight: 600; font-size: 0.95rem;">Quick Registration</div>
                                    <div style="font-size: 0.85rem; opacity: 0.85;">Simple 5-step process</div>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ki-duotone ki-shield">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <div class="text-start">
                                    <div style="font-weight: 600; font-size: 0.95rem;">Secure Platform</div>
                                    <div style="font-size: 0.85rem; opacity: 0.85;">Protected data encryption</div>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ki-duotone ki-user-tick">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </div>
                                <div class="text-start">
                                    <div style="font-weight: 600; font-size: 0.95rem;">Verified Profiles</div>
                                    <div style="font-size: 0.85rem; opacity: 0.85;">Official healthcare registry</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form Section -->
            <div class="col-lg-7 p-0">
                <div class="form-section">
                    <h1 class="register-title">Create Account</h1>
                    <p class="register-subtitle">Register as healthcare professional</p>

                    <form action="<?php echo e(route('health-staff.register')); ?>" method="POST" id="registrationForm">
                        <?php echo csrf_field(); ?>

                        <div class="row g-4">
                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label required">Email Address</label>
                                <input type="email"
                                       class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="email"
                                       name="email"
                                       value="<?php echo e(old('email')); ?>"
                                       placeholder="your.email@example.com"
                                       required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Username -->
                            <div class="col-md-6">
                                <label for="username" class="form-label required">Username</label>
                                <input type="text"
                                       class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="username"
                                       name="username"
                                       value="<?php echo e(old('username')); ?>"
                                       placeholder="Choose a unique username"
                                       required>
                                <div class="password-hint">Will be used for login</div>
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <label for="password" class="form-label required">Password</label>
                                <input type="password"
                                       class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="password"
                                       name="password"
                                       placeholder="Enter strong password"
                                       required>
                                <div class="password-hint">Must be at least 8 characters</div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label required">Confirm Password</label>
                                <input type="password"
                                       class="form-control"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Re-enter your password"
                                       required>
                            </div>

                            <!-- Staff Type -->
                            <div class="col-12">
                                <label for="human_type" class="form-label required">Staff Type</label>
                                <select class="form-control <?php $__errorArgs = ['human_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="human_type"
                                        name="human_type"
                                        required>
                                    <option value="">Select your staff type...</option>
                                    <?php $__currentLoopData = $humanTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>" <?php echo e(old('human_type') == $type->id ? 'selected' : ''); ?>>
                                            <?php echo e($type->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['human_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-register" id="submitBtn">
                            <i class="ki-duotone ki-check-circle fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Create Account
                        </button>
                    </form>

                    <!-- Already have an account -->
                    <div class="login-link">
                        <p>
                            Already have an account?
                            <a href="<?php echo e(route('login')); ?>">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Form validation
        $('#registrationForm').on('submit', function(e) {
            const password = $('#password').val();
            const confirmPassword = $('#password_confirmation').val();
            const submitBtn = $('#submitBtn');

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }

            // Disable button to prevent double submission
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Creating Account...');

            // Re-enable after 3 seconds in case of error
            setTimeout(function() {
                submitBtn.prop('disabled', false);
                submitBtn.html('<i class="ki-duotone ki-check-circle fs-2"><span class="path1"></span><span class="path2"></span></i> Create Account');
            }, 3000);
        });

        // Password strength indicator
        $('#password').on('input', function() {
            const password = $(this).val();
            const strength = checkPasswordStrength(password);
            // You can add visual feedback here
        });

        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;
            return strength;
        }
    });
</script>

</body>
</html>
<?php /**PATH D:\work\laragon\www\delegation\resources\views/health-staff/register.blade.php ENDPATH**/ ?>