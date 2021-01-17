<template>
    <main-layout>
        <jet-authentication-card>
            <template #logo>
                <application-mark class="block h-5 w-auto" />
            </template>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <text-input label="Email" name="email" type="email" v-model="form.email" />
                </div>

                <div class="mt-4">
                    <text-input label="Password" name="password" type="password" v-model="form.password" />
                </div>

                <div class="mt-4">
                    <checkbox name="remember" v-model="form.remember">
                        Remember me
                    </checkbox>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Forgot your password?
                    </inertia-link>

                    <submit-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Login
                    </submit-button>
                </div>
            </form>
        </jet-authentication-card>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import ApplicationMark from '@/Components/Main/ApplicationMark'
import TextInput from '@/Components/Form/TextInput'
import Checkbox from '@/Components/Form/Checkbox'
import SubmitButton from '@/Components/Form/Button'

import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'

export default {
    components: {
        MainLayout,
        ApplicationMark,
        TextInput,
        Checkbox,
        SubmitButton,
        JetAuthenticationCard,
    },

    props: {
        canResetPassword: Boolean,
        status: String
    },

    data() {
        return {
            test: 'test',
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ... data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
        }
    }
}
</script>
