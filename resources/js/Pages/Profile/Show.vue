<template>
    <main-layout>
        <portal to="breadcrumbs">
            <nav-link toRoute="home">Home</nav-link> <bc-arrow />
            <nav-link toRoute="profile.show">Profile</nav-link>
        </portal>
        <div>
            <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                <update-profile-information-form :user="$page.props.user" />

                <section-border />
            </div>

            <div v-if="$page.props.jetstream.canUpdatePassword">
                <update-password-form class="mt-10 sm:mt-0" />

                <section-border />
            </div>

            <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                <two-factor-authentication-form class="mt-10 sm:mt-0" />

                <section-border />
            </div>

            <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

            <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                <section-border />

                <delete-user-form class="mt-10 sm:mt-0" />
            </template>
        </div>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import DeleteUserForm from './DeleteUserForm'
import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
import UpdatePasswordForm from './UpdatePasswordForm'
import UpdateProfileInformationForm from './UpdateProfileInformationForm'
import SectionBorder from '@/Components/Sections/SectionBorder'
import NavLink from '@/Components/NavLink'
import BcArrow from '@/Components/Icons/BreadcrumbArrow'

export default {
    props: ['sessions'],

    components: {
        MainLayout,
        SectionBorder,
        DeleteUserForm,
        LogoutOtherBrowserSessionsForm,
        TwoFactorAuthenticationForm,
        UpdatePasswordForm,
        UpdateProfileInformationForm,
        NavLink,
        BcArrow
    },

    created() {
        console.dir(this.$page.props.user);
    }
}
</script>
