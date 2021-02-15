<template>
	<main-layout>
		<portal to="breadcrumbs">
            <nav-link toRoute="home">Home</nav-link> <bc-arrow />
			<nav-link toRoute="favsports.index">Choose Sports</nav-link>
        </portal>

		<!-- Sport Choice Container -->
		<section class="flex justify-center">
			<div class="max-w-3xl w-full">
				<div class="flex justify-between items-center mb-5">
					<h1 class="prose-xl">Choose your favorite sports.</h1>
					<div class="flex items-center">
						<div class="text-sm mr-3" v-if="currentlySelected > 0"><span class="font-bold">{{ currentlySelected }}</span> Selected</div>
						<form @submit.prevent="submit">
							<submit-button>Save</submit-button>
						</form>
					</div>
				</div>
				<div class="grid grid-cols-3 gap-2">

					<button v-for="sport in sports" :key="sport.id" @click.prevent="selectSport" :data-id="sport.id"
						class="bg-gray-200 text-center py-4 px-7 flex justify-center items-center shadow-none hover:shadow-sm focus:bg-main-700
						group transition duration-60 ease-out focus:outline-none font-bold">

						<img :src="sport.icon" :alt="sport.title + 'Icon'" class="h-6 filter-invert-none transition duration-60 ease-out pointer-events-none"
						:class="isActive(sport.id) && 'filter-invert-full opacity-90'">
						<span class="flex-1 transition duration-60 ease-out pointer-events-none">
							{{ sport.title }}
						</span>
					</button>
				</div>
			</div>
		</section>

	</main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import NavLink from '@/Components/NavLink'
import BcArrow from '@/Components/Icons/BreadcrumbArrow'
import SubmitButton from '@/Components/Form/Button'

export default {
	components: {
		MainLayout,
		NavLink,
		BcArrow,
		SubmitButton
	},

	props: ['sports'],

	data() {
		return {
			activeSports: []
		}
	},

	computed: {
		currentlySelected() {
			return this.activeSports.length
		}
	},

	methods: {
		submit() {
			if(this.currentlySelected == 0)
				return;

			this.$inertia.put(route('favsports.update'), this.activeSports)
		},

		isActive(id) {
			return this.activeSports.includes(id)
		},

		selectSport(e) {
			const img = e.target.children[0]
			const txt = e.target.children[1]

			if(!this.isActive(e.target.dataset.id)) {
				this.activeSports.push(e.target.dataset.id)

				e.target.classList.add('bg-main-700')

				img.classList.add('filter-invert-full', 'opacity-90')
				txt.classList.add('text-gray-100')
			} else {
				this.activeSports.splice(this.activeSports.indexOf(e.target.dataset.id), 1)

				e.target.classList.remove('bg-main-700')
				img.classList.remove('filter-invert-full', 'opacity-90')
				txt.classList.remove('text-gray-100')

				e.target.blur()
			}
		}
	}
}
</script>

<style>

</style>