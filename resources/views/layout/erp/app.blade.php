<!DOCTYPE html>
<html lang="zxx">


<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Logic Social</title>


    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap1.min.css') }}" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('vendors/themefy_icon/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/niceselect/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/owl_carousel/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/gijgo/gijgo.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/font_awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/tagsinput/tagsinput.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/datepicker/date-picker.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/vectormap-home/vectormap-2.0.2.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/scroll/scrollable.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/datatable/css/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/datatable/css/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/datatable/css/buttons.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/text_editor/summernote-bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/material_icon/material-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/colors/default.css') }}" id="colorSkinCSS">
    {{-- Bootstrap 5 cdn --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    {{-- <!-- FullCalendar styles -->
    <link href="{{ asset('css/fullcalendar/core/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fullcalendar/daygrid/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fullcalendar/timegrid/main.css') }}" rel="stylesheet"> --}}



</head>

<body class="crm_body_bg">


    <!--begin::Sidebar-->
    @include('layout.erp.sidebar')
    <!--end::Sidebar-->




    <section class="main_content dashboard_part large_header_bg">

        @include('layout.erp.navbar')


        <div class="container">
            <!--begin::Content wrapper-->
            @yield('page')
            <!--end::Content wrapper-->
        </div>


        {{-- Footer part Start --}}
        <div class="footer_part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer_iner text-center">
                            <p>LogicSocial Footer Part <a href="#"> <i class="ti-heart"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Footer part End --}}
    </section>




    <script src="{{ asset('js/jquery1-3.4.1.min.js') }}"></script>
    {{-- <script src="{{ asset('js/popper1.min.js') }}"></script>s --}}
    {{-- <script src="{{ asset('js/bootstrap.min.html') }}"></script> --}}
    <script src="{{ asset('js/metisMenu.js') }}"></script>
    <script src="{{ asset('vendors/count_up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('vendors/chartlist/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/count_up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('vendors/niceselect/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/datepicker/datepicker.js') }}"></script>
    <script src="{{ asset('vendors/datepicker/datepicker.en.js') }}"></script>
    <script src="{{ asset('vendors/datepicker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('vendors/chartjs/roundedBar.min.js') }}"></script>
    <script src="{{ asset('vendors/progressbar/jquery.barfiller.js') }}"></script>
    <script src="{{ asset('vendors/tagsinput/tagsinput.js') }}"></script>
    <script src="{{ asset('vendors/text_editor/summernote-bs4.js') }}"></script>
    <script src="{{ asset('vendors/am_chart/amcharts.js') }}"></script>
    <script src="{{ asset('vendors/scroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendors/scroll/scrollable-custom.js') }}"></script>
    <script src="{{ asset('vendors/vectormap-home/vectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('vendors/vectormap-home/vectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('vendors/apex_chart/apex-chart2.js') }}"></script>
    <script src="{{ asset('vendors/apex_chart/apex_dashboard.js') }}"></script>
    <script src="{{ asset('vendors/echart/echarts.min.js') }}"></script>
    <script src="{{ asset('vendors/chart_am/core.js') }}"></script>
    <script src="{{ asset('vendors/chart_am/charts.js') }}"></script>
    <script src="{{ asset('vendors/chart_am/animated.js') }}"></script>
    <script src="{{ asset('vendors/chart_am/kelly.js') }}"></script>
    <script src="{{ asset('vendors/chart_am/chart-custom.js') }}"></script>
    <script src="{{ asset('js/dashboard_init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/custom.js') }}"></script>

    {{-- Bootstrap 5 cdn --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script> --}}


    {{-- <!-- FullCalendar scripts -->
    <script src="{{ asset('js/fullcalendar/core/main.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/daygrid/main.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/timegrid/main.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/interaction/main.js') }}"></script> --}}

</body>


</html>
