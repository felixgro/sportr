<template>
    <action-section>
        <template #title>
            Delete Account
        </template>

        <template #description>
            Permanently delete your account.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
            </div>
        </template>

        <template #actions>
            <jet-confirms-password title="Permanently delete Account" @confirmed="deleteUser">
                <danger-button type="button" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Delete Account
                </danger-button>
            </jet-confirms-password>
        </template>
    </action-section>
</template>

<script>
    import ActionSection from '@/Components/Sections/ActionSection'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import DangerButton from '@/Components/Form/ButtonDanger'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import JetConfirmsPassword from '@/Jetstream/ConfirmsPassword'

    export default {
        components: {
            ActionSection,
            DangerButton,
            JetDialogModal,
            JetDangerButton,
            JetInput,
            JetInputError,
            JetSecondaryButton,
            JetConfirmsPassword
        },

        data() {
            return {
                confirmingUserDeletion: false,

                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods: {
            confirmUserDeletion() {
                this.confirmingUserDeletion = true;

                setTimeout(() => this.$refs.password.focus(), 250)
            },

            deleteUser(password) {
                this.form.password = password;
                this.form.delete(route('current-user.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },

            closeModal() {
                this.confirmingUserDeletion = false

                this.form.reset()
            },
        },
    }
</script>
