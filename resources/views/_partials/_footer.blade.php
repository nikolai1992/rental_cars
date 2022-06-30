<!--Footer-->
<footer class="footer">
    <div class="container footer__container">
        <div class="footer__side-1"><a class="logo footer__logo" href="{{route('main.page')}}"><img src="{{asset('img/logo.png')}}" alt=""></a>
            <div class="footer__lists">
                <ul>
                    <li style="{{$pages->where('alias', 'about_us')->first()->footer ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'about_us')}}">{{$pages->where('alias', 'about_us')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'news')->first()->footer ? '' : "display:none"}}"><a href="{{route('news.page')}}">{{$pages->where('alias', 'news')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'reviews')->first()->footer ? '' : "display:none"}}"><a href="{{route('reviews.page')}}">{{$pages->where('alias', 'reviews')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'why_we')->first()->footer ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'why_we')}}">{{$pages->where('alias', 'why_we')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'contacts')->first()->footer ? '' : "display:none"}}"><a href="{{route('contacts.page')}}">{{$pages->where('alias', 'contacts')->first()->getTranslation('name')}}</a></li>
                    @if(isset($other_pages[0]))
                        @foreach($other_pages[0] as $other_page)
                            <li style="{{$pages->where('alias', $other_page->alias)->first()->footer ? '' : "display:none"}}"><a href="{{route('dynamical.page', $other_page->alias)}}">{{$pages->where('alias', $other_page->alias)->first()->getTranslation('name')}}</a></li>
                        @endforeach
                    @endif
                </ul>
                <ul>
                    <li style="{{$pages->where('alias', 'features-of-renting')->first()->footer ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'features-of-renting')}}">{{$pages->where('alias', 'features-of-renting')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'terms-of-cooperation')->first()->footer ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'terms-of-cooperation')}}">{{$pages->where('alias', 'terms-of-cooperation')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'advertising-placement')->first()->footer ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'advertising-placement')}}">{{$pages->where('alias', 'advertising-placement')->first()->getTranslation('name')}}</a></li>
                    @if(auth()->user()==null)
                        <li><a class="modal-open" href="#partner">{{$words->where('name', "partners_office")->first()->translations->where("language_id", $sel_lang->id)->first()->value}}</a></li>
                    @else
                        @if(auth()->user()->role->alias=="partner")
                            <li><a href="{{route('partner.index')}}">{{$words->where('name', "partners_office")->first()->translations->where("language_id", $sel_lang->id)->first()->value}} </a></li>
                        @endif
                    @endif
                    <li style="{{$pages->where('alias', 'faq')->first()->footer ? '' : "display:none"}}"><a href="{{route('faq')}}">FAQ</a></li>
                    @if(isset($other_pages[1]))
                        @foreach($other_pages[1] as $other_page)
                            <li style="{{$pages->where('alias', $other_page->alias)->first()->footer ? '' : "display:none"}}"><a href="{{route('dynamical.page', $other_page->alias)}}">{{$pages->where('alias', $other_page->alias)->first()->getTranslation('name')}}</a></li>
                        @endforeach
                    @endif
                </ul>
                <ul>
                    <li style="{{$pages->where('alias', 'assistance')->first()->footer ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'assistance')}}">{{$pages->where('alias', 'assistance')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'cars')->first()->footer ? '' : "display:none"}}"><a href="{{route('cars.page')}}">{{$pages->where('alias', 'cars')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'brands')->first()->footer ? '' : "display:none"}}"><a href="{{route('brands.page')}}">{{$pages->where('alias', 'brands')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'rent-of-cars-with-driver')->first()->footer ? '' : "display:none"}}"><a href="{{route('cars_rent_with_driver.page')}}">{{$pages->where('alias', 'rent-of-cars-with-driver')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'rent_condition')->first()->footer ? '' : "display:none"}}"><a href="{{route('rent_condition')}}">{{$pages->where('alias', 'rent_condition')->first()->getTranslation('name')}}</a></li>
                    @if(isset($other_pages[2]))
                        @foreach($other_pages[2] as $other_page)
                            <li style="{{$pages->where('alias', $other_page->alias)->first()->footer ? '' : "display:none"}}"><a href="{{route('dynamical.page', $other_page->alias)}}">{{$pages->where('alias', $other_page->alias)->first()->getTranslation('name')}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="footer__social">
                @if($medias->where('name', 'twitter')->first()->url)
                    <a class="social-link" href="{{$medias->where('name', 'twitter')->first()->url}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="21" height="21">
                            <path fill="#03a9f4" d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z"></path>
                        </svg>
                    </a>
                @endif
                @if($medias->where('name', 'facebook')->first()->url)
                    <a class="social-link" href="{{$medias->where('name', 'facebook')->first()->url}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                            <path fill="#3b5999" d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0 8.064 0 9.95 7.85 9.674 9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877c.188-2.824-.761-5.016 2.051-5.016z"></path>
                        </svg>
                    </a>
                @endif
                @if($medias->where('name', 'youtube')->first()->url)
                    <a class="social-link" href="{{$medias->where('name', 'youtube')->first()->url}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                            <path fill="#C60000" d="M9.939 7.856a.75.75 0 00-1.134.644v7c0 .585.638.939 1.134.645l5.869-3.495a.751.751 0 00.001-1.289zm.366 6.325v-4.36l3.655 2.183z"></path>
                            <path fill="#C60000" d="M19.904 3.271c-4.653-.691-11.153-.691-15.808 0C2.234 3.547.767 5.009.447 6.907c-.596 3.523-.596 6.664 0 10.186.32 1.899 1.787 3.36 3.649 3.636 2.332.346 5.124.519 7.915.519 2.786 0 5.571-.172 7.894-.518 1.86-.276 3.326-1.737 3.648-3.636.596-3.523.596-6.665 0-10.188-.32-1.897-1.787-3.359-3.649-3.635zm2.17 13.573c-.213 1.256-1.173 2.222-2.39 2.402-4.518.671-10.838.671-15.368-.001-1.218-.181-2.179-1.146-2.391-2.402-.574-3.394-.574-6.291 0-9.687.213-1.256 1.173-2.22 2.392-2.402 2.262-.335 4.973-.503 7.682-.503 2.711 0 5.422.168 7.684.503 1.218.181 2.179 1.146 2.391 2.402.574 3.396.574 6.293 0 9.688z"></path>
                        </svg>
                    </a>
                @endif
                @if($medias->where('name', 'instagram')->first()->url)
                    <a class="social-link" href="{{$medias->where('name', 'instagram')->first()->url}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
                            <linearGradient id="a" x1="42.966" x2="469.034" y1="469.03" y2="42.962" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#ffd600"></stop>
                                <stop offset=".5" stop-color="#ff0100"></stop>
                                <stop offset="1" stop-color="#d800b9"></stop>
                            </linearGradient>
                            <linearGradient id="b" x1="163.043" x2="348.954" y1="348.954" y2="163.043" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#ff6400"></stop>
                                <stop offset=".5" stop-color="#ff0100"></stop>
                                <stop offset="1" stop-color="#fd0056"></stop>
                            </linearGradient>
                            <linearGradient id="c" x1="370.929" x2="414.373" y1="141.068" y2="97.624" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#f30072"></stop>
                                <stop offset="1" stop-color="#e50097"></stop>
                            </linearGradient>
                            <path fill="url(#a)" d="M510.46 150.453c-1.245-27.25-5.573-45.86-11.901-62.14a125.466 125.466 0 00-29.528-45.344 125.503 125.503 0 00-45.344-29.535c-16.285-6.325-34.89-10.649-62.14-11.887C334.247.297 325.523 0 256 0s-78.246.297-105.547 1.54c-27.25 1.245-45.855 5.573-62.14 11.901A125.466 125.466 0 0042.968 42.97a125.488 125.488 0 00-29.535 45.34c-6.325 16.285-10.649 34.894-11.887 62.14C.297 177.754 0 186.473 0 255.996c0 69.527.297 78.25 1.547 105.55 1.242 27.247 5.57 45.856 11.898 62.142a125.451 125.451 0 0029.528 45.34 125.433 125.433 0 0045.343 29.527c16.282 6.332 34.891 10.656 62.141 11.902 27.305 1.246 36.023 1.54 105.547 1.54 69.523 0 78.246-.294 105.547-1.54 27.25-1.246 45.855-5.57 62.14-11.902a130.879 130.879 0 0074.868-74.868c6.332-16.285 10.656-34.894 11.902-62.14C511.703 334.242 512 325.523 512 256c0-69.527-.297-78.246-1.54-105.547zM464.38 359.45c-1.137 24.961-5.309 38.516-8.813 47.535a84.775 84.775 0 01-48.586 48.586c-9.02 3.504-22.574 7.676-47.535 8.813-26.988 1.234-35.086 1.492-103.445 1.492-68.363 0-76.457-.258-103.45-1.492-24.956-1.137-38.51-5.309-47.534-8.813a79.336 79.336 0 01-29.434-19.152 79.305 79.305 0 01-19.152-29.434c-3.504-9.02-7.676-22.574-8.813-47.535-1.23-26.992-1.492-35.09-1.492-103.445 0-68.36.262-76.453 1.492-103.45 1.14-24.96 5.309-38.515 8.813-47.534a79.367 79.367 0 0119.152-29.438 79.261 79.261 0 0129.438-19.148c9.02-3.508 22.574-7.676 47.535-8.817 26.992-1.23 35.09-1.492 103.445-1.492h-.004c68.356 0 76.453.262 103.45 1.496 24.96 1.137 38.511 5.309 47.534 8.813a79.375 79.375 0 0129.434 19.148 79.261 79.261 0 0119.149 29.438c3.507 9.02 7.68 22.574 8.816 47.535 1.23 26.992 1.492 35.09 1.492 103.445 0 68.36-.258 76.453-1.492 103.45zm0 0"></path>
                            <path fill="url(#b)" d="M255.996 124.54c-72.601 0-131.457 58.858-131.457 131.46s58.856 131.457 131.457 131.457c72.606 0 131.461-58.855 131.461-131.457s-58.855-131.46-131.46-131.46zm0 216.792c-47.125-.004-85.332-38.207-85.328-85.336 0-47.125 38.203-85.332 85.332-85.332 47.129.004 85.332 38.207 85.332 85.332 0 47.129-38.207 85.336-85.336 85.336zm0 0"></path>
                            <path fill="url(#c)" d="M423.371 119.348c0 16.965-13.754 30.718-30.719 30.718-16.968 0-30.722-13.754-30.722-30.718 0-16.97 13.754-30.723 30.722-30.723 16.965 0 30.72 13.754 30.72 30.723zm0 0"></path>
                        </svg>
                    </a>
                @endif
            </div>
            <div class="footer__copy">©{{Carbon\Carbon::now()->format('Y')}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_right_reserved")}}</div>
        </div>
        <div class="footer__side-2">
            <ul>
                @foreach($other_pages2 as $other_page2)
                <li><a href="{{route('dynamical.page', $other_page2->alias)}}">{{$pages->where('alias', $other_page2->alias)->first()->getTranslation('name')}}</a></li>
                @endforeach
            </ul>
            <div class="footer__payments">
                @foreach($payment_icons as $payment_icon)
                <a href="{{route('payment.page')}}"><img src="{{asset($payment_icon->icon)}}" alt=""></a>
                @endforeach

            </div>
        </div>
    </div>
</footer>
