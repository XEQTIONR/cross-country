<template>
    <div class="h-full flex">
        <navigation :items="menu"/>
        <div class="h-screen max-w-full flex flex-wrap p-10 overflow-scroll">
            <div class="w-1/2">
                <h1 class="text-2xl font-extrabold text-gray-600">{{ title }}</h1>
                <h2 class="text-sm text-gray-500 mb-8">All our customers</h2>
            </div>
            <div class="w-1/2">
                <search-bar />
            </div>
            <base-table
                :class="'bg-white'"
                :labels="labels"
                :rows="customers.data"
                :textRight="textRight"
                :totals="{
                    totalOrders: customers.meta.totals.grandTotal,
                    totalPayments: customers.meta.totals.paymentsTotal,
                    balance: customers.meta.totals.balance
                }"
            />
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
        customers : {
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
                name: 'LC #',
                address: 'Address',
                phone: 'Phone #',
                totalOrders: 'Total Orders',
                totalPayments: 'Total Payments',
                balance: 'Balance'
            },

            textRight: [
                'totalOrders', 'totalPayments', 'balance',
            ],
        }
    },

}
</script>

<style scoped>

</style>
