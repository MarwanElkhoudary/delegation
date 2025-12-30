@include('layouts.head')

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <style>body { background-image: url('assets/media/auth/bg4.jpg'); } [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg4-dark.jpg'); }</style>
    <!--end::Page bg image-->
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-center flex-lg-start flex-column">
                <!--begin::Logo-->
                <a href="index.html" class="mb-7">
                    <img alt="Logo"  class="h-100px h-lg-150px theme-light-show"  src="assets/images/logos/logo.svg" />
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                <h2 class="text-white fw-normal m-0">Ministrty of Health </h2>
                <!--end::Title-->
            </div>
            <!--begin::Aside-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
            <!--begin::Card-->
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="POST" action="{{route('register')}}">
                        <!--begin::Heading-->
                        @csrf
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-gray-900 fw-bolder mb-3">Sign Up</h1>
                            <!--end::Title-->
                            <!--begin::Subtitle-->
                            <div class="text-gray-500 fw-semibold fs-6">Ministry of Health</div>
                            <!--end::Subtitle=-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Username-->
                            <input type="text" placeholder="Full name" name="full_name" autocomplete="off" class="form-control bg-transparent" />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />

                            <!--end::Email-->
                        </div>
                        <!--begin::Input group-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Username-->
                            <select id="role_id"  name="role_id" data-control="select2"
                                    class="form-select form-select-solid">
                                <option value="">Select user role</option>
                                @if(count($roles) >0)
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" >{{$role->name}}</option>

                                    @endforeach
                                @endif
                            </select>
                            <!--end::Email-->
                        </div>
                        <div class="fv-row mb-8">
                            <!--begin::Username-->
                            <select id="hospital_id" disabled  name="hospital_id" data-control="select2"
                                    class="form-select form-select-solid">
                                <option value="null">Select the hospital</option>
                                @if(count($hospitals) >0)
                                    @foreach($hospitals as $hospital)
                                        <option value="{{$hospital->id}}" >{{$hospital->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <!--end::Email-->
                        </div>
                        <!--begin::Input group-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Username-->
                            <input type="text" placeholder="username" name="username" autocomplete="off" class="form-control bg-transparent" />
                            <!--end::Email-->
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-8" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off" />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="ki-outline ki-eye-slash fs-2"></i>
												<i class="ki-outline ki-eye fs-2 d-none"></i>
											</span>
                                    <x-input-error :messages="$errors->get('Password')" class="mt-2" />

                                </div>
                                <!--end::Input wrapper-->
                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Hint-->
                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group=-->
                        <!--end::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Repeat Password-->
                            <input placeholder="Repeat Password" name="confirm-password" type="password" autocomplete="off" class="form-control bg-transparent" />
                            <!--end::Repeat Password-->
                        </div>
                        <!--end::Input group=-->

                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_up_submit_" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Sign up</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Submit button-->

                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->

            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->



{{--@section('scripts')--}}
{{--    <script src="{{ asset('assets')  }}/javascript/pages/add-task.js"></script>--}}



{{--@endsection--}}
@include('layouts.scripts')
<script src="{{ asset('assets')  }}/js/custom/authentication/sign-up/general.js"></script>
<script>
    console.log('sdsadsd')
    $("#role_id").change(function(){
        let role_id = $(this).val();

        if(role_id == 1){
            $('#hospital_id').prop('disabled', false);
        }else {
            document.getElementById("hospital_id").selectedIndex = null;
            $('#hospital_id').prop('disabled', true);

        }
    });
</script>
