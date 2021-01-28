<template>
	<main-layout>
		<form-section @submitted="submit">
			<template #title>
				Edit Sport
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
			</template>

			<template #actions>
				<submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
					Save Changes
				</submit-button>
			</template>
		</form-section>
		<action-section>
			<template #title>
				Delete Sport
			</template>

			<template #description>
				Permanently delete a sport along with all related data.
			</template>

			<template #content>
				<div class="max-w-xl text-sm text-gray-600">
					Once a sport is deleted, all of its teams and events will be permanently deleted as well.
					Before deleting this sport, please consider downloading any data or information that you wish to retain.
					<div class="mt-3">
						<inertia-link href="/sports/1/teams" class="font-bold">12 Teams</inertia-link> and
						<inertia-link href="/sports/1/events" class="font-bold">5 Events</inertia-link> are currently
						related to this sport.
					</div>
				</div>
			</template>

			<template #actions>
				<jet-confirms-password title="Permanently delete Account" @confirmed="deleteSport">
					<danger-button type="button" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
						Delete Sport
					</danger-button>
				</jet-confirms-password>
			</template>
    </action-section>
	</main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import FormSection from '@/Components/Sections/FormSection'
import TextInput from '@/Components/Form/Input'
import SubmitButton from '@/Components/Form/Button'
import ImageUpload from '@/Components/Form/ImageUpload'
import ActionSection from '@/Components/Sections/ActionSection'
import DangerButton from '@/Components/Form/ButtonDanger'
import JetConfirmsPassword from '@/Jetstream/ConfirmsPassword'

export default {

	props: ['sport'],

	components: {
		MainLayout,
		TextInput,
		SubmitButton,
		FormSection,
		ImageUpload,
		ActionSection,
		DangerButton,
		JetConfirmsPassword
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
		},
		deleteSport() {
			this.$inertia.delete(route('sports.destroy', this.sport.id))
		}
	}
}
</script>