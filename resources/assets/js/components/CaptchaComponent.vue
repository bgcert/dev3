<template>
	<div class="ui segment captcha">
		<p>{{ hun[randoms[0]] }} {{ dec[randoms[1]] }} и {{ dig[randoms[2]] }}</p>
		<input type="text" name="result" v-model="input">
		<button @click.prevent="check()">test</button>
		<button @click.prevent="load()">refresh</button>
	</div>
	
</template>

<script>
	export default {

    	data: function () {
    		return {
    			input: null,
    			result: null,
    			dig: ['', 'едно', 'две', 'три', 'четири', 'пет', 'шест', 'седем', 'осем', 'девет'],
    			dec: ['', '', 'двадесет', 'тридесет', 'четиредесет', 'петдесет', 'шестдесет', 'седемдесет', 'осемдесет', 'деведесет'] ,
    			hun: ['', 'сто', 'двеста', 'триста', 'четиристотин', 'петстотин', 'шестстотин', 'седемстотин', 'осемстотин', 'деветстотин'],
    			randoms: []

    		}
    	},

    	methods: {
    		random(x) {
    			return _.random(x);
    		},

    		check() {
    			if (this.result == this.input) {
    				console.log('cool');
    			} else {
    				console.log('not cool');
    			}
    		},
    		load() {
    			this.randoms[0] = _.random(1, 9);
    			this.randoms[1] = _.random(2, 9);
    			this.randoms[2] = _.random(1, 9);
	    		this.result = this.randoms[0] * 100 + this.randoms[1] * 10 + this.randoms[2];
    		}
    	},

    	created() {
    		this.load();
		}
    };
</script>

<style>
	.captcha {
		border: 1px solid green;
	}
</style>