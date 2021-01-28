<template>
	<div>
		<label :for="name" class="font-medium text-sm text-gray-600">
			{{ label }}
		</label>

		<div class="relative bg-gray-200 bg-opacity-50 ring-2 ring-gray-200 w-full mt-2 h-40 rounded-md flex items-center justify-center flex-col cursor-pointer"
			:class="dragging && 'ring-4 ring-main-200 border-main-200'"
			@dragenter="dragging = true"
			@dragleave="dragging = false"
			@drop="dragging = false"
			@mouseover="dragging = true"
			@mouseleave="dragging = false">

			<input type="file" :name="name" :id="name"  ref="file" @change="handleUpload" class="absolute w-full h-full opacity-0 cursor-pointer" />

			<img v-if="hasImage" src="#" ref="preview" class="h-12 mb-4" />

			<svg v-else class="h-12 w-auto mb-4 fill-current text-gray-300" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
				<path d="M480.6,319c-11.3,0-20.4,9.1-20.4,20.4v120.7H51.8V339.4c0-11.3-9.1-20.4-20.4-20.4c-11.3,0-20.4,9.1-20.4,20.4v141.2    c0,11.3,9.1,20.4,20.4,20.4h449.2c11.3,0,20.4-9.1,20.4-20.4V339.4C501,328.1,491.9,319,480.6,319z"/>
				<path d="m146.2,170l89.4-89.3v259.1c0,11.3 9.1,20.4 20.4,20.4 11.3,0 20.4-9.1 20.4-20.4v-259.1l89.4,89.3c12.3,11.4 24.9,4 28.9,0 8-8 8-20.9 0-28.9l-124.3-124.1c-8-8-20.9-8-28.9,0l-124.1,124.1c-8,8-8,20.9 0,28.9 7.9,8 20.9,8 28.8,0z"/>
			</svg>

			<p v-if="hasImage" class="text-gray-500 select-none"><span class="font-bold">{{ data.name }}</span></p>
			<p v-else class="text-gray-500 select-none"><span class="font-bold">Choose an image</span> or drag it here.</p>
		</div>

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
		label: String,
		name: String,
		preview: {
			type: String,
			required: false,
			default: null
		}
	},

	model: {
        prop: "file",
        event: "change",
    },

	data() {
		return {
			dragging: false,
			hasImage: false,
			data: {}
		}
	},

	created() {
		if(this.preview) {
			this.data.name = this.preview
			this.hasImage = true;
			this.$nextTick(() => {
				this.$refs.preview.src = '/' + this.preview
			})
		}
	},

	methods: {
		handleUpload() {
			if(this.$refs.file.files.length !== 1)
				return;

			const file = this.$refs.file.files[0]

			this.data = file

			this.$emit('change', file)

			this.readFile()
		},

		readFile() {
			const reader = new FileReader()

			reader.onload = this.showFile
			reader.readAsDataURL(this.data)
		},

		showFile(e) {
			this.hasImage = true

			this.$nextTick(() => {
				this.$refs.preview.src = e.target.result
			})
		}
	}
}
</script>