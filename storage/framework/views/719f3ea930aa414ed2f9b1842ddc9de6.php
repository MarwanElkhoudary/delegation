<?php $__env->startSection('css'); ?>
    <style>
        .success-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            margin-top: 50px;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .success-icon i {
            font-size: 50px;
        }

        .success-card h1 {
            color: white;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .success-card p {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .application-details {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-top: 30px;
            color: #1e293b;
        }

        .detail-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            width: 200px;
            color: #64748b;
        }

        .detail-value {
            flex: 1;
            color: #1e293b;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="container-xxl">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Success Card -->
                    <div class="success-card">
                        <div class="success-icon">
                            <i class="ki-outline ki-check fs-2x"></i>
                        </div>

                        <h1>Application Submitted Successfully!</h1>

                        <p class="mb-2">Thank you for applying to join our mission.</p>
                        <p>Your application has been received and is currently under review.</p>
                        <p class="mt-4">
                            <strong>Application Reference: #<?php echo e(str_pad($application->id, 6, '0', STR_PAD_LEFT)); ?></strong>
                        </p>
                    </div>

                    <!-- Application Details -->
                    <div class="application-details">
                        <h3 class="mb-6" style="color: #1e293b; font-weight: 600;">Application Summary</h3>

                        <div class="detail-row">
                            <div class="detail-label">Full Name</div>
                            <div class="detail-value"><?php echo e($application->full_name); ?></div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">Role</div>
                            <div class="detail-value"><?php echo e($application->humanType->name ?? 'N/A'); ?></div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">Specialization</div>
                            <div class="detail-value"><?php echo e($application->specialization->name ?? 'N/A'); ?></div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value"><?php echo e($application->phone); ?></div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">Application Status</div>
                            <div class="detail-value">
                                <span class="badge badge-<?php echo e($application->status_color); ?>">
                                    <?php echo e(ucfirst($application->application_status)); ?>

                                </span>
                            </div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">Submitted On</div>
                            <div class="detail-value"><?php echo e($application->created_at->format('d M Y, h:i A')); ?></div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center mt-10">
                        <a href="/calendar" class="btn btn-lg btn-primary me-3">
                            <i class="ki-outline ki-home fs-3"></i>
                            Back to Calendar
                        </a>
                        <a href="#" onclick="window.print(); return false;" class="btn btn-lg btn-light">
                            <i class="ki-outline ki-printer fs-3"></i>
                            Print Confirmation
                        </a>
                    </div>

                    <!-- What's Next Section -->
                    <div class="alert alert-info mt-10" style="background: #f0f9ff; border: 1px solid #bae6fd; color: #075985;">
                        <h4 class="alert-heading" style="color: #075985;">
                            <i class="ki-outline ki-information-5 fs-2"></i> What Happens Next?
                        </h4>
                        <p class="mb-3">Our team will review your application carefully. Here's what to expect:</p>
                        <ul class="mb-0">
                            <li>Your application will be reviewed within 3-5 business days</li>
                            <li>You will receive an email notification regarding the status</li>
                            <li>If approved, you'll receive further instructions about the mission</li>
                            <li>Please keep your phone available for any follow-up calls</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('unauthorized.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\laragon\www\delegation\resources\views/unauthorized/pages/application-success.blade.php ENDPATH**/ ?>