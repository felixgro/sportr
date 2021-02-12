<template>
	<main-layout>
		<portal to="breadcrumbs">
            <nav-link toRoute="home">Home</nav-link>
        </portal>

		<section class="pb-36">
			<title-section />
		</section>

		<section class="pb-36">
			<h2 class="prose-2xl mb-10 font-extrabold text-gray-800">Recently Scored</h2>

			<event-loader href="/recentevents" />
		</section>

		<section class="pb-36">
			<sport-section :sports="sports" />
		</section>

		<section class="pb-36">
			<h2 class="prose-2xl mb-10 font-extrabold text-gray-800">Upcomming Events</h2>

			<event-loader href="/upcommingevents" />
		</section>

	</main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import TitleSection from './Title'
import SportSection from './Sports'
import EventLoader from '@/Components/Event/EventLoader'
import NavLink from '@/Components/NavLink'

export default {
	components: {
		MainLayout,
		TitleSection,
		SportSection,
		EventLoader,
		NavLink
	},

	props: ['sports', 'scoredEvents']
}
</script>