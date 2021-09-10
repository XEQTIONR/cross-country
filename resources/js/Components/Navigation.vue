<template>
    <div class="h-screen bg-yellow-300 w-1/4">
        <ul>
            <li
                class="flex flex-row justify-start items-center p-3.5"
                v-for="item in listItems"
            >
                <icon
                    class="mr-2"
                    :icon="item.icon"
                />
                {{item.title}}

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
            type : Array,
            default : []
        }
    },
    data() {
        return {
            listItems : [
                { title: 'Letters of Credit', icon: 'anchor' },
                { title: 'Consignments', icon: 'anchor' },
                { title: 'Orders', icon: 'box' },
                { title: 'Payments', icon: 'cash' },
                { title: 'Products', icon: 'disc' },
                { title: 'Customers', icon: 'store' },
                { title: 'Reports', icon: 'container' },
                { title: 'Users', icon: 'cash' },
            ]
        }
    }
}
</script>

<style scoped>

</style>
