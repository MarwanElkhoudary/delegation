@extends('unauthorized.index')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.css') }}" rel="stylesheet" type="text/css"/>

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
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="container-xxl">
            <!-- Mission Info Card -->
            <div class="mission-info-card">
                <h2>{{ $mission->title ?? 'Mission Details' }}</h2>

                <div class="row">
                    <div class="col-md-2">
                        <div class="mission-detail">
                            <i class="ki-outline ki-information"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Status</div>
                                <div class="mission-detail-value">
                                    <span class="status-badge status-{{ $mission->duration_state == 1 ? 'active' : ($mission->duration_state == 0 ? 'pending' : 'completed') }}">
                                        {{ $mission->duration_state == 1 ? 'Active' : ($mission->duration_state == 0 ? 'Pending' : 'Completed') }}
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
                                <div class="mission-detail-value">{{ $mission->start_date ? date('d M Y', strtotime($mission->start_date)) : 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mission-detail">
                            <i class="ki-outline ki-calendar-tick"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">End Date</div>
                                <div class="mission-detail-value">{{ $mission->end_date ? date('d M Y', strtotime($mission->end_date)) : 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mission-detail">
                            <i class="ki-outline ki-user"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Contact Name</div>
                                <div class="mission-detail-value">{{ $mission->contact_name ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mission-detail">
                            <i class="ki-outline ki-phone"></i>
                            <div class="mission-detail-content">
                                <div class="mission-detail-label">Contact Phone</div>
                                <div class="mission-detail-value">{{ $mission->contact_phone ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($mission->description)
                    <div class="mission-detail" style="margin-top: 15px;">
                        <i class="ki-outline ki-abstract-26"></i>
                        <div class="mission-detail-content">
                            <div class="mission-detail-label">Description</div>
                            <div class="mission-detail-value">{{ $mission->description }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Application Form -->
            <form class="form" action="{{ route('application.update', $application->id) }}" method="POST" id="apply_mission_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="mission_id" value="{{ $mission->id }}"/>

                <!-- Basic Information Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Basic Information</h3>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Would you like to apply for this mission as</label>
                            <select class="form-select form-select-solid" name="human_type_display" id="human_type_display" data-control="select2" data-placeholder="Select Your Role" disabled>
                                <option value="" disabled>Select Your Role</option>
                                @foreach ($humanTypes as $type)
                                    <option value="{{ $type->id }}" {{ $application->human_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <!-- Hidden input to ensure the value is submitted -->
                            <input type="hidden" name="human_type" id="human_type" value="{{ $application->human_type_id }}"/>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Select Your Specialization</label>
                            <select class="form-select form-select-solid" name="specialization" id="specialization" data-control="select2" data-placeholder="Select Your Specialization">
                                <option value="" disabled selected>Select Your Specialization</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Full Name</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Full Name" id="full_name" name="full_name" value="{{ $application->full_name }}"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Gender</label>
                            <select class="form-select form-select-solid" name="gender" id="gender" data-control="select2" data-placeholder="Select an option">
                                <option></option>
                                <option value="1" {{ $application->gender == 1 ? 'selected' : '' }}>Male</option>
                                <option value="2" {{ $application->gender == 2 ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Birth of Date</label>
                            <input type="date" class="form-control form-control-solid" name="birth_date" id="birth_date" max="{{ date('Y-m-d') }}" min="1920-01-01" value="{{ $application->birth_date ? \Carbon\Carbon::parse($application->birth_date)->format('Y-m-d') : '' }}">
                        </div>

                        <div class="col-md-4 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Nationality</label>
                            <select class="form-select form-select-solid" name="nationality" id="nationality" data-control="select2" data-placeholder="Select Nationality">
                                <option value="" disabled selected>Select Nationality</option>
                                @php
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
                                @endphp
                                @foreach($countries as $country)
                                    <option value="{{ $country }}" {{ $application->nationality == $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
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
                            <input type="text" class="form-control form-control-solid" placeholder="Phone" name="phone" id="phone" value="{{ $application->phone }}"/>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Languages Spoken</label>
                            <select class="form-select form-select-solid" name="languages_spoken[]" id="languages_spoken" data-control="select2" data-close-on-select="false" data-placeholder="Select languages" data-allow-clear="true" multiple="multiple">
                                <option></option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}" {{ $application->languages->contains($language->id) ? 'selected' : '' }}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Academic Qualifications Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Academic Qualifications</h3>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">The Highest Academic Qualification</label>
                            <input type="text" class="form-control form-control-solid" placeholder="e.g., Master's Degree" id="highest_qualification" name="highest_qualification" value="{{ $application->highest_qualification }}"/>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">The Granting University</label>
                            <input type="text" class="form-control form-control-solid" id="granting_university" name="granting_university" placeholder="e.g., Harvard University" value="{{ $application->granting_university }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Degree-Granting Country</label>
                            <input type="text" class="form-control form-control-solid" placeholder="e.g., USA" id="degree_granting_country" name="degree_granting_country" value="{{ $application->degree_granting_country }}"/>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Date of Graduation</label>
                            <input type="date" class="form-control form-control-solid" id="date_of_graduation" name="date_of_graduation" value="{{ $application->date_of_graduation ? \Carbon\Carbon::parse($application->date_of_graduation)->format('Y-m-d') : '' }}">
                        </div>
                    </div>
                </div>

                <!-- Professional Experience Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Professional Experience</h3>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Years of Clinical Experience</label>
                            <input type="number" class="form-control form-control-solid" id="clinical_experience_years" name="clinical_experience_years" placeholder="e.g., 5" min="0" value="{{ $application->clinical_experience_years }}">
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Countries Previously Served In</label>
                            <input type="text" class="form-control form-control-solid" id="countries_previously_served" name="countries_previously_served" placeholder="e.g., USA, Canada, UK" value="{{ $application->countries_previously_served }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Previous Employers</label>
                            <input type="text" class="form-control form-control-solid" id="previous_employers" name="previous_employers" placeholder="e.g., ABC Hospital, XYZ Clinic" value="{{ $application->previous_employers }}">
                        </div>
                    </div>
                </div>

                <!-- Specialized Experience Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Specialized Experience</h3>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold required mb-2">Experience in Disaster/Emergency Settings</label>
                        <div class="d-flex gap-5">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" value="yes" id="disaster_experience_yes" name="disaster_experience" {{ $application->disaster_experience == 'yes' ? 'checked' : '' }}/>
                                <label class="form-check-label" for="disaster_experience_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" value="no" id="disaster_experience_no" name="disaster_experience" {{ $application->disaster_experience == 'no' ? 'checked' : '' }}/>
                                <label class="form-check-label" for="disaster_experience_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-7" id="disaster_experience_description_row" style="display: {{ $application->disaster_experience == 'yes' ? 'block' : 'none' }};">
                        <label class="fs-6 fw-semibold required mb-2">Please describe your disaster/emergency experience</label>
                        <textarea class="form-control form-control-solid" rows="4" id="disaster_experience_description" name="disaster_experience_description" placeholder="Describe your experience...">{{ $application->disaster_experience_description }}</textarea>
                    </div>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold required mb-2">Volunteer Work Experience</label>
                        <div class="d-flex gap-5">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" value="yes" id="volunteer_experience_yes" name="volunteer_experience" {{ $application->volunteer_experience == 'yes' ? 'checked' : '' }}/>
                                <label class="form-check-label" for="volunteer_experience_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" value="no" id="volunteer_experience_no" name="volunteer_experience" {{ $application->volunteer_experience == 'no' ? 'checked' : '' }}/>
                                <label class="form-check-label" for="volunteer_experience_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-7" id="volunteer_experience_description_row" style="display: {{ $application->volunteer_experience == 'yes' ? 'block' : 'none' }};">
                        <label class="fs-6 fw-semibold required mb-2">Please describe your volunteer experience</label>
                        <textarea class="form-control form-control-solid" rows="4" id="volunteer_experience_description" name="volunteer_experience_description" placeholder="Describe your experience...">{{ $application->volunteer_experience_description }}</textarea>
                    </div>
                </div>

                <!-- Gaza Experience Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Gaza Experience</h3>

                    <div class="row">
                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold required mb-2">Have You Ever Visited Gaza?</label>
                            <div class="d-flex gap-5">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" value="yes" id="visited_gaza_yes" name="visited_gaza" {{ $application->visited_gaza == 'yes' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="visited_gaza_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" value="no" id="visited_gaza_no" name="visited_gaza" {{ $application->visited_gaza == 'no' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="visited_gaza_no">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-7">
                            <label class="fs-6 fw-semibold mb-2">Place of Work During Previous Visit</label>
                            <input type="text" class="form-control form-control-solid" id="place_of_work_previous_visit" name="place_of_work_previous_visit" placeholder="e.g., Al-shifa'a, Nasser" value="{{ $application->place_of_work_previous_visit }}">
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Additional Information</h3>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold required mb-2">Educational or Training Contributions</label>
                        <textarea class="form-control form-control-solid" rows="3" id="educational_contributions" name="educational_contributions" placeholder="e.g., Conducted surgical training workshops...">{{ $application->educational_contributions }}</textarea>
                    </div>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold required mb-2">Published Scientific Papers</label>
                        <textarea class="form-control form-control-solid" rows="3" id="published_scientific_papers" name="published_scientific_papers" placeholder="e.g., Published 'AI-Driven Diagnostic Models'...">{{ $application->published_scientific_papers }}</textarea>
                    </div>

                    <div class="mb-7">
                        <label class="fs-6 fw-semibold required mb-2">Participation in Conferences or Workshops</label>
                        <textarea class="form-control form-control-solid" rows="3" id="conference_participation" name="conference_participation" placeholder="e.g., Presented a research paper at...">{{ $application->conference_participation }}</textarea>
                    </div>
                </div>

                <!-- Doctors Worked With Section -->
                <div class="form-section">
                    <h3 class="form-section-title">Doctors Worked With</h3>

                    <div id="kt_docs_repeater_basic_doctors">
                        <div class="form-group">
                            <div data-repeater-list="doctors">
                                @if($application->workedWithDoctors && $application->workedWithDoctors->count() > 0)
                                    @foreach($application->workedWithDoctors as $doctor)
                                        <div data-repeater-item>
                                            <div class="row mb-5">
                                                <div class="col-md-5">
                                                    <label class="form-label">Doctor Name</label>
                                                    <input type="text" name="doctor_name" class="form-control mb-2 mb-md-0" placeholder="Enter full name" value="{{ $doctor->doctor_name }}"/>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Visited Date</label>
                                                    <input type="date" name="visited_date" class="form-control mb-2 mb-md-0" value="{{ $doctor->visited_date ? \Carbon\Carbon::parse($doctor->visited_date)->format('Y-m-d') : '' }}"/>
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
                                    @endforeach
                                @else
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
                                @endif
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

                        @if($application->files && $application->files->count() > 0)
                            <div class="mb-5">
                                <h6 class="mb-3">Existing Files:</h6>
                                @foreach($application->files as $file)
                                    <div class="d-flex align-items-center justify-content-between p-3 mb-2 bg-light rounded">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-file fs-2 text-primary me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div>
                                                <div class="fw-bold">{{ $file->file_name }}</div>
                                                <div class="text-muted fs-7">{{ number_format($file->file_size / 1024, 2) }} KB</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteFile({{ $file->id }})">
                                            <i class="ki-duotone ki-trash fs-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                            Delete
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

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
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('assets/javascript/unauthorized/pages/apply-mission.js') }}"></script>

    <script>
        // Load specializations and set the selected value
        $(document).ready(function() {
            var selectedSpecialization = '{{ $application->specialization_id }}';
            var humanTypeId = $('#human_type').val();

            console.log('=== Edit Application Page Initialized ===');
            console.log('Selected Specialization ID:', selectedSpecialization);
            console.log('Human Type ID:', humanTypeId);

            // Function to load specializations
            function loadSpecializations() {
                if (!humanTypeId) {
                    console.error('No human_type_id found!');
                    return;
                }

                console.log('Loading specializations for human_type:', humanTypeId);

                $.ajax({
                    url: '/get_specialization',
                    type: 'POST',
                    data: {
                        HUMAN_TYPE: humanTypeId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('#specialization').prop('disabled', true);
                    },
                    success: function(response) {
                        console.log('Specializations response:', response);

                        if (response.status === 'success' && response.data && response.data.length > 0) {
                            var $specSelect = $('#specialization');
                            $specSelect.empty();
                            $specSelect.append('<option value="" disabled>Select Your Specialization</option>');

                            $.each(response.data, function(index, spec) {
                                var isSelected = spec.id == selectedSpecialization ? 'selected' : '';
                                $specSelect.append('<option value="' + spec.id + '" ' + isSelected + '>' + spec.name + '</option>');
                            });

                            $specSelect.prop('disabled', false);

                            // Set the value and trigger change
                            if (selectedSpecialization) {
                                $specSelect.val(selectedSpecialization).trigger('change');
                                console.log('✓ Specialization set to:', selectedSpecialization);
                            }

                            console.log('✓ Loaded ' + response.data.length + ' specializations');
                        } else {
                            console.warn('No specializations found in response');
                            $('#specialization').prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('✗ Failed to load specializations:', {
                            status: status,
                            error: error,
                            response: xhr.responseText
                        });
                        $('#specialization').prop('disabled', false);

                        Swal.fire({
                            text: "Failed to load specializations. Please refresh the page.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }

            // Wait for Select2 to initialize, then load specializations
            setTimeout(function() {
                console.log('Initializing Select2 and loading specializations...');

                // Initialize Select2 for specialization if not already initialized
                if (!$('#specialization').hasClass('select2-hidden-accessible')) {
                    $('#specialization').select2({
                        placeholder: "Select Your Specialization",
                        allowClear: true
                    });
                }

                loadSpecializations();
            }, 500);
        });

        // Delete existing file function
        function deleteFile(fileId) {
            Swal.fire({
                text: "Are you sure you want to delete this file?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary"
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/application/file/' + fileId,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    text: response.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                text: "Failed to delete file. Please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
