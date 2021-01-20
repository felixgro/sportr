export default {
	props: {
		name: {
            type: String,
            required: false
		},
		errorBag: {
			type: String,
			default: 'default'
		}
	},
	computed: {
		id() {
			return this._props.name && `id_${this._uid}`
		},
		hasError() {
			if (this.$page.props.errorBags.hasOwnProperty(this.errorBag)) {
				return (this.name in this.$page.props.errorBags[this.errorBag])
			}

			return false
		},
		getError() {
			return this.$page.props.errorBags[this.errorBag][this.name][0]
		},
	}
}