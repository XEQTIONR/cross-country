<template>
    <div class="flex justify-end">
        <div v-for="link in links"
            :class="['hover:bg-yellow-200 mx-2 py-2 px-3 rounded',
                link.active ? 'bg-yellow-200' : 'bg-gray-200',
            ]"
        >
            <inertia-link
                v-if="!link.active"
                :href="link.url"
                v-html="link.label"
            />
            <span
                v-else
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
