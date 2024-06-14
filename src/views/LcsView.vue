<template>
    <AppHeader />
    <div class="w-full px-5">
      <TableView 
        :columns="columns"
        :items="pageData?.lcs.items"
        :links="pageData?.lcs.links"
        :page="pageData?.lcs.page"
        :perPage="pageData?.lcs.per_page"
        :uniqueField="'lc_num'"
        @changePageSize="changePageSize"
      />
    </div>
</template>

<script>
import AppHeader from '@/components/Header.vue'
import TableView from '@/components/TableView.vue'

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
    TableView,
  },

  data () {
    return {
      pageData: null,
      selected: [],
      columns: [
        {key: "lc_num", label: "LC #"},
        {key: "date_issued", label: "Issued On"},
        {key: "date_expiry", label: "Expires On"},
        {key: "currency_code", label: "Currency"},
        {key: "exchange_rate", label: "Exchange Rate"},
        {key: "foreign_amount", label: "Value (Foreign)"},
        {key: "local_amount", label: "Value (TK)"},
      ]
    }
  },

  methods: {
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