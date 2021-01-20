<template>
    <div class="mt-10 flex flex-col sm:justify-center items-center relative w-full sm:max-w-md sm:px-5 mx-auto">
        <div class="w-full">
            <h1>{{ title }}</h1>
        </div>

        <div class="w-full sm:max-w-md mt-4">
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
