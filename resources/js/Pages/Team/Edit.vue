<template>
	<main-layout>
		<form-section @submitted="submit">
			<template #title>
				Edit Team
			</template>

			<template #description>
				Edit and update an existing team with a title and assign it to a sport.
			</template>

			<template #form>
				<!-- Title -->
				<div class="col-span-6 sm:col-span-4">
					<text-input label="Title" name="title" v-model="form.title" />
				</div>

				<!-- Sport ID -->
				<div class="col-span-6 sm:col-span-4">
					<text-input label="Sport Id" name="sportId" v-model="form.sport_id" />
				</div>
			</template>

			<template #actions>
				<submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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

	props: ['team'],

	data() {
		return {
			form: this.$inertia.form({
				_method: 'PUT',
				title: null,
				sport_id: null
			}),
		}
	},

	created() {
		this.form.title = this.team.title
		this.form.sport_id = this.team.sport_id.toString()
	},

	methods: {
		submit() {
			this.form.post(route('sportteams.update', [this.form.sport_id, this.team.id]));
		}
	}
}
</script>