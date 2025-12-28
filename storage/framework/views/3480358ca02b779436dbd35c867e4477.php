<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Register - Health Staff</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .register-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .register-icon i {
            color: white;
            font-size: 40px;
        }

        .register-header h1 {
            color: #1e293b;
            font-weight: 800;
            font-size: 28px;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .register-header p {
            color: #64748b;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }

        .form-group label.required:after {
            content: " *";
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            height: 52px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 0 18px;
            font-size: 15px;
            transition: all 0.3s;
            outline: none;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
            padding-right: 2.5rem;
            cursor: pointer;
        }

        .btn-register {
            width: 100%;
            height: 55px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            padding: 25px 20px;
            background: #f8fafc;
            border-radius: 12px;
            margin-top: 25px;
        }

        .login-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }

        .password-hint {
            font-size: 12px;
            color: #64748b;
            margin-top: 6px;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        /* Loading spinner */
        .btn-register.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-register.loading:after {
            content: "";
            width: 16px;
            height: 16px;
            margin-left: 10px;
            border: 3px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            display: inline-block;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .register-card {
                padding: 40px 30px;
            }

            .register-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
<div class="register-container">
    <div class="register-card">
        <!-- Header -->
        <div class="register-header">
            <div class="register-icon">
                <i class="fas fa-user-md"></i>
            </div>
            <h1>REGISTER HEALTH STAFF</h1>
            <p>Create your account to join our medical team</p>
        </div>

        <!-- Error Messages -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form action="<?php echo e(route('health-staff.register')); ?>" method="POST" id="registrationForm">
            <?php echo csrf_field(); ?>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="required">Email</label>
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
            <div class="form-group">
                <label for="username" class="required">Username</label>
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
            <div class="form-group">
                <label for="password" class="required">Password</label>
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
                       placeholder="Enter a strong password"
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
            <div class="form-group">
                <label for="password_confirmation" class="required">Confirm Password</label>
                <input type="password"
                       class="form-control"
                       id="password_confirmation"
                       name="password_confirmation"
                       placeholder="Re-enter your password"
                       required>
            </div>

            <!-- Staff Type -->
            <div class="form-group">
                <label for="human_type" class="required">Staff Type</label>
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
                    <option value="">Select your staff type</option>
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

            <!-- Submit Button -->
            <button type="submit" class="btn-register" id="submitBtn">
                <i class="fas fa-check-circle"></i> Create Account
            </button>
        </form>

        <!-- Already have an account -->
        <div class="login-link">
            <p style="margin: 0; color: #64748b;">
                Already have an account?
                <a href="<?php echo e(route('login')); ?>" style="color: #667eea; text-decoration: none;">
                    Sign In
                </a>
            </p>
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

            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters!');
                return false;
            }

            // Add loading state
            submitBtn.addClass('loading');
            submitBtn.html('<i class="fas fa-spinner"></i> Creating Account...');
        });

        // Remove error styling on input
        $('.form-control').on('focus', function() {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').hide();
        });
    });
</script>
</body>
</html>
<?php /**PATH D:\work\laragon\www\delegation\resources\views/health-staff/register.blade.php ENDPATH**/ ?>