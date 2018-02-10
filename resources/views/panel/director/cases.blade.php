@extends('panel.director.master')

@section('main-content')
	<div class="content-header">
		<h1>Cases of {{ $cases->first()->crime->name }}</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<table class="table">
					<tr>
						<th>Cases</th>
						<th>Reporting Station</th>
						<th>Status</th>
						<th>View Details</th>
					</tr>
					@foreach($cases as $case)
					<tr>
						<td>{{ $case->title}}</td>
						<td>{{ $case->station->station }}</td>
						<td style="color:{{ $case->status == 'open' ? 'green' :'red' }}">{{ $case->status }}</td>
						<td><a href="/home/director/case/{{ $case->id }}" class="btn btn-primary">View Details</a></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection