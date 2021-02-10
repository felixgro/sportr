<template>
    <div class="pt-32 flex flex-col sm:justify-center items-center relative w-full sm:max-w-md sm:px-5 mx-auto">
        <div class="w-full text-center prose-2xl font-extrabold text-gray-600">
            <p>{{ title }}</p>
        </div>

        <div class="w-full sm:max-w-md mt-6">
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String
    }
}
</script>
