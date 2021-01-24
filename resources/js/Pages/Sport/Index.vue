<template>
    <main-layout>

        <inertia-link as="button" :href="route('sports.create')">Add new Sport</inertia-link>

		<h1>Sports</h1>

        <ul>
            <li v-for="sport in sports" :key="sport.id">
                {{ sport.id }}: {{ sport.title }}
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
