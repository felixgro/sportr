<template>
	<main-layout>
		<input type="search" class="w-full mb-5" v-model="searchTerm" @input="sendRequest">

		<div class="grid grid-cols-3">
			<div>
				<h3 class="font-bold">Events:</h3>
				<div v-for="event in events" :key="event.id">
					{{ event.id }}: <span v-html="parseText(event.title)" />
				</div>
			</div>
			<div>
				<h3 class="font-bold">Teams:</h3>
				<div v-for="team in teams" :key="team.id">
					{{ team.id }}: <span v-html="parseText(team.title)" />
				</div>
			</div>
			<div>
				<h3 class="font-bold">Sports:</h3>
				<div v-for="sport in sports" :key="sport.id">
					{{ sport.id }}: <span v-html="parseText(sport.title)" />
				</div>
			</div>
		</div>
	</main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'

export default {
	components: {
		MainLayout
	},

	data() {
		return {
			searchTerm: '',
			events: [],
			sports: [],
			teams: []
		}
	},

	methods: {
		sendRequest() {
			if(this.searchTerm.length === 0) {
				this.events = [];
				this.sports = [];
				this.teams = [];

				return
			}

			window.axios({
				method: 'get',
				url: route('search') + "?q=" + this.searchTerm,
			}).then(res => {
				this.events = res.data.events
				this.sports = res.data.sports
				this.teams = res.data.teams
			})
		},

		parseText(string) {
			const replace = "(" + this.searchTerm + ")"
			const re = new RegExp(replace, 'gi');

			return string.replace(re, '<span class="font-bold">$1</span>')
		}
	}
}
</script>