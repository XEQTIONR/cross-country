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
        <tfoot>
          <tr>
            <td colspan="8">
              <div class="flex w-full justify-end">
                <!-- <span>Page {{ pageData?.lcs?.page }} / {{ pageData?.lcs?.total_pages }}</span> -->
                <AnchorLink :to="previousLink?.link ?? '/404'" :disabled="previousLink == null" class="pb-0.5 px-1 bg-gray-200"><i class="lni lni-chevron-left align-middle"></i></AnchorLink>
                <AnchorLink
                  v-for="link in pageData?.lcs.links"
                  :key="link.label"
                  :to="link.link"
                  :disabled="link.is_current_page"
                  class="pb-0.5 px-1 bg-gray-200 ml-2">{{ link.label }}</AnchorLink>
                  <AnchorLink :to="nextLink?.link ?? '/404'" :disabled="nextLink == null" class="pb-0.5 px-1 ml-2 bg-gray-200"><i class="lni lni-chevron-right align-middle"></i></AnchorLink>
              </div>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
</template>

<script>

import AnchorLink from '@/components/AnchorLink.vue';
import AppHeader from '@/components/Header.vue'

export default {
  
  beforeRouteEnter (to, from, next) {
    console.log('beforeRouteEnter')
    next(vm => vm.pageData = window.data)
  },

  beforeRouteUpdate (to, from, next) {
    console.log('beforeRouteUpdate')
    this.pageData = window.data
    next()
  },

  components: {
    AppHeader,
    AnchorLink,
  },

  data () {
    return {
      pageData: null,
    }
  },

  computed: {
    previousLink () {

      const all = this.pageData?.lcs?.links

      if (all) {
        const index = all.findIndex(({is_current_page}) => is_current_page)

        if (index > 0) {
          return this.pageData.lcs.links[index-1]
        }
      }

      return null
    },
    nextLink () {
      const all = this.pageData?.lcs?.links

      if (all) {
        const index = all.findIndex(({is_current_page}) => is_current_page)

        if (index < (this.pageData.lcs.links.length - 1)) {
          return this.pageData.lcs.links[index+1]
        }
      }

      return null
    },
  }
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