<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
      rel="icon"
      href="{{ url('public/admin/assets/img/kaiadmin/favicon.ico') }}"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{ url('public/admin/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["public/admin/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ url('public/admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/admin/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/admin/assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ url('public/admin/assets/css/demo.css') }}" />
    <script>
      var base_url = '{{ url("admin/") }}'; 
      var base_url_new = '{{ url("/") }}'; 
  </script>
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('Driver.Layout.sidebar')
      <!-- End Sidebar -->
      <div class="main-panel">
       <!----header-->
       @include('Driver.Layout.Header')
        <div class="container">
        <!---yield content-->
        @yield('content')
        </div>
        <!--footer-->
        @include('Driver.Layout.footer')
      </div>


    </div>
    <!--   Core JS Files   -->
    <script src="{{ url('public/admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/js/custom-ajax.js') }}"></script> 
    <script src="{{ url('public/admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/js/all.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="{{ url('public/admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ url('public/admin/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ url('public/admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ url('public/admin/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ url('public/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
 
    <!-- jQuery Vector Maps -->
    <script src="{{ url('public/admin/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ url('public/admin/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ url('public/admin/assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ url('public/admin/assets/js/setting-demo.js') }}"></script>
    <script src="{{ url('public/admin/assets/js/demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.0/jspdf.plugin.autotable.min.js"></script>
    <script src="{{ url('public/admin/assets/js/custom-script.js') }}"></script>
       <script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});
        });
        </script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>  

  </body>
</html>
