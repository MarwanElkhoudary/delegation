<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
        @include('layouts.head')
        @yield('css')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                @include('layouts.header')

				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Wrapper container-->
					<div class="app-container container-xxl d-flex flex-row-fluid">
						<!--begin::Sidebar-->
                        @include('layouts.sidebar')

						<!--end::Sidebar-->
						<!--begin::Main-->
						<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
							<!--begin::Content wrapper-->
							<div class="d-flex flex-column flex-column-fluid">
								<!--begin::Toolbar-->
								<div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
									<!--begin::Toolbar container-->
									<div class="d-flex flex-stack flex-row-fluid">
										<!--begin::Toolbar container-->
										<div class="d-flex flex-column flex-row-fluid">
											<!--begin::Toolbar wrapper-->
											<!--begin::Page title-->
											<div class="page-title d-flex align-items-center me-3">
												<!--begin::Title-->
												<h3 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-lg-2x gap-2">
													<span>
													<span class="fw-light"> </span>&nbsp;@yield('role_user')</span>
													<!--begin::Description-->
                                                    <!--begin::Breadcrumb-->
                                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                                                        <!--begin::Item-->
                                                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                                            <a href="index.html" class="text-white text-hover-primary">
                                                                <i class="ki-outline ki-home text-gray-700 fs-6"></i>
                                                            </a>
                                                        </li>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <li class="breadcrumb-item">
                                                            <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                                                        </li>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">@yield('main-title')</li>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <li class="breadcrumb-item">
                                                            <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                                                        </li>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">@yield('sub-title')</li>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->

                                                    </ul>
                                                    <!--end::Breadcrumb-->													<!--end::Description-->
												</h3>
												<!--end::Title-->
											</div>
											<!--end::Page title-->
										</div>
										<!--end::Toolbar container-->

									</div>
									<!--end::Toolbar container-->
								</div>
								<!--end::Toolbar-->
								<!--begin::Content-->
								<div id="kt_app_content" class="app-content flex-column-fluid">
                                    @yield('content')
								</div>
								<!--end::Content-->
							</div>
							<!--end::Content wrapper-->
							<!--begin::Footer-->
                            @include('layouts.footer')

							<!--end::Footer-->
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
		<!--begin::Drawers-->


		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-outline ki-arrow-up"></i>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Modals-->

		<!--end::Modals-->
		<!--begin::Javascript-->
		<script>
            const hostUrl = "assets/";
            let  BASE_URL='{!! url('/') !!}';
            let  TOKEN='{!! csrf_token() !!}';

        </script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
        @include('layouts.scripts')

		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
        @yield('script')
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
        @yield('js')
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
