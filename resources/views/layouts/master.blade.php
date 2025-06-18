<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>VintageMuse - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet" />

    <!-- Template CSS -->
    <link href="{{ asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet" />

    <!-- ✅ Custom CSS harus di bawah sb-admin agar bisa override -->
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}" />

</head>

</head>

<body id="page-top">

    @yield('content')

    <!-- jQuery dan Bootstrap 4.6 dari CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
   
    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>
        <!-- Custom CSS -->
    

</body>

</html>
