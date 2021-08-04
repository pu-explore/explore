<template>
    <div class="login-page">
        <nav class="main-header navbar navbar-expand ml-0 h-auto border-bottom-0 w-100 position-absolute" style="top: 0;">
            <ul class="navbar-nav ml-auto">
                <nav-dropdown align="right">
                    <template #trigger>
                        <i class="fa fa-language fa-fw fa-2x" aria-hidden="true"></i>
                    </template>
                    <template #content>
                        <a href="#" class="dropdown-item" v-for="(object, lang) in $page.props.lang" @click="changeLang(lang)">
                            <i class="fa fa-tags fa-fw mr-2"></i>{{ object.language }}
                        </a>
                    </template>
                </nav-dropdown>
            </ul>
        </nav>
        <div class="login-box">
            <div :class="'card card-outline card-'+$page.props.admin.color">
                <div class="card-header text-center">
                    <a :href="this.route('home')" class="h1" v-html="$page.props.admin.name"></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form  @submit.prevent="submit">
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" :placeholder="$t('username')" v-model="form.username" required autofocus autocomplete="username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope fa-fw"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" :placeholder="$t('password')" v-model="form.password" required autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock fa-fw"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div :class="'icheck-'+$page.props.admin.color">
                                    <input type="checkbox" id="remember" name="remember" v-model="form.remember">
                                    <label for="remember">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" :class="'btn btn-block btn-'+$page.props.admin.color">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--
    <breeze-validation-errors class="mb-4"/>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <breeze-label for="username" value="用户名"/>
            <breeze-input id="username" type="text" class="mt-1 block w-full" v-model="form.username" required autofocus
                          autocomplete="username"/>
        </div>

        <div class="mt-4">
            <breeze-label for="password" value="Password"/>
            <breeze-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                          autocomplete="current-password"/>
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <breeze-checkbox name="remember" v-model:checked="form.remember"/>
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <inertia-link v-if="canResetPassword" :href="route('password.request')"
                          class="underline text-sm text-gray-600 hover:text-gray-900">
                Forgot your password?
            </inertia-link>

            <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Log in
            </breeze-button>
        </div>
    </form>
    -->
</template>

<script>
import NavDropdown from "@/Components/NavDropdown";
// import BreezeButton from '@/Components/Button'
// import BreezeGuestLayout from "@/Layouts/Guest"
// import BreezeInput from '@/Components/Input'
// import BreezeCheckbox from '@/Components/Checkbox'
// import BreezeLabel from '@/Components/Label'
// import BreezeValidationErrors from '@/Components/ValidationErrors'

export default {
    // layout: BreezeGuestLayout,

    components: {
        NavDropdown,
        // BreezeButton,
        // BreezeInput,
        // BreezeCheckbox,
        // BreezeLabel,
        // BreezeValidationErrors
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
