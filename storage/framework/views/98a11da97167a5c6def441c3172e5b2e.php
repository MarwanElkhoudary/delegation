<?php $__env->startSection('css'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(asset('assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/custom/formrepeater/formrepeater.bundle.css')); ?>" rel="stylesheet" type="text/css"/>
    <style>
        /* Calendar custom styles */
        .fc-event-available {
            background-color: #50cd89 !important;
            border-color: #50cd89 !important;
            cursor: pointer !important;
        }

        .fc-event-available:hover {
            background-color: #47be7d !important;
            transform: scale(1.02);
            transition: all 0.2s;
        }

        .fc-event-unavailable {
            background-color: #f1416c !important;
            border-color: #f1416c !important;
            cursor: not-allowed !important;
            opacity: 0.7;
        }

        .fc-daygrid-event {
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
        }

        /* Legend */
        .calendar-legend {
            display: flex;
            gap: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .legend-color.active {
            background-color: #50cd89;
        }

        .legend-color.pending {
            background-color: #ffc700;
        }

        .legend-color.completed {
            background-color: #7239ea;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
                <h2 class="card-title fw-bold">Mission Calendar</h2>
                <div class="card-toolbar">
                    <span class="badge badge-light-info">Click on active missions to apply</span>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Legend-->
                <div class="calendar-legend">
                    <div class="legend-item">
                        <div class="legend-color active"></div>
                        <span>Active (Click to Apply)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color pending"></div>
                        <span>Pending</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color completed"></div>
                        <span>Completed</span>
                    </div>
                </div>
                <!--end::Legend-->

                <!--begin::Calendar-->
                <div id="kt_calendar_app"></div>
                <!--end::Calendar-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/plugins/global/plugins.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/javascript/unauthorized/pages/calendar/calendar.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('unauthorized.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\laragon\www\delegation\resources\views/unauthorized/pages/home.blade.php ENDPATH**/ ?>