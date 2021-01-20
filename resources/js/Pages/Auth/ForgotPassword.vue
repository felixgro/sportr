<template>
    <main-layout>
        <jet-authentication-card>
            <template #logo>
                <the-logo class="block h-5 w-auto" />
            </template>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <div class="mb-4 text-sm text-gray-600">
                Forgot your password? No problem. Just let us know your email address and we will email
                you a password reset link that will allow you to choose a new one.
            </div>

            <form @submit.prevent="submit">
                <div>
                    <text-input label="Email" name="email" type="email" v-model="form.email" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </submit-button>
                </div>
            </form>
        </jet-authentication-card>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import TheLogo from '@/Components/Main/TheLogo'
import TextInput from '@/Components/Form/Input'
import SubmitButton from '@/Components/Form/Button'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'

export default {
    components: {
        MainLayout,
        TheLogo,
        TextInput,
        SubmitButton,
        JetAuthenticationCard,
    },

    props: {
        status: String
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
