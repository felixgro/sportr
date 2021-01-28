<template>
	<main-layout>
		<form-section @submitted="submit">
			<template #title>
				Add new Team
			</template>

			<template #description>
				Create and store a new team using a title and assign it to a sport.
			</template>

			<template #form>
				<!-- Title -->
				<div class="col-span-6 sm:col-span-4">
					<text-input label="Title" name="title" v-model="team.title" />
				</div>

				<!-- Sport ID -->
				<div class="col-span-6 sm:col-span-4">
					<text-input label="Sport Id" name="sportId" v-model="sportId" />
				</div>
			</template>

			<template #actions>
				<submit-button :class="{ 'opacity-25': team.processing }" :disabled="team.processing">
					Add
				</submit-button>
			</template>
		</form-section>
	</main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import FormSection from '@/Components/Sections/FormSection'
import TextInput from '@/Components/Form/Input'
import ImageUpload from '@/Components/Form/ImageUpload'
import SubmitButton from '@/Components/Form/Button'

export default {
	components: {
		MainLayout,
		TextInput,
		ImageUpload,
		SubmitButton,
		FormSection
	},

	data() {
		return {
			team: this.$inertia.form({
				title: '',
			}),
			sportId: "0"
		}
	},

	methods: {
		submit() {
			this.team.post(route('sportteams.store', this.sportId));
		}
	}
}
</script>