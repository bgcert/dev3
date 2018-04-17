<template>
	<div>
		<h4>Коментари</h4>
		<div class="ui reply form" style="overflow: auto;">
			<div class="field">
				<textarea rows="2" v-model="body"></textarea>
			</div>
			<a href="#" class="ui small right floated basic button" @click.prevent="addComment">
				Добави коментар
			</a>
		</div>
		<div class="ui comments">
			<template v-for="(comment, index) in comments">
				<div class="comment">
					<a :href="'/user/' + comment.user.id" class="avatar">
						<img class="rounded" :src="comment.user.picture">
					</a>
					<div class="content">
						<a :href="'/user/' + comment.user.id" class="author">{{ comment.user.name }}</a>
						<div class="metadata">
							<div class="date">{{ date(comment.created_at) }}</div>
							<template v-if="comment.user.id == user_id">
								<a href="#" @click.prevent="removeComment(comment.id, index)" class="reply">delete</a>
							</template>
						</div>
						<div class="text">
							<p>
								{{ comment.body }}
							</p>
						</div>
					</div>
				</div>
			</template>
		</div>

	</div>
</template>

<script>
    export default {
    	props: ['type', 'id', 'user_id'],

    	data: function () {
    		return {
    			comments: [],
    			body: '',
    		}
    	},

    	methods: {

    		date(date) {
    			return moment().to(date);
    		},

    		addComment() {
    			console.log(this.message);
    			var vm = this;
    			var route = '/users/comment/' + this.type + '/add';
				axios.post(route, { id: vm.id, body: this.body })
				.then(function (response) {
					vm.comments.unshift(response.data);
					vm.body = '';
					window.flash('New comment posted', 'success');
				})
				.catch(function (error) {
					console.log(error);
				});
	            console.log('Comments Component mounted.')
    		},

    		removeComment(id, index) {
    			var vm = this;

    			this.$confirm('This will permanently delete the comment. Continue?', 'Warning', {
    				type: 'warning'
    			})
    			.then( () => {
    				// Actual delete if "Ok" is pressed
    				axios.post('/users/comment/remove', { id: id })
	    				.then(function (response) {
	    					vm.comments.splice(index, 1);
	    				})
	    				.catch(function (error) {
	    					console.log(error);
	    				});

	    				this.$message({
	    					type: 'success',
	    					message: 'Delete completed'
	    				});
    			})
    			.catch( () => {
    				this.$message({
    					type: 'info',
    					message: 'Delete canceled'
    				});          
    			});

    			
    		}
    	},

        mounted() {
        	var vm = this;
        	var route = '/data/' + this.type +'/comments';
			axios.post(route, { id: vm.id })
			.then(function (response) {
				vm.comments = response.data;
				console.log(response.data);
			})
			.catch(function (error) {
				console.log(error);
			});
            console.log('Comments Component mounted.');            
        },
    }
</script>

<style>
	.rounded {
		border-radius: 50% !important;
	}
</style>
