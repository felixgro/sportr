<template>
	<div>
		<label :for="id" class="font-medium text-sm text-gray-600">{{ label }}</label>

    	<input class="bg-gray-50 block w-full mt-1 border-2 border-gray-200 focus:ring-2 focus:ring-main-200 focus:border-main-200 rounded-md shadow-sm"
			:type="type"
			:value="value"
			:id="id"
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