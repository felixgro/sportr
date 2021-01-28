<template>
    <div>
        <label :for="name" class="flex items-center">
            <input class="rounded border-gray-300 text-main-600 shadow-sm focus:border-main-300 focus:ring focus:ring-main-200"
                type="checkbox"
                :value="value"
                v-model="proxyChecked"
                :id="name"
            >

            <span class="font-medium text-sm text-gray-600 ml-2">
                <slot />
            </span>
        </label>
        <span v-if="hasError" class="text-sm text-red-600">
            {{ getError }}
        </span>
    </div>
</template>

<script>
import FormField from '@/Mixins/FormField'

export default {
    mixins: [FormField],

    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
    },

    model: {
        prop: "checked",
        event: "change",
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },
            set(val) {
                this.$emit("change", val);
            },
        }
    }
}
</script>

