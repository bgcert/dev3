<template>
	<div class="card">
		<div class="image">
			<img :src="image">
		</div>
		<div class="content">
			<router-link :to="edit_link" class="header">
				{{ title }}
			</router-link>
			<div class="meta" v-if="date">
		    	<span class="date">{{ date }}</span>
		    </div>
		</div>
		<div class="extra content">
			<div class="right floated">
				<div class="ui basic mini icon buttons">
					<router-link :to="view_link" class="ui button">
						<i class="eye icon"></i>
					</router-link>
					<router-link :to="edit_link" class="ui button">
						<i class="edit icon"></i>
					</router-link>
					<router-link :to="delete_link" class="ui button">
						<i class="trash icon"></i>
					</router-link>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	props: ['image', 'date', 'title', 'view_link', 'edit_link', 'delete_link'],
    	data: function () {
    		return {

    		}
    	},

        mounted() {
            console.log('Card Dashboard Component mounted.')
        },

        methods: {

        },

        created() {
        	
        }
    };
</script>