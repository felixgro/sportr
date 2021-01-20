<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm
	bg-transparent border-2 border-gray-400 text-gray-500 hover:text-gray-600 hover:border-gray-500
	focus:outline-none focus:text-gray-500 focus:border-gray-500 focus:shadow-outline-main
	active:text-gray-800 active:bg-gray-50
	transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    }
</script>
