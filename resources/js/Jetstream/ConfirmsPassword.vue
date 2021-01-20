<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot />
        </span>

        <jet-dialog-modal :show="confirmingPassword" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                {{ content }}

                <div class="mt-4 mb-6">
                    <text-input label="Password" type="password" class="block w-full" placeholder="Password"
                                ref="password"
                                v-model="form.password"
                                @keyup.enter.native="confirmPassword" />

                    <jet-input-error :message="form.error" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <secondary-button @click.native="closeModal">
                    Nevermind
                </secondary-button>

                <submit-button class="ml-2" @click.native="confirmPassword" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ button }}
                </submit-button>
            </template>
        </jet-dialog-modal>
    </span>
</template>

<script>
    import SubmitButton from '@/Components/Form/Button'
    import JetDialogModal from './DialogModal'
    import SecondaryButton from '@/Components/Form/ButtonSecondary'
    import TextInput from '@/Components/Form/Input'
    import JetInputError from './InputError'

    export default {
        props: {
            title: {
                default: 'Confirm Password',
            },
            content: {
                default: 'For your security, please confirm your password to continue.',
            },
            button: {
                default: 'Confirm',
            }
        },

        components: {
            SubmitButton,
            SecondaryButton,
            JetDialogModal,
            TextInput,
            JetInputError,
        },

        data() {
            return {
                confirmingPassword: false,
                form: {
                    password: '',
                    error: '',
                },
            }
        },

        methods: {
            startConfirmingPassword() {
                axios.get(route('password.confirmation')).then(response => {
                    if (response.data.confirmed) {
                        this.$emit('confirmed', this.form.password);
                    } else {
                        this.confirmingPassword = true;
                        setTimeout(() => this.$refs.password.$el.focus(), 250)
                    }
                })
            },

            confirmPassword() {
                this.form.processing = true;

                axios.post(route('password.confirm'), {
                    password: this.form.password,
                }).then(() => {
                    this.form.processing = false;
                    this.$nextTick(function() {
                        this.$emit('confirmed', this.form.password)
                        this.closeModal()
                    });
                }).catch(error => {
                    this.form.processing = false;
                    this.form.error = error.response.data.errors.password[0];
                    this.$refs.password.focus()
                });
            },

            closeModal() {
                this.confirmingPassword = false
                this.form.password = '';
                this.form.error = '';
            },
        }
    }
</script>
