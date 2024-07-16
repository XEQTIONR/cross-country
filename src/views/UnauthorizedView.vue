<template>
    Unauthorized
</template>

<script>

export default {
  
  beforeRouteEnter (to, from, next) {
    console.log('b4 route enter',  to, from)
    next(vm => vm.pageData = window.data)
  },

  beforeRouteUpdate (to, from, next) {
    console.log('b4 route update',  to, from)
    this.pageData = window.data
    next()
  },
}

</script>