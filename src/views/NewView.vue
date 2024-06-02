<template>
    <AppHeader />
    <div>
        <User :username="pageData?.user" />
        <span>NewView.vue</span>
    </div>
</template>

<script>
import User from '../components/User.vue'
import AppHeader from '../components/Header.vue'

export default {

    components: {
        AppHeader,
        User,
    },
    
    data() {
        return {
            pageData: null,
        }
    },
    beforeRouteEnter (to, from, next) {
        next(vm => vm.pageData = window.data)
  },
}
</script>