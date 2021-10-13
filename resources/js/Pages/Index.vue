<template>
    <div class="h-full flex w-auto">
        <navigation :items="menu"/>
        <div class="h-screen w-full flex flex-col py-10 overflow-hidden">
            <div class="height-fit-content w-full px-7 flex">
                <div class="w-1/2 height-fit-content">
                    <h1 class="text-2xl font-extrabold text-gray-600">{{ title }}</h1>
                    <h2 class="text-sm text-gray-500 mb-8">All our customers</h2>
                </div>
                <div class="w-1/2 height-fit-content flex flex-row justify-end">
                    <a class="bg-black uppercase rounded pl-2 pr-4 py-0 flex justify-center items-center text-white"
                        href="https://www.google.com"
                    >
                        <icon
                            class="text-2xl mr-1"
                            icon="plus"
                        />
                        Create New
                    </a>
                    <search-bar @search="search" />
                </div>
            </div>
            <div class="object-fill px-7 max-h-4/5 w-auto max-w-full">
                <div class="overflow-scroll w-full h-full">
                    <base-table
                        class="bg-white "
                        :labels="labels"
                        :rows="rows"
                        :textRight="textRight"
                        :totals="totals"
                    />
                </div>
            </div>
            <pagination
                class="mt-7 pr-5"
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
import Icon from "@/Components/Icon";

export default {
    components: {
        Icon,
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

        searchKey: {
            type: String,
            default: null,
        }
    },

    computed: {
        rows() {
            return this.data.data;
        },

        totals() {
            return this.data.meta.totals;
        }
    },

    methods: {
        search(query) {
            console.log('search in index', query);
            axios.post(route('search'), {
                query: query,
                entity: this.searchKey,
            }).then((res) => {
                console.log('res', res)
            }).catch(e => {
                console.log(e.data);
            })
        }
    }
}
</script>

<style scoped>
    .height-fit-content{
        height: fit-content;
    }
</style>
