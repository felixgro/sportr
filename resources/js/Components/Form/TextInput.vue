<template>
	<div>
		<label :for="name" class="font-medium text-sm text-gray-600">{{ label }}</label>

    	<input class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
			:type="type"
			:value="value"
			:id="name"
			@input="$emit('input', $event.target.value)
		">

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
		value: {
			type: String,
			required: true
		},
		label: {
			type: String,
			required: true
		},
		type: {
			type: String,
			default: 'text'
		}
	}
}
</script>