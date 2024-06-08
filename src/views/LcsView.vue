<template>
    <h1>LcsView</h1>
</template>

<script>
export default {
    beforeRouteEnter (to, from, next) {
        next(vm => vm.pageData = window.data)
    },

    data () {
        return {
            pageData: null
        }
    }
}
</script>