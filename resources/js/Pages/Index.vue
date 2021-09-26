<template>
    <div class="h-full flex">
        <navigation class="w-1/6" :items="menu"/>
        <div class="h-screen w-5/6 flex flex-wrap p-10 overflow-clip">
            <div class="w-1/2">
                <h1 class="text-2xl font-extrabold text-gray-600">{{ title }}</h1>
                <h2 class="text-sm text-gray-500 mb-8">All our customers</h2>
            </div>
            <div class="w-1/2">
                <search-bar />
            </div>
            <div class="w-full relative overflow-scroll">

                <base-table
                    :class="'bg-white'"
                    :labels="labels"
                    :rows="rows"
                    :textRight="textRight"
                    :totals="totals"
                />
            </div>
        </div>
    </div>
</template>

<script>

import BaseTable from '@/Components/BaseTable';
import Navigation from "@/Components/Navigation";
import SearchBar from "@/Components/SearchBar";

export default {
    components: {
        BaseTable,
        Navigation,
        SearchBar,
    },
    props: {
        data : {
            type: Object,
            default: null,
        },

        labels: {
            type: Object,
            default: null,
        },

        menu:{
            type: Object,
            default: {}
        },

        textRight: {
            type: Array,
            default: [],
        },

        title: {
            type: String,
            default: 'Dashboard',
        },
    },

    computed: {
        rows() {
            return this.data.data;
        },

        totals() {
            return this.data.meta.totals;
        }
    }
}
</script>

<style scoped>

</style>
