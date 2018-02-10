<template>
	<div class="row">
		<div class="col-md-12">
			<div class="box collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title">Show by Date</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				<div class="box-body" style="display: none;">
					<div class="col-md-6">
						<h3>From:</h3>
						<datepicker v-model="dateRange.min" @input="filterCases"></datepicker>
					</div>
					<div class="col-md-6">
						<h3>To:</h3>
						<datepicker v-model="dateRange.max" @input="filterCases"></datepicker>
					</div>
				</div>
			</div>
			<table class="table">
				<tr>
					<th>Title</th>
					<th>Reporting Station</th>
					<th>Reported On</th>
					<th>Status</th>
					<th>View Details</th>
				</tr>
				<tr v-for="report in reports" v-show="report.show">
					<td>{{ report.title }}</td>
					<td>{{ report.station }}</td>
					<td>{{ report.reported_on }}</td>
					<td>{{ report.status }}</td>
					<td><a :href="href(report.id)">View details</a></td>
				</tr>
			</table>
		</div>
	</div>
</template>

<script>
	import Datepicker from 'vuejs-datepicker';
	export default{
		data(){
			return{
				reports: [],
				dateRange:{
					min: new Date(),
					max: new Date()
				}
			}
		},
		components: {Datepicker},
		mounted(){
			$.ajax({
				method: 'POST',
				url: '/home/cases'
			}).done(response=>{
				this.reports = [];
				let reports = JSON.parse(response);
				reports.forEach(report=>{
					report.show = true;
					this.reports.push(report);
				});
			});
		},
		methods:{
			href(id){
				return '/home/director/case/'+id;
			},
			filterCases(){
				this.reports.forEach(report=>{
					report.show = true;
					let reported_on = new Date(report.reported_on);
					if(reported_on <= this.dateRange.min || reported_on >= this.dateRange.max){
						report.show = false;
					}
				});
			}
		}
	}
</script>