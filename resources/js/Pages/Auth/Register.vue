<template>
    <main-layout>
        <authentication-card title="Create new Account">
            <form @submit.prevent="submit">

                <div>
                    <text-input label="Name" name="name" v-model="form.name" />
                </div>

                <div class="mt-4">
                    <text-input label="Email" name="email" type="email" v-model="form.email" />
                </div>

                <div class="mt-4">
                    <text-input label="Password" name="password" type="password" v-model="form.password" />
                </div>

                <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                    <checkbox name="terms" v-model="form.terms">
                        I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                    </checkbox>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Already registered?
                    </inertia-link>

                    <submit-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </submit-button>
                </div>
            </form>
        </authentication-card>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import TextInput from '@/Components/Form/Input'
import Checkbox from '@/Components/Form/Checkbox'
import SubmitButton from '@/Components/Form/Button'
import AuthenticationCard from '@/Components/AuthenticationCard'

export default {
    components: {
        MainLayout,
        TextInput,
        Checkbox,
        AuthenticationCard,
        SubmitButton,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
