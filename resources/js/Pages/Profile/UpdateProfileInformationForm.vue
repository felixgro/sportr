<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <text-input label="Name" name="name" errorBag="updateProfileInformation" v-model="form.name" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <text-input label="Email" name="email" errorBag="updateProfileInformation" v-model="form.email" />
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
import JetFormSection from '@/Jetstream/FormSection'
import JetActionMessage from '@/Jetstream/ActionMessage'

    export default {
        components: {
            TextInput,
            SubmitButton,
            JetActionMessage,
            JetFormSection
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    name: this.user.name,
                    email: this.user.email
                })
            }
        },

        methods: {
            updateProfileInformation() {
                this.form.post(route('user-profile-information.update'), {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true
                });
            }
        },
    }
</script>
