<template>
	<div>
		<div class="row">
			<div class="col-md-8">
				<input class="form-control" type="text" name="station" v-model="name" placeholder="Enter a new station" autofocus>
			</div>
			<div class="col-md-2">
				<input type="submit" class="btn btn-primary" name="submit" value="Add" @click="addNew()">
			</div>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th style="width:50%">Name</th>
					<th style="width:50%">Edit/Delete</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="station in stations">
					<td>
						<p v-show="!station.showEdit">{{ station.station }}</p>
						<input type="text" v-model="station.station" v-show="station.showEdit">
					</td>
					<td>
						<button class="btn btn-primary" v-show="!station.showEdit" @click="showEditInput(station.id,true)">Edit</button>
						<button class="btn btn-primary" v-show="station.showEdit" @click="editStation(station.id);">Save</button>
						<button class="btn btn-primary btn-danger" @click="deleteStation(station.id)">Delete</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				stations: [],
				name: ''
			}
		},
		mounted(){
			$.ajax({
				method: 'POST',
				url: '/home/admin/stations'
			}).done(response=>{
				var stations = JSON.parse(response);
				stations.forEach(station=>{
					var temp = JSON.parse(station);
					temp.showEdit = false;
					this.stations.push(temp);
				});
			});
		},
		methods:{
			showEditInput(id, key){
				this.stations.forEach(station=>{
					if(station.id == id){
						station.showEdit = key;
					}
				});
			},
			addNew(){
				var name = this.name.charAt(0).toUpperCase() + this.name.slice(1);
				$.ajax({
					method: 'POST',
					url: '/home/admin/station/add-new',
					data:{
						name: name
					}
				}).done(response=>{
					if(response){
						var data = {
							id: parseInt(response),
							station: name,
							showEdit: false
						};
						this.stations.push(data);
						this.name = '';
					}
				});
			},
			editStation(id){
				this.stations.forEach(station=>{
					if(station.id == id){
						var newName = station.station;
						$.ajax({
							method: 'PATCH',
							url: '/home/admin/station/'+id,
							data:{
								name: newName
							}
						}).done(response=>{
							if(response){
								this.showEditInput(id,false)
							}
						});
					}
				}); 
			},
			deleteStation(id){
				$.ajax({
					method: 'DELETE',
					url: '/home/admin/station/'+id
				}).done(response=>{
					if(response){
						this.stations.forEach(station=>{
							if(station.id == id){
								var index = this.stations.indexOf(station);
								this.stations.splice(index,1);
							}
						});
					}
				});
			}
		}
	}
</script>