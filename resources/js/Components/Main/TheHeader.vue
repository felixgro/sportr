<template>
	<header class="border-b border-none fixed top-0 left-0 h-16 transform scale-y-0 heigh w-full bg-gray-100 z-30 origin-top overflow-hidden transition duration-180 ease-out"
	:class="this.value && 'scale-y-100'" :aria-hidden="!this.value">

		<nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

			<!-- Top Section -->
			<div class="flex justify-between h-16">

				<!-- Left Section -->
				<div class="flex items-center">
					<!-- Sportr Logo -->
					<div class="flex-shrink-0 flex items-center">
						<inertia-link :href="route('home')">
							<the-logo class="block h-5 w-auto" />
						</inertia-link>
					</div>
					<!-- Desktop Navigation Links -->
					<div class="hidden space-x-4 sm:ml-10 sm:flex">
						<nav-link v-for="item in navItems" :key="item.route" :toRoute="item.route">
							{{ item.title }}
						</nav-link>
					</div>
				</div>

				<!-- Desktop Right Section -->
				<div class="hidden sm:flex">
					<div class="relative sm:flex sm:items-center">
						<div v-if="!$page.props.user" class="hidden space-x-4 sm:flex -mr-4">
							<nav-link toRoute="login">
								Login
							</nav-link>
							<nav-link toRoute="register">
								Register
							</nav-link>
						</div>
						<dropdown align="right" width="48" v-else>
							<template #trigger>
								<span class="inline-flex rounded-md">
									<button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
										{{ $page.props.user.name }}

										<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
											<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
										</svg>
									</button>
								</span>
							</template>

							<template #content>
								<!-- Account Management -->
								<div class="block px-4 py-2 text-xs text-gray-400">
									Manage Account
								</div>

								<jet-dropdown-link :href="route('profile.show')">
									Profile
								</jet-dropdown-link>

								<div class="border-t border-gray-100"></div>

								<!-- Authentication -->
								<form @submit.prevent="logout">
									<jet-dropdown-link as="button">
										Logout
									</jet-dropdown-link>
								</form>
							</template>
						</dropdown>
					</div>
				</div>
			</div>
		</nav>
	</header>
</template>

<script>
import TheLogo from '@/Components/Main/TheLogo'
import NavLink from '@/Components/NavLink'
import Dropdown from '@/Components/Dropdown'

import { mainNavigationItems } from '@/config/navigation.js'

import JetDropdownLink from '@/Jetstream/DropdownLink'

export default {
	components: {
		NavLink,
		TheLogo,
		Dropdown,
		JetDropdownLink
	},

	props: ['value'],

	data() {
		return {
			navItems: mainNavigationItems
		}
	},

	methods: {
		logout() {
			this.$inertia.post(route('logout'))
		}
	}
}
</script>