<template>
	<div>
		<h2 class="prose-2xl mb-6 font-extrabold text-gray-800">All Sports</h2>

		<div class="flex flex-wrap justify-center -mx-2">
			<!-- Sport Cards -->
			<inertia-link v-for="sport in sports" :key="sport.id" :href="sport.route" class="bg-gray-200 w-full sm:w-auto py-4 px-7 m-2 flex items-center
				group focus:bg-main-700 focus:outline-none hover:bg-main-700 transition duration-60 ease-out">
				<img :src="sport.icon" :alt="sport.title + ' Icon'" class="w-7 mr-3 filter-invert-none group-hover:filter-invert-full group-hover:opacity-90 group-focus:filter-invert-full group-focus:opacity-90 transition duration-1000 ease-in-out">
				<h3 class="prose-lg group-focus:text-gray-100 group-hover:text-gray-100 font-bold transition duration-60 ease-out">
					{{ sport.title }}
				</h3>
			</inertia-link>
		</div>
	</div>
</template>

<script>
export default {
	props: ['sports']
}
</script>