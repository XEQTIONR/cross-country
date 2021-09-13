<template>
    <div class="h-full flex">
        <navigation :items="menu"/>
        <div class="h-screen max-w-full flex flex-wrap p-10 overflow-scroll">
            <div class="w-1/2">
                <h1 class="text-2xl font-extrabold text-gray-600">{{ title }}</h1>
                <h2 class="text-sm text-gray-500 mb-8">All tyres in the database</h2>
            </div>
            <div class="w-1/2">
                <search-bar />
            </div>
            <base-table
                :class="'bg-white'"
                :labels="labels"
                :rows="this.tyres.data"
            />
        </div>
    </div>
</template>

<script>

import BaseTable from '@/Components/BaseTable';
import SearchBar from "@/Components/SearchBar";
import Navigation from "@/Components/Navigation";

export default {

    components: {
        SearchBar,
        BaseTable,
        Navigation,
    },
    props: {
        tyres : {
            type: Object,
            default: {}
        },

        menu:{
            type: Object,
            default: {}
        },

        title: {
            type: String,
            default: 'Dashboard',
        },
    },

    data() {
        return {
            labels: {
                id: 'ID',
                brand: 'Brand',
                size: 'Size',
                pattern: 'Pattern',
                lisi: 'Li/Si',
                createdAt: 'Created On'
            },
        }
    }
}
</script>

<style scoped>

</style>
