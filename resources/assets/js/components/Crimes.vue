<template>
	<div>

		<div class="row" v-show="userRole == 'admin'">
			<div class="col-md-8">
				<input class="form-control" type="text" name="crime" v-model="name" placeholder="Enter a new crime" autofocus>
			</div>
			<div class="col-md-2">
				<input class="form-control" type="text" name="number" v-model="number">
			</div>
			<div class="col-md-2">
				<input type="submit" class="btn btn-primary" name="submit" value="Add" @click="addNew()">
			</div>
		</div>

		<div class="row" v-show="userRole == 'commander'">
			<div class="col-md-8">
				<select class="form-control" name="crime" v-model="id">
					<option disabled value="0">SELECT ONE</option>
                    <option v-for="crime in crimeOptions" :value="crime.id">{{ crime.name }}</option>
                </select>
			</div>
			<div class="col-md-2">
				<input class="form-control" type="text" name="number" v-model="number">
			</div>
			<div class="col-md-2">
				<input type="submit" class="btn btn-primary" name="submit" value="Add" @click="addCrimeNumber()">
			</div>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th style="width:33.33%">Name</th>
					<th style="width:33.33%">Number</th>
					<th style="width:33.33%">Edit/Delete</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="crime in crimes">
					<td>
						<p v-show="!crime.showEdit">{{ crime.name }}</p>
						<input type="text" v-model="crime.name" v-show="crime.showEdit">
					</td>

					<td>
						<p v-show="!crime.showEdit">{{ crime.number }}</p>
						<input type="text" v-model="crime.number" v-show="crime.showEdit">
					</td>

					<td>
						<button class="btn btn-primary" v-show="!crime.showEdit" @click="showEditInput(crime.id,true)">Edit</button>
						<button class="btn btn-primary" v-show="crime.showEdit" @click="editCrime(crime.id);">Save</button>
						<button class="btn btn-primary btn-danger" v-show="userRole == 'admin'" @click="deleteCrime(crime.id)">Delete</button>
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
				crimes: [],
				crimeOptions: [],
				userRole: window.userRole,
				id: '0',
				name: '',
				number: 0
			}
		},
		mounted(){
			$.ajax({
				method: 'POST',
				url: '/home/crimes'
			}).done(response=>{
				var crimes = JSON.parse(response);
				if(userRole == 'admin'){
					crimes.forEach(crime=>{
						var temp = JSON.parse(crime);
						temp.showEdit = false;
						this.crimes.push(temp);
					});
				} else if(userRole == 'commander'){
					crimes.forEach(crime=>{
						var temp = JSON.parse(crime);
						temp.showEdit = false;
						if(temp.number == 0){
							this.crimeOptions.push(temp);
						} else{
							this.crimes.push(temp);
						}
					});
				}
			});
		},
		methods:{
			addCrimeNumber(){
				var id = this.id;
				var number = this.number;
				$.ajax({
					method: 'POST',
					url: '/home/commander/crime/'+id,
					data:{
						number: number
					}
				}).done(response=>{
					if(response){
						var data = {
							id: id,
							name: response,
							number: number,
							showEdit: false
						};
						this.crimes.push(data);
						this.crimeOptions.forEach(crime=>{
							if(crime.id == data.id){
								var index = this.crimeOptions.indexOf(crime);
								this.crimeOptions.splice(index,1);
							}
						});
						this.id = '0';
						this.number = 0;
					}
				});
			},
			addNew(){
				var name = this.name.charAt(0).toUpperCase() + this.name.slice(1);
				var number = this.number;
				$.ajax({
					method: 'POST',
					url: '/home/add-new',
					data:{
						name: name,
						number: number
					}
				}).done(response=>{
					if(response){
						var data = {
							id: parseInt(response),
							name: name,
							number: number,
							showEdit: false
						};
						this.crimes.push(data);
						this.name = '';
						this.number = 0;
					}
				});
			},
			showEditInput(id, key){
				this.crimes.forEach(crime=>{
					if(crime.id == id){
						crime.showEdit = key;
					}
				});
			},
			editCrime(id){
				this.crimes.forEach(crime=>{
					if(crime.id == id){
						var newName = crime.name;
						var newNumber = crime.number;
						$.ajax({
							method: 'PATCH',
							url: '/home/crime/'+id,
							data:{
								name: newName,
								number: newNumber
							}
						}).done(response=>{
							if(response){
								this.showEditInput(id,false)
							}
						});
					}
				}); 
			},
			deleteCrime(id){
				$.ajax({
					method: 'DELETE',
					url: '/home/crime/'+id
				}).done(response=>{
					if(response){
						this.crimes.forEach(crime=>{
							if(crime.id == id){
								var index = this.crimes.indexOf(crime);
								this.crimes.splice(index,1);
							}
						});
					}
				});
			}
		}
	}
</script>