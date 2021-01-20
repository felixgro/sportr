<template>
    <authentication-card>
        <sportr-logo class="h-6 w-auto mb-6" />

        <div class="mb-4 text-sm font-bold text-gray-600">
            Thanks for signing up!
        </div>

        <div class="mb-4 text-sm text-gray-600">
            Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <div class="font-medium text-sm text-green-600" v-if="verificationLinkSent" >
            A new verification link has been sent to the email address you provided during registration.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-6 flex items-center justify-between">
                <submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Resend Verification Email
                </submit-button>

                <inertia-link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Logout</inertia-link>
            </div>
        </form>
    </authentication-card>
</template>

<script>
import AuthenticationCard from '@/Components/AuthenticationCard'
import SportrLogo from '@/Components/Main/TheLogo'
import SubmitButton from '@/Components/Form/Button'

export default {
    components: {
        AuthenticationCard,
        SportrLogo,
        SubmitButton,
    },

    props: {
        status: String
    },

    data() {
        return {
            form: this.$inertia.form()
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('verification.send'))
        },
    },

    computed: {
        verificationLinkSent() {
            return this.status === 'verification-link-sent';
        }
    }
}
</script>
