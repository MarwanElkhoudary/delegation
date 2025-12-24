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

@section('sub-title', 'Add New Mission')

@section('content')
    <div class="tab-content">
        <!--begin::Tab pane-->
        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <!--begin::General options-->
                <form action="{{route('task.store') }}" class="form mb-15" method="post"
                      id="kt_careers_form">
                    @csrf
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
                                            {{--                                            <option value="{{$target->id}}" {{ old('specialization') === $target->id ? 'selected' : '' }}>{{$target->name}}</option>--}}

                                            <option
                                                value="{{$target->id}}" {{ old('specialization') ==$target->id? "selected" :""}}>{{$target->name}}</option>
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
                                    <label class="required fs-5 fw-semibold mb-2">Contact
                                        Person</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input required value="{{old('contact_name')}}" type="text"
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
                                    <label class="required fs-5 fw-semibold mb-2">Contact
                                        Phone</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input value="{{old('contact_phone')}}" class="form-control form-control-solid"
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
                                                value="{{$target->id}}" {{ old('specialization_target') ==$target->id? "selected" :""}}>{{$target->name}}</option>

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
                                        <label class="fs-6 fw-semibold mb-2 required">Start
                                            Mission</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input required type="date" class="form-control form-control-solid"
                                               name="start_date" value="{{old("start_date")}}"
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
                                               name="end_date" value="{{old("end_date")}}"
                                               placeholder="select the end period date"
                                               id="end_date"/>
                                        <!--end::Input-->
                                    </div>
                                    @error('end_date')
                                    <li class="alert alert-danger">{{ $message }}</li>
                                    @enderror
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-semibold mb-2">Medical Team
                                    Needs</label>
                                <!--end::Label-->

                                <!--begin::Repeater-->
                                <div id="medical_needs_repeater">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="medical_needs_list"
                                             class="d-flex flex-column gap-3">
                                            <div data-repeater-item=""
                                                 class="form-group d-flex flex-wrap align-items-center gap-5">
                                                <!--begin::Select2-->
                                                <div class="w-100 w-md-150px">
                                                    <select
                                                        class="form-select form-select-solid need-human-type"
                                                        name="human_type_id"
                                                        data-placeholder="Select an option"
                                                        data-kt-ecommerce-catalog-add-category="human_type"
                                                        data-control="select2">
                                                        <option
                                                            value="">Select human type
                                                        </option>
                                                        @if(count($human_types) >0)
                                                            @foreach($human_types as $human_type)
                                                                <option
                                                                    value="{{$human_type->id}}">{{$human_type->name}}</option>

                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="w-100 w-md-150px">
                                                    <select required
                                                            class="form-select form-select-solid need-specialization"
                                                            name="specialization_id"
                                                            data-placeholder="Select an option"
                                                            data-kt-ecommerce-catalog-add-category="Specialization_type"
                                                            data-control="select2">
                                                        <option>
                                                        </option>
                                                    </select>
                                                </div>
                                                <!--end::Select2-->
                                                <!--begin::Select2-->
                                                <div class="w-100 w-md-100px">
                                                    <input type="number" min="1" required
                                                           class="form-control mw-100 w-200px"
                                                           name="count" id="count_no"
                                                           placeholder="count"/>

                                                </div>
                                                <!--end::Select2-->
                                                <!--begin::Input-->
                                                <input type="text"
                                                       class="form-control mw-100 w-200px"
                                                       name="note"
                                                       placeholder="notes"/>
                                                <!--end::Input-->

                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group mt-5">
                                        <!--begin::Button-->
                                        <button type="button" data-repeater-create=""
                                                class="btn btn-sm btn-light-primary">
                                            <i class="ki-outline ki-plus fs-2"></i>Add another
                                            medical need
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required">priority</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                          title="selected specialization">
                                                                <i class="ki-outline ki-information fs-7"></i>
                                                            </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="priority" data-control="select2"
                                        data-placeholder="Select a specialization..."
                                        class="form-select form-select-solid">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>

                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->

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
                            <h1 class="fw-bold text-gray-900 mb-9">Additional Requirements</h1>
                            <div id="additional_requirements_repeater">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div data-repeater-list="additional_requirements_list"
                                         class="d-flex flex-column gap-3">
                                        <div data-repeater-item=""
                                             class="form-group d-flex flex-wrap align-items-center gap-5">
                                            <!--begin::Select2-->
                                            <div class="w-100 w-md-250px">
                                                <select
                                                    class="form-select form-select-solid need-human-type"
                                                    name="requirement_id"
                                                    data-placeholder="Select an option"
                                                    data-kt-ecommerce-catalog-add-category="human_type"
                                                    data-control="select2">
                                                    <option
                                                        value="">Select addition requirements
                                                    </option>
                                                    @if(count($requirements) >0)
                                                        @foreach($requirements as $requirement)
                                                            <option
                                                                value="{{$requirement->id}}">{{$requirement->name}}</option>

                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="w-100 w-md-200px">
                                                <input type="text"
                                                       class="form-control mw-100 w-200px"
                                                       name="category_name" id="category_name"
                                                       placeholder="category name"/>
                                            </div>
                                            <!--end::Select2-->
                                            <!--begin::Select2-->
                                            <div class="w-100 w-md-150px">
                                                <input type="number" min="1" required
                                                       class="form-control mw-100 w-200px"
                                                       name="count" id="count_no"
                                                       placeholder="count"/>

                                            </div>
                                            <div class="w-100 w-md-150px">

                                                <select
                                                    class="form-select form-select-solid need-human-type"
                                                    name="priority"
                                                    data-placeholder="Select an option"
                                                    data-kt-ecommerce-catalog-add-category="human_type"
                                                    data-control="select2">
                                                    <option
                                                        value="critical ">critical
                                                    </option>
                                                    <option
                                                        value="not critical ">not critical
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group mt-5">
                                    <!--begin::Button-->
                                    <button type="button" data-repeater-create=""
                                            class="btn btn-sm btn-light-primary">
                                        <i class="ki-outline ki-plus fs-2"></i>Add another
                                        additional requirements
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Form group-->
                            </div>


                        </div>
                        <!--end::Card header-->
                    </div>

                    <br>

                    <div class="card card-flush py-4">
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <h1 class="fw-bold text-gray-900 mb-9">Recommendition</h1>

                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-5">
                                    <label class="fs-6 fw-semibold mb-2">Recommendation Team
                                        (Optional)</label>
                                    <textarea class="form-control form-control-solid" rows="1"
                                              name="recommendation_team"
                                              placeholder="">{{old('recommendation_team')}}</textarea>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-8">
                                    <label class="fs-6 fw-semibold mb-2">Recommendation Doctor
                                        (Optional)</label>
                                    <textarea class="form-control form-control-solid" rows="1"
                                              name="recommendation_doctor"
                                              placeholder="">{{old('recommendation_doctor')}}</textarea>
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
                                <span class="indicator-label">Submit</span>
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
    <script src="{{ asset('assets')  }}/javascript/pages/add-task.js"></script>
@endsection


<!--end::Custom Javascript-->
