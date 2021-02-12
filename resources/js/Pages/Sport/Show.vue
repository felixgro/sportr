<template>
    <main-layout>
        <portal to="breadcrumbs">
            <nav-link toRoute="home">Home</nav-link> <bc-arrow />
            <nav-link :href="sport.route">{{ sport.title }}</nav-link>
        </portal>

        <inertia-link as="button" :href="sport.route + '/edit'">Edit Sport</inertia-link>

		<h1 class="text-xl mt-5">Teams</h1>
        <ul>
            <li v-for="team in sport.teams" :key="team.id">
				{{ team.id }}: {{ team.title }}
            </li>
        </ul>

		<h1 class="text-xl mt-5">Events</h1>
        <ul>
            <li v-for="event in sport.events" :key="event.id">
				{{ event.id}}: {{ event.title }}
            </li>
        </ul>

    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import NavLink from '@/Components/NavLink'
import BcArrow from '@/Components/Icons/BreadcrumbArrow'

export default {
    props: ['sport'],

    components: {
        MainLayout,
        NavLink,
        BcArrow
    },

	created() {
		console.dir(this.sport)
	}
}
</script>