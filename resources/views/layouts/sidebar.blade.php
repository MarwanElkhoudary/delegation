<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle">
    <!--begin::Sidebar nav-->
    <div class="app-sidebar-wrapper py-8 py-lg-10" id="kt_app_sidebar_wrapper">
        <!--begin::Nav wrapper-->
        <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column px-5 px-lg-8 hover-scroll-y" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="{default: false, lg: '#kt_app_header'}" data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_wrapper" data-kt-scroll-offset="{default: '10px', lg: '40px'}">
            
            @php
                use App\Models\Task;
                if (Auth::user()->role_id == 1){
                    $recently   = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 1)->get();
                    $suspended  = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 2)->get();
                    $ongoing    = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 3)->get();
                    $completed  = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 4)->get();
                    $rejected   = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 5)->get();
                    $approved   = Task::where('hospital_id', Auth::user()->hospital_id)->where('status_id', 6)->get();
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
                
                $totalMissions = count($recently) + count($suspended) + count($ongoing) + count($completed) + count($rejected) + count($approved);
                $completedPercentage = $totalMissions > 0 ? round((count($completed) / $totalMissions) * 100) : 0;
            @endphp
            
            <!--begin::Progress Section-->
            <div class="mb-7">
                <div class="d-flex align-items-center mb-3">
                    <i class="ki-outline ki-chart-simple fs-2 text-primary me-2"></i>
                    <h5 class="fw-bold text-gray-800 mb-0">Mission Progress</h5>
                </div>
                
                <div class="bg-light-primary rounded p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-gray-700 fw-semibold fs-7">Completion Rate</span>
                        <span class="badge badge-primary fw-bold">{{$completedPercentage}}%</span>
                    </div>
                    
                    <div class="progress h-6px mb-3">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$completedPercentage}}%"></div>
                    </div>
                    
                    <div class="text-gray-600 fs-8 text-center">
                        {{count($completed)}} of {{$totalMissions}} missions completed
                    </div>
                </div>
            </div>
            <!--end::Progress Section-->
            
            <!--begin::Mission Statistics-->
            <div class="mb-7">
                <div class="d-flex align-items-center mb-4">
                    <i class="ki-outline ki-abstract-26 fs-2 text-gray-600 me-2"></i>
                    <h5 class="fw-bold text-gray-800 mb-0">Mission Statistics</h5>
                </div>
                
                <!--begin::Stats Grid-->
                <div class="d-flex flex-column gap-3">
                    <!--begin::Recently-->
                    <div class="d-flex align-items-center bg-light-primary rounded p-3">
                        <div class="symbol symbol-40px me-3">
                            <span class="symbol-label bg-primary">
                                <i class="ki-outline ki-file-added fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <span class="text-gray-700 fw-semibold fs-7 d-block">Recently</span>
                            <span class="text-gray-900 fw-bold fs-3">{{count($recently)}}</span>
                        </div>
                    </div>
                    <!--end::Recently-->
                    
                    <!--begin::Approved-->
                    <div class="d-flex align-items-center bg-light-info rounded p-3">
                        <div class="symbol symbol-40px me-3">
                            <span class="symbol-label bg-info">
                                <i class="ki-outline ki-check-circle fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <span class="text-gray-700 fw-semibold fs-7 d-block">Approved</span>
                            <span class="text-gray-900 fw-bold fs-3">{{count($approved)}}</span>
                        </div>
                    </div>
                    <!--end::Approved-->
                    
                    <!--begin::Ongoing-->
                    <div class="d-flex align-items-center bg-light-warning rounded p-3">
                        <div class="symbol symbol-40px me-3">
                            <span class="symbol-label bg-warning">
                                <i class="ki-outline ki-time fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <span class="text-gray-700 fw-semibold fs-7 d-block">Ongoing</span>
                            <span class="text-gray-900 fw-bold fs-3">{{count($ongoing)}}</span>
                        </div>
                    </div>
                    <!--end::Ongoing-->
                    
                    <!--begin::Suspended-->
                    <div class="d-flex align-items-center bg-light-dark rounded p-3">
                        <div class="symbol symbol-40px me-3">
                            <span class="symbol-label bg-dark">
                                <i class="ki-outline ki-cross-circle fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <span class="text-gray-700 fw-semibold fs-7 d-block">Suspended</span>
                            <span class="text-gray-900 fw-bold fs-3">{{count($suspended)}}</span>
                        </div>
                    </div>
                    <!--end::Suspended-->
                    
                    <!--begin::Completed-->
                    <div class="d-flex align-items-center bg-light-success rounded p-3">
                        <div class="symbol symbol-40px me-3">
                            <span class="symbol-label bg-success">
                                <i class="ki-outline ki-double-check-circle fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <span class="text-gray-700 fw-semibold fs-7 d-block">Completed</span>
                            <span class="text-gray-900 fw-bold fs-3">{{count($completed)}}</span>
                        </div>
                    </div>
                    <!--end::Completed-->
                    
                    <!--begin::Rejected-->
                    <div class="d-flex align-items-center bg-light-danger rounded p-3">
                        <div class="symbol symbol-40px me-3">
                            <span class="symbol-label bg-danger">
                                <i class="ki-outline ki-cross fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <span class="text-gray-700 fw-semibold fs-7 d-block">Rejected</span>
                            <span class="text-gray-900 fw-bold fs-3">{{count($rejected)}}</span>
                        </div>
                    </div>
                    <!--end::Rejected-->
                </div>
                <!--end::Stats Grid-->
            </div>
            <!--end::Mission Statistics-->
            
            <!--begin::Quick Actions-->
            <div class="mb-0">
                <div class="d-flex align-items-center mb-4">
                    <i class="ki-outline ki-element-11 fs-2 text-gray-600 me-2"></i>
                    <h5 class="fw-bold text-gray-800 mb-0">Quick Actions</h5>
                </div>
                
                <!--begin::Actions List-->
                <div class="d-flex flex-column gap-2">
                    <!--begin::Missions-->
                    <a href="{{ url('/missions') }}" class="btn btn-light-primary w-100 d-flex align-items-center justify-content-start">
                        <i class="ki-outline ki-compass fs-2 me-3"></i>
                        <span class="fw-bold">Missions</span>
                    </a>
                    <!--end::Missions-->
                    
                    <!--begin::Calendar-->
                    <a href="{{ url('/calendar') }}" class="btn btn-light-info w-100 d-flex align-items-center justify-content-start">
                        <i class="ki-outline ki-calendar fs-2 me-3"></i>
                        <span class="fw-bold">Calendar</span>
                    </a>
                    <!--end::Calendar-->
                    
                    <!--begin::Health Staff-->
                    <a href="{{ url('/health_staff') }}" class="btn btn-light-warning w-100 d-flex align-items-center justify-content-start">
                        <i class="ki-outline ki-people fs-2 me-3"></i>
                        <span class="fw-bold">Health Staff</span>
                    </a>
                    <!--end::Health Staff-->
                    
                    <!--begin::Reports-->
                    <a href="#" class="btn btn-light-danger w-100 d-flex align-items-center justify-content-start">
                        <i class="ki-outline ki-chart-simple-2 fs-2 me-3"></i>
                        <span class="fw-bold">Reports</span>
                    </a>
                    <!--end::Reports-->
                    
                    <!--begin::Settings-->
                    <a href="#" class="btn btn-light-secondary w-100 d-flex align-items-center justify-content-start">
                        <i class="ki-outline ki-setting-2 fs-2 me-3"></i>
                        <span class="fw-bold">Settings</span>
                    </a>
                    <!--end::Settings-->
                </div>
                <!--end::Actions List-->
            </div>
            <!--end::Quick Actions-->
            
        </div>
        <!--end::Nav wrapper-->
    </div>
    <!--end::Sidebar nav-->
</div>
<!--end::Sidebar-->
