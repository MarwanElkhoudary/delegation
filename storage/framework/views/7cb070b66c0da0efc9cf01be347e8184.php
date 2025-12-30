<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets')); ?>/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        /* ============================================
           ENHANCED VIEW MISSION PAGE - RESPONSIVE
           ============================================ */

        /* Page Header */
        .mission-view-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border-radius: 12px;
            padding: 1.5rem 2rem;
            margin-bottom: 1.5rem;
            color: white;
            box-shadow: 0 4px 15px rgba(30, 60, 114, 0.2);
        }

        .mission-view-header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .mission-title-section {
            flex: 1;
        }

        .mission-id-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            backdrop-filter: blur(10px);
        }

        .mission-main-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            color: white;
        }

        .mission-subtitle {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        .mission-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .action-btn-header {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .action-btn-header.back {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(10px);
        }

        .action-btn-header.edit {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .action-btn-header.delete {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .action-btn-header:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .action-btn-header.disabled {
            opacity: 0.5;
            pointer-events: none;
            cursor: not-allowed;
        }

        /* Enhanced Cards */
        .mission-info-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            margin-bottom: 1.25rem;
            overflow: hidden;
        }

        .mission-card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #dee2e6;
        }

        .mission-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e3c72;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .mission-card-title i {
            font-size: 1.35rem;
        }

        .mission-card-body {
            padding: 1.5rem;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.25rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .info-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #7e8299;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .info-value {
            font-size: 0.95rem;
            font-weight: 500;
            color: #3f4254;
        }

        /* Enhanced Badges */
        .badge-enhanced {
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-priority-high {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
            animation: pulse 2s infinite;
        }

        .badge-priority-medium {
            background: linear-gradient(135deg, #fd7e14 0%, #e8590c 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(253, 126, 20, 0.3);
        }

        .badge-priority-low {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3), 0 0 0 0 rgba(220, 53, 69, 0.7);
            }
            50% {
                box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3), 0 0 0 10px rgba(220, 53, 69, 0);
            }
        }

        .badge-status {
            background: #e9ecef;
            color: #495057;
            border: 2px solid #dee2e6;
        }

        .badge-status.recently {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .badge-status.ongoing {
            background: linear-gradient(135deg, #feca57 0%, #fd7e14 100%);
            color: white;
        }

        .badge-status.completed {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
        }

        .badge-status.suspended {
            background: #6c757d;
            color: white;
        }

        .badge-status.rejected {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .badge-status.approved {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        /* Team List */
        .team-list {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .team-member {
            background: #f8f9fa;
            border-left: 4px solid #1e3c72;
            padding: 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .team-member:hover {
            background: #e9ecef;
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .team-member-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.6rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .team-member-name {
            font-size: 1rem;
            font-weight: 700;
            color: #1e3c72;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .team-member-badge {
            background: white;
            color: #1e3c72;
            padding: 0.2rem 0.65rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .team-member-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0.65rem;
        }

        .team-detail-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: #495057;
        }

        .team-detail-item i {
            color: #1e3c72;
            font-size: 1.1rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: #e9ecef;
            margin-bottom: 1rem;
        }

        .empty-state-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .empty-state-text {
            color: #adb5bd;
        }

        /* Status Update Section (for admin roles) */
        .status-update-section {
            background: #fff8e1;
            border: 2px dashed #ffc107;
            border-radius: 12px;
            padding: 1.25rem;
            margin-top: 1.5rem;
        }

        .status-update-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .status-update-icon {
            width: 48px;
            height: 48px;
            background: #ffc107;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .status-update-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #856404;
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .mission-view-header {
                padding: 1.5rem;
            }

            .mission-view-header-content {
                flex-direction: column;
                align-items: stretch;
            }

            .mission-actions {
                width: 100%;
            }

            .action-btn-header {
                flex: 1;
                justify-content: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .mission-card-body {
                padding: 1.5rem;
            }
        }

        @media (max-width: 767px) {
            .mission-view-header {
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 1rem;
            }

            .mission-main-title {
                font-size: 1.25rem;
            }

            .mission-actions {
                flex-direction: column;
            }

            .action-btn-header {
                width: 100%;
            }

            .mission-card-header {
                padding: 0.85rem 1rem;
            }

            .mission-card-title {
                font-size: 1rem;
            }

            .mission-card-body {
                padding: 1rem;
            }

            .team-member {
                padding: 0.85rem;
            }

            .team-member-details {
                grid-template-columns: 1fr;
            }

            .info-grid {
                gap: 1rem;
            }
        }

        /* Requirements Table */
        .table-hover tbody tr:hover {
            background: #f8f9fa !important;
            transform: translateX(3px);
        }

        /* Print Styles */
        @media print {
            .mission-actions,
            .status-update-section {
                display: none;
            }

            .mission-view-header {
                background: white;
                color: black;
                border: 2px solid #1e3c72;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php
    $userRole = Auth::user()->role_id;
    $canEditDelete = $userRole == 1 && $task->status && $task->status->name === 'Recently';
    $canUpdateStatus = in_array($userRole, [2, 3]);
?>

<?php $__env->startSection('role_user'); ?>
    <?php if($userRole == 1): ?>
        Hospital Account
    <?php elseif($userRole == 2): ?>
        General Administration
    <?php else: ?>
        International Cooperation
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-title'); ?>
    <a href="<?php echo e(route('mission.index')); ?>">Missions</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sub-title', 'Mission Details'); ?>

<?php $__env->startSection('content'); ?>

    
    <?php if(session('message')): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-4 mb-4" role="alert" style="border-radius: 12px; border-left: 4px solid #28a745;">
            <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <div class="flex-grow-1">
                <h5 class="mb-1 text-success">Success!</h5>
                <span><?php echo e(session('message')); ?></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <div class="mission-view-header">
        <div class="mission-view-header-content">
            <div class="mission-title-section">
                <div class="mission-id-badge">
                    <i class="ki-duotone ki-file-up fs-5 me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Mission ID: #<?php echo e($task->id); ?>

                </div>
                <h1 class="mission-main-title"><?php echo e($task->target ? $task->target->name : 'Mission Details'); ?></h1>
                <p class="mission-subtitle">
                    <i class="ki-duotone ki-geolocation fs-6 me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <?php echo e($task->requestTarget ? $task->requestTarget->name : 'N/A'); ?>

                </p>
            </div>

            <div class="mission-actions">
                <a href="<?php echo e(route('mission.index')); ?>" class="action-btn-header back">
                    <i class="ki-duotone ki-arrow-left fs-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Back to List
                </a>

                <?php if($userRole == 1): ?>
                    <a href="<?php echo e(url('/missions/edit_mission/' . $task->id)); ?>"
                       class="action-btn-header edit <?php echo e(!$canEditDelete ? 'disabled' : ''); ?>"
                       <?php if(!$canEditDelete): ?>
                           data-bs-toggle="tooltip"
                       title="Cannot edit - Status is not Recently"
                        <?php endif; ?>>
                        <i class="ki-duotone ki-notepad-edit fs-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Edit Mission
                    </a>

                    <a href="<?php echo e(url('/missions/delete_mission/' . $task->id)); ?>"
                       class="action-btn-header delete <?php echo e(!$canEditDelete ? 'disabled' : ''); ?>"
                       <?php if($canEditDelete): ?>
                           onclick="return confirm('Are you sure you want to delete this mission?');"
                       <?php else: ?>
                           data-bs-toggle="tooltip"
                       title="Cannot delete - Status is not Recently"
                        <?php endif; ?>>
                        <i class="ki-duotone ki-trash fs-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                        Delete
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="mission-info-card">
        <div class="mission-card-header">
            <h3 class="mission-card-title">
                <i class="ki-duotone ki-information-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                Mission Information
            </h3>
        </div>

        <div class="mission-card-body">
            <div class="info-grid">
                <?php if(in_array($userRole, [2, 3])): ?>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="ki-duotone ki-hospital fs-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Hospital
                        </div>
                        <div class="info-value">
                            <span class="badge-enhanced badge-status"><?php echo e($task->hospital ? $task->hospital->name : 'N/A'); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="info-item">
                    <div class="info-label">
                        <i class="ki-duotone ki-abstract-26 fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Specialization
                    </div>
                    <div class="info-value"><?php echo e($task->target ? $task->target->name : 'N/A'); ?></div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="ki-duotone ki-flag fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Priority
                    </div>
                    <div class="info-value">
                        <?php
                            $priority = strtolower($task->priority);
                            $priorityClass = "badge-priority-{$priority}";
                            $priorityIcon = $priority === 'high' ? '🔴' : ($priority === 'medium' ? '🟠' : '🟢');
                        ?>
                        <span class="badge-enhanced <?php echo e($priorityClass); ?>">
                        <?php echo e($priorityIcon); ?> <?php echo e(strtoupper($priority)); ?>

                    </span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="ki-duotone ki-status fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Status
                    </div>
                    <div class="info-value">
                        <?php if($task->status): ?>
                            <?php
                                $statusClass = 'badge-status ' . strtolower(str_replace(' ', '-', $task->status->name));
                            ?>
                            <span class="badge-enhanced <?php echo e($statusClass); ?>"><?php echo e($task->status->name); ?></span>
                        <?php else: ?>
                            <span class="badge-enhanced badge-status">N/A</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="ki-duotone ki-geolocation fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Target Location
                    </div>
                    <div class="info-value"><?php echo e($task->requestTarget ? $task->requestTarget->name : 'N/A'); ?></div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="ki-duotone ki-calendar fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Start Date
                    </div>
                    <div class="info-value">
                    <span class="badge-enhanced" style="background: linear-gradient(135deg, #28a745 0%, #218838 100%); color: white;">
                        <?php echo e($task->start_date); ?>

                    </span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="ki-duotone ki-calendar-tick fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        End Date
                    </div>
                    <div class="info-value">
                    <span class="badge-enhanced" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white;">
                        <?php echo e($task->end_date); ?>

                    </span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="ki-duotone ki-user fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Contact Person
                    </div>
                    <div class="info-value"><?php echo e($task->contact_name); ?></div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="ki-duotone ki-phone fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Contact Phone
                    </div>
                    <div class="info-value">
                        <a href="tel:<?php echo e($task->contact_phone); ?>" style="color: #1e3c72; font-weight: 600;">
                            <?php echo e($task->contact_phone); ?>

                        </a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="ki-duotone ki-calendar-add fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Created At
                    </div>
                    <div class="info-value"><?php echo e($task->created_at->format('d/m/Y H:i')); ?></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="mission-info-card">
        <div class="mission-card-header">
            <h3 class="mission-card-title">
                <i class="ki-duotone ki-people">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
                Medical Team Requirements
                <?php if(count($task->medicalNeeds) > 0): ?>
                    <span class="badge-enhanced" style="background: #1e3c72; color: white; font-size: 0.9rem;">
                    <?php echo e(count($task->medicalNeeds)); ?> Doctors
                </span>
                <?php endif; ?>
            </h3>
        </div>

        <div class="mission-card-body">
            <?php if(count($task->medicalNeeds) > 0): ?>
                <div class="team-list">
                    <?php $__currentLoopData = $task->medicalNeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="team-member">
                            <div class="team-member-header">
                                <div class="team-member-name">
                                    <i class="ki-duotone ki-badge fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                    Doctor #<?php echo e($index + 1); ?>

                                </div>
                                <?php if($doctor->priority === 'critical'): ?>
                                    <span class="team-member-badge" style="background: #dc3545; color: white;">
                                Critical
                            </span>
                                <?php else: ?>
                                    <span class="team-member-badge">
                                Not Critical
                            </span>
                                <?php endif; ?>
                            </div>

                            <div class="team-member-details">
                                <div class="team-detail-item">
                                    <i class="ki-duotone ki-abstract-26">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <strong>Specialization:</strong> <?php echo e($doctor->target ? $doctor->target->name : 'N/A'); ?>

                                </div>

                                <div class="team-detail-item">
                                    <i class="ki-duotone ki-time">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <strong>Experience:</strong> <?php echo e($doctor->year_of_experience); ?> Years
                                </div>

                                <?php if($doctor->description): ?>
                                    <div class="team-detail-item" style="grid-column: 1 / -1;">
                                        <i class="ki-duotone ki-note-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                        <strong>Notes:</strong> <?php echo e($doctor->description); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="ki-duotone ki-user-square empty-state-icon">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <h4 class="empty-state-title">No Team Members</h4>
                    <p class="empty-state-text">No medical team requirements have been specified for this mission.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if(isset($task->requirementNeeds) && count($task->requirementNeeds) > 0): ?>
        <div class="mission-info-card">
            <div class="mission-card-header">
                <h3 class="mission-card-title">
                    <i class="ki-duotone ki-package">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Additional Requirements
                    <span class="badge-enhanced" style="background: #1e3c72; color: white; font-size: 0.9rem;">
                <?php echo e(count($task->requirementNeeds)); ?> Items
            </span>
                </h3>
            </div>

            <div class="mission-card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead style="background: #f8f9fa;">
                        <tr>
                            <th style="padding: 0.75rem 1rem; font-weight: 700; color: #1e3c72; text-transform: uppercase; font-size: 0.8rem;">
                                <i class="ki-duotone ki-notepad fs-6 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Requirement
                            </th>
                            <th style="padding: 0.75rem 1rem; font-weight: 700; color: #1e3c72; text-transform: uppercase; font-size: 0.8rem; text-align: center;">
                                <i class="ki-duotone ki-abstract-21 fs-6 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Count
                            </th>
                            <th style="padding: 0.75rem 1rem; font-weight: 700; color: #1e3c72; text-transform: uppercase; font-size: 0.8rem; text-align: center;">
                                <i class="ki-duotone ki-flag fs-6 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Priority
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $task->requirementNeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="border-bottom: 1px solid #f0f2f5; transition: all 0.2s ease;">
                                <td style="padding: 0.85rem 1rem;">
                                    <div style="display: flex; flex-direction: column; gap: 0.2rem;">
                                        <strong style="color: #3f4254; font-size: 0.95rem;">
                                            <?php echo e($item->requirement ? $item->requirement->name : 'N/A'); ?>

                                        </strong>
                                        <?php if($item->category_name): ?>
                                            <span style="color: #7e8299; font-size: 0.85rem;">
                                    <?php echo e($item->category_name); ?>

                                </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td style="padding: 0.85rem 1rem; text-align: center;">
                            <span class="badge-enhanced" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; font-size: 0.9rem; padding: 0.4rem 0.85rem;">
                                <?php echo e($item->count); ?>

                            </span>
                                </td>
                                <td style="padding: 0.85rem 1rem; text-align: center;">
                                    <?php if($item->priority === 'critical' || $item->priority === 'Critical'): ?>
                                        <span class="badge-enhanced" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; font-size: 0.8rem;">
                                    <i class="ki-duotone ki-information-3 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    Critical
                                </span>
                                    <?php else: ?>
                                        <span class="badge-enhanced" style="background: linear-gradient(135deg, #28a745 0%, #218838 100%); color: white; font-size: 0.8rem;">
                                    <i class="ki-duotone ki-check-circle fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Not Critical
                                </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <?php if($canUpdateStatus): ?>
        <div class="status-update-section">
            <div class="status-update-header">
                <div class="status-update-icon">
                    <i class="ki-duotone ki-shield-tick">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <h4 class="status-update-title">Update Mission Status</h4>
            </div>

            <form action="<?php echo e(route('mission.edit_mission_status', $task->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mission Status</label>
                        <select name="task_status" class="form-select" required>
                            <?php if(count($statuses ?? []) > 0): ?>
                                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($status->id); ?>"
                                        <?php echo e(old('task_status', $task->status_id) == $status->id ? 'selected' : ''); ?>>
                                        <?php echo e($status->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Priority</label>
                        <select name="priority" class="form-select" required>
                            <option value="low" <?php echo e(old('priority', strtolower($task->priority)) == 'low' ? 'selected' : ''); ?>>
                                🟢 LOW
                            </option>
                            <option value="medium" <?php echo e(old('priority', strtolower($task->priority)) == 'medium' ? 'selected' : ''); ?>>
                                🟠 MEDIUM
                            </option>
                            <option value="high" <?php echo e(old('priority', strtolower($task->priority)) == 'high' ? 'selected' : ''); ?>>
                                🔴 HIGH
                            </option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Notes (Optional)</label>
                        <textarea name="note" class="form-control" rows="3"
                                  placeholder="Add any notes or comments about this status update..."><?php echo e(old('note', $task->note)); ?></textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn-enhanced" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); color: white; width: 100%;">
                            <i class="ki-duotone ki-check fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Update Status
                        </button>
                    </div>
                </div>
            </form>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert-dismissible').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 5000);

        // Initialize tooltips
        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\laragon\www\delegation\resources\views/task/show_task.blade.php ENDPATH**/ ?>