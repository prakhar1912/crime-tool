@extends('panel.master')

@section('sidebar-wrapper')
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Options</li>
      <li class="active"><a href="/home/commander"><i class="fa fa-link"></i> <span>Add New</span></a></li>
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