<template>
	<div class="item box-alt">
		<div class="image" :style="`background: url(${image})`"></div>
		<div class="content">
			<router-link :to="edit_link" class="title">
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
						<button class="btn blue small" @click.prevent="$emit('show')">
							<i class="far fa-eye"></i>
						</button>
					</el-tooltip>
					<el-tooltip effect="dark" content="Редактиране" placement="top">
						<router-link :to="edit_link" class="btn blue small">
							<i class="fas fa-pencil-alt"></i>
						</router-link>
					</el-tooltip>
					<el-tooltip effect="dark" content="Изтриване" placement="top">
						<button class="btn blue small" @click.prevent="emitDelete">
							<i class="far fa-trash-alt"></i>
						</button>
					</el-tooltip>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	props: ['image', 'date', 'title', 'edit_link', 'confirmMessage'],
    	data: function () {
    		return {

    		}
    	},

        mounted() {
            console.log('Card Dashboard Component mounted.')
        },

        methods: {
        	emitDelete() {
        		var result = confirm(this.confirmMessage);
			    if (result) {
			    	this.$emit('deleteClick');   
			    } else {
			        console.log('canceled');
			    }
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