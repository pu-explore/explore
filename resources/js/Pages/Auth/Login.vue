<template>
    <div class="login-page">
        <nav class="main-header navbar navbar-expand ml-0 h-auto border-bottom-0 w-100 position-absolute top-0">
            <ul class="navbar-nav ml-auto">
                <breeze-nav-dropdown align="right">
                    <template #trigger>
                        <i class="fas fa-globe fa-fw"></i><span class="pl-1">{{ $t('language') }}</span>
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
            <breeze-card class="card-outline" header="text-center">
                <template #header>
                    <a :href="this.route('home')" class="h1" v-html="admin.name"></a>
                </template>
                <template #body>
                    <p class="login-box-msg">{{ $t('login_msg') }}</p>

                    <form @submit.prevent="submit">
                        <breeze-input v-model="form.username"
                                      :placeholder="$t('username')"
                                      name="username"
                                      :append="{icon:'fas fa-user'}"
                                      required autofocus autocomplete="username"
                        >
                        </breeze-input>
                        <breeze-input v-model="form.password"
                                      :placeholder="$t('password')"
                                      type="password"
                                      name="password"
                                      :append="{icon:'fas fa-lock'}"
                                      required autocomplete="current-password"
                        >
                        </breeze-input>

                        <div class="row">
                            <div class="col-8">
                                <breeze-checkbox v-model:checked="form.remember" name="remember" :label="$t('remember_me')"></breeze-checkbox>
                            </div>
                            <div class="col-4">
                                <breeze-button type="submit">{{ $t('sign_in') }}</breeze-button>
                            </div>
                        </div>
                    </form>
                </template>
            </breeze-card>
        </div>
    </div>
</template>

<script>
import BreezeNavDropdown from "@/Components/NavDropdown";
import BreezeCard from "@/Components/Card"
import BreezeInput from "@/Components/Input"
import BreezeCheckbox from "@/Components/Checkbox"
import BreezeButton from "@/Components/Button"

export default {
    name: 'Login',
    components: {
        BreezeNavDropdown,
        BreezeCard,
        BreezeInput,
        BreezeCheckbox,
        BreezeButton,
    },
    props: {
        admin: String,
    },
    data() {
        return {
            form: this.$inertia.form({
                username: '',
                password: '',
                remember: true
            })
        }
    },
    beforeCreate() {
        // document.querySelector('body').setAttribute('class', '')
    },
    created() {

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
