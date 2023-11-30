<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/samara.png') }}" />

    <link href="{{ asset('assets/layouts/modern-light-menu/css/light/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/layouts/modern-light-menu/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('assets/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('assets/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/src/table/datatable/datatables.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">

    <link href="{{ asset('assets/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/src/assets/css/light/apps/contacts.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/src/plugins/src/font-icons/fontawesome/css/regular.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/plugins/src/font-icons/fontawesome/css/fontawesome.css') }}">

    <link href="{{ asset('assets/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/src/assets/css/light/components/font-icons.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/src/assets/css/light/apps/invoice-preview.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/src/assets/css/dark/apps/invoice-preview.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body class="layout-boxed">
    @stack('style')
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->

    @include('layouts.components.dashboard.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            @include('layouts.components.dashboard.sidebar')
        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">
                    <!-- CONTENT AREA -->
                    @yield('content')
                </div>

            </div>
            <!--  BEGIN FOOTER  -->
            @include('layouts.components.dashboard.footer')
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->

        @stack('script')
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/layouts/modern-light-menu/app.js') }}"></script>
    <script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/src/assets/js/apps/invoice-preview.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/src/assets/js/apps/contact.js') }}"></script>

    <script src="{{ asset('assets/src/plugins/src/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/src/assets/js/dashboard/dash_1.js') }}"></script>

    <script src="{{ asset('assets/src/plugins/src/highlight/highlight.pack.js') }}"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="{{ asset('assets/src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/font-icons/feather/feather.min.js') }}"></script>
    <script>
        feather.replace();
    </script>

    <script src="{{ asset('assets/src/plugins/src/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/input-mask/input-mask.js') }}"></script>

    <script src="{{ asset('assets/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->



</body>


</html>
