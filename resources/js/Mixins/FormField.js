export default {
	props: {
		name: {
            type: String,
            required: true
        }
	},
	computed: {
		hasError() {
			return (this.name in this.$page.props.errors)
		},
		getError() {
			return this.$page.props.errors[this.name]
		}
	}
}