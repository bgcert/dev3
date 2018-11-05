<template>
	<div class="form captcha">
		<template v-if="error">
			 <el-alert type="error" :title="error"></el-alert>
		</template>
		<div class="field">
			<mark>{{ numberString }}</mark>
		</div>
		<div class="field">
			<a href="#" class="btn small blue" @click.prevent="load"><i class="fas fa-sync-alt"></i></a>
		</div>
		<div class="field">
			<input type="text" placeholder="Въведете числото" v-model="input">
		</div>
	</div>
	
</template>

<script>
	import { EventBus } from '../app';
	export default {
    	data: function () {
    		return {
    			input: '',
    			result: -11,
    			dig: ['', 'едно', 'две', 'три', 'четири', 'пет', 'шест', 'седем', 'осем', 'девет'],
    			dec: ['', '', 'двадесет', 'тридесет', 'четиредесет', 'петдесет', 'шестдесет', 'седемдесет', 'осемдесет', 'деведесет'] ,
    			hun: ['', 'сто', 'двеста', 'триста', 'четиристотин', 'петстотин', 'шестстотин', 'седемстотин', 'осемстотин', 'деветстотин'],
    			randoms: [],
    			numberString: '',
    			error: ''
    		}
    	},

    	methods: {
    		setNumberString: function () {
                this.numberString = this.hun[this.randoms[0]] + ' ' + this.dec[this.randoms[1]] + ' и ' + this.dig[this.randoms[2]];
            },

    		random(x) {
    			return _.random(x);
    		},

    		load() {
    			this.randoms[0] = _.random(1, 9);
    			this.randoms[1] = _.random(2, 9);
    			this.randoms[2] = _.random(1, 9);
	    		this.result = this.randoms[0] * 100 + this.randoms[1] * 10 + this.randoms[2];
	    		this.setNumberString();
    		}
    	},

    	created() {
    		this.load();

    		EventBus.$on('captcha', (resolve, reject) => {
    			this.error = '';
    			if (this.input == '') {
    				this.error = 'Моля въведете числото';
    				reject();
    				this.load();
    				return;
    			}

    			if (this.result == this.input) {
    				resolve();
    			} else {
    				this.error = 'Грешка при валидиране на captcha код';
    				this.load();
    				reject();
    			}
        	});
		},

		destroyed() {
			EventBus.$off('captcha');
		}
    };
</script>

<style>

</style>