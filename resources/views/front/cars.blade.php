@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="filter filter--catalog">
            <div class="container">
                <form class="filter-catalog" action="{{route('cars.page')}}" method="get">
                    <div>
                        <div class="custom-select-multiple-wrapper">
                            <input type="hidden" value="1" name="filter">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "brand")}}</label>
                            <select class="custom-select-multiple" name="brands[]" multiple="multiple" data-placeholder="{{App\Models\Translation::getTranslWord($words, $sel_lang, "find_car")}}" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                @foreach($brandsSimpleRent as $brand)
                                    <option value="{{$brand->id}}" {{App\Models\CarBrand::findInArr($selected_brands, $brand->id)}}>{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="input-group input-group--with-label mb-0">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "city")}}</label>
                            <div class="custom-select-wrapper">
                                <select class="custom-select custom-select--bold custom-select--uppercase" name="city" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase" required>
                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                    <option value="1" {{$selected_city=="1" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}</option>
                                    <option value="2" {{$selected_city=="2" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}</option>
                                    <option value="3" {{$selected_city=="3" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}</option>
                                    <option value="4" {{$selected_city=="4" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-desktop">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_from")}}</label>
                            <input type="date" data-datepicker-mob-from name="from_date" value="{{$from_date}}" required>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                <path fill="#828C98" d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                <path fill="#828C98" d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                <path fill="#828C98" d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                            </svg>
                        </div>
                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-mobile">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_from")}}</label>
                            <input type="text" data-datepicker-from name="from_date" value="{{$from_date}}" data-date-from-to-id="date-from-to" required>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                <path fill="#828C98" d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                <path fill="#828C98" d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                <path fill="#828C98" d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                            </svg>
                        </div>
                        <div class="date-from-to" id="date-from-to">
                            <div class="flatpickr-hero" data-elem-from="[data-datepicker-from]" data-elem-to="[data-datepicker-to]" data-hidden data-lang="ru"></div>
                        </div>
                    </div>
                    <div>
                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-desktop">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_to")}}</label>
                            <input type="date" data-datepicker-mob-to name="to_date" value="{{$to_date}}" required>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                <path fill="#828C98" d="M35.475 36.508V10h45.706v26.508h98.638V10h45.706v26.508H261V271H0V36.508h35.475zm30.413-11.215h-15.12v31.605h15.12V25.293zm144.344 0h-15.12v31.605h15.12V25.293zM15.293 255.707h230.414v-151.91H15.293v151.91zm0-167.203h230.414V51.8h-20.182v20.39h-45.706v-20.39H81.181v20.39H35.475v-20.39H15.293v36.703z"></path>
                                <path fill="#828C98" d="M117.866 123.678h25.266v15.293h-25.266v-15.293zM74.821 123.678h25.266v15.293H74.821v-15.293zM31.777 123.678h25.266v15.293H31.777v-15.293zM203.96 156.812h25.266v15.293H203.96v-15.293zM160.911 156.812h25.266v15.293h-25.266v-15.293zM117.866 156.812h25.266v15.293h-25.266v-15.293zM74.821 156.812h25.266v15.293H74.821v-15.293zM31.777 156.812h25.266v15.293H31.777v-15.293zM203.96 189.947h25.266v15.293H203.96v-15.293zM160.911 189.947h25.266v15.293h-25.266v-15.293zM117.866 189.947h25.266v15.293h-25.266v-15.293zM74.821 189.947h25.266v15.293H74.821v-15.293zM31.777 189.947h25.266v15.293H31.777v-15.293zM203.96 223.082h25.266v15.293H203.96v-15.293zM160.911 223.082h25.266v15.293h-25.266v-15.293zM117.866 223.082h25.266v15.293h-25.266v-15.293zM74.821 223.082h25.266v15.293H74.821v-15.293z"></path>
                                <path fill="#828C98" d="M162.043 256.341l71.182-71.193a10.704 10.704 0 017.628-3.148c2.891 0 5.598 1.117 7.629 3.148l6.463 6.465a10.707 10.707 0 013.149 7.629c0 2.888-1.118 5.689-3.149 7.718l-41.527 41.624h131.933c5.949 0 10.649 4.657 10.649 10.608v9.14c0 5.951-4.7 11.078-10.649 11.078H212.947l41.997 41.856c2.03 2.032 3.149 4.668 3.149 7.558 0 2.886-1.119 5.561-3.149 7.592l-6.463 6.444c-2.032 2.033-4.739 3.14-7.63 3.14a10.713 10.713 0 01-7.627-3.154l-71.183-71.192a10.714 10.714 0 01-3.149-7.652c-.006-2.903 1.112-5.626 3.151-7.661z"></path>
                            </svg>
                        </div>
                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-mobile">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_to")}}</label>
                            <input type="text" data-datepicker-to name="to_date" value="{{$to_date}}" data-date-from-to-id="date-from-to" required>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                <path fill="#828C98" d="M35.475 36.508V10h45.706v26.508h98.638V10h45.706v26.508H261V271H0V36.508h35.475zm30.413-11.215h-15.12v31.605h15.12V25.293zm144.344 0h-15.12v31.605h15.12V25.293zM15.293 255.707h230.414v-151.91H15.293v151.91zm0-167.203h230.414V51.8h-20.182v20.39h-45.706v-20.39H81.181v20.39H35.475v-20.39H15.293v36.703z"></path>
                                <path fill="#828C98" d="M117.866 123.678h25.266v15.293h-25.266v-15.293zM74.821 123.678h25.266v15.293H74.821v-15.293zM31.777 123.678h25.266v15.293H31.777v-15.293zM203.96 156.812h25.266v15.293H203.96v-15.293zM160.911 156.812h25.266v15.293h-25.266v-15.293zM117.866 156.812h25.266v15.293h-25.266v-15.293zM74.821 156.812h25.266v15.293H74.821v-15.293zM31.777 156.812h25.266v15.293H31.777v-15.293zM203.96 189.947h25.266v15.293H203.96v-15.293zM160.911 189.947h25.266v15.293h-25.266v-15.293zM117.866 189.947h25.266v15.293h-25.266v-15.293zM74.821 189.947h25.266v15.293H74.821v-15.293zM31.777 189.947h25.266v15.293H31.777v-15.293zM203.96 223.082h25.266v15.293H203.96v-15.293zM160.911 223.082h25.266v15.293h-25.266v-15.293zM117.866 223.082h25.266v15.293h-25.266v-15.293zM74.821 223.082h25.266v15.293H74.821v-15.293z"></path>
                                <path fill="#828C98" d="M162.043 256.341l71.182-71.193a10.704 10.704 0 017.628-3.148c2.891 0 5.598 1.117 7.629 3.148l6.463 6.465a10.707 10.707 0 013.149 7.629c0 2.888-1.118 5.689-3.149 7.718l-41.527 41.624h131.933c5.949 0 10.649 4.657 10.649 10.608v9.14c0 5.951-4.7 11.078-10.649 11.078H212.947l41.997 41.856c2.03 2.032 3.149 4.668 3.149 7.558 0 2.886-1.119 5.561-3.149 7.592l-6.463 6.444c-2.032 2.033-4.739 3.14-7.63 3.14a10.713 10.713 0 01-7.627-3.154l-71.183-71.192a10.714 10.714 0 01-3.149-7.652c-.006-2.903 1.112-5.626 3.151-7.661z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="input-group input-group--with-label mb-0">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "auto_class")}}</label>
                            <div class="custom-select-wrapper">
                                <select class="custom-select custom-select--bold custom-select--uppercase" name="car_class" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase" data-placeholder="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}">
                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                    <option value="">???? ??????????????</option>
                                    <option value="vip" {{$selected_car_class=="vip" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "vip_class")}}</option>
                                    <option value="elites" {{$selected_car_class=="elites" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "elit_class")}}</option>
                                    <option value="super_car" {{$selected_car_class=="super_car" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "supercars")}}</option>
                                    <option value="sport_class" {{$selected_car_class=="sport_class" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "sport_class")}}</option>
                                    <option value="suv" {{$selected_car_class=="suv" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "suvs")}}</option>
                                    <option value="business" {{$selected_car_class=="business" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "business_class")}}</option>
                                    <option value="middle" {{$selected_car_class=="middle" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "middle_class")}}</option>
                                    <option value="econom" {{$selected_car_class=="econom" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "econom_class")}}</option>
                                    <option value="microbus" {{$selected_car_class=="microbus" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "minibuses")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn w-full"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "search")}}</span></button>
                        <div class="checkbox-group-2 checkbox-group-2--white checkbox-group-2--small filter-catalog__checkbox">
                            @if(isset($only_free_cars))
                                <input id="filter-show-cars" type="checkbox" {{$only_free_cars ? "checked" : ''}} name="free_cars">
                            @else
                                <input id="filter-show-cars" type="checkbox" name="free_cars">
                            @endif
                            <label for="filter-show-cars">{{App\Models\Translation::getTranslWord($words, $sel_lang, "show_available_cars")}}</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="catalog">
            <div class="container">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li>{{$pages->where('alias', 'cars')->first()->getTranslation('name')}}</li>
                    </ul>
                </div>
                <div class="catalog__top">
                    <div class="sort">
                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "sort_by")}}</label>
                        <div class="custom-select-wrapper w-full">
                            <select class="custom-select cars-sorting">
                                <option value="{{strpos($page_url2, "?") ? str_replace('?', "?sortBy=recommend&", $page_url2) : $page_url2."?sortBy=recommend"}}" {{$sortedBy=="recommend" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "recommended")}}</option>
                                <option value="{{strpos($page_url2, "?") ? str_replace('?', "?sortBy=alphabetOrder&", $page_url2) : $page_url2."?sortBy=alphabetOrder"}}" {{$sortedBy=="alphabetOrder" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "in_alphabet_order")}}</option>
                                <option value="{{strpos($page_url2, "?") ? str_replace('?', "?sortBy=fromHighPrice&", $page_url2) : $page_url2."?sortBy=fromHighPrice"}}" {{$sortedBy=="fromHighPrice" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_highest_lowest")}}</option>
                                <option value="{{strpos($page_url2, "?") ? str_replace('?', "?sortBy=fromLowPrice&", $page_url2) : $page_url2."?sortBy=fromLowPrice"}}" {{$sortedBy=="fromLowPrice" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_lowest_highest")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="catalog__top-info">{{App\Models\Translation::getTranslWord($words, $sel_lang, "found")}} {{$cars_total_count}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "cars")}}</div>
                </div>
                <div class="catalog-cards">
                    @if($from_date&&$to_date)
                        <?php
                        $time_from = \Carbon\Carbon::parse(\Carbon\Carbon::parse($from_date)->format('Y-m-d')." 00:00:00");
                        $time_to = \Carbon\Carbon::parse(\Carbon\Carbon::parse($to_date)->format('Y-m-d')." 23:59:59");
                        ?>
                    @endif
                    @foreach($cars as $car)
                        @if(!$only_free_cars)
                            @include('_partials._car')
                        @else
                            @if(!$car->orders->count())
                                @include('_partials._car')
                            @elseif(!$car->orders->where("status", 'approved')->count())
                                @include('_partials._car')
                            @elseif(!$car->orders->where("status", "approved")->where('from_date', ">", $time_from)->where('from_date', ">", $time_to)->count()&&!$car->orders->where("status", "approved")->where('to_date', ">", $time_from)->where('to_date', ">", $time_to)->count())
                                @include('_partials._car')
                            @endif
                        @endif
                    @endforeach
                </div>

                @if($cars!=null)
                    <div class="pagination">
                        <ul>
                            @if($cars->previousPageUrl())
                                <li class="prev"><a href="{{strpos($page_url, "?") ? str_replace('?', "?page=".($_GET["page"]-1)."&", $page_url) : "?page=".($_GET["page"]-1)}}">&lsaquo;</a></li>
                            @endif

                            @for($i=1; $i<=(int)($cars->lastPage()); $i++)
                                @if($cars->currentPage()==$i)
                                    <li class="active"><a href="#">{{$i}}</a></li>
                                @else
                                        <li><a href="{{strpos($page_url, "?") ? str_replace('?', "?page=".$i."&", $page_url) : "?page=".$i}}">{{$i}}</a></li>
                                @endif

                            @endfor
                            @if($cars->nextPageUrl())
                                @if(isset($_GET["page"]))
                                    <li class="next"><a href="{{strpos($page_url, "?") ? str_replace('?', "?page=".($_GET["page"]+1)."&", $page_url) : "?page=".($_GET["page"]+1)}}">&rsaquo;</a></li>
                                @else
                                    <li class="next"><a href="{{strpos($page_url, "?") ? str_replace('?', "?page=2&", $page_url) : "?page=2"}}">&rsaquo;</a></li>
                                @endif
                            @endif
                        </ul>

                    </div>

                    <div class="display-n" style="display: none">
                        {{ $cars->links() }}
                    </div>
                @endif
                {{--<div class="pagination">--}}
                    {{--<ul>--}}
                        {{--<li class="prev"><a href="#">&lsaquo;</a></li>--}}
                        {{--<li><a href="#">1</a></li>--}}
                        {{--<li class="empty">...</li>--}}
                        {{--<li><a href="#">9</a></li>--}}
                        {{--<li><a href="#">10</a></li>--}}
                        {{--<li class="active"><a href="#">11</a></li>--}}
                        {{--<li class="empty">...</li>--}}
                        {{--<li><a href="#">26</a></li>--}}
                        {{--<li class="next"><a href="#">&rsaquo;</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>
        </div>
    </main>
@endsection
@section('js')
    @parent
    <script>
        $('.cars-sorting').on('change', function(){
            var url = $(this).val();
            window.location.href = url;
        });
    </script>
@stop