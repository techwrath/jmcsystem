<!DOCTYPE html>
<html lang="en">


 @include('dashboard.layout.head')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/JamalLogo.png')}}" alt="AdminLTELogo" height="100" width="100">
  </div>

  <!-- Navbar -->
  @include('dashboard.layout.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('dashboard.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('dashboard.layout.script')
@stack('scripts')
<!-- jQuery Knob Chart -->

</body>
</html>
