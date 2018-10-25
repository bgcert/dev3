<template>

	<div class="comment-feed">
		<h1 class="centered">Комантари</h1>

		<template v-for="(comment, index) in comments">

			<div class="comment">
				<div class="photo">
					<img src="/img/default_user.png">
				</div>
				<div class="comment-body">
					<div class="name aligned">
						{{ comment.user.full_name }}
						<div class="date">{{ comment.updated_at_carbon }}</div>
					</div>
					<p>{{ comment.body }}</p>
					<template v-if="comment.user.id == user_id">
						<a href="#" @click.prevent="removeComment(comment.id, index)">Изтрий</a>
					</template>
				</div>
			</div>
		</template>

		<div class="comment">
			<template v-if="auth">
				<el-input
					type="textarea"
					autosize
					placeholder="Добавете коментар ..."
					v-model="body">
				</el-input>
				<a href="#" class="ui small right floated basic button" @click.prevent="addComment">
					Добави коментар
				</a>
			</template>
			<template v-else>
				<el-input
					@focus="login"
					type="textarea"
					autosize
					placeholder="Добавете коментар ...">
				</el-input>
				<a href="#" class="ui small right floated basic button" @click.prevent="login">
					Добави коментар
				</a>
			</template>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['type', 'id', 'user_id'],

    	data: function () {
    		return {
    			auth: window.auth,
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
