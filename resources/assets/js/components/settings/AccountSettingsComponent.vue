<template>
	<div>
		<el-form ref="form" :model="form" label-width="180px">
			<el-form-item label="Име">
				<el-input v-model="form.name"></el-input>
			</el-form-item>

			<el-form-item>
				<el-button type="primary" plain @click.prevent="setName"> Промени</el-button>
			</el-form-item>

			<el-form-item label="Бизнес акаунт">
				<el-switch v-model="form.type" @change="toggleType"></el-switch>
			</el-form-item>

			<el-form-item label="Публикуване на събития">
				<el-switch v-model="form.events" :disabled="!form.type"></el-switch>
			</el-form-item>

			<el-form-item label="Публикуване на зали">
				<el-switch v-model="form.venues" :disabled="!form.type"></el-switch>
			</el-form-item>
		</el-form>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	props: [],

    	data: function () {
    		return {

    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Account settings component mounted.')
        }
    }
</script>