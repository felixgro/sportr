<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 rounded-md font-bold text-xs uppercase tracking-widest shadow-sm
        bg-main-600 text-main-50 border border-transparent
        hover:bg-main-700 active:bg-main-900 focus:outline-none focus:border-none focus:shadow-outline-main focus:bg-main-700
        transition ease-in-out duration-150">

        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>