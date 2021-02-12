<template>
  <div class="relative w-full bg-gray-200 py-6 px-8">
	  <!-- Head Section -->
	  <div class="flex justify-between items-start">
		  <div>
			<div class="flex items-center text-gray-800">
				<img :src="event.sport.icon" class="h-5 mr-3 opacity-80">
				{{ event.sport.title }}
			</div>
			<div class="mt-1 prose-lg font-bold text-gray-800">{{ event.title }}</div>
		  </div>
		  <div>
			  blaa
		  </div>
	  </div>

	  <!-- Teams & Scores -->
	  <div class="relative grid grid-cols-2 my-6 h-20 text-gray-900">
		  <div class="absolute top-0 left-1/2 h-full w-0.5 transform -translate-x-1/2 bg-gray-300" />
		  <div v-for="team in event.teams" :key="team.id" class="text-center flex justify-center items-center">
			  <div class="font-bold prose-xl truncate w-5/6">
				<div class="prose-2xl">{{ team.pivot.score }}</div>
				<span>{{ team.title }}</span>
			  </div>
		  </div>
	  </div>

	  	<!-- Foot Section -->
	  	<div class="flex justify-between items-end font-bold text-sm">
		  	<div>
			  	<div class="bg-main-200 text-center text-main-800 rounded-full w-16 px-1 py-0.5">
			  		{{ getTime(event.date) }}
			  	</div>
			  	<div class="mt-2 text-gray-700">
				  {{ getDate(event.date) }}
				</div>
			</div>
			<div class="text-gray-700">
				{{ event.location.title }}
			</div>
		</div>

  </div>
</template>

<script>
export default {
	props: ['event'],

	methods: {
		getDate(date) {
			const d = new Date(date)

			const months = [
				"January", "February", "March", "April", "May", "June",
  				"July", "August", "September", "October", "November", "December"
			]

			let day = d.getDate();

			switch(day) {
				case 1:
					day += 'st'
					break
				case 2:
					day += 'nd'
				case 3:
					day += 'rd'
				default:
					day += 'th'
			}

			return `${months[d.getMonth()]} ${day} ${d.getFullYear()}`
		},

		getTime(date) {
			const d = new Date(date)
			const minutes = d.getMinutes() < 10 ? `0${d.getMinutes()}` : d.getMinutes();

			return `${d.getHours()}:${minutes}`
		}
	}
}
</script>