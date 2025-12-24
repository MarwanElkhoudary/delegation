<!--begin::Header-->
<div id="kt_app_header" class="app-header "
     data-kt-sticky="true" data-kt-sticky-activate-="true" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '200px', lg: '300px'}"
     >
                        <!--begin::Header container-->
            <div class="app-container  container-xxl d-flex align-items-stretch justify-content-between " id="kt_app_header_container">
                <!--begin::Header wrapper-->
<div class="app-header-wrapper d-flex flex-grow-1 align-items-stretch justify-content-between" id="kt_app_header_wrapper">
<!--layout-partial:layout/partials/header/_logo.html-->
    @include('unauthorized.layout.partials.header._logo')

    <!--layout-partial:layout/partials/header/_menu.html-->

<!--layout-partial:layout/partials/header/_navbar.html-->
    @include('unauthorized.layout.partials.header._navbar')

</div>
<!--end::Header wrapper-->            </div>
            <!--end::Header container-->
            </div>
<!--end::Header-->
