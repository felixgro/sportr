<template>
	<main-layout>
		<form-section @submitted="submit">
			<template #title>
				Add new Sport
			</template>

			<template #description>
				Create and store a new sport for Sportr.
			</template>

			<template #form>
				<!-- Title -->
				<div class="col-span-6 sm:col-span-4">
					<text-input label="Title" name="title" v-model="sport.title" />
				</div>
			</template>

			<template #actions>
				<submit-button :class="{ 'opacity-25': sport.processing }" :disabled="sport.processing">
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
import SubmitButton from '@/Components/Form/Button'

export default {
	components: {
		MainLayout,
		TextInput,
		SubmitButton,
		FormSection
	},

	data() {
		return {
			sport: this.$inertia.form({
				title: ''
			})
		}
	},

	methods: {
		submit() {
			this.sport.post(route('sports.store'));
		}
	}
}
</script>