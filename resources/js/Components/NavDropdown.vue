<template>
    <li class="nav-item dropdown" :class="showClass">
        <a href="#" data-toggle="dropdown" aria-haspopup="true" :aria-expanded="open" class="nav-link" :class="toggleClass" @click="open = !open">
            <slot name="trigger" />
        </a>

        <!-- Full Screen Dropdown Overlay -->
        <div class="position-fixed inset-0 z-40" :class="open ? 'show' : 'd-none'" @click="open = false"></div>

        <ul class="dropdown-menu z-50" :class="[showClass, widthClass, alignClass]" @click="open = false">
            <slot name="content" />
        </ul>
    </li>
</template>

<script>
import { ref } from "vue";

export default {
    props: {
        toggle: {
            default: false
        },
        align: {
            default: ''
        },
        width: {
            default: ''
        },
    },

    setup() {
        let open = ref(false)

        return {
            open,
        }
    },

    computed: {
        toggleClass() {
            return this.toggle ? 'dropdown-toggle' : '';
        },
        showClass() {
            return this.open ? 'show' : '';
        },
        widthClass() {
            return this.width === 'lg' ? 'dropdown-menu-lg' : '';
        },
        alignClass() {
            return this.align === 'right' ? 'dropdown-menu-right' : '';
        }
    },
}
</script>
