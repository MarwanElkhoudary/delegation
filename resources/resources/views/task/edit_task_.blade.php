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
@section('main-title', 'Tasks')
@section('sub-title', 'Edit Task')

@section('content')
    <div class="tab-content">
        <!--begin::Tab pane-->
        {{--        @dd($task->medicalNeeds)--}}

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <form action="{{route('task.update', [$task->id]) }}" class="form mb-15" method="post"
                  id="kt_careers_form">
                @csrf
                @method('PUT')
                <!--begin::Input group-->
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
                        <label class="required fs-5 fw-semibold mb-2">Contact
                            Person</label>
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
                        <label class="required fs-5 fw-semibold mb-2">Contact
                            Phone</label>
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
                                {{--                                            <option value="{{$target->id}}"  {{ old('specialization_target') == $target->id? "selected" :""}}>{{$target->name}}</option>--}}
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
                            <label class="fs-6 fw-semibold mb-2 required">Start
                                Task</label>
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
                            <label class="fs-6 fw-semibold mb-2">End Task</label>
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
                                @foreach($task->medicalNeeds as $medicalNeed)
                                    <div data-repeater-item=""
                                         class="form-group d-flex flex-wrap align-items-center gap-5">
                                        <!--begin::Select2-->
                                        <div class="w-100 w-md-150px">
                                            <select
                                                class="form-select form-select-solid need-human-type"
                                                name="human_type_id"

                                                {{--                                                         name="human_type_id[{{ $loop->index }}][first_option]" --}}
                                                data-placeholder="Select an option"
                                                data-kt-ecommerce-catalog-add-category="human_type"
                                                data-control="select2">

                                                @if(count($human_types) >0)
                                                    @foreach($human_types as $human_type)

                                                        <option
                                                            value="{{$human_type->id}}"
                                                            {{ old('human_type_id', $medicalNeed->human_type_id) == $human_type->id ? "selected" :""}}
{{--                                                            {{ old('human_type_id', $medicalNeed->human_type_id) == $human_type->id ? "handleSelectChange(event)" : "" }}--}}
                                                        >{{$human_type->name}}</option>
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
{{--                                                 <option --}}
{{--                                                     value="{{$medicalNeed->specialization_id}}" {{ old('specialization_id', $medicalNeed->specialization_id) == $human_type->id ? "selected" :""}}>{{$human_type->name}}</option> --}}


                                            </select>
                                        </div>
                                        <!--end::Select2-->
                                        <!--begin::Select2-->
                                        <div class="w-100 w-md-100px">
                                            <input type="number" min="1" required
                                                   class="form-control mw-100 w-200px"
                                                   name="count" id="count_no"
                                                   value="{{$medicalNeed->count}}"
                                                   placeholder="count"/>

                                        </div>
                                        <!--end::Select2-->
                                        <!--begin::Input-->
                                        <input type="text"
                                               class="form-control mw-100 w-200px"
                                               name="note"
                                               value="{{$medicalNeed->note}}"
                                               placeholder="notes"/>
                                        <!--end::Input-->
                                        <!--begin::Button-->
                                        <button type="button" data-repeater-delete=""
                                                class="btn btn-sm btn-icon btn-light-danger">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </button>
                                        <!--end::Button-->
                                    </div>

                                @endforeach
                            </div>
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group mt-5">
                            <!--begin::Button-->
                            <button type="button" data-repeater-create="" style="display: none"
                                    class="btn btn-sm btn-light-primary hide">
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
                            data-placeholder="Select a priority..."
                            class="form-select form-select-solid">
                        {{--                                    {{ $task->priority}}--}}
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
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-5">
                    <label class="fs-6 fw-semibold mb-2">Recommendation Team
                        (Optional)</label>
                    <textarea class="form-control form-control-solid" rows="1"
                              name="recommendation_team"
                              placeholder="">{{old('recommendation_team', $task->recommendation?->recommendation_team)}}</textarea>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-semibold mb-2">Recommendation Doctor
                        (Optional)</label>
                    <textarea class="form-control form-control-solid" rows="1"
                              name="recommendation_doctor"
                              placeholder="">{{old('recommendation_doctor', $task->recommendation?->recommendation_doctor)}}</textarea>
                </div>
                <!--end::Input group-->
                <!--begin::Separator-->
                <div class="separator mb-8"></div>
                <!--end::Separator-->
                <!--begin::Submit-->
                <button type="submit" class="btn btn-primary"
                        id="kt_careers_submit_button">
                    <!--begin::Indicator label-->
                    <span class="indicator-label">Update</span>
                    <!--end::Indicator label-->
                    <!--begin::Indicator progress-->
                    <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    <!--end::Indicator progress-->
                </button>
                <!--end::Submit-->
            </form>
        </div>
        <!--end::Card header-->
    </div>
    <!--end::General options-->

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


<!--end::Custom Javascript-->
