@extends('panel.admin.master')

@section('main-content')
	<div class="content-header">
		<h1>All Users</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12" id="app">
				<users></users>
			</div>
		</div>
	</div>
@endsection