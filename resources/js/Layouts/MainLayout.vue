<template>
	<div class="min-h-screen bg-gray-200 bg-opacity-60">
		<!-- Main Header -->
		<the-header />

		<!-- Page Content -->
		<main>
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
	}
}
</script>