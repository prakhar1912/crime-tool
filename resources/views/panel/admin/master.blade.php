@extends('panel.master')

@section('sidebar-wrapper')
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Options</li>
      <li><a href="/home/admin"><i class="fa fa-link"></i> <span>All Crimes</span></a></li>
      <li><a href="/home/admin/users"><i class="fa fa-link"></i> <span>All Users</span></a></li>
      <li><a href="/home/admin/stations"><i class="fa fa-link"></i> <span>Commanding Stations</span></a></li>
      <li><a href="/home/admin/new"><i class="fa fa-link"></i> <span>Admins</span></a></li>
      <li><a href="/home/admin/report"><i class="fa fa-link"></i> <span>View Report</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
@endsection

@section('content-wrapper')
	@yield('main-content')
@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
@endsection