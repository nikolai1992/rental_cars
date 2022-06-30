<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Starter</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/vendor/adminlte/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <style>
        .logout-label:hover
        {
            cursor: pointer;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- SEARCH FORM -->

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">

            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('admin')}}" class="brand-link">
            <img src="{{asset('/vendor/adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Rental Cars.one</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('page.index')}}" class="nav-link {{\Request::route()->getName()=='page.index'||
                                 \Request::route()->getName()=='page.create'||
                                 \Request::route()->getName()=='page.edit'? 'active' : ''}}">
                                    <i class="fas fa-file-invoice"></i>
                                    <p>Страницы</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('order.index')}}" class="nav-link {{\Request::route()->getName()=='order.index'||
                                 \Request::route()->getName()=='order.create'||
                                 \Request::route()->getName()=='order.edit'? 'active' : ''}}">
                                    <i class="fas fa-file-invoice"></i>
                                    <p>Заказы</p>
                                </a>
                            </li>
                            <li class="nav-item menu-is-opening">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-envelope-open-text"></i>
                                    <p>
                                        Тикеты
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('ticket_status.index')}}" class="nav-link">
                                            <i class="fas fa-file-invoice"></i>
                                            <p>Темы тикетов</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('ticket.index')}}" class="nav-link">
                                            <i class="fas fa-envelope-open-text"></i>
                                            <p>Список тикетв</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('car.index')}}" class="nav-link {{\Request::route()->getName()=='car.index'||
                                 \Request::route()->getName()=='car.create'||
                                 \Request::route()->getName()=='car.edit'? 'active' : ''}}">
                                    <i class="fas fa-car"></i>
                                    <p>Автомобили</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('car_brand.index')}}" class="nav-link {{\Request::route()->getName()=='car_brand.index'||
                                 \Request::route()->getName()=='car_brand.create'||
                                 \Request::route()->getName()=='car_brand.edit'? 'active' : ''}}">
                                    <i class="fas fa-copyright"></i>
                                    <p>Марки</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('faq.index')}}" class="nav-link {{\Request::route()->getName()=='faq.index'||
                                 \Request::route()->getName()=='faq.create'||
                                 \Request::route()->getName()=='faq.edit'? 'active' : ''}}">
                                    <i class="fas fa-question-circle"></i>
                                    <p>FAQ</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('article.index')}}" class="nav-link {{\Request::route()->getName()=='article.index'||
                                 \Request::route()->getName()=='article.create'||
                                 \Request::route()->getName()=='article.edit'? 'active' : ''}}">
                                    <i class="fas fa-newspaper"></i>
                                    <p>Новости</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('setting.index')}}" class="nav-link {{\Request::route()->getName()=='setting.index'||
                                 \Request::route()->getName()=='setting.edit'? 'active' : ''}}">
                                    <i class="fa fa-cog"></i>
                                    <p>Общее</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('currency.index')}}" class="nav-link {{\Request::route()->getName()=='currency.index'||
                                 \Request::route()->getName()=='currency.edit'||
                                 \Request::route()->getName()=='currency.create' ? 'active' : ''}}">
                                    <i class="fab fa-bitcoin"></i>
                                    <p>Вылюты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('language.index')}}" class="nav-link {{\Request::route()->getName()=='language.index'||
                                 \Request::route()->getName()=='language.edit'||
                                 \Request::route()->getName()=='language.create' ? 'active' : ''}}">
                                    <i class="fas fa-font"></i>
                                    <p>Языки</p>
                                </a>
                            </li>
                            {{--<li class="nav-item">--}}
                                {{--<a href="{{route('services.index')}}" class="nav-link {{\Request::route()->getName()=='services.index'||--}}
                                 {{--\Request::route()->getName()=='services.create'||--}}
                                 {{--\Request::route()->getName()=='services.edit'? 'active' : ''}}">--}}
                                    {{--<i class="fa fa-wrench"></i>--}}
                                    {{--<p>Сервисы</p>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link {{\Request::route()->getName()=='users.index'||
                                 \Request::route()->getName()=='users.create'||
                                 \Request::route()->getName()=='users.edit'? 'active' : ''}}">
                                    <i class="fa fa-users"></i>
                                    <p>Пользователи</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <label class="nav-link logout-label" for="logout"><i class="fas fa-sign-out-alt"></i>Выйти</label>

                                <form id="frm-logout" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="nav-link" id="logout" style="opacity: 0"></button>
                                </form>

                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
                @if (Session::has('flash_message'))
                        <div class="alert alert-success">
                            <p>{{Session::get('flash_message')}}</p>
                        </div>
                @endif
            @yield('content')
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-{{date('Y')}}
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/vendor/adminlte/dist/js/adminlte.min.js')}}"></script>

@yield('js')
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script>
    var tables = '';
    $(document).ready( function () {
        tables = $('.example2').dataTable( {
            "pageLength": 10,
            "sorting" : false
        } );
    } );
</script>
<script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
<script>
    var editor_config = {
        path_absolute: "/",
        selector: "textarea.my-editor",
        language: "en",
        content_css: "{{asset('assets/css/style.css')}}",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern",
            'codesample'
        ],
        // toolbar: 'codesample | bold italic sizeselect fontselect fontsizeselect | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | insertfile undo redo | forecolor backcolor emoticons | code',
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        rel_list: [
            {title: 'follow', value: 'follow'},
            {title: 'nofollow', value: 'nofollow'}
        ],
        importcss_file_filter: "",
        importcss_append: true,
        style_formats: [

        ],
        textcolor_map: [
            '314c9b','Blue',
            'ffd54e', 'Yellow',
            "000000", "Black",
            "808080", "Gray",
            "333333", "Very dark gray",
            "FF0000", "Red",
            "008000", "Green",
            "FFFFFF", "White",
        ],
        templates: [

        ],
        codesample_languages: [
            {text: 'HTML/XML', value: 'markup'},
            {text: 'JavaScript', value: 'javascript'},
            {text: 'CSS', value: 'css'},
            {text: 'PHP', value: 'php'},
            {text: 'Ruby', value: 'ruby'},
            {text: 'Python', value: 'python'},
            {text: 'Java', value: 'java'},
            {text: 'C', value: 'c'},
            {text: 'C#', value: 'csharp'},
            {text: 'C++', value: 'cpp'}
        ],
        menubar: true,
        toolbar: "insertfile undo redo | styleselect | bold italic sizeselect fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor",
        relative_urls: false,
        file_browser_callback: function (field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };

    tinymce.init(editor_config);
</script>
</body>
</html>
