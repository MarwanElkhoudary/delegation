<?php $__env->startSection('css'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(asset('assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/custom/formrepeater/formrepeater.bundle.css')); ?>" rel="stylesheet" type="text/css"/>

    <style>
        .mission-info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .mission-info-card h2 {
            color: white;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .mission-detail {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: rgba(255,255,255,0.1);
            border-radius: 5px;
        }

        .mission-detail i {
            font-size: 24px;
            margin-right: 15px;
            opacity: 0.9;
        }

        .mission-detail-content {
            flex: 1;
        }

        .mission-detail-label {
            font-size: 12px;
            opacity: 0.8;
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .mission-detail-value {
            font-size: 16px;
            font-weight: 500;
        }

        .status-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
        }

        .status-active {
            background: #10b981;
        }

        .status-pending {
            background: #f59e0b;
        }

        .status-completed {
            background: #6366f1;
        }

        .form-section {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .form-section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f5f9;
        }

        .required:after {
            content: " *";
            color: #ef4444;
        }

        /* File upload styling */
        .file-upload-wrapper {
            position: relative;
        }

        .file-upload-info {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
            display: none;
        }

        .file-upload-info.active {
            display: block;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px;
            background: white;
            border-radius: 4px;
            margin-bottom: 5px;
            border: 1px solid #e9ecef;
        }

        .file-item-name {
            flex: 1;
            font-size: 13px;
            color: #495057;
        }

        .file-item-size {
            font-size: 12px;
            color: #6c757d;
            margin: 0 10px;
        }

        .file-item-remove {
            cursor: pointer;
            color: #dc3545;
            font-size: 18px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="container-xxl">
            <!-- Mission Info Card -->
            <div class="mission-info-card">
                <h2><?php echo e($mission->title ?? 'Mission Details'); ?></h2>

                <div class="row">
                    <div class="col-md-2">
                        <div class="mission-detail">
                            <i class="ki-outline ki-information"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Status</div>
                                <div class="mission-detail-value">
                                    <span class="status-badge status-<?php echo e($mission->duration_state == 1 ? 'active' : ($mission->duration_state == 0 ? 'pending' : 'completed')); ?>">
                                        <?php echo e($mission->duration_state == 1 ? 'Active' : ($mission->duration_state == 0 ? 'Pending' : 'Completed')); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mission-detail">
                            <i class="ki-outline ki-calendar"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Start Date</div>
                                <div class="mission-detail-value"><?php echo e($mission->start_date ? date('d M Y', strtotime($mission->start_date)) : 'N/A'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mission-detail">
                            <i class="ki-outline ki-calendar-tick"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">End Date</div>
                                <div class="mission-detail-value"><?php echo e($mission->end_date ? date('d M Y', strtotime($mission->end_date)) : 'N/A'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mission-detail">
                            <i class="ki-outline ki-user"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Contact Name</div>
                                <div class="mission-detail-value"><?php echo e($mission->contact_name ?? 'N/A'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mission-detail">
                            <i class="ki-outline ki-phone"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Contact Phone</div>
                                <div class="mission-detail-value"><?php echo e($mission->contact_phone ?? 'N/A'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if($mission->description): ?>
                    <div class="mission-detail" style="margin-top: 15px;">
                        <i class="ki-outline ki-abstract-26"></i>
                        <div class="mission-detail-content">
                            <div class="mission-detail-label">Description</div>
                            <div class="mission-detail-value"><?php echo e($mission->description); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Application Form -->
            <form class="form" action="/apply_to_mission" method="POST" id="apply_mission_form" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="mission_id" value="<?php echo e($mission->id); ?>"/>

                <!-- Basic Information Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Basic Information</h3>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold  mb-2">Would you like to apply for this mission as</label>

                            <?php if(Auth::user()->human_type_id): ?>
                                <select class="form-select form-select-solid" name="human_type_display" id="human_type_display" data-control="select2" data-placeholder="Select Your Role" disabled>
                                    <option value="" disabled>Select Your Role</option>
                                    <?php $__currentLoopData = $humanTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>" <?php echo e(Auth::user()->human_type_id == $type->id ? 'selected' : ''); ?>><?php echo e($type->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <input type="hidden" name="human_type" id="human_type" value="<?php echo e(Auth::user()->human_type_id); ?>"/>
                            <?php else: ?>
                                <div class="alert alert-danger d-flex align-items-center p-5">
                                    <i class="ki-duotone ki-information fs-2hx text-danger me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <div class="d-flex flex-column">
                                        <h4 class="mb-1 text-danger">Missing Information</h4>
                                        <span>Your staff type is not set. Please contact the administrator.</span>
                                    </div>
                                </div>
                                <input type="hidden" name="human_type" id="human_type" value=""/>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Select Your Specialization</label>
                            <select class="form-select form-select-solid" name="specialization" id="specialization" data-control="select2" data-placeholder="Select Your Specialization" <?php echo e(!Auth::user()->human_type_id ? 'disabled' : ''); ?>>
                                <option value="" disabled selected>Select Your Specialization</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Full Name</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Full Name" id="full_name" name="full_name"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Gender</label>
                            <select class="form-select form-select-solid" name="gender" id="gender" data-control="select2" data-placeholder="Select an option">
                                <option></option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Birth of Date</label>
                            <input type="date" class="form-control form-control-solid" name="birth_date" id="birth_date" max="<?php echo e(date('Y-m-d')); ?>" min="1920-01-01">
                        </div>

                        <div class="col-md-4 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Nationality</label>
                            <select class="form-select form-select-solid" name="nationality" id="nationality" data-control="select2" data-placeholder="Select Nationality">
                                <option value="" disabled selected>Select Nationality</option>
                                <?php
                                    $countries = [
                                        'Afghan', 'Albanian', 'Algerian', 'American', 'Andorran', 'Angolan', 'Antiguans', 'Argentinean', 'Armenian', 'Australian',
                                        'Austrian', 'Azerbaijani', 'Bahamian', 'Bahraini', 'Bangladeshi', 'Barbadian', 'Barbudans', 'Batswana', 'Belarusian', 'Belgian',
                                        'Belizean', 'Beninese', 'Bhutanese', 'Bolivian', 'Bosnian', 'Brazilian', 'British', 'Bruneian', 'Bulgarian', 'Burkinabe',
                                        'Burmese', 'Burundian', 'Cambodian', 'Cameroonian', 'Canadian', 'Cape Verdean', 'Central African', 'Chadian', 'Chilean', 'Chinese',
                                        'Colombian', 'Comoran', 'Congolese', 'Costa Rican', 'Croatian', 'Cuban', 'Cypriot', 'Czech', 'Danish', 'Djibouti',
                                        'Dominican', 'Dutch', 'East Timorese', 'Ecuadorean', 'Egyptian', 'Emirian', 'Equatorial Guinean', 'Eritrean', 'Estonian', 'Ethiopian',
                                        'Fijian', 'Filipino', 'Finnish', 'French', 'Gabonese', 'Gambian', 'Georgian', 'German', 'Ghanaian', 'Greek',
                                        'Grenadian', 'Guatemalan', 'Guinea-Bissauan', 'Guinean', 'Guyanese', 'Haitian', 'Herzegovinian', 'Honduran', 'Hungarian', 'I-Kiribati',
                                        'Icelander', 'Indian', 'Indonesian', 'Iranian', 'Iraqi', 'Irish', 'Israeli', 'Italian', 'Ivorian', 'Jamaican',
                                        'Japanese', 'Jordanian', 'Kazakhstani', 'Kenyan', 'Kittian and Nevisian', 'Kuwaiti', 'Kyrgyz', 'Laotian', 'Latvian', 'Lebanese',
                                        'Liberian', 'Libyan', 'Liechtensteiner', 'Lithuanian', 'Luxembourger', 'Macedonian', 'Malagasy', 'Malawian', 'Malaysian', 'Maldivan',
                                        'Malian', 'Maltese', 'Marshallese', 'Mauritanian', 'Mauritian', 'Mexican', 'Micronesian', 'Moldovan', 'Monacan', 'Mongolian',
                                        'Moroccan', 'Mosotho', 'Motswana', 'Mozambican', 'Namibian', 'Nauruan', 'Nepalese', 'New Zealander', 'Ni-Vanuatu', 'Nicaraguan',
                                        'Nigerian', 'Nigerien', 'North Korean', 'Northern Irish', 'Norwegian', 'Omani', 'Pakistani', 'Palauan', 'Palestinian', 'Panamanian',
                                        'Papua New Guinean', 'Paraguayan', 'Peruvian', 'Polish', 'Portuguese', 'Qatari', 'Romanian', 'Russian', 'Rwandan', 'Saint Lucian',
                                        'Salvadoran', 'Samoan', 'San Marinese', 'Sao Tomean', 'Saudi', 'Scottish', 'Senegalese', 'Serbian', 'Seychellois', 'Sierra Leonean',
                                        'Singaporean', 'Slovakian', 'Slovenian', 'Solomon Islander', 'Somali', 'South African', 'South Korean', 'Spanish', 'Sri Lankan', 'Sudanese',
                                        'Surinamer', 'Swazi', 'Swedish', 'Swiss', 'Syrian', 'Taiwanese', 'Tajik', 'Tanzanian', 'Thai', 'Togolese',
                                        'Tongan', 'Trinidadian or Tobagonian', 'Tunisian', 'Turkish', 'Tuvaluan', 'Ugandan', 'Ukrainian', 'Uruguayan', 'Uzbekistani', 'Venezuelan',
                                        'Vietnamese', 'Welsh', 'Yemenite', 'Zambian', 'Zimbabwean'
                                    ];
                                ?>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country); ?>"><?php echo e($country); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Contact & Languages Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Contact & Languages</h3>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Contact Phone</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Phone" name="phone" id="phone"/>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Languages Spoken</label>
                            <select class="form-select form-select-solid" name="languages_spoken[]" id="languages_spoken" data-control="select2" data-close-on-select="false" data-placeholder="Select languages" data-allow-clear="true" multiple="multiple">
                                <option></option>
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($language->id); ?>"><?php echo e($language->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Academic Qualifications Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Academic Qualifications</h3>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold  mb-2">The Highest Academic Qualification</label>
                            <input type="text" class="form-control form-control-solid" placeholder="e.g., Master's Degree" id="highest_qualification" name="highest_qualification"/>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold  mb-2">The Granting University</label>
                            <input type="text" class="form-control form-control-solid" id="granting_university" name="granting_university" placeholder="e.g., Harvard University">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold  mb-2">Degree-Granting Country</label>
                            <input type="text" class="form-control form-control-solid" placeholder="e.g., USA" id="degree_granting_country" name="degree_granting_country"/>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold  mb-2">Date of Graduation</label>
                            <input type="date" class="form-control form-control-solid" id="date_of_graduation" name="date_of_graduation">
                        </div>
                    </div>
                </div>

                <!-- Professional Experience Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Professional Experience</h3>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold  mb-2">Years of Clinical Experience</label>
                            <input type="number" class="form-control form-control-solid" id="clinical_experience_years" name="clinical_experience_years" placeholder="e.g., 5" min="0">
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold  mb-2">Countries Previously Served In</label>
                            <input type="text" class="form-control form-control-solid" id="countries_previously_served" name="countries_previously_served" placeholder="e.g., USA, Canada, UK">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-7">
                            <label class="fs-6 fw-semibold  mb-2">Previous Employers</label>
                            <input type="text" class="form-control form-control-solid" id="previous_employers" name="previous_employers" placeholder="e.g., ABC Hospital, XYZ Clinic">
                        </div>
                    </div>
                </div>

                <!-- Specialized Experience Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Specialized Experience</h3>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold  mb-2">Experience in Disaster/Emergency Settings</label>
                        <div class="d-flex gap-5">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" value="yes" id="disaster_experience_yes" name="disaster_experience"/>
                                <label class="form-check-label" for="disaster_experience_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" value="no" id="disaster_experience_no" name="disaster_experience"/>
                                <label class="form-check-label" for="disaster_experience_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-7" id="disaster_experience_description_row" style="display: none;">
                        <label class="fs-6 fw-semibold  mb-2">Please describe your disaster/emergency experience</label>
                        <textarea class="form-control form-control-solid" rows="4" id="disaster_experience_description" name="disaster_experience_description" placeholder="Describe your experience..."></textarea>
                    </div>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold  mb-2">Volunteer Work Experience</label>
                        <div class="d-flex gap-5">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" value="yes" id="volunteer_experience_yes" name="volunteer_experience"/>
                                <label class="form-check-label" for="volunteer_experience_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" value="no" id="volunteer_experience_no" name="volunteer_experience"/>
                                <label class="form-check-label" for="volunteer_experience_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-7" id="volunteer_experience_description_row" style="display: none;">
                        <label class="fs-6 fw-semibold  mb-2">Please describe your volunteer experience</label>
                        <textarea class="form-control form-control-solid" rows="4" id="volunteer_experience_description" name="volunteer_experience_description" placeholder="Describe your experience..."></textarea>
                    </div>
                </div>

                <!-- Gaza Experience Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Gaza Experience</h3>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold mb-2">Have You Ever Visited Gaza?</label>
                            <div class="d-flex gap-5">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" value="yes" id="visited_gaza_yes" name="visited_gaza"/>
                                    <label class="form-check-label" for="visited_gaza_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" value="no" id="visited_gaza_no" name="visited_gaza"/>
                                    <label class="form-check-label" for="visited_gaza_no">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold mb-2">Place of Work During Previous Visit</label>
                            <input type="text" class="form-control form-control-solid" id="place_of_work_previous_visit" name="place_of_work_previous_visit" placeholder="e.g., Al-shifa'a, Nasser">
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Additional Information</h3>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold  mb-2">Educational or Training Contributions</label>
                        <textarea class="form-control form-control-solid" rows="3" id="educational_contributions" name="educational_contributions" placeholder="e.g., Conducted surgical training workshops..."></textarea>
                    </div>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold  mb-2">Published Scientific Papers</label>
                        <textarea class="form-control form-control-solid" rows="3" id="published_scientific_papers" name="published_scientific_papers" placeholder="e.g., Published 'AI-Driven Diagnostic Models'..."></textarea>
                    </div>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold  mb-2">Participation in Conferences or Workshops</label>
                        <textarea class="form-control form-control-solid" rows="3" id="conference_participation" name="conference_participation" placeholder="e.g., Presented a research paper at..."></textarea>
                    </div>
                </div>

                <!-- Doctors Worked With Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Doctors Worked With</h3>

                    <div id="kt_docs_repeater_basic_doctors">
                        <div class="form-group">
                            <div data-repeater-list="doctors">
                                <div data-repeater-item>
                                    <div class="row mb-5">
                                        <div class="col-md-5">
                                            <label class="form-label">Doctor Name</label>
                                            <input type="text" name="doctor_name" class="form-control mb-2 mb-md-0" placeholder="Enter full name"/>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">Visited Date</label>
                                            <input type="date" name="visited_date" class="form-control mb-2 mb-md-0"/>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-5">
                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                <i class="ki-duotone ki-plus fs-3"></i>
                                Add Doctor
                            </a>
                        </div>
                    </div>
                </div>

                <!-- File Upload Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Supporting Documents</h3>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold mb-2">Upload Files (Maximum 10 files)</label>
                        <div class="file-upload-wrapper">
                            <!-- Hidden file input for actual upload -->
                            <input type="file" name="file_input_temp" id="file_input_temp" multiple class="d-none" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"/>

                            <!-- Visible button to trigger file selection -->
                            <button type="button" class="btn btn-light-primary mb-3" onclick="document.getElementById('file_input_temp').click()">
                                <i class="ki-duotone ki-file-up fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Choose Files
                            </button>

                            <div class="form-text mb-3">Accepted formats: PDF, DOC, DOCX, JPG, PNG. Maximum file size: 5MB per file.</div>

                            <!-- File preview area -->
                            <div id="file_preview" class="file-upload-info"></div>

                            <!-- Hidden container for actual file inputs that will be submitted -->
                            <div id="file_inputs_container"></div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between pt-10">
                    <a href="/calendar" class="btn btn-light">
                        <i class="ki-duotone ki-arrow-left fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Back to Calendar
                    </a>
                    <button type="submit" class="btn btn-primary" id="submit_btn">
                        <span class="indicator-label">Submit Application</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/plugins/global/plugins.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/javascript/unauthorized/pages/apply-mission.js')); ?>"></script>

    <script>
        // Debug: Check user data
        $(document).ready(function() {
            console.log('=== Apply Mission Page Debug ===');
            console.log('User Role ID:', '<?php echo e(Auth::user()->role_id); ?>');
            console.log('User Human Type ID:', '<?php echo e(Auth::user()->human_type_id ?? "NULL"); ?>');
            console.log('Selected Human Type:', $('#human_type').val());
            console.log('User Email:', '<?php echo e(Auth::user()->email); ?>');
            console.log('User Name:', '<?php echo e(Auth::user()->name); ?>');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('unauthorized.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\laragon\www\delegation\resources\views/unauthorized/pages/apply-mission.blade.php ENDPATH**/ ?>