@extends('panel.director.master')

@section('main-content')
	<div class="content-header">
		<h1>Report</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div id="pieChartContainer" style="height: 370px; width: 100%;"></div>
			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div id="barChartContainer" style="height: 370px; width: 100%;"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<table class="table">
					<tr>
						<th>Crime</th>
						<th>Number</th>
					</tr>
					@foreach($crimes as $crime)
					<tr>
						<td>{{ $crime->name }}</td>
						<td>{{ $crime->number }}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection