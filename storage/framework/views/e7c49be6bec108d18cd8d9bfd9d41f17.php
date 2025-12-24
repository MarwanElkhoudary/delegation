<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Notifications-->
    <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
            <i class="ki-outline ki-calendar fs-1"></i>
        </div>
<!--layout-partial:partials/menus/_notifications-menu.html-->
        <!--end::Menu wrapper-->
    </div>
    <!--end::Notifications-->
    <!--begin::Quick links-->
    <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
            <i class="ki-outline ki-abstract-26 fs-1"></i>        </div>
<!--layout-partial:partials/menus/_quick-links-menu.html-->
        <!--end::Menu wrapper-->
    </div>
    <!--end::Quick links-->
    <!--begin::Chat-->
    <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px position-relative" id="kt_drawer_chat_toggle">
            <i class="ki-outline ki-notification-on fs-1"></i>
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::Chat-->
    <!--begin::User menu-->
    <div class="app-navbar-item ms-3 ms-lg-5" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <img class="symbol symbol-circle symbol-35px symbol-md-40px" src="<?php echo e(asset('assets/media/avatars/300-13.jpg')); ?>" alt="user"/>
        </div>
<!--layout-partial:partials/menus/_user-account-menu.html-->
        <?php echo $__env->make('unauthorized.partials.menus._user-account-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Header menu toggle-->
            <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
            <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px" id="kt_app_header_menu_toggle">
                <i class="ki-outline ki-text-align-left fs-1"></i>            </div>
        </div>
        <!--end::Header menu toggle-->
</div>
<!--end::Navbar--><?php /**PATH D:\work\laragon\www\delegation\resources\views/unauthorized/layout/partials/header/_navbar.blade.php ENDPATH**/ ?>