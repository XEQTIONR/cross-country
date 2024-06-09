<template>
    <AppHeader />
    <h1>LcsView</h1>
    <div class="w-full px-5">
      <table v-if="pageData?.lcs" class="w-full border">
        <thead class="border-b">
          <tr>
            <th class="w-12"><div><input type="checkbox"></div></th>
            <th class="py-2 text-sm">
              <div>LC#</div>
            </th>
            <th class="py-2 text-sm">
              <div>Issued On</div>
            </th>
            <th class="py-2 text-sm">
              <div>Expires On</div>
            </th>
            <th class="py-2 text-sm">
              <div>Currency</div>
            </th>
            <th class="py-2 text-sm">
              <div>Exchange Rate</div>
            </th>
            <th class="py-2 text-sm">
              <div>Foreign Amount</div>
            </th>
            <th class="py-2 text-sm">
              <div>Local Amount</div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="lc in pageData.lcs.items" 
            class="border-b"
            :key="lc.lc_num"
          >
            <td class="w-12"><input class="block mx-auto" type="checkbox"></td>
            <td class="text-center px-2 py-3">{{ lc.lc_num }}</td>
            <td class="text-center px-2 py-3">{{ lc.date_issued }}</td>
            <td class="text-center px-2 py-3">{{ lc.date_expiry }}</td>
            <td class="text-center px-2 py-3">{{ lc.currency_code }}</td>
            <td class="text-right px-2 py-3">{{ lc.exchange_rate }}</td>
            <td class="text-right px-2 py-3">{{ lc.foreign_amount }}</td>
            <td class="text-right px-2 py-3">{{ lc.local_amount }}</td>
          </tr>
        </tbody>
      </table>
    </div>
</template>

<script>
import AppHeader from '@/components/Header.vue'

export default {
  
  beforeRouteEnter (to, from, next) {
    next(vm => vm.pageData = window.data)
  },

  components: {
    AppHeader,
  },

  data () {
    return {
      pageData: null,
    }
  },
}


</script>

<style scoped>
  thead tr th div {
    border-right: 2px solid transparent;
  }

  thead tr th:first-child div {
    border-left: 2px solid transparent;
  }

  thead:hover tr th:not(:last-child) div {
    border-right-color: red;
  }
</style>