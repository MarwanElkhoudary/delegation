<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style>
    /* ============================================
       ENHANCED MISSIONS PAGE STYLES - RESPONSIVE
       Shared for all roles
       ============================================ */
    
    /* Statistics Cards */
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 1.5rem;
        color: white;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .stats-card.primary {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    }
    
    .stats-card.success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    .stats-card.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .stats-card.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    
    .stats-label {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 500;
    }
    
    .stats-icon {
        font-size: 3rem;
        opacity: 0.3;
        position: absolute;
        right: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
    }
    
    /* Enhanced Search & Filters */
    .filter-section {
        background: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .filter-section .form-control,
    .filter-section .form-select {
        border-radius: 8px;
        border: 1px solid #e4e6ef;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .filter-section .form-control:focus,
    .filter-section .form-select:focus {
        border-color: #1e3c72;
        box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.1);
    }
    
    /* Enhanced DataTable */
    .enhanced-table-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .enhanced-table-card .card-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        border: none;
        padding: 1.5rem;
    }
    
    #kt_missions_table thead th {
        background: #f8f9fa;
        color: #1e3c72;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem;
        border: none;
    }
    
    #kt_missions_table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f0f2f5;
    }
    
    #kt_missions_table tbody tr {
        transition: all 0.2s ease;
    }
    
    #kt_missions_table tbody tr:hover {
        background: #f8f9fa;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    /* Enhanced Badges */
    .badge-enhanced {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .badge-enhanced i {
        font-size: 1rem;
    }
    
    .priority-badge.high {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        font-weight: 700;
        animation: pulse 2s infinite;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }
    
    .priority-badge.medium {
        background: linear-gradient(135deg, #fd7e14 0%, #e8590c 100%);
        color: white;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(253, 126, 20, 0.3);
    }
    
    .priority-badge.low {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }
    
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(255, 107, 107, 0.7);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(255, 107, 107, 0);
        }
    }
    
    /* Enhanced Action Buttons */
    .action-btn-group {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }
    
    .action-btn {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .action-btn.view {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .action-btn.edit {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .action-btn.delete {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }
    
    .action-btn:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    /* Mobile Card View */
    .mobile-mission-card {
        display: none;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border-left: 4px solid #1e3c72;
        transition: all 0.3s ease;
    }
    
    .mobile-mission-card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        transform: translateX(5px);
    }
    
    .mobile-card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f0f2f5;
    }
    
    .mobile-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e3c72;
        margin-bottom: 0.25rem;
    }
    
    .mobile-card-id {
        font-size: 0.85rem;
        color: #7e8299;
    }
    
    .mobile-card-body {
        display: grid;
        gap: 0.75rem;
    }
    
    .mobile-info-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .mobile-info-icon {
        width: 35px;
        height: 35px;
        background: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1e3c72;
        flex-shrink: 0;
    }
    
    .mobile-info-content {
        flex: 1;
    }
    
    .mobile-info-label {
        font-size: 0.75rem;
        color: #7e8299;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .mobile-info-value {
        font-size: 0.9rem;
        color: #3f4254;
        font-weight: 500;
        margin-top: 0.25rem;
    }
    
    .mobile-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 2px solid #f0f2f5;
    }
    
    /* Loading Animation */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    
    .loading-spinner {
        width: 60px;
        height: 60px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #1e3c72;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Responsive Design */
    @media (max-width: 991px) {
        .stats-card {
            margin-bottom: 1rem;
        }
        
        .stats-number {
            font-size: 2rem;
        }
        
        .filter-section {
            padding: 1rem;
        }
    }
    
    @media (max-width: 767px) {
        /* Hide table on mobile */
        .table-responsive {
            display: none !important;
        }
        
        /* Show mobile cards */
        .mobile-mission-card {
            display: block !important;
        }
        
        .stats-card {
            padding: 1rem;
        }
        
        .stats-number {
            font-size: 1.75rem;
        }
        
        .stats-icon {
            font-size: 2rem;
            right: 1rem;
        }
        
        .filter-section {
            padding: 1rem;
        }
        
        .mobile-card-title {
            font-size: 1rem;
        }
    }
    
    /* Disabled state for actions */
    a[aria-disabled="true"],
    .action-btn.disabled {
        opacity: 0.5 !important;
        pointer-events: none !important;
        cursor: not-allowed !important;
        filter: grayscale(50%);
    }
    
    a[aria-disabled="true"]:hover,
    .action-btn.disabled:hover {
        transform: none !important;
        box-shadow: none !important;
    }
    
    /* Enhanced Button Styles */
    .btn-enhanced {
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-enhanced:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .btn-primary-gradient {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
    }
    
    .btn-success-gradient {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }
    
    .empty-state-icon {
        font-size: 4rem;
        color: #e4e6ef;
        margin-bottom: 1rem;
    }
    
    .empty-state-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #3f4254;
        margin-bottom: 0.5rem;
    }
    
    .empty-state-text {
        color: #7e8299;
    }
</style>
<?php $__env->stopSection(); ?>

<?php
    $userRole = Auth::user()->role_id;
    $roleNames = [
        1 => 'Hospital Account',
        2 => 'General Administration of Hospitals',
        3 => 'International Cooperation'
    ];
    $roleName = $roleNames[$userRole] ?? 'System Account';
    
    // Check if user can add missions (only role 1)
    $canAddMission = $userRole == 1;
    
    // Check if we need hospital column (roles 2 and 3)
    $showHospitalColumn = in_array($userRole, [2, 3]);
?>

<?php $__env->startSection('role_user', $roleName); ?>
<?php $__env->startSection('main-title', 'Missions Management'); ?>
<?php $__env->startSection('sub-title', 'Mission Overview'); ?>

<?php $__env->startSection('content'); ?>
<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay" style="display: none;">
    <div class="loading-spinner"></div>
</div>

<!-- Alerts -->
<?php if(session('message')): ?>
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-4 mb-4" role="alert" style="border-radius: 12px; border-left: 4px solid #38ef7d;">
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

<?php if(session('message_delete')): ?>
<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center p-4 mb-4" role="alert" style="border-radius: 12px; border-left: 4px solid #ff6b6b;">
    <i class="ki-duotone ki-information fs-2hx text-danger me-4">
        <span class="path1"></span>
        <span class="path2"></span>
        <span class="path3"></span>
    </i>
    <div class="flex-grow-1">
        <h5 class="mb-1 text-danger">Deleted Successfully</h5>
        <span><?php echo e(session('message_delete')); ?></span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if(session('message_edit')): ?>
<div class="alert alert-info alert-dismissible fade show d-flex align-items-center p-4 mb-4" role="alert" style="border-radius: 12px; border-left: 4px solid #4facfe;">
    <i class="ki-duotone ki-check-circle fs-2hx text-info me-4">
        <span class="path1"></span>
        <span class="path2"></span>
    </i>
    <div class="flex-grow-1">
        <h5 class="mb-1 text-info">Updated Successfully</h5>
        <span><?php echo e(session('message_edit')); ?></span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Statistics Cards Row -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="stats-card primary position-relative">
            <div class="position-relative" style="z-index: 2;">
                <div class="stats-number" id="totalMissions">0</div>
                <div class="stats-label">Total Missions</div>
            </div>
            <i class="ki-duotone ki-graph-up stats-icon">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
                <span class="path6"></span>
            </i>
        </div>
    </div>
    
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="stats-card success position-relative">
            <div class="position-relative" style="z-index: 2;">
                <div class="stats-number" id="activeMissions">0</div>
                <div class="stats-label">Active Missions</div>
            </div>
            <i class="ki-duotone ki-chart-simple stats-icon">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
            </i>
        </div>
    </div>
    
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="stats-card warning position-relative">
            <div class="position-relative" style="z-index: 2;">
                <div class="stats-number" id="pendingMissions">0</div>
                <div class="stats-label">Pending Missions</div>
            </div>
            <i class="ki-duotone ki-time stats-icon">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="stats-card info position-relative">
            <div class="position-relative" style="z-index: 2;">
                <div class="stats-number" id="completedMissions">0</div>
                <div class="stats-label">Completed Missions</div>
            </div>
            <i class="ki-duotone ki-check-circle stats-icon">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
</div>

<!-- Filters Section -->
<div class="filter-section">
    <div class="row g-3 align-items-end">
        <div class="col-lg-4 col-md-6">
            <label class="form-label fw-bold text-muted">Search Missions</label>
            <div class="position-relative">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4 mt-3 text-muted"></i>
                <input type="text" id="searchInput" class="form-control ps-12" placeholder="Search by contact, hospital, or ID..." />
            </div>
        </div>
        
        <div class="col-lg-2 col-md-6">
            <label class="form-label fw-bold text-muted">Status</label>
            <select class="form-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="Recently">Recently</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Completed">Completed</option>
                <option value="Suspended">Suspended</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>
        </div>
        
        <div class="col-lg-2 col-md-6">
            <label class="form-label fw-bold text-muted">Priority</label>
            <select class="form-select" id="priorityFilter">
                <option value="">All Priority</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>
        
        <div class="col-lg-2 col-md-6">
            <button type="button" class="btn btn-enhanced btn-primary-gradient w-100" id="resetFilters">
                <i class="ki-outline ki-arrows-circle fs-3"></i>
                Reset Filters
            </button>
        </div>
        
        <?php if($canAddMission): ?>
        <div class="col-lg-2 col-md-6">
            <a href="<?php echo e(url('missions/add')); ?>" class="btn btn-enhanced btn-success-gradient w-100">
                <i class="ki-outline ki-plus fs-3"></i>
                Add Mission
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Enhanced Table Card -->
<div class="enhanced-table-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3 class="card-title fw-bold mb-1">Missions List</h3>
                <p class="text-white mb-0 opacity-75" style="font-size: 0.9rem;">Manage and track all medical missions</p>
            </div>
            <div>
                <form action="<?php echo e(route('mission.export')); ?>" method="GET" class="d-inline">
                    <button type="submit" class="btn btn-light btn-sm">
                        <i class="ki-duotone ki-exit-down fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Export to Excel
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        <!-- Desktop Table View -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="kt_missions_table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;">#</th>
                        <th style="min-width: 100px;">Mission ID</th>
                        <?php if($showHospitalColumn): ?>
                        <th style="min-width: 150px;">Hospital</th>
                        <?php endif; ?>
                        <th style="min-width: 150px;">Specialization</th>
                        <th class="text-center" style="min-width: 120px;">Priority</th>
                        <th style="min-width: 150px;">Target</th>
                        <th style="min-width: 150px;">Contact Info</th>
                        <th style="min-width: 200px;">Timeline</th>
                        <th class="text-center" style="min-width: 120px;">Status</th>
                        <th class="text-center" style="min-width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="missionsTableBody">
                    <!-- Data will be populated by DataTables -->
                </tbody>
            </table>
        </div>
        
        <!-- Mobile Cards View -->
        <div id="mobileCardsContainer">
            <!-- Mobile cards will be populated here -->
        </div>
        
        <!-- Empty State -->
        <div class="empty-state d-none" id="emptyState">
            <i class="ki-duotone ki-file-deleted empty-state-icon">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <h4 class="empty-state-title">No Missions Found</h4>
            <p class="empty-state-text">Try adjusting your filters<?php if($canAddMission): ?> or create a new mission<?php endif; ?></p>
            @if($canAddMission)
            <a href="<?php echo e(url('missions/add')); ?>" class="btn btn-enhanced btn-primary-gradient mt-3">
                <i class="ki-outline ki-plus fs-3"></i>
                Create New Mission
            </a>
            @endif
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets')); ?>/plugins/custom/datatables/datatables.bundle.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
// Enhanced Missions DataTable - Shared for all roles
"use strict";

// Global config from PHP
const USER_ROLE = <?php echo e($userRole); ?>;
const CAN_ADD_MISSION = <?php echo e($canAddMission ? 'true' : 'false'); ?>;
const SHOW_HOSPITAL_COLUMN = <?php echo e($showHospitalColumn ? 'true' : 'false'); ?>;

var EnhancedMissionsTable = function() {
    var table;
    var dt;
    var statsData = {
        total: 0,
        active: 0,
        pending: 0,
        completed: 0
    };
    
    // Update statistics
    function updateStatistics(data) {
        statsData.total = data.length;
        statsData.active = data.filter(item => item.status === 'Ongoing').length;
        statsData.pending = data.filter(item => item.status === 'Recently').length;
        statsData.completed = data.filter(item => item.status === 'Completed').length;
        
        animateCounter('totalMissions', statsData.total);
        animateCounter('activeMissions', statsData.active);
        animateCounter('pendingMissions', statsData.pending);
        animateCounter('completedMissions', statsData.completed);
    }
    
    function animateCounter(elementId, targetValue) {
        const element = document.getElementById(elementId);
        const duration = 1000;
        const steps = 30;
        const stepValue = targetValue / steps;
        let currentValue = 0;
        
        const interval = setInterval(function() {
            currentValue += stepValue;
            if (currentValue >= targetValue) {
                element.textContent = targetValue;
                clearInterval(interval);
            } else {
                element.textContent = Math.floor(currentValue);
            }
        }, duration / steps);
    }
    
    function formatPriority(priority) {
        const priorityClasses = {
            'high': 'high',
            'medium': 'medium',
            'low': 'low'
        };
        
        const priorityIcons = {
            'high': '<i class="ki-duotone ki-arrow-up fs-3"><span class="path1"></span><span class="path2"></span></i>',
            'medium': '<i class="ki-duotone ki-minus fs-3"><span class="path1"></span></i>',
            'low': '<i class="ki-duotone ki-arrow-down fs-3"><span class="path1"></span><span class="path2"></span></i>'
        };
        
        return `<span class="badge-enhanced priority-badge ${priorityClasses[priority] || 'medium'}">
            ${priorityIcons[priority] || ''} ${priority.toUpperCase()}
        </span>`;
    }
    
    function formatStatus(status, note) {
        const statusConfig = {
            'Recently': { color: 'primary', icon: 'ki-time' },
            'Suspended': { color: 'dark', icon: 'ki-pause-circle' },
            'Rejected': { color: 'danger', icon: 'ki-cross-circle' },
            'Ongoing': { color: 'warning', icon: 'ki-loading' },
            'Completed': { color: 'success', icon: 'ki-check-circle' },
            'Approved': { color: 'info', icon: 'ki-verify' }
        };
        
        const config = statusConfig[status] || statusConfig['Recently'];
        const tooltip = note ? `data-bs-toggle="tooltip" title="${note}"` : '';
        
        return `<span class="badge badge-light-${config.color} badge-enhanced" ${tooltip}>
            <i class="ki-duotone ${config.icon} fs-5"><span class="path1"></span><span class="path2"></span></i>
            ${status}
        </span>`;
    }
    
    function formatTimeline(startDate, endDate) {
        return `
            <div class="d-flex flex-column gap-1">
                <div class="d-flex align-items-center gap-2">
                    <i class="ki-duotone ki-calendar fs-5 text-success"><span class="path1"></span><span class="path2"></span></i>
                    <span class="fw-semibold text-success" style="font-size: 0.85rem;">${startDate}</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="ki-duotone ki-calendar fs-5 text-danger"><span class="path1"></span><span class="path2"></span></i>
                    <span class="fw-semibold text-danger" style="font-size: 0.85rem;">${endDate}</span>
                </div>
            </div>
        `;
    }
    
    function formatContactInfo(name, phone) {
        return `
            <div class="d-flex flex-column gap-1">
                <div class="d-flex align-items-center gap-2">
                    <i class="ki-duotone ki-user fs-5 text-primary"><span class="path1"></span><span class="path2"></span></i>
                    <span class="fw-semibold" style="font-size: 0.85rem;">${name}</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="ki-duotone ki-phone fs-5 text-primary"><span class="path1"></span><span class="path2"></span></i>
                    <span class="text-muted" style="font-size: 0.85rem;">${phone}</span>
                </div>
            </div>
        `;
    }
    
    function formatActions(row) {
        // For roles 2 and 3, show View button only (always enabled)
        if (!CAN_ADD_MISSION) {
            return `
                <div class="action-btn-group">
                    <a href="${BASE_URL}/missions/view_mission/${row.id}" 
                       class="action-btn view" 
                       data-bs-toggle="tooltip" 
                       title="View Mission Details">
                        <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    </a>
                </div>
            `;
        }
        
        // For role 1, show View/Edit/Delete with conditional disabling
        const canEdit = row.status === 'Recently';
        const editDisabled = !canEdit ? 'disabled' : '';
        const editAttr = !canEdit ? 'aria-disabled="true"' : '';
        const deleteDisabled = !canEdit ? 'disabled' : '';
        const deleteAttr = !canEdit ? 'aria-disabled="true"' : '';
        
        // Edit button
        const editButton = canEdit 
            ? `<a href="${BASE_URL}/missions/edit_mission/${row.id}" 
                   class="action-btn edit" 
                   data-bs-toggle="tooltip" 
                   title="Edit Mission">
                    <i class="ki-duotone ki-notepad-edit fs-4"><span class="path1"></span><span class="path2"></span></i>
                </a>`
            : `<span class="action-btn edit ${editDisabled}" 
                     ${editAttr}
                     data-bs-toggle="tooltip" 
                     title="Cannot edit - Status is not Recently">
                    <i class="ki-duotone ki-notepad-edit fs-4"><span class="path1"></span><span class="path2"></span></i>
                </span>`;
        
        // Delete button
        const deleteButton = canEdit
            ? `<a href="${BASE_URL}/missions/delete_mission/${row.id}" 
                   class="action-btn delete" 
                   data-bs-toggle="tooltip" 
                   title="Delete Mission"
                   onclick="return confirm('Are you sure you want to delete this mission?');">
                    <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                </a>`
            : `<span class="action-btn delete ${deleteDisabled}" 
                     ${deleteAttr}
                     data-bs-toggle="tooltip" 
                     title="Cannot delete - Status is not Recently">
                    <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                </span>`;
        
        return `
            <div class="action-btn-group">
                <a href="${BASE_URL}/missions/view_mission/${row.id}" 
                   class="action-btn view" 
                   data-bs-toggle="tooltip" 
                   title="View Details">
                    <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                </a>
                ${editButton}
                ${deleteButton}
            </div>
        `;
    }
    
    function createMobileCard(row, index) {
        const hospitalInfo = SHOW_HOSPITAL_COLUMN ? `
            <div class="mobile-info-row">
                <div class="mobile-info-icon">
                    <i class="ki-duotone ki-hospital fs-2"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <div class="mobile-info-content">
                    <div class="mobile-info-label">Hospital</div>
                    <div class="mobile-info-value">${row.hospital}</div>
                </div>
            </div>
        ` : '';
        
        return `
            <div class="mobile-mission-card">
                <div class="mobile-card-header">
                    <div>
                        <div class="mobile-card-title">Mission #${row.id}</div>
                        <div class="mobile-card-id">${row.target}</div>
                    </div>
                    ${formatStatus(row.status, row.note)}
                </div>
                
                <div class="mobile-card-body">
                    ${hospitalInfo}
                    
                    <div class="mobile-info-row">
                        <div class="mobile-info-icon">
                            <i class="ki-duotone ki-abstract-26 fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <div class="mobile-info-content">
                            <div class="mobile-info-label">Specialization</div>
                            <div class="mobile-info-value">${row.target}</div>
                        </div>
                    </div>
                    
                    <div class="mobile-info-row">
                        <div class="mobile-info-icon">
                            <i class="ki-duotone ki-flag fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <div class="mobile-info-content">
                            <div class="mobile-info-label">Priority</div>
                            <div class="mobile-info-value">${formatPriority(row.priority)}</div>
                        </div>
                    </div>
                    
                    <div class="mobile-info-row">
                        <div class="mobile-info-icon">
                            <i class="ki-duotone ki-user fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <div class="mobile-info-content">
                            <div class="mobile-info-label">Contact Person</div>
                            <div class="mobile-info-value">${row.contact_name}</div>
                            <div class="text-muted" style="font-size: 0.85rem; margin-top: 0.25rem;">
                                <i class="ki-duotone ki-phone fs-6"><span class="path1"></span><span class="path2"></span></i>
                                ${row.contact_phone}
                            </div>
                        </div>
                    </div>
                    
                    <div class="mobile-info-row">
                        <div class="mobile-info-icon">
                            <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <div class="mobile-info-content">
                            <div class="mobile-info-label">Timeline</div>
                            <div class="mobile-info-value">
                                <span class="text-success">${row.start_date}</span> 
                                <i class="ki-outline ki-arrow-right fs-6 text-muted mx-1"></i> 
                                <span class="text-danger">${row.end_date}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mobile-card-footer">
                    <div class="text-muted" style="font-size: 0.85rem;">
                        <i class="ki-duotone ki-geolocation fs-5"><span class="path1"></span><span class="path2"></span></i>
                        ${row.requestTarget}
                    </div>
                    ${formatActions(row)}
                </div>
            </div>
        `;
    }
    
    var initDatatable = function() {
        $('#loadingOverlay').show();
        
        // Define columns based on role
        let columns = [
            { data: 'id' },      // 0: Row number
            { data: 'id' },      // 1: Mission ID
        ];
        
        let columnDefs = [
            {
                targets: 0,
                className: 'text-center fw-bold',
                render: function(data, type, row, meta) {
                    return `<span class="badge badge-light-primary">${meta.row + meta.settings._iDisplayStart + 1}</span>`;
                }
            },
            {
                targets: 1,
                render: function(data, type, row) {
                    return `<a href="${BASE_URL}/missions/view_mission/${row.id}" class="text-primary fw-bold text-hover-dark">#${data}</a>`;
                }
            }
        ];
        
        let colIndex = 2;
        
        // Add hospital column if needed
        if (SHOW_HOSPITAL_COLUMN) {
            columns.push({ data: 'hospital' });
            columnDefs.push({
                targets: colIndex,
                render: function(data, type, row) {
                    return `
                        <div class="d-flex align-items-center gap-2">
                            <i class="ki-duotone ki-hospital fs-2 text-info">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-semibold">${data}</span>
                        </div>
                    `;
                }
            });
            colIndex++;
        }
        
        // Add remaining columns
        columns.push(
            { data: 'target' },          // Specialization
            { data: 'priority' },        // Priority
            { data: 'requestTarget' },   // Target
            { data: 'contact_name' },    // Contact
            { data: 'start_date' },      // Timeline
            { data: 'status' }           // Status
        );
        
        // Specialization
        columnDefs.push({
            targets: colIndex,
            render: function(data, type, row) {
                return `
                    <div class="d-flex align-items-center gap-2">
                        <i class="ki-duotone ki-abstract-26 fs-2 text-primary">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <a href="${BASE_URL}/missions/view_mission/${row.id}" class="text-gray-800 text-hover-primary fw-semibold">${data}</a>
                    </div>
                `;
            }
        });
        colIndex++;
        
        // Priority
        columnDefs.push({
            targets: colIndex,
            className: 'text-center',
            render: function(data, type, row) {
                return formatPriority(data);
            }
        });
        colIndex++;
        
        // Target
        columnDefs.push({
            targets: colIndex,
            render: function(data, type, row) {
                return `
                    <div class="d-flex align-items-center gap-2">
                        <i class="ki-duotone ki-geolocation fs-2 text-success">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <span class="fw-semibold">${data}</span>
                    </div>
                `;
            }
        });
        colIndex++;
        
        // Contact Info
        columnDefs.push({
            targets: colIndex,
            render: function(data, type, row) {
                return formatContactInfo(row.contact_name, row.contact_phone);
            }
        });
        colIndex++;
        
        // Timeline
        columnDefs.push({
            targets: colIndex,
            render: function(data, type, row) {
                return formatTimeline(row.start_date, row.end_date);
            }
        });
        colIndex++;
        
        // Status
        columnDefs.push({
            targets: colIndex,
            className: 'text-center',
            render: function(data, type, row) {
                return formatStatus(data, row.note);
            }
        });
        colIndex++;
        
        // Actions (always show, but different based on role)
        columns.push({ data: null });
        columnDefs.push({
            targets: colIndex,
            className: 'text-center',
            orderable: false,
            render: function(data, type, row) {
                return formatActions(row);
            }
        });
        
        dt = $("#kt_missions_table").DataTable({
            responsive: false,
            searchDelay: 500,
            processing: true,
            serverSide: false,
            order: [[1, 'desc']],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            pageLength: 25,
            language: {
                processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                lengthMenu: "Show _MENU_ missions",
                info: "Showing _START_ to _END_ of _TOTAL_ missions",
                infoEmpty: "Showing 0 to 0 of 0 missions",
                infoFiltered: "(filtered from _MAX_ total missions)",
                search: "",
                searchPlaceholder: "Search missions...",
                paginate: {
                    first: '<i class="ki-outline ki-double-left fs-3"></i>',
                    last: '<i class="ki-outline ki-double-right fs-3"></i>',
                    previous: '<i class="ki-outline ki-left fs-3"></i>',
                    next: '<i class="ki-outline ki-right fs-3"></i>'
                }
            },
            ajax: {
                url: BASE_URL + '/missions/list',
                type: 'POST',
                data: {"_token": TOKEN},
                dataSrc: function(json) {
                    $('#loadingOverlay').hide();
                    updateStatistics(json.data);
                    updateMobileCards(json.data);
                    
                    if (json.data.length === 0) {
                        $('#emptyState').removeClass('d-none');
                        $('.table-responsive').hide();
                    } else {
                        $('#emptyState').addClass('d-none');
                        $('.table-responsive').show();
                    }
                    
                    return json.data;
                }
            },
            columns: columns,
            columnDefs: columnDefs,
            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
                KTMenu.createInstances();
            }
        });
        
        table = dt.$;
        
        // Filters
        $('#searchInput').on('keyup', function() {
            dt.search(this.value).draw();
        });
        
        const statusColumn = SHOW_HOSPITAL_COLUMN ? 8 : 7;
        $('#statusFilter').on('change', function() {
            dt.column(statusColumn).search(this.value).draw();
        });
        
        const priorityColumn = SHOW_HOSPITAL_COLUMN ? 4 : 3;
        $('#priorityFilter').on('change', function() {
            dt.column(priorityColumn).search(this.value).draw();
        });
        
        $('#resetFilters').on('click', function() {
            $('#searchInput').val('');
            $('#statusFilter').val('');
            $('#priorityFilter').val('');
            dt.search('').columns().search('').draw();
        });
    }
    
    function updateMobileCards(data) {
        const container = $('#mobileCardsContainer');
        container.empty();
        
        if (data.length === 0) {
            container.html(`
                <div class="empty-state">
                    <i class="ki-duotone ki-file-deleted empty-state-icon">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <h4 class="empty-state-title">No Missions Found</h4>
                    <p class="empty-state-text">Try adjusting your filters</p>
                </div>
            `);
            return;
        }
        
        data.forEach((row, index) => {
            container.append(createMobileCard(row, index));
        });
        
        $('[data-bs-toggle="tooltip"]').tooltip();
    }
    
    return {
        init: function() {
            initDatatable();
        }
    }
}();

KTUtil.onDOMContentLoaded(function() {
    EnhancedMissionsTable.init();
});

setTimeout(function() {
    $('.alert-dismissible').fadeOut('slow', function() {
        $(this).remove();
    });
}, 5000);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\laragon\www\delegation\resources\views/task/index.blade.php ENDPATH**/ ?>