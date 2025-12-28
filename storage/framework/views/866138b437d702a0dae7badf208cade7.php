<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-xxl">
    <div class="row">
        <div class="col-lg-12">
            <!-- Mission Info -->
            <div class="mission-info-box">
                <h2 class="mb-3"><?php echo e($application->task->task_name ?? 'Mission Application'); ?></h2>
                <div class="d-flex align-items-center">
                    <i class="ki-outline ki-calendar fs-2 me-2"></i>
                    <span>Mission Period: <?php echo e(\Carbon\Carbon::parse($application->task->start_date)->format('M d, Y')); ?> - <?php echo e(\Carbon\Carbon::parse($application->task->end_date)->format('M d, Y')); ?></span>
                </div>
            </div>

            <!-- Application Status -->
            <div class="application-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-2">Application Status</h3>
                        <p class="text-muted mb-0">Submitted on: <?php echo e(\Carbon\Carbon::parse($application->created_at)->format('M d, Y h:i A')); ?></p>
                    </div>
                    <div>
                        <span class="status-badge status-<?php echo e($application->application_status); ?>">
                            <?php echo e(ucfirst($application->application_status)); ?>

                        </span>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="application-card">
                <h3 class="section-title">Personal Information</h3>
                
                <div class="info-row">
                    <div class="info-label">Full Name:</div>
                    <div class="info-value"><?php echo e($application->full_name); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Role:</div>
                    <div class="info-value"><?php echo e($application->humanType->name ?? 'N/A'); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Specialization:</div>
                    <div class="info-value"><?php echo e($application->specialization->name ?? 'N/A'); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Gender:</div>
                    <div class="info-value"><?php echo e($application->gender_text); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Birth Date:</div>
                    <div class="info-value"><?php echo e(\Carbon\Carbon::parse($application->birth_date)->format('M d, Y')); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Nationality:</div>
                    <div class="info-value"><?php echo e($application->nationality); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Phone:</div>
                    <div class="info-value"><?php echo e($application->phone); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value"><?php echo e($application->email); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Languages:</div>
                    <div class="info-value">
                        <?php if($application->languages->count() > 0): ?>
                            <?php echo e($application->languages->pluck('name')->join(', ')); ?>

                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Educational Background -->
            <div class="application-card">
                <h3 class="section-title">Educational Background</h3>
                
                <div class="info-row">
                    <div class="info-label">Highest Qualification:</div>
                    <div class="info-value"><?php echo e($application->highest_qualification); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Granting University:</div>
                    <div class="info-value"><?php echo e($application->granting_university); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Country:</div>
                    <div class="info-value"><?php echo e($application->degree_granting_country); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Graduation Date:</div>
                    <div class="info-value"><?php echo e(\Carbon\Carbon::parse($application->date_of_graduation)->format('M d, Y')); ?></div>
                </div>
            </div>

            <!-- Professional Experience -->
            <div class="application-card">
                <h3 class="section-title">Professional Experience</h3>
                
                <div class="info-row">
                    <div class="info-label">Clinical Experience:</div>
                    <div class="info-value"><?php echo e($application->clinical_experience_years); ?> years</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Countries Previously Served:</div>
                    <div class="info-value"><?php echo e($application->countries_previously_served); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Previous Employers:</div>
                    <div class="info-value"><?php echo e($application->previous_employers); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Disaster Experience:</div>
                    <div class="info-value">
                        <?php echo e(ucfirst($application->disaster_experience)); ?>

                        <?php if($application->disaster_experience === 'yes' && $application->disaster_experience_description): ?>
                            <br><small class="text-muted"><?php echo e($application->disaster_experience_description); ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Volunteer Experience:</div>
                    <div class="info-value">
                        <?php echo e(ucfirst($application->volunteer_experience)); ?>

                        <?php if($application->volunteer_experience === 'yes' && $application->volunteer_experience_description): ?>
                            <br><small class="text-muted"><?php echo e($application->volunteer_experience_description); ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Visited Gaza:</div>
                    <div class="info-value"><?php echo e(ucfirst($application->visited_gaza)); ?></div>
                </div>

                <?php if($application->place_of_work_previous_visit): ?>
                <div class="info-row">
                    <div class="info-label">Place of Work in Previous Visit:</div>
                    <div class="info-value"><?php echo e($application->place_of_work_previous_visit); ?></div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Academic Contributions -->
            <div class="application-card">
                <h3 class="section-title">Academic Contributions</h3>
                
                <div class="info-row">
                    <div class="info-label">Educational Contributions:</div>
                    <div class="info-value"><?php echo e($application->educational_contributions); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Published Scientific Papers:</div>
                    <div class="info-value"><?php echo e($application->published_scientific_papers); ?></div>
                </div>

                <div class="info-row">
                    <div class="info-label">Conference Participation:</div>
                    <div class="info-value"><?php echo e($application->conference_participation); ?></div>
                </div>
            </div>

            <!-- Doctors Worked With -->
            <?php if($application->workedWithDoctors->count() > 0): ?>
            <div class="application-card">
                <h3 class="section-title">Doctors Previously Worked With</h3>
                
                <?php $__currentLoopData = $application->workedWithDoctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="info-row">
                    <div class="info-label"><?php echo e($doctor->doctor_name); ?></div>
                    <div class="info-value"><?php echo e(\Carbon\Carbon::parse($doctor->visited_date)->format('M d, Y')); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <!-- Uploaded Files -->
            <?php if($application->files->count() > 0): ?>
            <div class="application-card">
                <h3 class="section-title">Uploaded Documents</h3>
                
                <?php $__currentLoopData = $application->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="file-item">
                    <i class="ki-outline ki-file"></i>
                    <div class="flex-grow-1">
                        <div><?php echo e($file->file_name); ?></div>
                        <small class="text-muted"><?php echo e(number_format($file->file_size / 1024, 2)); ?> KB</small>
                    </div>
                    <a href="<?php echo e(asset('storage/' . $file->file_path)); ?>" target="_blank" class="btn btn-sm btn-light-primary">
                        <i class="ki-outline ki-eye"></i> View
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="/calendar" class="btn btn-light">
                    <i class="ki-outline ki-arrow-left"></i>
                    Back to Calendar
                </a>
                
                <?php if($application->application_status === 'pending'): ?>
                <a href="<?php echo e(route('application.edit', $application->id)); ?>" class="btn btn-primary">
                    <i class="ki-outline ki-pencil"></i>
                    Edit Application
                </a>
                <?php endif; ?>

                <button onclick="window.print()" class="btn btn-light-primary">
                    <i class="ki-outline ki-printer"></i>
                    Print
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('unauthorized.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\laragon\www\delegation\resources\views/unauthorized/pages/view-application.blade.php ENDPATH**/ ?>