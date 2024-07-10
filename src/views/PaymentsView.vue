<template>
    <SidePanel side="R" :open="sidePanelOpen" @close="toggleSidePanel">
      <FiltersForm :initVal="getQFilters" @submit="filter" :columns="columns" />
    </SidePanel>
    
    <div :class="[
        'w-full flex flex-nowrap',
        sidePanelOpen ? 'h-screen overflow-y-hidden' : ''
      ]">
      <NavBar />
      <div class="w-full px-2">
        <div class="w-full flex justify-between items-center sticky top-0 bg-white">
          <h1 class="text-xl ml-0.5">Tyres</h1>
          <button 
            class="hover:bg-gray-100 bg-gray-200 hover:text-purple-400 text-gray-500 border hover:border-purple-400 border-gray-200 pt-1 px-1 my-2 rounded text-sm shadow-lg"
            @click="toggleSidePanel"
          >
            <span class="material-symbols-rounded">
              filter_alt
            </span>
          </button>
        </div>
        <TableView
          v-if="pageData?.payments"
          :columns="columns"
          :items="pageData?.payments.items"
          :links="pageData?.payments.links"
          :page="pageData?.payments.page"
          :perPage="pageData?.payments.per_page"
          :total="pageData?.payments.total"
          uniqueField="transaction_id"
          :orderBy="pageData?.payments.order_by"
          :order="pageData?.payments.order"
          @changePageSize="changePageSize"
          @changeOrder="reorder"
        />
      </div>
    </div>
</template>

<script>
import TableView from '@/components/TableView.vue'
import SidePanel from '@/components/SidePanel.vue'
import FiltersForm from '@/components/FiltersForm.vue'
import NavBar from '@/components/NavBar.vue'

import { ops } from '@/composables/operations'
import { changePageSize, reorder, filter } from '@/composables/qvars'

export default {
  
  beforeRouteEnter (to, from, next) {
    next(vm => vm.pageData = window.data)
  },

  beforeRouteUpdate (to, from, next) {
    this.pageData = window.data
    next()
  },

  components: {
    FiltersForm,
    TableView,
    SidePanel,
    NavBar,
  },

  data () {
    return {
      pageData: null,
      selected: [],
      columns: [
        {key: "transaction_id", label: "Trans ID", formatter: null},
        {key: "order_num", label: "OrderNum", formatter: null},
        {key: "payment_amount", label: "Payment Amount", formatter: "currency"},
        {key: "refund_amount", label: "Refund Amount", formatter: "currency"},
        {key: "type", label: "Type", formatter: null},
        {key: "created_at", label: "Created At", formatter: "dateTime"},
      ],
      sidePanelOpen: false,
    }
  },

  computed: {
    getQFilters() {
      const { href } = window.location
      let params = (new URL(href)).searchParams

      let filters = []

      for (const [key, value] of params) {
        
        if ( key.indexOf(".") > 0 ) {
          const [field, oper] = key.split(".")
          const {formatter} = this.columns.find(col => col.key == field)
          let val = null

          switch (formatter) {
            case "currency":
              val = parseFloat(value)
              break
            default:
              val = value.substring(1, value.length - 1)
          }

          filters.push({
            field,
            op: ops.find(item => item.qStr == oper).value,
            value: val,
            formatter
          })
        }
      }

      return filters
    },
  },

  methods: {
    toggleSidePanel() {
      this.sidePanelOpen = !this.sidePanelOpen
    },

    closeSidePanel() {
      this.sidePanelOpen = false
    },

    filter,

    changePageSize,

    reorder,
  }
}

</script>

<style scoped>
  thead tr th div {
    border-right: 1px solid transparent;
  }

  thead tr th:first-child div {
    border-left: 1px solid transparent;
  }

  thead:hover tr th:not(:last-child) div {
    border-right-color: #DDD;
  }
</style>