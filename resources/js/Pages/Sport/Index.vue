<template>
    <main-layout>

        <inertia-link as="button" :href="route('sports.create')">Add new Sport</inertia-link>

		<h1>Sports</h1>

        <ul>
            <li v-for="sport in sports" :key="sport.id">
                <inertia-link :href="'sports/' + sport.id + '/edit'" class="flex items-center my-5">
                    <img class="h-8 mr-3" :src="sport.icon" :alt="sport.title + ' Icon'">
                    {{ sport.id }}: {{ sport.title }}
                </inertia-link>
            </li>
        </ul>

    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'

export default {
    props: ['sports'],

    components: {
        MainLayout
    }
}
</script>
