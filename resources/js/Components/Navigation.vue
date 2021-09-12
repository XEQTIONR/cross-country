<template>
    <div class="h-screen  bg-gray-200">
        <ul class="">
            <li
                class="flex flex-row justify-start items-center py-5 px-10"
                v-for="item in listItems"
            >
                <icon
                    class="mr-4 text-2xl"
                    :icon="item.icon_class"
                />
                <span class="text-sm font-normal whitespace-nowrap">{{item.title}}</span>
            </li>
        </ul>
    </div>
</template>

<script>
import Icon from "@/Components/Icon";
export default {
    components: {Icon},
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
