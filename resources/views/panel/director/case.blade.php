@extends('panel.director.master')

@section('main-content')
	<div class="content-header">
		<h1>Case Details</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12" id="case">
				<case id="{{ $case->id }}"></case>
			</div>
		</div>
	</div>
@endsection