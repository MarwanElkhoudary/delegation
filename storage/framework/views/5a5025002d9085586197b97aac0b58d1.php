<!--begin::Toolbar-->

<div id="kt_app_toolbar" class="app-toolbar  d-flex pb-3 pb-lg-5 ">
            <!--begin::Toolbar container-->
<div class="d-flex flex-stack flex-row-fluid">
   <!--begin::Toolbar container-->
    <div class="d-flex flex-column flex-row-fluid">
    <!--begin::Toolbar wrapper-->
<!--layout-partial:layout/partials/toolbar/_page-title.html-->
        <?php echo $__env->make('unauthorized.layout.partials.toolbar._page-title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!--layout-partial:layout/partials/toolbar/_breadcrumb.html-->
        <?php echo $__env->make('unauthorized.layout.partials.toolbar._breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
    <!--end::Toolbar container-->
<!--layout-partial:layout/partials/toolbar/_actions.html-->


</div>
<!--end::Toolbar container-->    </div>
<!--end::Toolbar-->
<?php /**PATH D:\work\laragon\www\delegation\resources\views/unauthorized/layout/partials/_toolbar.blade.php ENDPATH**/ ?>