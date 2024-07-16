<template>
    <AppHeader />
    <form>        
        <label>Name</label>
        <input v-model="registerForm.name" />
        <label>Email</label>
        <input type="email" v-model="registerForm.email"  />
        <label>Password</label>
        <input type="password" v-model="registerForm.password" />
        <label>Confirm Password</label>
        <input type="password" v-model="registerForm.confirmPassword" />

        <SubmitButton url="/register" :form-data="registerForm">Register</SubmitButton>
    </form>

</template>
<script>
import AppHeader from '../components/Header.vue'
import SubmitButton from '@/components/SubmitButton.vue';
export default {
    components: {
        AppHeader,
        SubmitButton,
    },

    data() {
        return {
            pageData: null,
            errs: null,
            registerForm: {
                name: "",
                email: "",
                password: "",
                confirmPassword: ""
            }
        }
    },
    beforeRouteEnter (to, from, next) {
        next(vm => vm.pageData = window.data)
  },
}
</script>