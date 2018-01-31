<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DCI Reports | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/AdminLTE.min.css') }}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/skins/_all-skins.min.css') }}">
	<!-- Morris chart -->
	<link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">
	<div class="main-header">

		<nav class="navbar navbar-static-top" role="navigation">
	        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	            <span class="sr-only">Toggle navigation</span>
	        </a>
	        <div class="navbar-custom-menu">
	        	<ul class="nav navbar-nav">
	        		<li><a href="/logout">Logout</a></li>
	        	</ul>
	        </div>
	    </nav>
		@yield('main-header')
	</div>
	<div class="sidebar-wrapper">
		@yield('sidebar-wrapper')
	</div>
	<div class="content-wrapper">
		@yield('content-wrapper')
	</div>
</div>
<!-- ./wrapper -->
<script>
	window.userRole = '{{ auth()->user()->role->role }}';
</script>
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
	toastr.options = {
	  "positionClass": "toast-bottom-left"
	};
	@if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>
@yield('scripts')
</body>
</html>
