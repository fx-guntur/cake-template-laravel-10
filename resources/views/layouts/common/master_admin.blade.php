<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title')
     <!-- Google Web Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

     <!-- Icon Font Stylesheet -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

     <!-- Libraries Stylesheet -->
     <link href={{asset('lib/lightbox/css/lightbox.min.css')}} rel="stylesheet">
     <link href={{asset('lib/owlcarousel/assets/owl.carousel.min.css')}} rel="stylesheet">


     <!-- Customized Bootstrap Stylesheet -->
     <link href={{asset('css/bootstrap.min.css')}} rel="stylesheet">

     <!-- Template Stylesheet -->
     <link href={{asset('css/style.css')}} rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href={{asset('../static/assets/vendor/bootstrap/css/bootstrap.min.css')}} rel="stylesheet">
    <link href={{asset('../static/assets/vendor/bootstrap-icons/bootstrap-icons.css')}} rel="stylesheet">
    <link href={{asset('../static/assets/vendor/boxicons/css/boxicons.min.css')}} rel="stylesheet">
    <link href={{asset('../static/assets/vendor/quill/quill.snow.css')}} rel="stylesheet">
    <link href={{asset('../static/assets/vendor/quill/quill.bubble.css')}} rel="stylesheet">
    <link href={{asset('../static/assets/vendor/remixicon/remixicon.css')}} rel="stylesheet">
    <link href={{asset('../static/assets/vendor/simple-datatables/style.css')}} rel="stylesheet">
    <link href={{asset('../static/assets/img/logo.png')}} rel="icon" type="image/x-icon" />

    <!-- Template Main CSS File -->
    <link href={{asset('../static/assets/css/style.css')}} rel="stylesheet">
</head>

<body>
@include('layouts.common.header_admin')
@yield('content')
{{-- @stack('scripts') --}}
@include('layouts.common.footer_admin')
</body>
<!-- Vendor JS Files -->
<script src="../static/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../static/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../static/assets/vendor/chart.js/chart.umd.js"></script>
<script src="../static/assets/vendor/echarts/echarts.min.js"></script>
<script src="../static/assets/vendor/quill/quill.min.js"></script>
<script src="../static/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../static/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../static/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../static/assets/js/main.js"></script>
<script>
function myFunction() {
  confirm("Press a button!");
}
</script>
</body>

</html>
