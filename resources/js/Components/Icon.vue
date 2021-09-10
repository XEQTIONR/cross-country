<template>
    <span v-html="require(`!!html-loader!../../svg/${icon}.svg`).default"></span>
</template>

<script>
export default {
 props: {
     icon: {
         type: String,
         default: null,
     }
 }
}
</script>

<style scoped>

</style>
