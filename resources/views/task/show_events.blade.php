@extends('master')

@section('css')
    <link href="{{ asset('assets')}}/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets')}}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

@endsection

@section('role_user', 'Hospital Account')
@section('main-title')
    <a href="{{ route('task.index') }}">Missions</a>
@endsection
@section('sub-title', 'Show Events')


@section('content')

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
                <h2 class="card-title fw-bold">Calendar</h2>

            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Calendar-->
                <div id="kt_calendar_app"></div>
                <!--end::Calendar-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
        <!--begin::Modals-->

        <div class="modal fade" id="kt_modal_view_event" tabindex="-1" data-bs-focus="false" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header border-0 justify-content-end">
                        <!--begin::Edit-->
                        <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit Event" id="kt_modal_view_event_edit">
                            <i class="ki-outline ki-pencil fs-2"></i>
                        </div>
                        <!--end::Edit-->
                        <!--begin::Edit-->
                        <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete Event" id="kt_modal_view_event_delete">
                            <i class="ki-outline ki-trash fs-2"></i>
                        </div>
                        <!--end::Edit-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="Hide Event" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-2x"></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body pt-0 pb-20 px-lg-17">
                        <!--begin::Row-->
                        <div class="d-flex">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-calendar-8 fs-1 text-muted me-5"></i>
                            <!--end::Icon-->
                            <div class="mb-9">
                                <!--begin::Event name-->
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-3 fw-bold me-3" data-kt-calendar="event_name"></span>
                                    <span class="badge badge-light-success" data-kt-calendar="all_day"></span>
                                </div>
                                <!--end::Event name-->
                                <!--begin::Event description-->
                                <div class="fs-6" data-kt-calendar="event_description"></div>
                                <!--end::Event description-->
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot h-10px w-10px bg-success ms-2 me-7"></span>
                            <!--end::Bullet-->
                            <!--begin::Event start date/time-->
                            <div class="fs-6">
                                <span class="fw-bold">Starts</span>
                                <span data-kt-calendar="event_start_date"></span>
                            </div>
                            <!--end::Event start date/time-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="d-flex align-items-center mb-9">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot h-10px w-10px bg-danger ms-2 me-7"></span>
                            <!--end::Bullet-->
                            <!--begin::Event end date/time-->
                            <div class="fs-6">
                                <span class="fw-bold">Ends</span>
                                <span data-kt-calendar="event_end_date"></span>
                            </div>
                            <!--end::Event end date/time-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="d-flex align-items-center">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-geolocation fs-1 text-muted me-5"></i>
                            <!--end::Icon-->
                            <!--begin::Event location-->
                            <div class="fs-6" data-kt-calendar="event_location"></div>
                            <!--end::Event location-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Modal body-->
                </div>
            </div>
        </div>

        <!--end::Modals-->
    </div>
    <!--end::Content-->

@endsection

@section('script')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets')  }}/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="{{ asset('assets')  }}/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets')  }}/js/custom/apps/calendar/calendar.js"></script>
    <script src="{{ asset('assets')  }}/js/widgets.bundle.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/widgets.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/apps/chat/chat.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/utilities/modals/new-target.js"></script>
    <script src="{{ asset('assets')  }}/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->
@endsection

{{--@section('js')--}}

{{--@endsection--}}


<!--end::Custom Javascript-->
