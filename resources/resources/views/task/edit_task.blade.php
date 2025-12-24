@extends('master')
@section('css')
    <link href="{{ asset('assets')  }}/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets')  }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets')  }}/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets')  }}/styles/flatpickr.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('role_user', 'Hospital Account')
@section('main-title')
    <a href="{{ route('task.index') }}">Missions</a>
@endsection

@section('sub-title', 'Edit Mission')

@section('content')
    <div class="tab-content">
        <!--begin::Tab pane-->
        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <!--begin::General options-->
                <form action="{{route('task.update', [$task->id]) }}" class="form mb-15" method="post"
                      id="kt_careers_form">
                    @csrf
                    @method('PUT')
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
                                    @if(count($targets) >0)
                                        @foreach($targets as $target)
                                            <option
                                                value="{{$target->id}}" {{ old('specialization', $task->target_id) == $target->id ? "selected" :""}}>{{$target->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <!--end::Select-->
                            </div>
                            @error('specialization')
                            <li class="alert alert-danger">{{ $message }}</li>
                            @enderror
                            <!--end::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">Contact Person</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input required value="{{old('contact_name', $task->contact_name)}}" type="text"
                                           class="form-control form-control-solid"
                                           placeholder="Contact Name" name="contact_name"/>
                                    <!--end::Input-->
                                    @error('contact_name')
                                    <li class="alert alert-danger">{{ $message }}</li>
                                    @enderror
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--end::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">Contact Phone</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input value="{{old('contact_phone', $task->contact_phone)}}"
                                           class="form-control form-control-solid"
                                           placeholder="Contact Phone" name="contact_phone"/>
                                    <!--end::Input-->
                                    @error('contact_phone')
                                    <li class="alert alert-danger">{{ $message }}</li>
                                    @enderror
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
                                    @if(count($targets) >0)
                                        @foreach($targets as $target)
                                            <option
                                                value="{{$target->id}}" {{ old('specialization_target', $task->request_target_id) == $target->id ? "selected" :""}}>{{$target->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <!--end::Select-->
                            </div>
                            @error('specialization_target')
                            <li class="alert alert-danger">{{ $message }}</li>
                            @enderror
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
                                               name="start_date" value="{{old("start_date",  $task->start_date)}}"
                                               placeholder="select the start period date"
                                               id="start_date"/>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                @error('start_date')
                                <li class="alert alert-danger">{{ $message }}</li>
                                @enderror
                                <div class="col" data-kt-calendar="datepicker">
                                    <div class="fv-row mb-9">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold mb-2">End Mission</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input required class="form-control form-control-solid"
                                               name="end_date" value="{{old("end_date", $task->end_date)}}"
                                               placeholder="select the end period date"
                                               id="end_date"/>
                                        <!--end::Input-->
                                    </div>
                                    @error('end_date')
                                    <li class="alert alert-danger">{{ $message }}</li>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex flex-column mb-5 fv-row">
                                <label class="required fs-5 fw-semibold mb-2">Medical Team Needs</label>
                                <div id="medical_needs_repeater">
                                    <div class="form-group">
                                        <div data-repeater-list="medical_needs_list" class="d-flex flex-column gap-3">
                                            @foreach($task->medicalNeeds as $medicalNeed)
                                                @php
                                                    // Fetch specializations for this human_type_id
                                                    $specializations = \App\Models\Specialization::where('human_type_id', $medicalNeed->human_type_id)->get();
                                                    // Log the medical need data for debugging
                                                    \Log::info('Medical Need Data for ID ' . $medicalNeed->id, [
                                                        'human_type_id' => $medicalNeed->human_type_id,
                                                        'specialization_id' => $medicalNeed->specialization_id,
                                                        'specializations' => $specializations->toArray()
                                                    ]);
                                                @endphp
                                                <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                                    <div class="w-100 w-md-250px">
                                                        <select class="form-select form-select-solid need-human-type" name="human_type_id" data-placeholder="Select an option" data-kt-ecommerce-catalog-add-category="human_type" data-control="select2">
                                                            @if(count($human_types) > 0)
                                                                @foreach($human_types as $human_type)
                                                                    <option value="{{$human_type->id}}" {{ old('human_type_id', $medicalNeed->human_type_id) == $human_type->id ? "selected" : "" }}>{{$human_type->name}}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="">No human types available</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="w-100 w-md-200px">
                                                        <select required class="form-select form-select-solid need-specialization" name="specialization_id" data-placeholder="Select an option" data-kt-ecommerce-catalog-add-category="Specialization_type" data-control="select2" data-preselected-value="{{ $medicalNeed->specialization_id ?? '' }}">
                                                            <option value="">Select an option</option>
                                                            @if($specializations->isEmpty())
                                                                <option value="">No specializations available for human type {{ $medicalNeed->human_type_id }}</option>
                                                            @else
                                                                @foreach($specializations as $specialization)
                                                                    <option value="{{$specialization->id}}" {{ $medicalNeed->specialization_id == $specialization->id ? "selected" : "" }}>{{$specialization->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="w-100 w-md-150px">
                                                        <input type="number" min="1" required class="form-control mw-100 w-200px" name="count" id="count_no" value="{{old('count', $medicalNeed->count)}}"/>
                                                    </div>
                                                    <div class="w-100 w-md-200px">
                                                        <input type="text" class="form-control mw-100 w-200px" name="note" id="note" value="{{old('note', $medicalNeed->note)}}"/>
                                                    </div>
                                                    <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">
                                                        <i class="ki-outline ki-cross fs-2"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="button" data-repeater-create="" style="display: none" class="btn btn-sm btn-light-primary hide">
                                            <i class="ki-outline ki-plus fs-2"></i>Add another medical need
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required">priority</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                          title="selected priority">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="priority" data-control="select2"
                                        data-placeholder="Select a priority..."
                                        class="form-select form-select-solid">
                                    <option value="Low" {{ old('priority', $task->priority) == "low" ? "selected" :""}}>Low</option>
                                    <option value="Medium" {{ old('priority', $task->priority) == "medium" ? "selected" :""}}>
                                        Medium
                                    </option>
                                    <option value="High" {{ old('priority', $task->priority) == "high" ? "selected" :""}}>High
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
                                            @if($task->requirementNeeds->isEmpty())
                                                <!-- Initialize with an empty item if no requirements exist -->
                                                <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                                    <div class="w-100 w-md-250px">
                                                        <select class="form-select form-select-solid" name="requirement_id" data-placeholder="Select an option" data-kt-ecommerce-catalog-add-category="human_type" data-control="select2">
                                                            @if(count($requirements) > 0)
                                                                @foreach($requirements as $requirement)
                                                                    <option value="{{$requirement->id}}">{{$requirement->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="w-100 w-md-200px">
                                                        <input type="text" class="form-control mw-100 w-200px" name="category_name" id="category_name" value=""/>
                                                    </div>
                                                    <div class="w-100 w-md-150px">
                                                        <input type="number" min="1" required class="form-control mw-100 w-200px" name="count" id="count_no" value=""/>
                                                    </div>
                                                    <div class="w-100 w-md-200px">
                                                        <select class="form-select form-select-solid" name="priority" id="priority" data-placeholder="Select an option" data-control="select2">
                                                            <option value="critical">critical</option>
                                                            <option value="not critical">not critical</option>
                                                        </select>
                                                    </div>
                                                    <!-- Removed data-repeater-delete button -->
                                                </div>
                                            @else
                                                @foreach($task->requirementNeeds as $requirementNeed)
                                                    <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                                        <div class="w-100 w-md-250px">
                                                            <select class="form-select form-select-solid" name="requirement_id" data-placeholder="Select an option" data-kt-ecommerce-catalog-add-category="human_type" data-control="select2">
                                                                @if(count($requirements) > 0)
                                                                    @foreach($requirements as $requirement)
                                                                        <option value="{{$requirement->id}}" {{ old('requirement_id', $requirementNeed->requirement_id) == $requirement->id ? "selected" :""}}>{{$requirement->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <input type="text" class="form-control mw-100 w-200px" name="category_name" id="category_name" value="{{old('category_name', $requirementNeed->category_name)}}"/>
                                                        </div>
                                                        <div class="w-100 w-md-150px">
                                                            <input type="number" min="1" required class="form-control mw-100 w-200px" name="count" id="count_no" value="{{old('count', $requirementNeed->count)}}"/>
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <select class="form-select form-select-solid" name="priority" id="priority" data-placeholder="Select an option" data-control="select2">
                                                                <option value="critical" {{ old('priority', $requirementNeed->priority) == 'critical' ? 'selected' : '' }}>critical</option>
                                                                <option value="not critical" {{ old('priority', $requirementNeed->priority) == 'not critical' ? 'selected' : '' }}>not critical</option>
                                                            </select>
                                                        </div>
                                                        <!-- Removed data-repeater-delete button -->
                                                    </div>
                                                @endforeach
                                            @endif
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
                                              placeholder="">{{old('recommendation_team', $task->recommendation?->recommendation_team)}}</textarea>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-8">
                                    <label class="fs-6 fw-semibold mb-2">Recommendation Doctor (Optional)</label>
                                    <textarea class="form-control form-control-solid" rows="1"
                                              name="recommendation_doctor"
                                              placeholder="">{{old('recommendation_doctor', $task->recommendation?->recommendation_doctor)}}</textarea>
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
@endsection
@section('script')
    <script src="{{ asset('assets')}}/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
@endsection

@section('js')
    <script src="{{ asset('assets')  }}/javascript/pages/edit-task.js"></script>
@endsection
