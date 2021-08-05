<template>
    <button :type="type" class="btn btn-block" :class="btnColor">
        <slot />
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        },
        computed: {
            btnColor() {
                return 'btn-'+this.$page.props.admin.color;
            },
        },
    }
</script>
