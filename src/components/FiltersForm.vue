<template>
    <form class="w-full flex flex-col p-2">
        <h2 class="text-lg font-bold mb-4">Filters</h2>

        <div class="w-full flex flex-col pb-1 mb-4">
            <div
                v-for="(filter, index) in filters"
                :key="index" 
                class="w-full flex justify-between mb-4">
                <select
                    v-model="filter.field"
                    class="border w-1/4 mr-1"
                    @change="() => updateFormatter(filter, index)"
                >
                    <option v-for="{key, label} in columns" :value="key" :key="key">{{ label }}</option>
                </select>
                <select v-model="filter.op" class="border w-3/8 mr-1">
                    <option v-for="{value, label} in ops" :value="value" :key="value">{{ label }}</option>
                </select>
                <input 
                    v-model="filter.value"
                    class="border w-2/8 mr-1"
                    :type="dataTypeMap[filter.formatter] ?? 'text'"
                    :step="filter.formatter == 'currency' ? 0.01 : null"
                >
                <button 
                    @click.prevent="() => removeFilter(index)"
                    class="w-1/8 rounded px-1.5 pt-0.5 bg-red-500">
                    <span class="material-symbols-outlined text-white text-sm">
                        close
                    </span>
                </button>
            </div>
            <button @click.prevent="addFilter" class="bg-transparent shadow hover:shadow-lg hover:bg-blue-50 border-2 border-blue-500  text-blue-500  mt-2 py-0.5 rounded">
                <span class="material-symbols-outlined text-lg align-middle">
                    add
                </span>
                Add a filter
            </button>

            <button @click.prevent="submitFilters" class="bg-blue-500 shadow hover:shadow-lg border-2 border-transparent mt-2 py-1.5 rounded text-white">
                Submit
            </button>
        </div>
    </form>
</template>
<script>

import {ops as opsAlias} from '@/composables/operations.js'

export default {
    
    emits: ['submit'],
    props: {
        columns: Array,
        initVal: Array
    },

    data() {
        return {
            ops: opsAlias,
            filters: this.initVal,

            dataTypeMap : {
                "currency" : "number",
                "date" : "date",
                "dateTime" : "datetime-local"
            }
        }
    },

    methods: {
        addFilter() {
            const n = this.filters.length % this.columns.length
            this.filters.push({
                field: this.columns[n].key,
                op: "=",
                value: null,
                formatter: this.columns[n]?.formatter
            })
        },

        removeFilter(idx) {
            this.filters.splice(idx, 1)
        },

        updateFormatter(filter, index) {
            this.filters[index].formatter = this.columns.find(col => col.key == filter.field).formatter
        },

        submitFilters() {

            const qStr = this.filters.map(({field, op, value, formatter}) => {
                let opS = this.ops.find(o => o.value == op)

                if (formatter == null || formatter == 'date') {
                    return `${field}.${opS.qStr}='${value}'`
                }

                if (formatter == 'dateTime') {
                    value = (new Date(value)).toISOString().replace('T', ' ').replace(/\.\d+Z/, '')
                    return `${field}.${opS.qStr}='${value}'`
                }
                return `${field}.${opS.qStr}=${value}`
            }).join('&')

            this.$emit('submit', qStr)
        }
    }
}

</script>