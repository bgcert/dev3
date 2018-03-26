<template>
	<div>
		<h4>Comments</h4>
		<hr>
		<div v-for="comment in comments">
			<div class="media">
		    	<img class="mr-3" :src="comment.user.picture" style="width: 28px;">
		    	<div class="media-body">
		    		<h5 class="mt-0">
		                <a :href="'/user/' + comment.user.id">{{ comment.user.name }}</a>
		                ({{ date(comment.created_at) }})
		            </h5>
		    		<p>{{ comment.body }}</p>	
		    	</div>
		    </div>	
		</div>
		<div>
			<!-- <form action="" method="post" @submit.prevent="submit"> -->
				<textarea v-model="body">
					
				</textarea>
				<a href="#" @click.prevent="addComment">Submit</a>
			<!-- </form> -->
		</div>
	</div>
</template>

<script>
    export default {
    	props: ['id'],

    	data: function () {
    		return {
    			comments: [],
    			body: ''
    		}
    	},

    	methods: {
    		date(date) {
    			return moment().to(date);
    			return moment(date).format('D MMM YYYY');
    		},

    		addComment() {
    			console.log(this.message);
    			var vm = this;
				axios.post('/users/comment/add', { id: vm.id, body: this.body })
				.then(function (response) {
					vm.comments.push(response.data);
					vm.message = '';
					console.log(response.data);
				})
				.catch(function (error) {
					console.log(error);
				});
	            console.log('Comments Component mounted.')
    		}
    	},

        mounted() {
        	var vm = this;
			axios.post('/data/getcomments', { id: vm.id })
			.then(function (response) {
				vm.comments = response.data;
				console.log(response.data);
			})
			.catch(function (error) {
				console.log(error);
			});
            console.log('Comments Component mounted.')
        }
    }
</script>