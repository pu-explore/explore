<template>
    <div class="form-group row mx-0">
        <label class="col-form-label px-0" :class="labelClass" :for="unique_id" v-if="label">{{ label }}</label>
        <div class="px-0" :class="groupClass">
            <div class="input-group" :class="invalid">
                <div class="input-group-prepend" v-if="prepend">
                    <span class="input-group-text" v-if="prepend.icon">
                        <i class="fa-fw" :class="prepend.icon"></i>
                    </span>
                    <span class="input-group-text" v-else-if="prepend.text" v-text="prepend.text"></span>
                </div>
                <input :type="type"
                       :id="unique_id"
                       :name="name"
                       class="form-control"
                       :class="invalid"
                       :value="modelValue"
                       :placeholder="placeholder ?? label"
                       @input="$emit('update:modelValue', $event.target.value)"
                       ref="input"
                       v-bind="$attrs"
                >
                <div class="input-group-append" v-if="append">
                    <span class="input-group-text" v-if="append.icon">
                        <i class="fa-fw" :class="append.icon"></i>
                    </span>
                    <span class="input-group-text" v-else-if="append.text" v-text="append.text"></span>
                </div>
            </div>
            <div class="invalid-feedback" v-if="errors[name]">{{ errors[name] }}</div>
        </div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        modelValue: null,
        prepend: Object,
        append: Object,
        label: {
            type: String,
            default: null
        },
        type: {
            type: String,
            default: 'text'
        },
        id: {
            type: String,
            default: null
        },
        name: {
            type: String,
            default: null
        },
        placeholder: {
            type: String,
            default: null
        },
        horizontal: {
            type: Boolean,
            default: false
        },
    },
    emits: ['update:modelValue'],
    computed: {
        unique_id() {
            return this.id ?? this.name;
        },
        errors() {
            return this.$page.props.errors;
        },
        invalid() {
            return this.errors[this.name] ? 'is-invalid' : '';
        },
        labelClass() {
            return this.horizontal ? 'col-sm-2' : 'col-sm-12';
        },
        groupClass() {
            return this.horizontal ? 'col-sm-10' : 'col-sm-12';
        },
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>

