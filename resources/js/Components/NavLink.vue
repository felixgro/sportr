<template>
    <inertia-link :href="route(toRoute)" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['toRoute'],

        computed: {
			active() {
				return route().current(this.toRoute)
			},
            classes() {
                return this.active
					? 'inline-flex px-4 py-1 rounded items-center text-sm font-medium leading-5 text-indigo-800 focus:outline-none bg-indigo-100 transition duration-150 ease-in-out'
					: 'inline-flex px-4 py-1 rounded items-center text-sm font-medium leading-5 text-gray-400 focus:text-indigo-700 hover:text-gray-700 focus:outline-none bg-indigo-100 bg-opacity-0 focus:bg-opacity-50 hover:bg-opacity-50 transition duration-150 ease-in-out'
            }
        }
    }
</script>