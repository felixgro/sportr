<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="px-8 pt-7">
            <div class="text-lg font-bold text-gray-700">
                <slot name="title">
                </slot>
            </div>

            <div class="mt-3 text-md text-gray-700">
                <slot name="content">
                </slot>
            </div>
        </div>

        <div class="px-8 py-4 bg-gray-100 text-right">
            <slot name="footer">
            </slot>
        </div>
    </modal>
</template>

<script>
    import Modal from './Modal'

    export default {
        components: {
            Modal,
        },

        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: 'xl'
            },
            closeable: {
                default: true
            },
        },

        methods: {
            close() {
                this.$emit('close')
            },
        }
    }
</script>
