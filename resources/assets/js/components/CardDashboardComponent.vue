<template>
	<div class="card dashboard-card mb-3">
		<div class="image" :style="`background: url(${image})`"></div>
		<div class="card-body">
			<h5>{{ title }}</h5>
			<div class="card-text" v-if="date">
				<small class="text-muted">{{ date }}</small>
		    </div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-end">
				<div class="btn-group">
					<el-tooltip effect="dark" content="Преглед" placement="top">
						<button class="btn btn-outline-secondary btn-sm" @click.prevent="$emit('show')">
							<i class="far fa-eye"></i>
						</button>
					</el-tooltip>
					<el-tooltip effect="dark" content="Редактиране" placement="top">
						<router-link :to="edit_link" class="btn btn-outline-secondary btn-sm">
							<i class="fas fa-pencil-alt"></i>
						</router-link>
					</el-tooltip>
					<el-tooltip effect="dark" content="Изтриване" placement="top">
						<button class="btn btn-outline-secondary btn-sm" @click.prevent="emitDelete">
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