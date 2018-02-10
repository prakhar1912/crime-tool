<template>
	<div>
		<div class="box collapsed-box">
			<div class="box-header with-border">
				<h3 class="box-title">Filters</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-plus"></i>
					</button>
				</div>
			</div>
			<div class="box-body" style="display: none;">
				<div class="row">
					<div class="col-md-6">
						<h4>Stations</h4>
						<div class="checkbox" v-for="station in stations">
						 	<label><input type="checkbox" name="role" v-model="station.checked" @change="applyFilter()">{{ station.station }}</label>
						</div>
					</div>
					<div class="col-md-6">
						<h4>Roles</h4>
						<div class="checkbox" v-for="role in roles">
						 	<label><input type="checkbox" name="role" v-model="role.checked" @change="applyFilter()">{{ role.role }}</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<table class="table">
			<thead>
				<tr>
					<th style="width:16.66%">Name</th>
					<th style="width:16.66%">Email</th>
					<th style="width:16.66%">Commanding Station</th>
					<th style="width:16.66%">Role</th>
					<th style="width:16.66%">Account Status</th>
					<th style="width:16.66%">Ban/Unban</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="user in users" v-show="user.show">
					<td>
						<p>{{ user.name }}</p>
					</td>
					<td>
						<p>{{ user.email }}</p>
					</td>
					<td>
						<p>{{ user.station }}</p>
					</td>
					<td>
						<p>{{ user.role }}</p>
					</td>
					<td>
						<p>{{ user.banned ? 'Deactivated' : 'Active' }}</p>
					</td>
					<td>
						<button class="btn btn-primary" v-show="user.banned" @click="unbanUser(user.id);">Activate</button>
						<button class="btn btn-primary btn-danger" v-show="!user.banned" @click="banUser(user.id)">Deactivate</button>
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
				users: [],
				stations: [],
				roles: [
					{
						role: 'commander',
						checked: false
					},
					{
						role: 'director',
						checked: false
					}
				]
			}
		},
		mounted(){
			$.ajax({
				method: 'POST',
				url: '/home/admin/users'
			}).done(response=>{
				var users = JSON.parse(response);
				users.forEach(user=>{
					var temp = JSON.parse(user);
					temp.show = true;
					this.users.push(temp);
				});
			});
			$.ajax({
				method: 'POST',
				url: '/home/stations'
			}).done(response=>{
				var stations = JSON.parse(response);
				stations.forEach(station=>{
					var temp = JSON.parse(station);
					temp.checked = false;
					this.stations.push(temp);
				});
			});
		},
		methods:{
			banUser(id){
				$.ajax({
					method: 'POST',
					url: '/home/admin/ban/'+id
				}).done(response=>{
					this.users.forEach(user=>{
						if(user.id == id){
							user.banned = 1;
						}
					});
				});
			},
			unbanUser(id){
				$.ajax({
					method: 'POST',
					url: '/home/admin/unban/'+id
				}).done(response=>{
					this.users.forEach(user=>{
						if(user.id == id){
							user.banned = 0;
						}
					});
				});
			},
			applyFilter(){
				let filters = {
					stations: [],
					roles: []
				};

				this.stations.forEach(station=>{
					if(station.checked){
						filters.stations.push(station.station);
					}
				});

				this.roles.forEach(role=>{
					if(role.checked){
						filters.roles.push(role.role);
					}
				});
				this.users.forEach(user=>{
					if(filters.stations.length || filters.roles.length){
						user.show=false;
						filters.stations.forEach(station=>{
							if(user.station == station){
								user.show = true;
							}
						});
						filters.roles.forEach(role=>{
							if(user.role == role){
								user.show=true;
							}
						});
					} else {
						user.show = true;
					}
				});
			}
		}
	}
</script>