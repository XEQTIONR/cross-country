<template>
    <div class="h-full flex w-auto">
        <navigation :items="menu"/>
        <div class="h-screen w-full flex flex-col py-10">
            <div class="height-fit-content w-full px-7 flex">
                <div class="w-1/2 height-fit-content">
                    <h1 class="text-2xl font-extrabold text-gray-600">{{ title }}</h1>
                    <h2 class="text-sm text-gray-500 mb-8">All our customers</h2>
                </div>
                <div class="w-1/2 height-fit-content">
                    <search-bar />
                </div>
            </div>
            <div class="overflow-x-scroll object-fill px-7 max-h-9/10 max-w-full">
                <base-table
                    :class="'bg-white'"
                    :labels="labels"
                    :rows="rows"
                    :textRight="textRight"
                    :totals="totals"
                />
            </div>
            <pagination
                class="pr-5"
                :links="data.meta.links"
            />
        </div>
    </div>
</template>

<script>

import BaseTable from '@/Components/BaseTable';
import Navigation from "@/Components/Navigation";
import SearchBar from "@/Components/SearchBar";
import Pagination from "@/Components/Pagination";

export default {
    components: {
        Pagination,
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
    },
}
</script>

<style scoped>
    .height-fit-content{
        height: fit-content;
    }
</style>
