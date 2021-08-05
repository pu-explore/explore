<template>
    <div class="login-page">
        <nav class="main-header navbar navbar-expand ml-0 h-auto border-bottom-0 w-100 position-absolute top-0">
            <ul class="navbar-nav ml-auto">
                <breeze-nav-dropdown align="right">
                    <template #trigger>
                        {{ $t('language') }}
                    </template>
                    <template #content>
                        <a href="#" class="dropdown-item" v-for="(object, lang) in $page.props.languages" @click="changeLang(lang)">
                            {{ object.language }}
                        </a>
                    </template>
                </breeze-nav-dropdown>
            </ul>
        </nav>
        <div class="login-box">
            <div class="card card-outline" :class="cardColor">
                <div class="card-header text-center">
                    <a :href="this.route('home')" class="h1" v-html="$page.props.admin.name"></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">{{ $t('login_msg') }}</p>
                    <form @submit.prevent="submit">
                        <breeze-input v-model="form.username"
                                   name="username"
                                   :placeholder="$t('username')"
                                   :append="{icon: 'fas fa-user'}"
                                   required autofocus autocomplete="username">
                        </breeze-input>
                        <breeze-input v-model="form.password"
                                   type="password"
                                   name="password"
                                   :placeholder="$t('password')"
                                   :append="{icon: 'fas fa-lock'}"
                                   required autocomplete="current-password">
                        </breeze-input>
                        <div class="row">
                            <div class="col-8">
                                <breeze-checkbox name="remember" :label="$t('remember_me')" v-model:checked="form.remember" />
                            </div>
                            <div class="col-4">
                                <breeze-button>{{ $t('sign_in') }}</breeze-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BreezeNavDropdown from "@/Components/NavDropdown";
import BreezeInput from "@/Components/Input";
import BreezeCheckbox from '@/Components/Checkbox'
import BreezeButton from '@/Components/Button'

export default {
    name: 'Login',
    components: {
        BreezeNavDropdown,
        BreezeInput,
        BreezeCheckbox,
        BreezeButton,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
        admin: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                username: '',
                password: '',
                remember: false
            })
        }
    },

    beforeCreate() {
        document.querySelector('body').setAttribute('class', 'text-sm accent-'+this.$page.props.admin.color)
    },

    created() {

    },
    computed: {
        cardColor() {
            return 'card-'+this.$page.props.admin.color;
        },
    },
    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        },
        changeLang(lang) {
            this.$i18n.locale = lang;
            localStorage.setItem('lang', lang);
        }
    }
}
</script>
