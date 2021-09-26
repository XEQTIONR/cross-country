<template>
    <div class="flex justify-end">
        <div v-for="link in links"
            class="h-12 mx-2"
        >
            <inertia-link 
                :href="link.url"
                v-html="link.label"
            />
        </div>
    </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3/src"
export default {
    components: {
        InertiaLink,
    },
    props: {
        links : {
            type: Array,
            default : [],
        }
    }
}
</script>

<style scoped>

</style>
