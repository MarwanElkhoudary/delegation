<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
        <!--layout-partial:layout/partials/_header.html-->
        <?php echo $__env->make('unauthorized.layout.partials._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--begin::Wrapper-->
        <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
            <!--begin::Wrapper container-->
            <div class="app-container  container-xxl d-flex flex-row-fluid ">
                <!--layout-partial:layout/partials/_sidebar.html-->
                <?php if(Auth::check() && Auth::user()->role_id != 6): ?>
                    <?php echo $__env->make('unauthorized.layout.partials._sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--layout-partial:layout/partials/_toolbar.html-->
                        <?php echo $__env->make('unauthorized.layout.partials._toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <!--layout-partial:layout/partials/_content.html-->
                        
                        <?php echo $__env->yieldContent('content'); ?>

                    </div>
                    <!--end::Content wrapper-->
                    <!--layout-partial:layout/partials/_footer.html-->
                    <?php echo $__env->make('unauthorized.layout.partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper container-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<!--layout-partial:partials/_drawers.html-->
<?php /**PATH D:\work\laragon\www\delegation\resources\views/unauthorized/layout/_default.blade.php ENDPATH**/ ?>