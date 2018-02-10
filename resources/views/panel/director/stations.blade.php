@extends('panel.director.master')

@section('main-content')
	<div class="content-header">
		<h1>Cases Per Station</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12" id="case">
				<cases-per-station></cases-per-station>
			</div>
		</div>
	</div>
@endsection