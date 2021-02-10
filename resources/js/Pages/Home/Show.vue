<template>
	<main-layout>
		<section class="py-36">
			<title-section />
		</section>

		<section class="pb-36">
			<h2 class="prose-2xl mb-10 font-extrabold text-gray-800">Recently Scored</h2>

			<event-loader href="/recentevents" />
		</section>

		<section class="pb-36">
			<h2 class="prose-2xl mb-10 font-extrabold text-gray-800">Upcomming Events</h2>

			<event-loader href="/upcommingevents" />
		</section>

		<section class="pb-36">
			<sport-section :sports="sports" />
		</section>

	</main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import TitleSection from './Title'
import SportSection from './Sports'
import EventLoader from '@/Components/Event/EventLoader'

export default {
	components: {
		MainLayout,
		TitleSection,
		SportSection,
		EventLoader
	},

	props: ['sports', 'scoredEvents']
}
</script>