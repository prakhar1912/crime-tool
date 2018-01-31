@extends('panel.master')

@section('sidebar-wrapper')
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Options</li>
      <li class="active"><a href="/home/director"><i class="fa fa-link"></i> <span>View Report</span></a></li>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js"></script>
<script src="{{ asset('js/director.js') }}"></script>
@endsection