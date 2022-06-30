<!DOCTYPE html>
<html lang="en" {{app()->getLocale()=="ar" ? 'dir=rtl' : ''}}>
<head>
    <meta charset="utf-8">
    <title>{{isset($current_page) ? $current_page->getTranslation('title') : 'RentalCars'}}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="{{asset('img/favicon/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('img/favicon/apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/favicon/apple-touch-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/favicon/apple-touch-icon-114x114.png')}}">
    <!--Stylesheets-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&amp;display=swap">
    <link rel="stylesheet" href="{{asset('libs/bootstrap/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('libs/fancybox/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div class="wrapper">

            @include('_partials._header')
            @yield('content')
            @include('_partials._footer')
            <button class="to-top-button"></button>
            <!--Modals-->
            <div class="modal mfp-hide" id="login">
                <div class="modal__inner">
                    <button class="close-button modal__close"></button>
                    <div class="modal__user-actions"><a class="modal-open" href="#signup">{{App\Models\Translation::getTranslWord($words, $sel_lang, "registration")}}</a><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "login")}}</span></div>
                    <form class="modal__form" action="{{route('login')}}" method="post">
                        @csrf
                        <div class="modal__text-divider">{{App\Models\Translation::getTranslWord($words, $sel_lang, "via")}}</div>
                        <div class="modal__social-login"><a class="modal__social-btn modal__social-btn--fb" href="{{route('auth_fb')}}" title="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#FFF" d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0c-3.159 0-5.323 1.987-5.323 5.639V9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877V6.062c.001-1.233.333-2.077 2.051-2.077z"></path>
                                </svg></a><a class="modal__social-btn modal__social-btn--tw" href="{{route('auth_twitter')}}" title="Twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#FFF" d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z"></path>
                                </svg></a><a class="modal__social-btn modal__social-btn--gg" href="{{route('login.google')}}" title="Google">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#fff" d="M120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308H52.823C18.568 144.703 0 198.922 0 256s18.568 111.297 52.823 155.785h86.308v-86.308C126.989 305.13 120 281.367 120 256z"></path>
                                    <path fill="#fff" d="M256 392l-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216C305.044 385.147 281.181 392 256 392z"></path>
                                    <path fill="#fff" d="M139.131 325.477l-86.308 86.308a260.085 260.085 0 0022.158 25.235C123.333 485.371 187.62 512 256 512V392c-49.624 0-93.117-26.72-116.869-66.523z"></path>
                                    <path fill="#fff" d="M512 256a258.24 258.24 0 00-4.192-46.377l-2.251-12.299H256v120h121.452a135.385 135.385 0 01-51.884 55.638l86.216 86.216a260.085 260.085 0 0025.235-22.158C485.371 388.667 512 324.38 512 256z"></path>
                                    <path fill="#fff" d="M352.167 159.833l10.606 10.606 84.853-84.852-10.606-10.606C388.668 26.629 324.381 0 256 0l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z"></path>
                                    <path fill="#fff" d="M256 120V0C187.62 0 123.333 26.629 74.98 74.98a259.849 259.849 0 00-22.158 25.235l86.308 86.308C162.883 146.72 206.376 120 256 120z"></path>
                                </svg></a></div>
                        <div class="modal__text-divider">{{App\Models\Translation::getTranslWord($words, $sel_lang, "or")}}</div>
                        <div class="input-group input-group--with-icon">
                            <input class="modal-focus" type="text" name="email" required>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="17" height="17">
                                <path fill="#828C98" d="M256 0c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135S330.439 0 256 0zm0 240c-57.897 0-105-47.103-105-105S198.103 30 256 30s105 47.103 105 105-47.103 105-105 105zM297.833 301h-83.667C144.964 301 76.669 332.951 31 401.458V512h450V401.458C435.397 333.05 367.121 301 297.833 301zm153.168 181H61v-71.363C96.031 360.683 152.952 331 214.167 331h83.667c61.215 0 118.135 29.683 153.167 79.637V482z"></path>
                            </svg>
                        </div>
                        <div class="input-group input-group--with-icon">
                            <button class="input-group-password-viewer" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M505.752 240.915l-89.088-89.088c-88.737-88.737-232.591-88.737-321.327 0L6.248 240.915c-8.331 8.331-8.331 21.839 0 30.17l89.088 89.088c88.737 88.737 232.591 88.737 321.327 0l89.088-89.088c8.332-8.331 8.332-21.839.001-30.17zm-119.258 89.088c-72.074 72.074-188.913 72.074-260.987 0L51.503 256l74.003-74.003c72.074-72.074 188.913-72.074 260.987 0L460.497 256l-74.003 74.003z"></path>
                                    <path d="M256 149.333c-58.907 0-106.667 47.759-106.667 106.667S197.093 362.667 256 362.667 362.667 314.907 362.667 256 314.907 149.333 256 149.333zM256 320c-35.343 0-64-28.657-64-64s28.657-64 64-64 64 28.657 64 64-28.657 64-64 64z"></path>
                                </svg>
                            </button>
                            <input type="password" name="password" required>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.867 477.867" width="17" height="17">
                                <path fill="#828C98" d="M409.6 170.667h-17.067V153.6C392.439 68.808 323.725.094 238.933 0c-84.792.094-153.506 68.808-153.6 153.6v17.067H68.267c-9.426 0-17.067 7.641-17.067 17.067V460.8c0 9.426 7.641 17.067 17.067 17.067H409.6c9.426 0 17.067-7.641 17.067-17.067V187.733c0-9.425-7.641-17.066-17.067-17.066zM119.467 153.6c0-65.98 53.487-119.467 119.467-119.467S358.4 87.62 358.4 153.6v17.067H119.467V153.6zm273.066 290.133h-307.2V204.8h307.2v238.933z"></path>
                                <path fill="#828C98" d="M287.209 290.111c-7.211-20.472-26.571-34.152-48.276-34.111-28.211-.053-51.124 22.773-51.177 50.984-.041 21.705 13.639 41.065 34.111 48.276v37.274c0 9.426 7.641 17.067 17.067 17.067S256 401.959 256 392.533V355.26c26.609-9.372 40.582-38.541 31.209-65.149zm-48.276 34.156c-9.426 0-17.067-7.641-17.067-17.067s7.641-17.067 17.067-17.067S256 297.774 256 307.2s-7.641 17.067-17.067 17.067z"></path>
                            </svg>
                        </div>
                        <div class="modal__both-sides-group">
                            <div class="checkbox-group">
                                <input id="login-remember-me" name="remember" type="checkbox">
                                <label for="login-remember-me">{{App\Models\Translation::getTranslWord($words, $sel_lang, "remember_me")}}</label>
                            </div><a class="modal__link modal-open" href="#forgot-password">{{App\Models\Translation::getTranslWord($words, $sel_lang, "forgot_your_password")}}</a>
                        </div>
                        <div class="modal__btn-group">
                            <button class="btn-outlined btn-outlined--theme-accent3 w-full" type="submit">{{App\Models\Translation::getTranslWord($words, $sel_lang, "come_in")}}</button>
                        </div>
                        <div class="modal__bottom-text">{{App\Models\Translation::getTranslWord($words, $sel_lang, "i_dont_have_account")}} <a class="modal-open" href="#signup">{{App\Models\Translation::getTranslWord($words, $sel_lang, "register")}}</a></div>
                    </form>
                </div>
            </div>
            <div class="modal mfp-hide" id="login-partner">
                <div class="modal__inner">
                    <button class="close-button modal__close"></button>
                    <div class="modal__user-actions"><a class="modal-open" href="#signup-partner">{{App\Models\Translation::getTranslWord($words, $sel_lang, "register")}}</a><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "log_in")}}</span></div>
                    <form class="modal__form" action="{{route('login')}}" method="post">
                        @csrf
                        <div class="modal__text-divider">{{App\Models\Translation::getTranslWord($words, $sel_lang, "via")}}</div>
                        <div class="modal__social-login"><a class="modal__social-btn modal__social-btn--fb" href="{{route('auth_fb')}}" title="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#FFF" d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0c-3.159 0-5.323 1.987-5.323 5.639V9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877V6.062c.001-1.233.333-2.077 2.051-2.077z"></path>
                                </svg></a><a class="modal__social-btn modal__social-btn--tw" href="{{route('auth_twitter')}}" title="Twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#FFF" d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z"></path>
                                </svg></a><a class="modal__social-btn modal__social-btn--gg" href="{{route('login.google')}}" title="Google">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#fff" d="M120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308H52.823C18.568 144.703 0 198.922 0 256s18.568 111.297 52.823 155.785h86.308v-86.308C126.989 305.13 120 281.367 120 256z"></path>
                                    <path fill="#fff" d="M256 392l-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216C305.044 385.147 281.181 392 256 392z"></path>
                                    <path fill="#fff" d="M139.131 325.477l-86.308 86.308a260.085 260.085 0 0022.158 25.235C123.333 485.371 187.62 512 256 512V392c-49.624 0-93.117-26.72-116.869-66.523z"></path>
                                    <path fill="#fff" d="M512 256a258.24 258.24 0 00-4.192-46.377l-2.251-12.299H256v120h121.452a135.385 135.385 0 01-51.884 55.638l86.216 86.216a260.085 260.085 0 0025.235-22.158C485.371 388.667 512 324.38 512 256z"></path>
                                    <path fill="#fff" d="M352.167 159.833l10.606 10.606 84.853-84.852-10.606-10.606C388.668 26.629 324.381 0 256 0l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z"></path>
                                    <path fill="#fff" d="M256 120V0C187.62 0 123.333 26.629 74.98 74.98a259.849 259.849 0 00-22.158 25.235l86.308 86.308C162.883 146.72 206.376 120 256 120z"></path>
                                </svg></a></div>
                        <div class="modal__text-divider">{{App\Models\Translation::getTranslWord($words, $sel_lang, "or")}}</div>
                        <div class="input-group input-group--with-icon">
                            <input class="modal-focus" type="text" name="login" required>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="17" height="17">
                                <path fill="#828C98" d="M256 0c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135S330.439 0 256 0zm0 240c-57.897 0-105-47.103-105-105S198.103 30 256 30s105 47.103 105 105-47.103 105-105 105zM297.833 301h-83.667C144.964 301 76.669 332.951 31 401.458V512h450V401.458C435.397 333.05 367.121 301 297.833 301zm153.168 181H61v-71.363C96.031 360.683 152.952 331 214.167 331h83.667c61.215 0 118.135 29.683 153.167 79.637V482z"></path>
                            </svg>
                        </div>
                        <div class="input-group input-group--with-icon">
                            <input type="tel" name="login-partner-phone" required>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16">
                                <path fill="#828C98" d="M401 0H111C94.458 0 81 13.458 81 30v452c0 16.542 13.458 30 30 30h290c16.542 0 30-13.458 30-30V30c0-16.542-13.458-30-30-30zM111 30h290l.002 61H111V30zm0 91h290v270H111V121zm290 361H111v-61h290.016l.002 60.999A.093.093 0 01401 482z"></path>
                                <path fill="#828C98" d="M296 46h-80c-8.284 0-15 6.716-15 15s6.716 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z"></path>
                                <circle cx="256" cy="452" r="15" fill="#828C98"></circle>
                            </svg>
                        </div>
                        <div class="input-group input-group--with-icon">
                            <button class="input-group-password-viewer" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M505.752 240.915l-89.088-89.088c-88.737-88.737-232.591-88.737-321.327 0L6.248 240.915c-8.331 8.331-8.331 21.839 0 30.17l89.088 89.088c88.737 88.737 232.591 88.737 321.327 0l89.088-89.088c8.332-8.331 8.332-21.839.001-30.17zm-119.258 89.088c-72.074 72.074-188.913 72.074-260.987 0L51.503 256l74.003-74.003c72.074-72.074 188.913-72.074 260.987 0L460.497 256l-74.003 74.003z"></path>
                                    <path d="M256 149.333c-58.907 0-106.667 47.759-106.667 106.667S197.093 362.667 256 362.667 362.667 314.907 362.667 256 314.907 149.333 256 149.333zM256 320c-35.343 0-64-28.657-64-64s28.657-64 64-64 64 28.657 64 64-28.657 64-64 64z"></path>
                                </svg>
                            </button>
                            <input type="password" name="login-partner-password" required>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.867 477.867" width="17" height="17">
                                <path fill="#828C98" d="M409.6 170.667h-17.067V153.6C392.439 68.808 323.725.094 238.933 0c-84.792.094-153.506 68.808-153.6 153.6v17.067H68.267c-9.426 0-17.067 7.641-17.067 17.067V460.8c0 9.426 7.641 17.067 17.067 17.067H409.6c9.426 0 17.067-7.641 17.067-17.067V187.733c0-9.425-7.641-17.066-17.067-17.066zM119.467 153.6c0-65.98 53.487-119.467 119.467-119.467S358.4 87.62 358.4 153.6v17.067H119.467V153.6zm273.066 290.133h-307.2V204.8h307.2v238.933z"></path>
                                <path fill="#828C98" d="M287.209 290.111c-7.211-20.472-26.571-34.152-48.276-34.111-28.211-.053-51.124 22.773-51.177 50.984-.041 21.705 13.639 41.065 34.111 48.276v37.274c0 9.426 7.641 17.067 17.067 17.067S256 401.959 256 392.533V355.26c26.609-9.372 40.582-38.541 31.209-65.149zm-48.276 34.156c-9.426 0-17.067-7.641-17.067-17.067s7.641-17.067 17.067-17.067S256 297.774 256 307.2s-7.641 17.067-17.067 17.067z"></path>
                            </svg>
                        </div>
                        <div class="modal__both-sides-group">
                            <div class="checkbox-group">
                                <input id="login-partner-remember-me" type="checkbox">
                                <label for="login-partner-remember-me">{{App\Models\Translation::getTranslWord($words, $sel_lang, "remember_me")}}</label>
                            </div><a class="modal__link modal-open" href="#forgot-password">{{App\Models\Translation::getTranslWord($words, $sel_lang, "forgot_your_password")}}</a>
                        </div>
                        <div class="modal__btn-group">
                            <button class="btn-outlined btn-outlined--theme-accent3 w-full" type="submit">{{App\Models\Translation::getTranslWord($words, $sel_lang, "come_in")}}</button>
                        </div>
                        <div class="modal__bottom-text">{{App\Models\Translation::getTranslWord($words, $sel_lang, "i_dont_have_account")}} <a class="modal-open" href="#signup-partner">{{App\Models\Translation::getTranslWord($words, $sel_lang, "register")}}</a></div>
                    </form>
                </div>
            </div>
            <div class="modal mfp-hide" id="signup">
                <div class="modal__inner">
                    <button class="close-button modal__close"></button>
                    <div class="modal__user-actions"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "registration")}}</span><a class="modal-open" href="#login">{{App\Models\Translation::getTranslWord($words, $sel_lang, "login")}}</a></div>
                    <form class="modal__form" action="{{route('register')}}" method="post">
                        @csrf
                        <input type="hidden" name="role_id" value="{{App\Models\Role::where('alias', 'client')->first()->id}}">
                        <div class="modal__text-divider">{{App\Models\Translation::getTranslWord($words, $sel_lang, "via")}}</div>
                        <div class="modal__social-login"><a class="modal__social-btn modal__social-btn--fb" href="{{route('auth_fb')}}" title="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#FFF" d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0c-3.159 0-5.323 1.987-5.323 5.639V9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877V6.062c.001-1.233.333-2.077 2.051-2.077z"></path>
                                </svg></a><a class="modal__social-btn modal__social-btn--tw" href="{{route('auth_twitter')}}" title="Twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#FFF" d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z"></path>
                                </svg></a><a class="modal__social-btn modal__social-btn--gg" href="{{route('login.google')}}" title="Google">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#fff" d="M120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308H52.823C18.568 144.703 0 198.922 0 256s18.568 111.297 52.823 155.785h86.308v-86.308C126.989 305.13 120 281.367 120 256z"></path>
                                    <path fill="#fff" d="M256 392l-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216C305.044 385.147 281.181 392 256 392z"></path>
                                    <path fill="#fff" d="M139.131 325.477l-86.308 86.308a260.085 260.085 0 0022.158 25.235C123.333 485.371 187.62 512 256 512V392c-49.624 0-93.117-26.72-116.869-66.523z"></path>
                                    <path fill="#fff" d="M512 256a258.24 258.24 0 00-4.192-46.377l-2.251-12.299H256v120h121.452a135.385 135.385 0 01-51.884 55.638l86.216 86.216a260.085 260.085 0 0025.235-22.158C485.371 388.667 512 324.38 512 256z"></path>
                                    <path fill="#fff" d="M352.167 159.833l10.606 10.606 84.853-84.852-10.606-10.606C388.668 26.629 324.381 0 256 0l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z"></path>
                                    <path fill="#fff" d="M256 120V0C187.62 0 123.333 26.629 74.98 74.98a259.849 259.849 0 00-22.158 25.235l86.308 86.308C162.883 146.72 206.376 120 256 120z"></path>
                                </svg></a></div>
                        <div class="modal__text-divider">{{App\Models\Translation::getTranslWord($words, $sel_lang, "or")}}</div>
                        <div class="input-group input-group--with-label">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "login2")}} <span class="text-red">*</span></label>
                            <input class="modal-focus" type="text" name="name" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>Email <span class="text-red">*</span></label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "password")}} <span class="text-red">*</span></label>
                            <button class="input-group-password-viewer" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M505.752 240.915l-89.088-89.088c-88.737-88.737-232.591-88.737-321.327 0L6.248 240.915c-8.331 8.331-8.331 21.839 0 30.17l89.088 89.088c88.737 88.737 232.591 88.737 321.327 0l89.088-89.088c8.332-8.331 8.332-21.839.001-30.17zm-119.258 89.088c-72.074 72.074-188.913 72.074-260.987 0L51.503 256l74.003-74.003c72.074-72.074 188.913-72.074 260.987 0L460.497 256l-74.003 74.003z"></path>
                                    <path d="M256 149.333c-58.907 0-106.667 47.759-106.667 106.667S197.093 362.667 256 362.667 362.667 314.907 362.667 256 314.907 149.333 256 149.333zM256 320c-35.343 0-64-28.657-64-64s28.657-64 64-64 64 28.657 64 64-28.657 64-64 64z"></path>
                                </svg>
                            </button>
                            <input type="password" name="password" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "repeat_password")}} <span class="text-red">*</span></label>
                            <button class="input-group-password-viewer" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M505.752 240.915l-89.088-89.088c-88.737-88.737-232.591-88.737-321.327 0L6.248 240.915c-8.331 8.331-8.331 21.839 0 30.17l89.088 89.088c88.737 88.737 232.591 88.737 321.327 0l89.088-89.088c8.332-8.331 8.332-21.839.001-30.17zm-119.258 89.088c-72.074 72.074-188.913 72.074-260.987 0L51.503 256l74.003-74.003c72.074-72.074 188.913-72.074 260.987 0L460.497 256l-74.003 74.003z"></path>
                                    <path d="M256 149.333c-58.907 0-106.667 47.759-106.667 106.667S197.093 362.667 256 362.667 362.667 314.907 362.667 256 314.907 149.333 256 149.333zM256 320c-35.343 0-64-28.657-64-64s28.657-64 64-64 64 28.657 64 64-28.657 64-64 64z"></path>
                                </svg>
                            </button>
                            <input type="password" name="password_confirmation" required>
                        </div>

                        <div class="modal__checkbox-group">
                            <div class="checkbox-group">
                                <input id="signup-checkbox-1" type="checkbox" checked required>
                                <label for="signup-checkbox-1">{{App\Models\Translation::getTranslWord($words, $sel_lang, "accept")}} <a href="service-rules.html">{{App\Models\Translation::getTranslWord($words, $sel_lang, "service_rules")}}</a> {{App\Models\Translation::getTranslWord($words, $sel_lang, "and")}} <a href="{{route('dynamical.page', "privacy_policy")}}">{{$pages->where('alias', "privacy_policy")->first()->getTranslation('name')}}</a></label>
                            </div>
                            <div class="checkbox-group">
                                <input id="signup-checkbox-2" name="notification" type="checkbox">
                                <label for="signup-checkbox-2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "yes_send_news")}}</label>
                            </div>
                        </div>
                        <div class="captcha-placeholder"><div class="g-recaptcha" data-sitekey="6LfzSzAaAAAAAIxMPCfTNBb4zrUbRkXyU9yE3CAM"></div></div>
                        <div class="modal__btn-group">
                            <button class="btn-outlined btn-outlined--theme-accent3 w-full" type="submit">{{App\Models\Translation::getTranslWord($words, $sel_lang, "register")}}</button>
                        </div>
                        <div class="modal__bottom-text">{{App\Models\Translation::getTranslWord($words, $sel_lang, "i_already")}} <a class="modal-open" href="#login">{{App\Models\Translation::getTranslWord($words, $sel_lang, "have_account")}}</a></div>
                    </form>
                </div>
            </div>
            <div class="modal mfp-hide" id="signup-partner">
                <div class="modal__inner">
                    <button class="close-button modal__close"></button>
                    <div class="modal__user-actions"><span>Регистрация</span><a class="modal-open" href="#login-partner">Вход</a></div>
                    <form class="modal__form">
                        <div class="modal__text-divider">с помощью</div>
                        <div class="modal__social-login"><a class="modal__social-btn modal__social-btn--fb" href="#" title="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#FFF" d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0c-3.159 0-5.323 1.987-5.323 5.639V9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877V6.062c.001-1.233.333-2.077 2.051-2.077z"></path>
                                </svg></a><a class="modal__social-btn modal__social-btn--tw" href="#" title="Twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#FFF" d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z"></path>
                                </svg></a><a class="modal__social-btn modal__social-btn--gg" href="#" title="Google">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#fff" d="M120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308H52.823C18.568 144.703 0 198.922 0 256s18.568 111.297 52.823 155.785h86.308v-86.308C126.989 305.13 120 281.367 120 256z"></path>
                                    <path fill="#fff" d="M256 392l-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216C305.044 385.147 281.181 392 256 392z"></path>
                                    <path fill="#fff" d="M139.131 325.477l-86.308 86.308a260.085 260.085 0 0022.158 25.235C123.333 485.371 187.62 512 256 512V392c-49.624 0-93.117-26.72-116.869-66.523z"></path>
                                    <path fill="#fff" d="M512 256a258.24 258.24 0 00-4.192-46.377l-2.251-12.299H256v120h121.452a135.385 135.385 0 01-51.884 55.638l86.216 86.216a260.085 260.085 0 0025.235-22.158C485.371 388.667 512 324.38 512 256z"></path>
                                    <path fill="#fff" d="M352.167 159.833l10.606 10.606 84.853-84.852-10.606-10.606C388.668 26.629 324.381 0 256 0l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z"></path>
                                    <path fill="#fff" d="M256 120V0C187.62 0 123.333 26.629 74.98 74.98a259.849 259.849 0 00-22.158 25.235l86.308 86.308C162.883 146.72 206.376 120 256 120z"></path>
                                </svg></a></div>
                        <div class="modal__text-divider">или</div>
                        <div class="input-group input-group--with-label">
                            <label>Логин <span class="text-red">*</span></label>
                            <input class="modal-focus" type="text" name="signup-partner-username" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>Email <span class="text-red">*</span></label>
                            <input type="email" name="signup-partner-email" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>Телефон <span class="text-red">*</span></label>
                            <input type="tel" name="signup-partner-phone" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>Пароль <span class="text-red">*</span></label>
                            <button class="input-group-password-viewer" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M505.752 240.915l-89.088-89.088c-88.737-88.737-232.591-88.737-321.327 0L6.248 240.915c-8.331 8.331-8.331 21.839 0 30.17l89.088 89.088c88.737 88.737 232.591 88.737 321.327 0l89.088-89.088c8.332-8.331 8.332-21.839.001-30.17zm-119.258 89.088c-72.074 72.074-188.913 72.074-260.987 0L51.503 256l74.003-74.003c72.074-72.074 188.913-72.074 260.987 0L460.497 256l-74.003 74.003z"></path>
                                    <path d="M256 149.333c-58.907 0-106.667 47.759-106.667 106.667S197.093 362.667 256 362.667 362.667 314.907 362.667 256 314.907 149.333 256 149.333zM256 320c-35.343 0-64-28.657-64-64s28.657-64 64-64 64 28.657 64 64-28.657 64-64 64z"></path>
                                </svg>
                            </button>
                            <input type="password" name="signup-partner-password" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>Повторите пароль <span class="text-red">*</span></label>
                            <button class="input-group-password-viewer" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M505.752 240.915l-89.088-89.088c-88.737-88.737-232.591-88.737-321.327 0L6.248 240.915c-8.331 8.331-8.331 21.839 0 30.17l89.088 89.088c88.737 88.737 232.591 88.737 321.327 0l89.088-89.088c8.332-8.331 8.332-21.839.001-30.17zm-119.258 89.088c-72.074 72.074-188.913 72.074-260.987 0L51.503 256l74.003-74.003c72.074-72.074 188.913-72.074 260.987 0L460.497 256l-74.003 74.003z"></path>
                                    <path d="M256 149.333c-58.907 0-106.667 47.759-106.667 106.667S197.093 362.667 256 362.667 362.667 314.907 362.667 256 314.907 149.333 256 149.333zM256 320c-35.343 0-64-28.657-64-64s28.657-64 64-64 64 28.657 64 64-28.657 64-64 64z"></path>
                                </svg>
                            </button>
                            <input type="password" name="signup-partner-password-2" required>
                        </div>
                        <div class="modal__checkbox-group">
                            <div class="checkbox-group">
                                <input id="signup-partner-checkbox-1" type="checkbox" checked required>
                                <label for="signup-partner-checkbox-1">Принимаю <a href="service-rules.html">Правила сервиса</a> и <a href="privacy-policy.html">Политику конфиденциальности</a></label>
                            </div>
                            <div class="checkbox-group">
                                <input id="signup-partner-checkbox-2" type="checkbox">
                                <label for="signup-partner-checkbox-2">Да, присылать мне скидки, предложения, обновления</label>
                            </div>
                        </div>
                        <div class="captcha-placeholder">Здесь будет капча</div>
                        <div class="modal__btn-group">
                            <button class="btn-outlined btn-outlined--theme-accent3 w-full" type="submit">Зарегистрироваться</button>
                        </div>
                        <div class="modal__bottom-text">У меня уже <a class="modal-open" href="#login-partner">есть аккаунт</a></div>
                    </form>
                </div>
            </div>
            <div class="modal mfp-hide" id="forgot-password">
                <div class="modal__inner">
                    <button class="close-button modal__close"></button>
                    <form class="modal__form" action="{{route('password.email')}}" method="post">
                        @csrf
                        <div class="modal__title">Восстановление пароля</div>
                        <div class="modal__text">Введите адрес эл.почты.<br>Инструкция по изменению пароля будет отправлена на ваш зарегистрированный адрес.</div>
                        <div class="input-group input-group--with-label">
                            <label>Email <span class="text-red">*</span></label>
                            <input class="modal-focus" type="email" name="email" required>
                        </div>
                        <div class="modal__btn-group mb-0">
                            <button class="btn-outlined btn-outlined--theme-accent3 w-full" type="submit">Продолжить</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal mfp-hide" id="new-password">
                <div class="modal__inner">
                    <button class="close-button modal__close"></button>
                    <form class="modal__form">
                        <div class="modal__title">Изменение пароля</div>
                        <div class="input-group input-group--with-label">
                            <label>Пароль <span class="text-red">*</span></label>
                            <button class="input-group-password-viewer" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M505.752 240.915l-89.088-89.088c-88.737-88.737-232.591-88.737-321.327 0L6.248 240.915c-8.331 8.331-8.331 21.839 0 30.17l89.088 89.088c88.737 88.737 232.591 88.737 321.327 0l89.088-89.088c8.332-8.331 8.332-21.839.001-30.17zm-119.258 89.088c-72.074 72.074-188.913 72.074-260.987 0L51.503 256l74.003-74.003c72.074-72.074 188.913-72.074 260.987 0L460.497 256l-74.003 74.003z"></path>
                                    <path d="M256 149.333c-58.907 0-106.667 47.759-106.667 106.667S197.093 362.667 256 362.667 362.667 314.907 362.667 256 314.907 149.333 256 149.333zM256 320c-35.343 0-64-28.657-64-64s28.657-64 64-64 64 28.657 64 64-28.657 64-64 64z"></path>
                                </svg>
                            </button>
                            <input type="password" name="new-password-password" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>Повторите пароль <span class="text-red">*</span></label>
                            <button class="input-group-password-viewer" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M505.752 240.915l-89.088-89.088c-88.737-88.737-232.591-88.737-321.327 0L6.248 240.915c-8.331 8.331-8.331 21.839 0 30.17l89.088 89.088c88.737 88.737 232.591 88.737 321.327 0l89.088-89.088c8.332-8.331 8.332-21.839.001-30.17zm-119.258 89.088c-72.074 72.074-188.913 72.074-260.987 0L51.503 256l74.003-74.003c72.074-72.074 188.913-72.074 260.987 0L460.497 256l-74.003 74.003z"></path>
                                    <path d="M256 149.333c-58.907 0-106.667 47.759-106.667 106.667S197.093 362.667 256 362.667 362.667 314.907 362.667 256 314.907 149.333 256 149.333zM256 320c-35.343 0-64-28.657-64-64s28.657-64 64-64 64 28.657 64 64-28.657 64-64 64z"></path>
                                </svg>
                            </button>
                            <input type="password" name="new-password-password-2" required>
                        </div>
                        <div class="modal__btn-group mb-0">
                            <button class="btn-outlined btn-outlined--theme-accent3 w-full" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal modal--gray mfp-hide" id="partner">
                <div class="modal__inner">
                    <button class="close-button modal__close modal__close--inside"></button>
                    <form class="modal__form" action="{{route('partnership_request')}}" method="post">
                        @csrf
                        <div class="modal__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "form_for_partner")}}</div>
                        <div class="modal__radio-group">
                            <div class="radio-group">
                                <input id="partner-radio-1" type="radio" value="freelancer" name="partner-radio" checked>
                                <label for="partner-radio-1">{{App\Models\Translation::getTranslWord($words, $sel_lang, "freelancer_or_agent")}}</label>
                            </div>
                            <div class="radio-group">
                                <input id="partner-radio-2" type="radio" value="company" name="partner-radio">
                                <label for="partner-radio-2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "company")}}</label>
                            </div>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "fion_company_name")}} <span class="text-red">*</span></label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "phone_number")}} <span class="text-red">*</span></label>
                            <input type="tel" name="phone" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "email")}} <span class="text-red">*</span></label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "web_site")}} <span class="text-red">*</span></label>
                            <input type="text" name="site" required>
                        </div>
                        <div class="input-group input-group--with-label">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "states")}} <span class="text-red">*</span></label>
                            <div class="custom-select-wrapper">
                                <select class="custom-select" name="state" data-minimum-results-for-search="0" required>
                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                    <option value="1">Эр-Рияд</option>
                                    <option value="2">Мекка</option>
                                    <option value="3">Медина</option>
                                    <option value="4">Эль-Касим</option>
                                    <option value="5">Эш-Шаркия</option>
                                    <option value="6">Асир</option>
                                    <option value="7">Табук</option>
                                    <option value="8">Хаиль</option>
                                    <option value="9">Эль-Худуд-эш-Шамалия</option>
                                    <option value="10">Джизан</option>
                                    <option value="11">Наджран</option>
                                    <option value="12">Эль-Баха</option>
                                    <option value="13">Эль-Джауф</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group input-group--with-label input-group--with-label-white">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "message")}}</label>
                            <textarea name="message"></textarea>
                        </div>
                        <div class="modal__btn-group">
              <button class="btn-outlined btn-outlined--theme-accent w-full" type="submit">{{App\Models\Translation::getTranslWord($words, $sel_lang, "send_request")}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal modal--wide-lg mfp-hide" id="thanks">
                <div class="modal__inner">
                    <button class="close-button modal__close modal__close--inside"></button>
                    <div class="modal__form modal__form--gratitude">
                        <div class="modal__gratitude-text">{!! App\Models\Translation::getTranslWord($words, $sel_lang, "thank_for_request") !!}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="#079C49" d="M256 512C114.836 512 0 397.164 0 256S114.836 0 256 0s256 114.836 256 256-114.836 256-256 256zm0-480C132.48 32 32 132.48 32 256s100.48 224 224 224 224-100.48 224-224S379.52 32 256 32zm0 0"></path>
                                <path fill="#079C49" d="M232 341.332c-4.098 0-8.191-1.555-11.309-4.691l-69.332-69.332c-6.25-6.254-6.25-16.387 0-22.637s16.383-6.25 22.637 0l58.024 58.027 127.363-127.36c6.25-6.25 16.383-6.25 22.633 0s6.25 16.384 0 22.634L243.348 336.64A16.03 16.03 0 01232 341.332zm0 0"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>


            <!--Scripts-->
            <script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=Element.prototype.closest%2CNodeList.prototype.forEach%2CCustomEvent%2CElement.prototype.append"></script>
            <script src="{{asset('libs/jquery/dist/jquery.min.js')}}"></script>
            <script src="{{asset('libs/magnific-popup/jquery.magnific-popup.js')}}"></script>
            <script src="{{asset('libs/fancybox/jquery.fancybox.min.js')}}"></script>
            <script src="{{asset('libs/owlcarousel/owl.carousel.min.js')}}"></script>
            <script src="{{asset('libs/object-fit-images/ofi.min.js')}}"></script>
            <script src="{{asset('libs/select2/select2.full.changed.js')}}"></script>
            <script src="{{asset('libs/flatpickr/flatpickr.min.js')}}"></script>
            <script src="{{asset('libs/flatpickr/l10n/ru.js')}}"></script>
            <script src="{{asset('libs/flatpickr/l10n/ar.js')}}"></script>
            <script src="{{asset('js/common.js')}}"></script>
            <script src="{{asset('js/modals.js')}}"></script>
    <script>
        function readURL2(input) {
            console.log(input.files && input.files[0]);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log($(input).parent().html());

                    $(input).parent().parent().find('img').attr('src', e.target.result).show();
                    $(input).parent().parent().find('img').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $('body').on('change', '.user-block-img', function (e) {
            readURL2(this);
            $(this).parents('form').submit();


        });
    </script>
    @yield('js')
    </div>
</body>
</html>
