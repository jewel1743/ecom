<!DOCTYPE html>
<html lang="en">
<head>
    @include('master.admin-master.includes.meta')
        <title>@yield('title')</title>
    @include('master.admin-master.includes.css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
   @include('master.admin-master.includes.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('master.admin-master.includes.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        @yield('body')
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
    @include('master.admin-master.includes.footer')

  <!-- Control Sidebar -->
    @include('master.admin-master.includes.sidebar-control')
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- All js and plugins -->
    @include('master.admin-master.includes.all-js')
    <script>
        @if (Session::has('tostMessage'))
            toaster.success('success');
        @endif
    </script>
</body>
</html>
