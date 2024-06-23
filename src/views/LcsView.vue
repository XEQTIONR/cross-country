<template>
    <SidePanel :open="sidePanelOpen" @close="toggleSidePanel">
      <FiltersForm @submit="filter" :columns="columns" />
    </SidePanel>
    <AppHeader />
    <div class="w-full px-5 flex justify-end">
      <button 
        class="hover:bg-gray-100 bg-gray-200 hover:text-purple-400 text-gray-500 border hover:border-purple-400 border-gray-200 pt-1 px-1 mb-1 rounded text-sm"
        @click="toggleSidePanel"
      >
        <span class="material-symbols-outlined">
          filter_alt
        </span>
      </button>
    </div>
    <div class="w-full px-5">
      <TableView
        v-if="pageData?.lcs"
        :columns="columns"
        :items="pageData?.lcs.items"
        :links="pageData?.lcs.links"
        :page="pageData?.lcs.page"
        :perPage="pageData?.lcs.per_page"
        :total="pageData?.lcs.total"
        uniqueField="lc_num"
        :orderBy="pageData?.lcs.order_by"
        :order="pageData?.lcs.order"
        @changePageSize="changePageSize"
        @changeOrder="reorder"
      />
    </div>
</template>

<script>
import AppHeader from '@/components/Header.vue'
import TableView from '@/components/TableView.vue'
import SidePanel from '@/components/SidePanel.vue'
import FiltersForm from '@/components/FiltersForm.vue'

export default {
  
  beforeRouteEnter (to, from, next) {
    next(vm => vm.pageData = window.data)
  },

  beforeRouteUpdate (to, from, next) {
    this.pageData = window.data
    next()
  },

  components: {
    AppHeader,
    FiltersForm,
    TableView,
    SidePanel,
  },

  data () {
    return {
      pageData: null,
      selected: [],
      columns: [
        {key: "lc_num", label: "LC #", formatter: null},
        {key: "date_issued", label: "Issued On", formatter: "date"},
        {key: "date_expiry", label: "Expires On", formatter: "date"},
        {key: "currency_code", label: "Currency", formatter: null},
        {key: "exchange_rate", label: "Exchange Rate", formatter: "currency"},
        {key: "foreign_amount", label: "Value (Foreign)", formatter: "currency"},
        {key: "local_amount", label: "Value (TK)", formatter: "currency"},
        {key: "created_at", label: "Created At", formatter: "dateTime"},
      ],
      sidePanelOpen: false,
    }
  },

  methods: {
    toggleSidePanel() {
      this.sidePanelOpen = !this.sidePanelOpen
    },

    closeSidePanel() {
      this.sidePanelOpen = false
    },

    filter(qStr) {
      const { search, pathname } = window.location
      let url = ""
      this.closeSidePanel()

      if (search == "") {
        url = pathname + "?perPage=25&page=1"
      } else {
        url = pathname
      }

      if (qStr !== "") {
        url += `&${qStr}`
      }

      this.$router.push(url)
    },

    changePageSize({target}) {
      let { search, pathname } = window.location

      if (search == "") {
        this.$router.push(pathname + "?perPage=" + target.value)
      } else {
        let regex = /perPage=\d+/
        let pageRegex = /page=\d+/

        let path = (pathname + search)
          .replace(regex, "perPage=" + target.value)

        if (path.includes('page=')) {
          path = path.replace(pageRegex, 'page=1')
        } else {
          path = path + '&page=1'
        }

        this.$router.push(path)
      }
    },

    reorder({orderBy, order}) {
      let { search, pathname } = window.location

      if (search == "") {
        this.$router.push(`${pathname}?orderBy=${orderBy}&order=${order}`)  
      } else {
        let orderByRegex = /orderBy=\w+/
        let orderRegex = /order=\w+/

        let path = (pathname + search)
          .replace(orderByRegex, "orderBy=" + orderBy)
        if (path.includes('order=')) {
          path = path.replace(orderRegex, 'order=' + order)
        } else {
          path = path + '&order=' + order
        }

        this.$router.push(path)
      }
    }
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