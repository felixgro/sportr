<template>
    <form-section @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>

            <!-- Role -->
            <div class="col-span-6 sm:col-span-4">
                <p class="font-medium text-sm text-gray-600">Role</p>
                <div class="px-3 py-1 mt-1 bg-main-100 text-main-800 inline-block rounded-full text-sm font-bold">
                    {{ roleTitle }}
                </div>
            </div>

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
    </form-section>
</template>

<script>
import TextInput from '@/Components/Form/Input'
import SubmitButton from '@/Components/Form/Button'
import FormSection from '@/Components/Sections/FormSection'
import JetActionMessage from '@/Jetstream/ActionMessage'

    export default {
        components: {
            TextInput,
            SubmitButton,
            FormSection,
            JetActionMessage,
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

        computed: {
            roleTitle() {
                let title = this.$page.props.user.role.title;

                return title.charAt(0).toUpperCase() + title.slice(1)
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
