@extends('master')

@section('css')
    <link href="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
          type="text/css"/>

@endsection

@section('role_user', 'Hospital Account')
@section('main-title')
    <a href="{{ route('task.index') }}">Missions</a>
@endsection
@section('sub-title', 'Show Mission')


@section('content')

    <div class="tab-content">
        <!--begin::Tab pane-->

        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <!--begin::Card-->
                <div class="card card-flush pt-3 mb-5 mb-xl-10">
                    <!--begin::Card body-->
                    <div class="card-body pt-3">
                        <!--begin::Section-->
                        <div class="mb-10">
                            <!--begin::Title-->
                            <h5 class="mb-4">Human Resources Info</h5>

                            <!--end::Title-->
                            <!--begin::Details-->
                            <div class="d-flex flex-wrap py-5">
                                <!--begin::Row-->
                                <div class="flex-equal me-5">
                                    <!--begin::Details-->
                                    <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500 min-w-175px w-175px">Hospital Name:</td>
                                            <td class="text-gray-800 min-w-200px">

                                                <span class="badge badge-light-dark">{{$task->hospital->name}}</span>
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">Contact Person:</td>
                                            <td class="text-gray-800">

                                                <span class="badge badge-light-primary">{{$task->contact_name}}</span>

                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">Target Specialization:</td>
                                            <td class="text-gray-800">

                                                <span class="badge badge-light-info">  {{$task->target->name}}</span>

                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">Start Period:</td>
                                            <td class="text-gray-800">
                                                <span class="badge badge-light-success"> {{$task->start_date}}</span>
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                    </table>
                                    <!--end::Details-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="flex-equal">
                                    <!--begin::Details-->
                                    <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500 min-w-175px w-175px">Specialization:</td>
                                            <td class="text-gray-800 min-w-200px">
                                                <span
                                                    class="badge badge-light-info"> {{$task->requestTarget->name}}</span>


                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">Contact Phone:</td>
                                            <td class="text-gray-800">
                                                <span class="badge badge-light-primary">{{$task->contact_phone}}</span>

                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->

                                        <tr>
                                            <td class="text-gray-500">Status Mission:</td>
                                            <td class="text-gray-800">
                                                <span class="badge badge-light-warning"
                                                      data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse"
                                                      data-bs-placement="top" title="{{$task->note}}"
                                                >{{$task->status->name}}</span>
                                            </td>
                                            {{--                                            <td class="text-gray-800">{{$task->status->name}}</td>--}}
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">End Date:</td>
                                            <td class="text-gray-800">
                                                <span class="badge badge-light-success"> {{$task->end_date}}</span>
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                    </table>
                                    <!--end::Details-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <div class="mb-10">
                            <!--begin::Title-->
                            <h5 class="mb-4">Medical Need Info</h5>
                            <!--end::Title-->
                            <!--begin::Product table-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-4 mb-0">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="border-bottom border-gray-200 text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-250px">specialization</th>
                                        <th class="min-w-125px">Count</th>
                                        <th class="min-w-125px">Note</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-semibold text-gray-800">
                                    @foreach($task->medicalNeeds as $item)
                                        <tr>
                                            <td>
                                                <label
                                                    class="w-150px"> {{$item->specialization->humanType->name}} </label>
                                                <div
                                                    class="fw-normal text-gray-600">{{$item->specialization->name}}</div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-circle badge-outline badge-primary">{{$item->count}}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-secondary"> {{$item->note}}</span>

                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Product table-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Example-->
                        <div class="separator border-4 my-10"></div>


                        <!--end::Example-->

                        <!--begin::Section-->
                        <div class="mb-10">
                            <!--begin::Title-->
                            @if(!$task->requirementNeeds->isEmpty())

                                <h5 class="mb-4">Requirements Needs Info</h5>
                                <!--end::Title-->
                                <!--begin::Product table-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-4 mb-0">
                                        <!--begin::Table head-->
                                        <thead>
                                        <!--begin::Table row-->
                                        <tr class="border-bottom border-gray-200 text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-250px">requirements</th>
                                            <th class="min-w-125px">count</th>
                                            <th class="min-w-125px">note</th>
                                        </tr>
                                        <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="fw-semibold text-gray-800">
                                        @foreach($task->requirementNeeds as $item)

                                            <tr>
                                                <td>
                                                    <label
                                                        class="w-250px"> {{$item->requirement->name}} </label>
                                                    <div
                                                        class="fw-normal text-gray-600">{{$item->category_name}}
                                                    </div>
                                                </td>
                                                <td>
                                                <span
                                                    class="badge badge-circle badge-outline badge-info">{{$item->count}}</span>
                                                </td>
                                                @if($item->priority == 'not critical')
                                                    <td><span
                                                            class="badge badge-light-success">{{$item->priority}}</span>
                                                    </td>
                                                @else
                                                    <td><span
                                                            class="badge badge-light-danger">{{$item->priority}}</span>
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Product table-->
                                <div class="separator border-4 my-10"></div>

                            @endif
                            <!--begin::Example-->

                            <!--end::Example-->
                            <!--begin::Section-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                     data-bs-toggle="collapse" data-bs-target="#kt_job_1_1">
                                    <!--begin::Icon-->
                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                        <i class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                        <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Requirements</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div id="kt_job_1_1" class="collapse show fs-6 ms-1">

                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-semibold fs-6">Team
                                                Recommendition: {{$task->recommendation?->recommendation_team}}
                                            </div>
                                            <!--end::Label-->
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-semibold fs-6">Doctor
                                                Recommendition: {{$task->recommendation?->recommendation_doctor}}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->

                                </div>
                                <!--end::Content-->

                            </div>
                            <!--end::Section-->

                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->

                <!--begin::Card-->
                <!-- Check if the user is authenticated -->
                <?php
                if (Auth::user()->role_id == 2) {
                    ?>

                <div class="card card-flush pt-3 mb-5 mb-xl-10">

                    <!--begin::Card body-->
                    <div class="card-body pt-3">
                        <!--begin::Section-->

                        @if (session('message'))
                            <!--begin::Alert-->
                            <div class="alert alert-success d-flex align-items-center p-5">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column">
                                    <!--begin::Title-->
                                    <h4 class="mb-1 text-dark">Success</h4>
                                    <!--end::Title-->

                                    <!--begin::Content-->
                                    <span> {{ session('message') }}</span>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        @endif
                        <div class="mb-10">
                            <!--begin::Title-->
                            <h5 class="mb-4">Mission Management: </h5>
                            <!--end::Title-->
                            <!--begin::Details-->
                            {{--                            {{$task}}--}}
                            <form action="{{route('task.edit_task_status', [$task->id]) }}" class="form mb-15"
                                  method="post"
                                  id="kt_careers_form">
                                @csrf
                                @method('PUT')                                <!--begin::Input group-->
                                <div class="card-flush py-4">

                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">

                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Mission Status</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                      title="selected mission status">
                                                            </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select required id="task_status"
                                                    name="task_status" data-control="select2"
                                                    class="form-select form-select-solid">
                                                @if(count($statuses) >0)
                                                    @foreach($statuses as $status)
                                                        {{--                                            <option value="{{$target->id}}" {{ old('specialization') === $target->id ? 'selected' : '' }}>{{$target->name}}</option>--}}
                                                        <option
                                                            value="{{$status->id}}" {{ old('task_status', $task->status_id) == $status->id ? "selected" :""}}>{{$status->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <!--end::Select-->

                                        </div>

                                        <!--begin::Input group-->

                                        <div class="d-flex flex-column mb-5 fv-row " id="reason"
                                             <?php if (!empty($task->note)) { ?>
                                             style="display: block !important;"
                                             <?php }else { ?> style="display: none !important;" <?php } ?> >

                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Reason</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                      title="selected priority">
                                                            </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Textarea-->
                                            <textarea class="form-control form-control-solid" rows="1" id="myTextarea"
                                                      name="reason"
                                                      placeholder="">{{old('reason', $task->note)}}</textarea>
                                            <!--end::Textarea-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Priority</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                      title="selected priority">
                                                            </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select name="priority" data-control="select2"
                                                    data-placeholder="Select a priority..."
                                                    class="form-select form-select-solid">
                                                <option
                                                    value="Low" {{ old('priority', $task->priority) == "low" ? "selected" :""}}>
                                                    Low
                                                </option>
                                                <option
                                                    value="Medium" {{ old('priority', $task->priority) == "medium" ? "selected" :""}}>
                                                    Medium
                                                </option>
                                                <option
                                                    value="High" {{ old('priority', $task->priority) == "high" ? "selected" :""}}>
                                                    High
                                                </option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Separator
                                        <div class="separator mb-8"></div>
                                        end::Separator-->
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
                                <!--end::General options-->

                            </form>
                            <!--end::Row-->
                        </div>
                        <!--end::Section-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                    <?php
                }
                if (Auth::user()->role_id == 3) {
                    ?>

                <div class="card card-flush pt-3 mb-5 mb-xl-10">

                    <!--begin::Card body-->
                    <div class="card-body pt-3">
                        <!--begin::Section-->

                        @if (session('message'))
                            <!--begin::Alert-->
                            <div class="alert alert-success d-flex align-items-center p-5">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column">
                                    <!--begin::Title-->
                                    <h4 class="mb-1 text-dark">Success</h4>
                                    <!--end::Title-->

                                    <!--begin::Content-->
                                    <span> {{ session('message') }}</span>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        @endif
                        <div class="mb-10">
                            <!--begin::Title-->
                            <h5 class="mb-4">Mission Management: </h5>
                            <!--end::Title-->
                            <!--begin::Details-->
                            {{--                            {{$task}}--}}
                            <form action="{{route('task.edit_task_internation', [$task->id]) }}" class="form mb-15"
                                  method="post"
                                  id="kt_careers_form">
                                @csrf
                                @method('PUT')                                <!--begin::Input group-->
                                <div class="card-flush py-4">

                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="row row-cols-lg-2 g-10">
                                            <div class="col">
                                                <div class="fv-row mb-9">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 ">Start
                                                        Mission</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input required type="date" class="form-control form-control-solid"
                                                           name="start_date" value="{{old("start_date",  \Carbon\Carbon::parse($task->start_date)->format('Y-m-d'))}}"
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
                                                    <input required type="date" class="form-control form-control-solid"
                                                           name="end_date" value="{{ old('end_date', \Carbon\Carbon::parse($task->end_date)->format('Y-m-d')) }}"
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


                                        <div class="row row-cols-lg-2 g-10">
                                            <div class="col">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                    <span class="">Mission Status</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                          title="selected mission status">
                                                            </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Select-->

                                                <select required id="international_task_id"
                                                        name="international_task_id" data-control="select2"
                                                        class="form-select form-select-solid">

                                                    @if(count($international_statuses) >0)
                                                        @foreach($international_statuses as $status)
                                                            {{--                                            <option value="{{$target->id}}" {{ old('specialization') === $target->id ? 'selected' : '' }}>{{$target->name}}</option>--}}
                                                            <option
                                                                value="{{$status->id}}" {{ old('international_task_id', $task->international_task_id) == $status->id ? "selected" :""}}>{{$status->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <!--end::Select-->
                                            </div>


                                            <!--begin::Input group-->
                                            <div class="col">

                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                    <span class="">Publication status</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                          title="selected priority">
                                                            </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Select-->
                                                <select name="publication_state" data-control="select2"
                                                        data-placeholder="Select a priority..."
                                                        class="form-select form-select-solid">
                                                    <option
                                                        value="0" {{ old('publication_state', $publication?->publication_state ?? 0) == 0 ? 'selected' : '' }}>
                                                        Unpublished
                                                    </option>
                                                    <option
                                                        value="1" {{ old('publication_state', $publication?->publication_state ?? 0) == 1 ? 'selected' : '' }}>
                                                        Published
                                                    </option>

                                                </select>
                                                <!--end::Select-->
                                            </div>
                                        </div>
                                        <!--end::Input group-->


{{--                                        <!--begin::Separator--}}
{{--                                        <div class="separator mb-8"></div>--}}
{{--                                        end::Separator-->--}}
                                        <!--begin::Submit-->
                                        <br />
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
                                <!--end::General options-->

                            </form>
                            <!--end::Row-->
                        </div>
                        <!--end::Section-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                    <?php
                }
                ?>

            </div>
        </div>
        <!--end::Tab pane-->
    </div>

@endsection

@section('script')
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets')  }}/js/widgets.bundle.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/widgets.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/apps/chat/chat.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/utilities/modals/new-target.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
@endsection

@section('js')
    <script src="{{ asset('assets')  }}/javascript/pages/show_task.js"></script>

@endsection


<!--end::Custom Javascript-->
