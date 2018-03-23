<template>
	<div>
		<a href="#" @click.prevent="openModal">Request</a>
		<div v-if="show">
			<!-- MODAL -->
			<div id="myModal" class="modal" tabindex="-1" role="dialog" style="display: block;">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modal title</h5>
							<button type="button" class="close" aria-label="Close" @click.prevent="openModal">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Modal body text goes here.</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary">Save changes</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- END MODAL -->
		</div>
	</div>
</template>

<script>
    export default {
    	props: ['followed', 'company_id'],

    	data: function () {
    		return {
    			show: false
    		}
    	},

    	methods: {
    		openModal: function() {
    			this.show = !this.show;
    		}
    	},

        mounted() {
            console.log('Request Modal component mounted.');
        }
    }
</script>