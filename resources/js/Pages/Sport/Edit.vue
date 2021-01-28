<template>
	<main-layout>
		<form-section @submitted="submit">
			<template #title>
				Edit {{ sport.title }}
			</template>

			<template #description>
				Change the title or icon of an existing sport by filling out the given form.
			</template>

			<template #form>
				<!-- Icon -->
				<div class="col-span-6 sm:col-span-4">
					<image-upload label="Icon" name="icon" v-model="form.icon" :preview="sport.icon" />
				</div>

				<!-- Title -->
				<div class="col-span-6 sm:col-span-4">
					<text-input label="Title" name="title" v-model="form.title" />
				</div>

				<!-- Icon -->
				<div class="col-span-6 sm:col-span-4">
					<image-upload label="Icon" name="icon" v-model="form.icon" :preview="sport.icon" />
				</div>
			</template>

			<template #actions>
				<submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
					Save Changes
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
import ImageUpload from '@/Components/Form/ImageUpload'

export default {

	props: ['sport'],

	components: {
		MainLayout,
		TextInput,
		SubmitButton,
		FormSection,
		ImageUpload
	},

	data() {
		return {
			form: this.$inertia.form({
				_method: 'PUT',
				title: '',
				icon: null
			})
		}
	},

	created() {
		this.form.title = this.sport.title
	},

	methods: {
		submit() {
			this.form.post(route('sports.update', this.sport.id));
		}
	}
}
</script>