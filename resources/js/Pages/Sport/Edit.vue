<template>
	<main-layout>
		<portal to="breadcrumbs">
            <nav-link toRoute="home">Home</nav-link> <bc-arrow />
            <nav-link :href="sport.route">{{ sport.title }}</nav-link> <bc-arrow />
			<nav-link :href="sport.route + '/edit'">Edit</nav-link>
        </portal>

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
						<span v-if="totalTeams > 0">
							<inertia-link :href="sport.route + '/teams'" class="font-bold">{{ relatedTeams }}</inertia-link>
						</span>
						<span v-if="totalEvents > 0">
							and <inertia-link :href="sport.route + '/events'" class="font-bold">{{ relatedEvents }}</inertia-link>
						</span>
						<span v-if="noRelations">Nothing</span>
						{{ verb }} currently related to this sport.
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
import NavLink from '@/Components/NavLink'
import BcArrow from '@/Components/Icons/BreadcrumbArrow'

export default {
	components: {
		MainLayout,
		TextInput,
		SubmitButton,
		FormSection,
		ImageUpload,
		ActionSection,
		DangerButton,
		JetConfirmsPassword,
		NavLink,
		BcArrow
	},

	props: ['sport', 'totalTeams', 'totalEvents'],

	data() {
		return {
			form: this.$inertia.form({
				_method: 'PUT',
				title: '',
				icon: null
			})
		}
	},

	computed: {
		noRelations() {
			return this.totalEvents == 0 && this.totalTeams == 0
		},

		relatedTeams() {
			return this.totalTeams + " " + (this.totalTeams > 1 ? ' Teams' : ' Team')
		},

		relatedEvents() {
			return this.totalEvents + " " + (this.totalEvents > 1 ? ' Events' : ' Event')
		},

		verb() {
			return this.noRelations || (this.totalEvents == 0 && this.totalTeams == 1) ? 'is' : 'are'
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