<template>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link" data-toggle="dropdown" @click="open = !open">
            <slot name="trigger" />
        </a>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="position-fixed inset-0 z-40" @click="open = false"></div>

        <div v-show="open" class="dropdown-menu z-50" :class="alignClass" style="display: none;" @click="open = false">
            <slot name="content" />
        </div>
    </li>
</template>

<script>
import { ref } from "vue";

export default {
    props: {
        align: {
            default: 'left'
        },
        width: {
            default: '48'
        },
    },

    setup() {
        let open = ref(false)

        return {
            open,
        }
    },

    computed: {
        alignClass() {
            return this.align === 'right' ? 'dropdown-menu-right' : '';
        }
    }
}
</script>
