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
                :rows="this.consignments.data"
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
        BaseTable,
        Navigation,
        SearchBar,
    },
    props: {
        consignments : {
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
              bol: 'BOL',
              lcNum: 'LC #',
              landDate: 'Date Landed',
              value: 'Value (Foreign)',
              localValue: 'Value (TK)',
              tax: 'Tax',
              createdAt: 'Created On'
          },

          textRight: [
              'value',
              'localValue',
              'tax',
          ],
      }
    },

}
</script>

<style scoped>

</style>
