<!--begin::Toolbar-->

<div id="kt_app_toolbar" class="app-toolbar  d-flex pb-3 pb-lg-5 ">
            <!--begin::Toolbar container-->
<div class="d-flex flex-stack flex-row-fluid">
   <!--begin::Toolbar container-->
    <div class="d-flex flex-column flex-row-fluid">
    <!--begin::Toolbar wrapper-->
<!--layout-partial:layout/partials/toolbar/_page-title.html-->
        @include('unauthorized.layout.partials.toolbar._page-title')

        <!--layout-partial:layout/partials/toolbar/_breadcrumb.html-->
        @include('unauthorized.layout.partials.toolbar._breadcrumb')

    </div>
    <!--end::Toolbar container-->
<!--layout-partial:layout/partials/toolbar/_actions.html-->
{{--    @include('unauthorized.layout.partials.toolbar._actions')--}}

</div>
<!--end::Toolbar container-->    </div>
<!--end::Toolbar-->
