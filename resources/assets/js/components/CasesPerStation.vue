<template>
	<div class="col-md-12">
		<h3>Choose a station</h3>
		<select class="form-control" name="type" v-model="id" @change="showCases()">
			<option disabled value="0">SELECT ONE</option>
	        <option v-for="station in stations" :value="station.id">{{ station.station }}</option>
	    </select>
	    <br>
	    <table class="table" v-show="reports.length">
	    	<tr>
	    		<th>Title</th>
	    		<th>Crime</th>
	    		<th>Status</th>
	    		<th>Show Details</th>
	    	</tr>
	    	<tr v-for="report in reports">
	    		<td>{{ report.title }}</td>
	    		<td>{{ report.crime }}</td>
	    		<td>{{ report.status }}</td>
	    		<td>
	    			<a :href="href(report.id)">View Details</a>
	    			<br>
	    		</td>
	    	</tr>
	    </table>
	</div>
</template>

<script>
	export default{
		data(){
			return {
				stations: [],
				reports: [],
				id: 0
			}
		},
		mounted(){
			$.ajax({
				method: 'POST',
				url: '/home/stations'
			}).done(response=>{
				var stations = JSON.parse(response);
				stations.forEach(station=>{
					var temp = JSON.parse(station);
					this.stations.push(temp);
				});
			});
		},
		methods:{
			showCases(){
				$.ajax({
					method: 'POST',
					url: '/home/station/'+this.id+'/cases'
				}).done(response=>{
					this.reports = JSON.parse(response);
				});
			},
			href(id){
				return '/home/director/case/'+id;
			}
		}
	}
</script>