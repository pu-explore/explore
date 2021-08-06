<template>
    <div :class="icheckColor">
        <input type="checkbox" :id="unique_id" :name="name" :value="value" v-model="proxyChecked">
        <label :for="unique_id" v-if="label">{{ label }}</label>
    </div>
</template>

<script>
export default {
    emits: ['update:checked'],

    props: {
        label: {
            type: String,
            default: null
        },
        id: {
            type: String,
            default: null
        },
        name: {
            type: String,
            default: null
        },
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
    },

    computed: {
        unique_id() {
            return this.id ?? this.name;
        },
        icheckColor() {
            return 'icheck-'+this.$page.props.admin.color;
        },
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
    },
}
</script>
