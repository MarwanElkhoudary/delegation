<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets')); ?>/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(asset('assets')); ?>/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(asset('assets')); ?>/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets')); ?>/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets')); ?>/styles/flatpickr.min.css" rel="stylesheet" type="text/css"/>

    <style>
        /* Enhanced Edit Mission Styling - Same as Add Page */

        /* Page Container */
        .tab-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Cards Enhancement */
        .card.card-flush {
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            margin-bottom: 1.25rem;
            border: none;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Headers */
        .card-body h1,
        .card-body h5 {
            color: #1e3c72;
            font-weight: 700;
            border-bottom: 2px solid #e4e6ef;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }

        /* Form Controls */
        .form-select-solid,
        .form-control-solid {
            border: 1px solid #e4e6ef;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-select-solid:focus,
        .form-control-solid:focus {
            border-color: #1e3c72;
            box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.1);
        }

        /* Labels */
        label.fs-5 {
            color: #3f4254;
            font-weight: 600;
            font-size: 0.95rem !important;
        }

        label.required::after {
            color: #dc3545;
        }

        /* Repeater Styling */
        [data-repeater-item] {
            background: white;
            border: 1px solid #e4e6ef;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        [data-repeater-item]:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }

        /* Repeater Container */
        [data-repeater-list] {
            background: #f8f9fa;
            border: 2px dashed #e4e6ef;
            border-radius: 12px;
            padding: 1.5rem;
        }

        /* Add Button */
        [data-repeater-create] {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%) !important;
            color: white !important;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        [data-repeater-create]:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        /* Delete Button */
        [data-repeater-delete] {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
            color: white !important;
            border: none;
            padding: 0.4rem 0.85rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        [data-repeater-delete]:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }

        /* Submit Button */
        button[type="submit"] {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border: none;
            padding: 0.85rem 2.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3);
        }

        /* Error Messages */
        .alert-danger {
            background: #fff5f5;
            border-left: 4px solid #dc3545;
            color: #721c24;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }

        /* Row Spacing */
        .row.mb-5 {
            margin-bottom: 1.25rem !important;
        }

        /* Separator */
        .separator {
            margin: 1.5rem 0;
            border-color: #e4e6ef;
        }

        /* Responsive */
        @media (max-width: 767px) {
            .card-body {
                padding: 1rem;
            }

            [data-repeater-list] {
                padding: 1rem;
            }

            [data-repeater-item] {
                padding: 1rem;
            }

            button[type="submit"] {
                width: 100%;
            }
        }

        /* Select2 Custom */
        .select2-container--bootstrap5 .select2-selection {
            border: 1px solid #e4e6ef;
            border-radius: 8px;
        }

        .select2-container--bootstrap5 .select2-selection:focus,
        .select2-container--bootstrap5.select2-container--focus .select2-selection,
        .select2-container--bootstrap5.select2-container--open .select2-selection {
            border-color: #1e3c72;
            box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.1);
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('role_user', 'Hospital Account'); ?>
<?php $__env->startSection('main-title'); ?>
    <a href="<?php echo e(route('mission.index')); ?>">Missions</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sub-title', 'Edit Mission'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="mb-4" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border-radius: 12px; padding: 1.5rem 2rem; color: white; box-shadow: 0 4px 15px rgba(30, 60, 114, 0.2);">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 style="font-size: 1.75rem; font-weight: 700; margin: 0; color: white;">
                    <i class="ki-duotone ki-notepad-edit fs-2x me-2" style="vertical-align: middle;">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Edit Mission #<?php echo e($task->id); ?>

                </h1>
                <p style="font-size: 0.95rem; opacity: 0.9; margin: 0.25rem 0 0 0;">Update mission details and requirements</p>
            </div>
            <div>
                <a href="<?php echo e(route('mission.index')); ?>" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="ki-duotone ki-arrow-left fs-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <!--begin::Tab pane-->
        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <!--begin::General options-->
                <form action="<?php echo e(route('mission.update', [$task->id])); ?>" class="form mb-15" method="post"
                      id="kt_careers_form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <!--begin::Input group-->
                    <div class="card card-flush py-4">
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <h1 class="fw-bold text-gray-900 mb-9">Human Resources</h1>

                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required">Specialization</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                          title="selected specialization">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select required
                                        name="specialization" data-control="select2"
                                        class="form-select form-select-solid">
                                    <option value="">Select your specialization</option>
                                    <?php if(count($targets) >0): ?>
                                        <?php $__currentLoopData = $targets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($target->id); ?>" <?php echo e(old('specialization', $task->target_id) == $target->id ? "selected" :""); ?>><?php echo e($target->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <!--end::Select-->
                            </div>
                            <?php $__errorArgs = ['specialization'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <li class="alert alert-danger"><?php echo e($message); ?></li>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <!--end::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">Contact Person</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input required value="<?php echo e(old('contact_name', $task->contact_name)); ?>" type="text"
                                           class="form-control form-control-solid"
                                           placeholder="Contact Name" name="contact_name"/>
                                    <!--end::Input-->
                                    <?php $__errorArgs = ['contact_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <li class="alert alert-danger"><?php echo e($message); ?></li>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--end::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">Contact Phone</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input value="<?php echo e(old('contact_phone', $task->contact_phone)); ?>"
                                           class="form-control form-control-solid"
                                           placeholder="Contact Phone" name="contact_phone"/>
                                    <!--end::Input-->
                                    <?php $__errorArgs = ['contact_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <li class="alert alert-danger"><?php echo e($message); ?></li>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required">Target Specialization</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                          title="selected specialization">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select required name="specialization_target" data-control="select2"
                                        class="form-select form-select-solid">
                                    <option value="">Select your specialization</option>
                                    <?php if(count($targets) >0): ?>
                                        <?php $__currentLoopData = $targets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($target->id); ?>" <?php echo e(old('specialization_target', $task->request_target_id) == $target->id ? "selected" :""); ?>><?php echo e($target->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <!--end::Select-->
                            </div>
                            <?php $__errorArgs = ['specialization_target'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <li class="alert alert-danger"><?php echo e($message); ?></li>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row row-cols-lg-2 g-10">
                                <div class="col">
                                    <div class="fv-row mb-9">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold mb-2 required">Start Mission</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input required type="date" class="form-control form-control-solid"
                                               name="start_date" value="<?php echo e(old("start_date",  $task->start_date)); ?>"
                                               placeholder="select the start period date"
                                               id="start_date"/>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <li class="alert alert-danger"><?php echo e($message); ?></li>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="col" data-kt-calendar="datepicker">
                                    <div class="fv-row mb-9">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold mb-2">End Mission</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input required class="form-control form-control-solid"
                                               name="end_date" value="<?php echo e(old("end_date", $task->end_date)); ?>"
                                               placeholder="select the end period date"
                                               id="end_date"/>
                                        <!--end::Input-->
                                    </div>
                                    <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <li class="alert alert-danger"><?php echo e($message); ?></li>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="d-flex flex-column mb-5 fv-row">
                                <label class="required fs-5 fw-semibold mb-2">Medical Team Needs</label>
                                <div id="medical_needs_repeater">
                                    <div class="form-group">
                                        <div data-repeater-list="medical_needs_list" class="d-flex flex-column gap-3">
                                            <?php $__currentLoopData = $task->medicalNeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicalNeed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    // Fetch specializations for this human_type_id
                                                    $specializations = \App\Models\Specialization::where('human_type_id', $medicalNeed->human_type_id)->get();
                                                ?>
                                                <div data-repeater-item="" class="form-group">
                                                    <div class="row g-3 align-items-end">
                                                        <!--Human Type-->
                                                        <div class="col-lg-3 col-md-6">
                                                            <label class="form-label fw-semibold">Human Type <span class="text-danger">*</span></label>
                                                            <select class="form-select form-select-solid need-human-type" name="human_type_id" data-placeholder="Select type" data-kt-ecommerce-catalog-add-category="human_type" data-control="select2" required>
                                                                <?php if(count($human_types) > 0): ?>
                                                                    <?php $__currentLoopData = $human_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $human_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($human_type->id); ?>" <?php echo e(old('human_type_id', $medicalNeed->human_type_id) == $human_type->id ? "selected" : ""); ?>><?php echo e($human_type->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php else: ?>
                                                                    <option value="">No human types available</option>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>

                                                        <!--Specialization-->
                                                        <div class="col-lg-3 col-md-6">
                                                            <label class="form-label fw-semibold">Specialization <span class="text-danger">*</span></label>
                                                            <select required class="form-select form-select-solid need-specialization" name="specialization_id" data-placeholder="Select specialization" data-kt-ecommerce-catalog-add-category="Specialization_type" data-control="select2" data-preselected-value="<?php echo e($medicalNeed->specialization_id ?? ''); ?>">
                                                                <option value="">Select specialization...</option>
                                                                <?php if($specializations->isEmpty()): ?>
                                                                    <option value="">No specializations available</option>
                                                                <?php else: ?>
                                                                    <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($specialization->id); ?>" <?php echo e($medicalNeed->specialization_id == $specialization->id ? "selected" : ""); ?>><?php echo e($specialization->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>

                                                        <!--Count-->
                                                        <div class="col-lg-2 col-md-6">
                                                            <label class="form-label fw-semibold">Count <span class="text-danger">*</span></label>
                                                            <input type="number" min="1" required class="form-control form-control-solid" name="count" placeholder="Qty" value="<?php echo e(old('count', $medicalNeed->count)); ?>"/>
                                                        </div>

                                                        <!--Notes-->
                                                        <div class="col-lg-3 col-md-6">
                                                            <label class="form-label fw-semibold">Notes</label>
                                                            <input type="text" class="form-control form-control-solid" name="note" placeholder="Enter notes" value="<?php echo e(old('note', $medicalNeed->note)); ?>"/>
                                                        </div>

                                                        <!--Delete Button-->
                                                        <div class="col-lg-1 col-md-12">
                                                            <button type="button"
                                                                    data-repeater-delete
                                                                    class="btn btn-sm btn-icon w-100"
                                                                    style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; height: 42px;">
                                                                <i class="ki-outline ki-trash fs-3"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="button" data-repeater-create="" style="display: none" class="btn btn-sm hide">
                                            <i class="ki-outline ki-plus fs-2"></i>Add another medical need
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required">Priority</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                          title="Select mission priority">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="priority" data-control="select2"
                                        data-placeholder="Select priority..."
                                        class="form-select form-select-solid">
                                    <option value="low" <?php echo e(old('priority', $task->priority) == "low" ? "selected" :""); ?>>🟢 LOW</option>
                                    <option value="medium" <?php echo e(old('priority', $task->priority) == "medium" ? "selected" :""); ?>>
                                        🟠 MEDIUM
                                    </option>
                                    <option value="high" <?php echo e(old('priority', $task->priority) == "high" ? "selected" :""); ?>>🔴 HIGH
                                    </option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <label class="required fs-5 fw-semibold mb-2">Additional Requirements</label>
                                <div id="additional_requirements_repeater">
                                    <div class="form-group">
                                        <div data-repeater-list="additional_requirements_list" class="d-flex flex-column gap-3">
                                            <?php if($task->requirementNeeds->isEmpty()): ?>
                                                <!-- Initialize with an empty item if no requirements exist -->
                                                <div data-repeater-item="" class="form-group">
                                                    <div class="row g-3 align-items-end">
                                                        <div class="col-lg-3 col-md-6">
                                                            <label class="form-label fw-semibold">Requirement Type <span class="text-danger">*</span></label>
                                                            <select class="form-select form-select-solid" name="requirement_id" data-placeholder="Select requirement" data-kt-ecommerce-catalog-add-category="human_type" data-control="select2" required>
                                                                <option value="">Select requirement...</option>
                                                                <?php if(count($requirements) > 0): ?>
                                                                    <?php $__currentLoopData = $requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($requirement->id); ?>"><?php echo e($requirement->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6">
                                                            <label class="form-label fw-semibold">Category Name</label>
                                                            <input type="text" class="form-control form-control-solid" name="category_name" placeholder="Enter category" value=""/>
                                                        </div>
                                                        <div class="col-lg-2 col-md-6">
                                                            <label class="form-label fw-semibold">Count <span class="text-danger">*</span></label>
                                                            <input type="number" min="1" required class="form-control form-control-solid" name="count" placeholder="Qty" value=""/>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6">
                                                            <label class="form-label fw-semibold">Priority <span class="text-danger">*</span></label>
                                                            <select class="form-select form-select-solid" name="priority" data-placeholder="Select priority" data-control="select2" required>
                                                                <option value="not critical">🟢 Not Critical</option>
                                                                <option value="critical">🔴 Critical</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-1 col-md-12">
                                                            <button type="button"
                                                                    data-repeater-delete
                                                                    class="btn btn-sm btn-icon w-100"
                                                                    style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; height: 42px;">
                                                                <i class="ki-outline ki-trash fs-3"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $task->requirementNeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirementNeed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div data-repeater-item="" class="form-group">
                                                        <div class="row g-3 align-items-end">
                                                            <div class="col-lg-3 col-md-6">
                                                                <label class="form-label fw-semibold">Requirement Type <span class="text-danger">*</span></label>
                                                                <select class="form-select form-select-solid" name="requirement_id" data-placeholder="Select requirement" data-kt-ecommerce-catalog-add-category="human_type" data-control="select2" required>
                                                                    <option value="">Select requirement...</option>
                                                                    <?php if(count($requirements) > 0): ?>
                                                                        <?php $__currentLoopData = $requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($requirement->id); ?>" <?php echo e(old('requirement_id', $requirementNeed->requirement_id) == $requirement->id ? "selected" :""); ?>><?php echo e($requirement->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6">
                                                                <label class="form-label fw-semibold">Category Name</label>
                                                                <input type="text" class="form-control form-control-solid" name="category_name" placeholder="Enter category" value="<?php echo e(old('category_name', $requirementNeed->category_name)); ?>"/>
                                                            </div>
                                                            <div class="col-lg-2 col-md-6">
                                                                <label class="form-label fw-semibold">Count <span class="text-danger">*</span></label>
                                                                <input type="number" min="1" required class="form-control form-control-solid" name="count" placeholder="Qty" value="<?php echo e(old('count', $requirementNeed->count)); ?>"/>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6">
                                                                <label class="form-label fw-semibold">Priority <span class="text-danger">*</span></label>
                                                                <select class="form-select form-select-solid" name="priority" data-placeholder="Select priority" data-control="select2" required>
                                                                    <option value="not critical" <?php echo e(old('priority', $requirementNeed->priority) == 'not critical' ? 'selected' : ''); ?>>🟢 Not Critical</option>
                                                                    <option value="critical" <?php echo e(old('priority', $requirementNeed->priority) == 'critical' ? 'selected' : ''); ?>>🔴 Critical</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-1 col-md-12">
                                                                <button type="button"
                                                                        data-repeater-delete
                                                                        class="btn btn-sm btn-icon w-100"
                                                                        style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; height: 42px;">
                                                                    <i class="ki-outline ki-trash fs-3"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- Removed data-repeater-create button -->
                                </div>
                            </div>

                            <!--begin::Separator-->
                            <div class="separator mb-8"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->

                    <br>

                    <div class="card card-flush py-4">
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <h1 class="fw-bold text-gray-900 mb-9">Recommendation</h1>

                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-5">
                                    <label class="fs-6 fw-semibold mb-2">Recommendation Team (Optional)</label>
                                    <textarea class="form-control form-control-solid" rows="1"
                                              name="recommendation_team"
                                              placeholder=""><?php echo e(old('recommendation_team', $task->recommendation?->recommendation_team)); ?></textarea>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-8">
                                    <label class="fs-6 fw-semibold mb-2">Recommendation Doctor (Optional)</label>
                                    <textarea class="form-control form-control-solid" rows="1"
                                              name="recommendation_doctor"
                                              placeholder=""><?php echo e(old('recommendation_doctor', $task->recommendation?->recommendation_doctor)); ?></textarea>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Separator-->
                                <div class="separator mb-8"></div>
                                <!--end::Separator-->
                            </div>
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary"
                                    id="kt_careers_submit_button">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Edit</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                    <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                            <!--end::Submit-->
                        </div>
                        <!--end::Card header-->
                    </div>
                </form>
            </div>
        </div>
        <!--end::Tab pane-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets')); ?>/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/javascript/pages/edit-task.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\laragon\www\delegation\resources\views/task/edit_task.blade.php ENDPATH**/ ?>