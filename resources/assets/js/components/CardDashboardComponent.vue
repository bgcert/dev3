<template>
	<div class="card">
		<div class="image" :style="`background: url(${image})`"></div>
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
					<el-tooltip effect="dark" content="Преглед" placement="top">
						<button class="ui button" @click.prevent="$emit('show')">
							<i class="eye icon"></i>
						</button>
					</el-tooltip>
					<el-tooltip effect="dark" content="Редактиране" placement="top">
						<router-link :to="edit_link" class="ui button">
							<i class="edit icon"></i>
						</router-link>
					</el-tooltip>
					<el-tooltip effect="dark" content="Изтриване" placement="top">
						<button class="ui button" @click.prevent="$emit('delete')">
							<i class="trash icon"></i>
						</button>
					</el-tooltip>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	props: ['image', 'date', 'title', 'edit_link'],
    	data: function () {
    		return {

    		}
    	},

        mounted() {
            console.log('Card Dashboard Component mounted.')
        },

        methods: {
        	click() {
        		console.log('delete ?');
		    	this.$emit('delete', 'bye');
		    },

        	handleDelete() {
        		console.log('delete clicked');
        	}
        },

        created() {
        	
        }
    };
</script>

<style>
	.image {
		height: 150px;
		background-size: cover !important;
		background-position: center center !important;
	}
</style>