<template>
        <form method="POST" @submit.prevent="submit">

            <!-- Email Address -->
            <div>
                <label for="email" :value="'Email'" />

                <input
                    v-model="email"
                    id="email"
                    class="block mt-1 w-full" type="email" name="email"
                    required autofocus
                />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" :value="'Password'" />

                <input
                    v-model="password"
                    id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input
                        v-model="remember"
                        id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ 'Remember me' }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
<!--                    @if (Route::has('password.request'))-->
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ 'Forgot your password?' }}
                </a>
<!--                    @endif-->

                <button class="ml-3" type="submit">
                    {{ 'Log in' }}
                </button>
            </div>
        </form>
</template>

<script>
import {reactive} from 'vue'
import { Inertia } from '@inertiajs/inertia'
export default {

    data() {
        return {
            // form: reactive({
                email: '',
                password: '',
                remember: 'off',
            // }),
        };
    },
    methods: {
        submit() {
            window.axios.post(this.route('login.request'), {
                email : this.email,
                password : this.password,
                remember : this.remember,
            })
            .then((res) => {
                console.log('then');
                console.log(res);
            })
            .catch((err) => {
                console.log('catch');
                console.log(err);
                console.log(err.data);
                console.log(err.response);
                console.log(err.error);
                console.log(err.message());
            });
            // this.form
            //     .post(this.route('login.request'), {
            //         onFinish: () => {
            //             this.form.reset('password');
            //             console.log('onFinish triggered');
            //         }
            //     });

        },
    }
}
</script>

<style scoped>

</style>
