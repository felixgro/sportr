<template>
    <jet-form-section @submitted="updatePassword">
        <template #title>
            Update Password
        </template>

        <template #description>
            Ensure your account is using a long, random password to stay secure.
        </template>

        <template #form>
            <!-- Current Password -->
            <div class="col-span-6 sm:col-span-4">
                <text-input label="Current Password" name="current_password" type="password" v-model="form.current_password" errorBag="updatePassword" />
            </div>

            <!-- New Password -->
            <div class="col-span-6 sm:col-span-4">
                <text-input label="New Password" name="password" type="password" v-model="form.password" errorBag="updatePassword" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </submit-button>
        </template>
    </jet-form-section>
</template>

<script>
import TextInput from '@/Components/Form/Input'
import SubmitButton from '@/Components/Form/Button'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetFormSection from '@/Jetstream/FormSection'

    export default {
        components: {
            TextInput,
            SubmitButton,
            JetActionMessage,
            JetFormSection
        },

        data() {
            return {
                form: this.$inertia.form({
                    current_password: '',
                    password: ''
                }),
            }
        },

        methods: {
            updatePassword() {
                this.form.put(route('user-password.update'), {
                    errorBag: 'updatePassword',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                    onError: () => {
                        if (this.form.errors.password) {
                            this.form.reset('password', 'password_confirmation')
                            this.$refs.password.focus()
                        }

                        if (this.form.errors.current_password) {
                            this.form.reset('current_password')
                            this.$refs.current_password.focus()
                        }
                    }
                })
            },
        },
    }
</script>
