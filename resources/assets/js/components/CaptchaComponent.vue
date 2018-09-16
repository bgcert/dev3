<template>
	<div class="ui segment captcha">
		<p><span>{{ numbers[n1] }} {{ operations[op] }} {{ numbers[n2] }}</span> е равно на</p>
		<input type="text" name="result" v-model="input">
		<button @click.prevent="check()">test</button>
		<button @click.prevent="load()">refresh</button>
	</div>
	
</template>

<script>
	export default {

    	data: function () {
    		return {
    			numbers: ['нула', 'едно', 'две', 'три', 'четири', 'пет', 'шест', 'седем', 'осем', 'девет'],
    			operations: ['плюс', 'минус'],
    			n1: null,
    			n2: null,
    			op: null,
    			input: null,
    			result: null
    		}
    	},

    	methods: {
    		random(x) {
    			return _.random(x);;
    		},

    		mathResult(n1, n2, op) {
    			if (op == 0){
	    			return n1 + n2;	
	    		} else if (op == 1) {
	    			return n1 - n2;
	    		} else {
	    			console.log('error');
	    		}
    		},

    		check() {
    			if (this.result == this.input) {
    				console.log('cool');
    			} else {
    				console.log('not cool');
    			}
    		},
    		load() {
    			this.n1 = this.random(9);
	    		this.n2 = this.random(9);
	    		this.op = this.random(1);
	    		this.result = this.mathResult(this.n1, this.n2, this.op);
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