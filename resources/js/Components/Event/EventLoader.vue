<template>
	<div>
		<div class="grid grid-cols-2 gap-10">

			<event-card v-for="event in events" :key="event.id" :event="event" />
		</div>
		<button v-if="moreEventsExist" class="relative block mt-8 mx-auto text-main-700 focus:outline-none" @click="loadEvents">show more..</button>
	</div>
</template>

<script>
import EventCard from './EventCard'

export default {
	components: {
		EventCard
	},

	props: ['href'],

	data() {
		return {
			events: [],
			nextUrl: null
		}
	},

	computed: {
		moreEventsExist() {
			return this.nextUrl !== null
		}
	},

	async created() {
		this.nextUrl = this.href

		await this.loadEvents()
	},

	methods: {
		async loadEvents() {
			return window.axios({
				method: 'get',
				url: this.nextUrl,
			}).then(res => {
				this.nextUrl = res.data.next_page_url
				this.events.push(...res.data.data)
			})
		}
	}
}
</script>