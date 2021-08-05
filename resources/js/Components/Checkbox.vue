<template>
    <div :class="icheckColor">
        <input type="checkbox" :id="getId" :value="value" name="remember" v-model="proxyChecked">
        <label :for="getId">{{ label }}</label>
    </div>
</template>

<script>
export default {
    emits: ['update:checked'],

    props: {
        id: {
            type: String,
            default: null,
        },
        name: String,
        label: {
            type: String,
            default: null,
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
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
        getId() {
            return this.id ?? this.name;
        },
        icheckColor() {
            return 'icheck-'+this.$page.props.admin.color;
        },
    },
}
</script>
