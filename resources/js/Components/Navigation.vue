<template>
    <div class="h-screen  bg-gray-200">
        <ul class="">
            <li
                class="flex flex-row justify-start items-center py-5 px-10"
                v-for="item in listItems"
            >
                <inertia-link :href="route(item.route)">
                    <icon
                        class="mr-4 text-2xl"
                        :icon="item.icon_class"
                    />
                    <span class="text-sm font-normal whitespace-nowrap">{{item.title}}</span>
                </inertia-link>
            </li>
        </ul>
    </div>
</template>

<script>
import Icon from "@/Components/Icon";
import {InertiaLink} from "@inertiajs/inertia-vue3/src";
export default {
    components: {
        Icon,
        InertiaLink,
    },
    props: {
        items : {
            type : Object,
            default : {}
        }
    },
    computed: {
        listItems(){
            return Object.values(this.items).sort((first, second) => first.order - second.order);
        }
    }
}
</script>

<style scoped>

</style>
