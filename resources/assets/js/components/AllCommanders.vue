<template>
	<div class="col-md-12">
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Station</th>
				<th>Reassign</th>
			</tr>
			<tr v-for="commander in commanders">
				<td>{{ commander.name }}</td>
				<td>{{ commander.station }}</td>
				<td>
					<select class="form-control" v-model="commander.selected" @change="changeStation(commander)">
						<option value="0" disabled>SELECT ONE</option>
						<option v-for="station in stations" :value="station.id">{{ station.station }}</option>
					</select>
				</td>
			</tr>
		</table>
	</div>
</template>

<script>
	export default{
		data(){
			return {
				commanders: [],
				stations: []
			}
		},
		mounted(){
			$.ajax({
				method: 'POST',
				url: '/home/director/commanders/all'
			}).done(response=>{
				let commanders = JSON.parse(response);
				commanders.forEach(commander=>{
					commander.selected = 0;
					this.commanders.push(commander);
				});
			});
			$.ajax({
				method: 'POST',
				url: '/home/stations/all'
			}).done(response=>{
				let stations = JSON.parse(response);
				stations.forEach(station=>{
					this.stations.push(JSON.parse(station));
				});
			});
		},
		methods:{
			changeStation(commander){
				$.ajax({
					method: 'PATCH',
					url: '/home/director/commanders/'+commander.id,
					data: {
						station_id: commander.selected
					}
				}).done(response=>{
					if(response){
						commander.station = response;
					}
				});
			}
		}
	}
</script>