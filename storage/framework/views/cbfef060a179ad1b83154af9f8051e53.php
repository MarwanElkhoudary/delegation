<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle">
    <!--begin::Sidebar nav-->
    <div class="app-sidebar-wrapper py-8 py-lg-10" id="kt_app_sidebar_wrapper">
        <!--begin::Nav wrapper-->
        <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column px-8 px-lg-10 hover-scroll-y" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="{default: false, lg: '#kt_app_header'}" data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_wrapper" data-kt-scroll-offset="{default: '10px', lg: '40px'}">
            <!--begin::Progress-->
            <div class="d-flex align-items-center flex-column w-100 mb-8 mb-lg-10">
                <div class="d-flex justify-content-between fw-bolder fs-6 text-gray-800 w-100 mt-auto mb-3">
                    <span>Your Goal</span>
                </div>
                <div class="w-100 bg-light-info rounded mb-2" style="height: 24px">
                    <div class="bg-info rounded" role="progressbar" style="height: 24px; width: 37%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="fw-semibold fs-7 text-primary w-100 mt-auto">
                    <span>reached 37% of your target</span>
                </div>
            </div>
            <!--end::Progress-->
            <!--begin::Stats-->

            <?php
                use App\Models\Task;
                if (Auth::user()->role_id == 1){
                $recently   = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 1)->get();
                $suspended  = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 2)->get();
                $ongoing    = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 3)->get();
                $completed  = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 4)->get();
                $rejected   = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 5)->get();
                $approved   = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 6)->get();
//                                    print_r(count($recently));
                }else if(Auth::user()->role_id == 2){
                $recently   = Task::where('status_id', 1)->get();
                $suspended  = Task::where('status_id', 2)->get();
                $ongoing    = Task::where('status_id', 3)->get();
                $completed  = Task::where('status_id', 4)->get();
                $rejected   = Task::where('status_id', 5)->get();
                $approved   = Task::where('status_id', 6)->get();
                }else if(Auth::user()->role_id == 3){
                $recently   = Task::where('status_id', 1)->get();
                $suspended  = Task::where('status_id', 2)->get();
                $ongoing    = Task::where('status_id', 3)->get();
                $completed  = Task::where('status_id', 4)->get();
                $rejected   = Task::where('status_id', 5)->get();
                $approved   = Task::where('status_id', 6)->get();
                }

            ?>


            <div class="d-flex mb-8 mb-lg-10">
                <!--begin::Stat-->
                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6">
                    <!--begin::Date-->
                    <span class="fs-6 text-gray-500 fw-bold">Recently</span>
                    <!--end::Date-->
                    <!--begin::Label-->
                    <div class="fs-2 fw-bold text-primary"><?php echo e(count($recently)); ?></div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->
                <!--begin::Stat-->
                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4">
                    <!--begin::Date-->
                    <span class="fs-6 text-gray-500 fw-bold">Approved</span>
                    <!--end::Date-->
                    <!--begin::Label-->
                    <div class="fs-2 fw-bold text-info"><?php echo e(count($approved)); ?></div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->

            </div>

            <div class="d-flex mb-8 mb-lg-10">
                <!--begin::Stat-->
                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4">
                    <!--begin::Date-->
                    <span class="fs-6 text-gray-500 fw-bold">Ongoing</span>
                    <!--end::Date-->
                    <!--begin::Label-->
                    <div class="fs-2 fw-bold text-warning"><?php echo e(count($ongoing)); ?></div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->
                <!--begin::Stat-->
                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6">
                    <!--begin::Date-->
                    <span class="fs-6 text-gray-500 fw-bold">Suspended</span>
                    <!--end::Date-->
                    <!--begin::Label-->
                    <div class="fs-2 fw-bold text-dark"><?php echo e(count($suspended)); ?></div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->

            </div>
            <div class="d-flex mb-8 mb-lg-10">
                <!--begin::Stat-->
                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4">
                    <!--begin::Date-->
                    <span class="fs-6 text-gray-500 fw-bold">Completed</span>
                    <!--end::Date-->
                    <!--begin::Label-->
                    <div class="fs-2 fw-bold text-success"><?php echo e(count($completed)); ?></div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->
                <!--begin::Stat-->
                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6">
                    <!--begin::Date-->
                    <span class="fs-6 text-gray-500 fw-bold">Rejected</span>
                    <!--end::Date-->
                    <!--begin::Label-->
                    <div class="fs-2 fw-bold text-danger"><?php echo e(count($rejected)); ?></div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->

            </div>
            <!--end::Stats-->
            <!--begin::Links-->
            <div class="mb-0">
                <!--begin::Title-->
                <h3 class="text-gray-800 fw-bold mb-8">Services</h3>
                <!--end::Title-->
                <!--begin::Row-->
                <div class="row g-5" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href="<?php echo e(url('/calendar')); ?>" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                            <i class="ki-outline ki-calendar fs-1"></i>
                                        </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">Calendar</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href="<?php echo e(url('/health_staff')); ?>" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                            <i class="ki-outline ki-tablet-book fs-1"></i>
                                        </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">Health Staff</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href="apps/support-center/overview.html" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                            <i class="ki-outline ki-wifi-home fs-1"></i>
                                        </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">Network</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href="apps/projects/list.html" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                            <i class="ki-outline ki-medal-star fs-1"></i>
                                        </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">Hospitality</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href="apps/file-manager/folders.html" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                            <i class="ki-outline ki-setting-2 fs-1"></i>
                                        </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">Utilities</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href="apps/file-manager/settings.html" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px active border-primary border-dashed" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                            <i class="ki-outline ki-plus fs-1"></i>
                                        </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">Add New</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Links-->
        </div>
        <!--end::Nav wrapper-->
    </div>
    <!--end::Sidebar nav-->
</div>
<!--end::Sidebar-->
<?php /**PATH D:\work\laragon\www\delegation\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>