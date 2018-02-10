<template>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table">
				<tr>
					<td><h3>Title</h3></td>
					<td><h3>{{ title }}</h3></td>
				</tr>
				<tr>
					<td><h3>Description</h3></td>
					<td><h3>{{ description }}</h3></td>
				</tr>
				<tr>
					<td><h3>Station</h3></td>
					<td><h3>{{ station }}</h3></td>
				</tr>
				<tr>
					<td><h3>Status</h3></td>
					<td><h3>{{ status }}</h3></td>
				</tr>
			</table>
			<br>
			<hr>
			<h2>Comments:</h2>
			<div class="panel panel-primary" v-for="comment in comments">
				<div class="panel-heading">{{ comment.name }}</div>
  				<div class="panel-body">{{ comment.comment }}</div>
			</div>
			<input type="text" class="form-control" name="comment" v-model="comment">
			<br>
			<button class="btn btn-primary" @click="postComment()">Post</button>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				title: '',
				description: '',
				station: '',
				status: '',
				comment: '',
				comments: []
			}
		},
		props:['id'],
		mounted(){
			$.ajax({
				method: 'POST',
				url: '/home/case/'+this.id
			}).done(response=>{
				let details = JSON.parse(response);
				this.title = details.title;
				this.description = details.description;
				this.station = details.station;
				this.status = details.status;
			});
			$.ajax({
				method: 'POST',
				url: '/home/case/'+this.id+'/comments'
			}).done(response=>{
				let comments = JSON.parse(response);
				this.comments = comments;
			});
		},
		methods:{
			postComment(){
				let comment = this.comment;
				$.ajax({
					method: 'POST',
					url: '/home/case/'+this.id+'/comment',
					data:{
						comment: comment
					}
				}).done(response=>{
					if(parseInt(response)){
						this.comments.push({
							name: window.userName,
							comment: this.comment
						});
						this.comment = '';
					}
				});
			}
		}
	}
</script>