<!--begin::Header-->
<div id="kt_app_header" class="app-header "
     data-kt-sticky="true" data-kt-sticky-activate-="true" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '200px', lg: '300px'}"
     >
                        <!--begin::Header container-->
            <div class="app-container  container-xxl d-flex align-items-stretch justify-content-between " id="kt_app_header_container">
                <!--begin::Header wrapper-->
<div class="app-header-wrapper d-flex flex-grow-1 align-items-stretch justify-content-between" id="kt_app_header_wrapper">
<!--layout-partial:layout/partials/header/_logo.html-->
    <?php echo $__env->make('unauthorized.layout.partials.header._logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--layout-partial:layout/partials/header/_menu.html-->

<!--layout-partial:layout/partials/header/_navbar.html-->
    <?php echo $__env->make('unauthorized.layout.partials.header._navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
<!--end::Header wrapper-->            </div>
            <!--end::Header container-->
            </div>
<!--end::Header-->
<?php /**PATH D:\work\laragon\www\delegation\resources\views/unauthorized/layout/partials/_header.blade.php ENDPATH**/ ?>