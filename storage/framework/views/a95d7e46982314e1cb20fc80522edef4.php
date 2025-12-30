<!--begin::Header-->
<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate-="true" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
    <!--begin::Header container-->
    <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        <!--begin::Header wrapper-->
        <div class="app-header-wrapper d-flex flex-grow-1 align-items-stretch justify-content-between" id="kt_app_header_wrapper">
            <!--begin::Logo wrapper-->
            <div class="app-header-logo d-flex flex-shrink-0 align-items-center justify-content-between justify-content-lg-center">
                <!--begin::Logo wrapper-->
                <button class="btn btn-icon btn-color-gray-600 btn-active-color-primary ms-n3 me-2 d-flex d-lg-none" id="kt_app_sidebar_toggle">
                    <i class="ki-outline ki-abstract-14 fs-2"></i>
                </button>
                <!--end::Logo wrapper-->
                <!--begin::Logo image-->
                <a href="<?php echo e(route('mission.index')); ?>">
                    <img alt="Logo"  src="<?php echo e(asset('assets')); ?>/images/logos/logo.svg" class="h-40px h-lg-70px theme-light-show" />
                    <img alt="Logo"  src="<?php echo e(asset('assets')); ?>/images/logos/logo.svg" class="h-40px h-lg-70px theme-dark-show" />
                </a>
                <!--end::Logo image-->
            </div>
            <!--end::Logo wrapper-->

            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">

                <!--begin::User menu-->
                <div class="app-navbar-item ms-3 ms-lg-5" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        
                        <h6 class="page-heading d-flex flex-column justify-content-center text-gray-9500 fw-bold fs-md-1x gap-2">
                            <span>
                                <span class="fw-light">Welcome </span>
                                ,&nbsp;<?php echo e(Auth::user()->name); ?>

                            </span>

                        </h6>
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="<?php echo e(asset('assets')); ?>/media/avatars/300-13.jpg" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5"><?php echo e(Auth::user()->name); ?>

                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?php echo e(Auth::user()->hospital?->name ? Auth::user()->hospital?->name :  Auth::user()->role?->name); ?></a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="account/overview.html" class="menu-link px-5">My Profile</a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <form id="logout-form"  method="POST" action="<?php echo e(route('logout')); ?>" >
                                <?php echo csrf_field(); ?>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link px-5">Sign Out</a>
                            </form>                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
                <!--begin::Header menu toggle-->
                <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
                    <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px" id="kt_app_header_menu_toggle">
                        <i class="ki-outline ki-text-align-left fs-1"></i>
                    </div>
                </div>
                <!--end::Header menu toggle-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
<!--end::Header-->
<?php /**PATH D:\work\laragon\www\delegation\resources\views/layouts/header.blade.php ENDPATH**/ ?>