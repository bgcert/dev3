<template>
	<div>
		<table class="table table-bordered">
			<tr>
				<td>#ID</td>
				<td>{{ event.id }}</td>
			</tr>
			<tr>
				<td>Name</td>
				<td>
					<a :href="'/event/' + event.id">{{ event.theme.title }}</a>
				</td>
			</tr>
			<tr>
				<td>cover</td>
				<td><img :src="event.cover" style="width: 200px;"></td>
			</tr>
			<tr>
			<td>Body</td>
				<td>{{ event.theme.body }}</td>
			</tr>
			<tr>
				<td>Begin at:</td>
				<td>{{ event.begin_at }}</td>
			</tr>
			<tr>
				<td>Organization</td>
				<td>
					<box-hover :name="event.theme.company.name" :id="event.theme.company.id"></box-hover>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><a href="#">Request</a></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<like
						:auth="auth"
						:likes="(event.theme.like_count != null) ? event.theme.like_count.count : ''"
						:liked="event.theme.is_liked.length"
						:item_id="event.theme.id"
						:route="'/users/like/theme'"
						>
					</like>
				</td>
			</tr>
		</table>
	</div>
</template>

<script>
    export default {
    	props: ['auth', 'item'],
    	data: function () {
    		return {
    			event: this.item,
    		}
    	},

        mounted() {
            console.log('event box Component mounted.')
        }
    }
</script>