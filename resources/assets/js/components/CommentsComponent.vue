<template>

	<div class="comments">

		<template v-for="(comment, index) in comments">

			<div class="comment card p-3 my-4">
				<div class="d-flex">
					<div class="avatar mr-3">
						<img src="/img/default_user.png">
					</div>
					<div>
						<div class="username font-weight-bold">{{ comment.user.full_name }}</div>
						<div class="small text-muted">{{ comment.updated_at_carbon }}</div>
					</div>
				</div>
				<p class="comment-body mt-4">{{ comment.body }}</p>
				<div class="text-right">
					<template v-if="comment.user.id == user_id">
						<button class="btn btn-primary btn-sm" @click.prevent="removeComment(comment.id, index)"> Изтрий</button>
					</template>
				</div>
			</div>

		</template>

		<div class="jumbotron p-3">
			<template v-if="auth">
				<textarea
					class="form-control w-100"
					type="textarea"
					autosize
					placeholder="Добавете коментар ..."
					v-model="body">
				</textarea>
				<div class="text-right mt-2">
					<button class="btn btn-primary" @click.prevent="addComment">
						Добави коментар
					</button>	
				</div>
			</template>
			<template v-else>
				<textarea
					@focus="login"
					class="form-control w-100"
					type="textarea"
					autosize
					placeholder="Добавете коментар ...">
				</textarea>
				<div class="text-right mt-2">
					<button class="btn btn-primary" @click.prevent="login">
						Добави коментар
					</button>	
				</div>
			</template>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['auth', 'type', 'id', 'user_id'],

    	data: function () {
    		return {
    			comments: [],
    			body: '',
    		}
    	},

    	methods: {

    		login() {
    			EventBus.$emit('loginClicked');
    		},

    		addComment() {
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
        	var route = '/api/' + this.type +'/comments';
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
    };
</script>