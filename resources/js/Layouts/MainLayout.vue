<template>
	<div class="min-h-screen bg-gray-100">
		<!-- Main Header -->
		<the-header v-model="showHeader" />

		<!-- Page Content -->
		<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<slot />
		</main>

		<!-- Modal Portal -->
		<portal-target name="modal" multiple>
		</portal-target>
	</div>
</template>

<script>
import TheHeader from '@/Components/Main/TheHeader'

export default {
	components: {
		TheHeader
	},

	data() {
		return {
			showHeader: true,
			scroll: {
				prev: 0,
			},
		}
	},

	mounted() {
		document.onscroll = this.scrolling
	},

	methods: {
		scrolling(e) {
			const scrollDist = window.scrollY

			// Header scroll logic
			if(scrollDist > 180) {
				this.showHeader = scrollDist < this.prevScroll

				this.prevScroll = scrollDist
			}

		}
	}
}
</script>