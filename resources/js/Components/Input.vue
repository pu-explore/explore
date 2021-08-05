<template>
    <div class="form-group row mx-0">
        <label class="col-form-label px-0" :class="labelClass" :for="getId" v-if="label">{{ label }}</label>
        <div class="px-0" :class="inputMainClass">
            <div class="input-group" :class="invalidClass">
                <div class="input-group-prepend" v-if="prepend">
                    <template v-if="prepend.html" v-html="prepend.html"></template>
                    <div class="input-group-text" v-else>
                        <span :class="prepend.icon +' fa-fw'" v-if="prepend.icon"></span>
                        <span v-else-if="prepend.text" v-text="prepend.text"></span>
                    </div>
                </div>

                <input :id="getId"
                       :type="type"
                       :name="name"
                       :value="modelValue"
                       :placeholder="placeholder ?? $t('please_enter') + label"
                       class="form-control"
                       :class="invalidClass"
                       v-bind="$attrs"
                       @input="$emit('update:modelValue', $event.target.value)"
                       ref="input">

                <div class="input-group-append" v-if="append">
                    <template v-if="append.html" v-html="append.html"></template>
                    <div class="input-group-text" v-else>
                        <span :class="append.icon +' fa-fw'" v-if="append.icon"></span>
                        <span v-else-if="append.text" v-text="append.text"></span>
                    </div>
                </div>
            </div>
            <div class="invalid-feedback" v-if="hasErrors">{{ errors[name] }}</div>
        </div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,

    props: {
        id: {
            type: String,
            default: null,
        },
        type: {
            type: String,
            default: 'text',
        },
        label: String,
        name: String,
        modelValue: null,
        placeholder: String,
        prepend: Object,
        append: Object,
        horizontal: false,
    },

    emits: ['update:modelValue'],

    computed: {
        getId() {
            return this.id ?? this.name;
        },
        errors() {
            return this.$page.props.errors
        },
        hasErrors() {
            return Object.keys(this.errors).includes(this.name);
        },
        labelClass() {
            return this.horizontal ? 'col-sm-2' : 'col-sm-12';
        },
        inputMainClass() {
            return this.horizontal ? 'col-sm-10' : 'col-sm-12';
        },
        invalidClass() {
            return this.hasErrors ? 'is-invalid' : '';
        },
    },

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>

