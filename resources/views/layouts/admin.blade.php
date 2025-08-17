
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PawMonitoring</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css')}}">

<link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{ asset('dashboard/dist/css/adminlte.min.css?v=3.2.0')}}">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<link rel="icon" href="{{ asset('seal.png')}}" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('loading.png')}}">>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  @yield('nav')

<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a class="brand-link">
  <div style="text-align: center;">
    <span class="brand-text font-weight-light"  style="color: white">PawMonitoring</span>
</div>

</a>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
<img src="{{ asset('images/adminlogo.png')}}" class="img-circle elevation-2" alt="User Image">
</div>
<div class="info">
<a  class="d-block" style="color: white">{{auth()->user()->username}}</a>
</div>
</div>



<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item">
    <a href="/admin/dashboard" class="nav-link {{  Request::is('admin/dashboard') ? 'active' : '' }}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
    Dashboard
    </p>
    </a>
    </li>



    <li class="nav-item
    {{  Request::is('admin/pending') ||Request::is('admin/approved') || Request::is('admin/declined') || Request::is('admin/preparing') || Request::is('admin/ready') || Request::is('admin/otw') || Request::is('admin/delivered') ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon 	fas fa-clipboard-check"></i>
    <p>
   Reports
    <i class="fas fa-angle-left right"></i>
    </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item ml-2">
    <a href="/admin/pending" class="nav-link {{  Request::is('admin/pending') ? 'active' : '' }}">
        <i class="fas fa-times nav-icon"></i>
    <p>Lost</p>
    </a>
    </li>
    <li class="nav-item ml-2">
      <a href="/admin/approved" class="nav-link {{  Request::is('admin/approved')  ? 'active' : '' }}">
      <i class="fas fa-check nav-icon"></i>
      <p>Found</p>
      </a>
      </li>

    </ul>
    </li>




    <li class="nav-item">
        <a href="/admin/announcement" class="nav-link">
        <i class="nav-icon fa fa-bullhorn"></i>
        <p>
  Announcement
        </p>
        </a>
        </li>





    <li class="nav-item">
      <a href="/admin/settings" class="nav-link">
      <i class="nav-icon fas fa-cog"></i>
      <p>
Settings
      </p>
      </a>
      </li>


    <li class="nav-item">
      <a href="/logout" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
      <p>
Sign Out
      </p>
      </a>
      </li>


</ul>
</nav>

</div>

</aside>

<div class="content-wrapper">
  <div class="container-fluid">
    @yield('content')
  </div>
</div>

<aside class="control-sidebar control-sidebar-dark">

</aside>

</div>






<script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="{{ asset('dashboard/dist/js/adminlte.min.js?v=3.2.0')}}"></script>

<script src="{{ asset('dashboard/dist/js/demo.js')}}"></script>

<script>
    var dataTable =

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
 </script>
</body>
</html>
