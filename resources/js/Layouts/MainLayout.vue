<template>
	<div class="min-h-screen bg-gray-100">
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