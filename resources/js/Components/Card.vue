<template>
    <div class="card" :class="cardColor">
        <div class="card-header" :class="header" v-if="$slots.header">
            <slot name="header" />
        </div>
        <div class="card-body" :class="body" v-if="$slots.body">
            <slot name="body" />
        </div>
    </div>
</template>

<script>
export default {
    name: "Card",

    props: {
        color: {
            type: Boolean,
            default: true
        },
        header: {
            type: String,
            default: ''
        },
        body: {
            type: String,
            default: ''
        },
    },

    computed: {
        cardColor() {
            return this.color ? 'card-'+this.$page.props.admin.color : '';
        },
    },
}
</script>

<style scoped>

</style>
