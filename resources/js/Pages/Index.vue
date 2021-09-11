<template>
    <div class="w-full h-full flex">
        <navigation :items="menu"/>
        <div class="w-screen h-screen bg-blue-300">
            This is the test component
        </div>
    </div>
</template>

<script>
import Navigation from "@/Components/Navigation";
import Icon from "@/Components/Icon";
export default {
    components: {
        Navigation,
        Icon,
    },
    props: {
        menu: {
            type: Array,
            default: [],
        }
    }
}
</script>

<style scoped>

</style>
