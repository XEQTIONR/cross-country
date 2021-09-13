<template>
    <div class="h-full flex">
        <navigation :items="menu"/>
        <div class="h-screen max-w-full flex flex-wrap p-10 overflow-scroll">
            <div class="w-1/2">
                <h1 class="text-2xl font-extrabold text-gray-600">{{ title }}</h1>
                <h2 class="text-sm text-gray-500 mb-8">All LCs in the database</h2>
            </div>
            <div class="w-1/2">
                <search-bar />
            </div>
                <base-table
                    :class="'bg-white'"
                    :labels="labels"
                    :rows="this.lcs.data"
                    :textRight="textRight"
                    :totals="totals"
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
        SearchBar,
        BaseTable,
        Navigation,
    },
    props: {
        lcs : {
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

        totals: {
            type: Object,
            default: {}
        }
    },

    data() {
        return {
            labels: {
                lc_num:          'LC #',
                dateIssued:      'Issue Date',
                dateExpiry:      'Expiry Date',
                // applicant:       'Applicant',
                // beneficiary:     'Beneficiary',
                // currencyCode:    'Currency Code',
                exchangeRate:    'Exchange Rate',
                foreignAmount:   'Foreign Amount',
                domesticAmount:  'Domestic Amount',
                //foreignExpense:  'Foreign Expense',
                //domesticExpense: 'Domestic Expense',
                totalExpense:    'Total Expenses',
                //portDepart:      'Departing Port',
                //portArrive:      'Arrival Port',
                invoiceNumber:   'Invoice #',
                // notes:           'Notes',
                createdAt:       'Created On',
            },

            textRight: [
                'foreignAmount', 'domesticAmount', 'exchangeRate', 'totalExpense',
            ],
        }
    },

}
</script>

<style scoped>

</style>
