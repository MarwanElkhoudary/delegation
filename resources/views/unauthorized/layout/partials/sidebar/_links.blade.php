<!--begin::Quick Actions-->
<div class="mb-0">
    <div class="d-flex align-items-center mb-4">
        <i class="ki-outline ki-element-11 fs-2 text-gray-600 me-2"></i>
        <h5 class="fw-bold text-gray-800 mb-0">Quick Actions</h5>
    </div>
    
    <!--begin::Actions List-->
    <div class="d-flex flex-column gap-2">
        <!--begin::Calendar-->
        <a href="{{ url('/calendar') }}" class="btn btn-light-primary w-100 d-flex align-items-center justify-content-start">
            <i class="ki-outline ki-calendar fs-2 me-3"></i>
            <span class="fw-bold">Calendar</span>
        </a>
        <!--end::Calendar-->
        
        <!--begin::Health Staff-->
        <a href="{{ url('/health_staff') }}" class="btn btn-light-success w-100 d-flex align-items-center justify-content-start">
            <i class="ki-outline ki-people fs-2 me-3"></i>
            <span class="fw-bold">Health Staff</span>
        </a>
        <!--end::Health Staff-->
        
        <!--begin::Reports-->
        <a href="#" class="btn btn-light-info w-100 d-flex align-items-center justify-content-start">
            <i class="ki-outline ki-chart-simple-2 fs-2 me-3"></i>
            <span class="fw-bold">Reports</span>
        </a>
        <!--end::Reports-->
        
        <!--begin::Settings-->
        <a href="#" class="btn btn-light-warning w-100 d-flex align-items-center justify-content-start">
            <i class="ki-outline ki-setting-2 fs-2 me-3"></i>
            <span class="fw-bold">Settings</span>
        </a>
        <!--end::Settings-->
    </div>
    <!--end::Actions List-->
</div>
<!--end::Quick Actions-->
