<template>
    <div class="py-10 w-full md:w-3/4 mx-auto">
        <div class="sm:grid sm:grid-cols-3 sm:gap-6">
            <jet-section-title>
                <template #title><slot name="title"></slot></template>
                <template #description><slot name="description"></slot></template>
            </jet-section-title>

            <div class="mt-5 sm:mt-0 sm:col-span-2">
                <div class="shadow overflow-hidden rounded-lg">
                    <div class="px-4 py-5 bg-gray-200 bg-opacity-20 sm:p-6">
                        <div class="">
                            <slot name="content"></slot>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-200 text-right sm:px-6" v-if="hasActions">
                        <slot name="actions"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import JetSectionTitle from '../../Jetstream/SectionTitle'

    export default {
        components: {
            JetSectionTitle,
        },

        computed: {
            hasActions() {
                return !! this.$slots.actions
            }
        }
    }
</script>
