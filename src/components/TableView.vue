<template>
    <table class="w-full border">
        <thead class="border-b">
            <tr>
                <th class="w-12">
                    <div>
                        <input 
                            :checked="allChecked"
                            type="checkbox"
                            @change="({target}) => { toggleSelectAll(target.checked) }"
                        >
                    </div>
                </th>
                <th 
                    v-for="{key, label} in columns"
                    class="py-2 text-sm"
                    :key="key"
                >
                    <div>
                        {{ label }}
                        <span v-if="key == orderBy && 'ASC' == order" 
                            @click="() => { $emit('changeOrder', {orderBy: key, order: 'DESC'}) }"
                            class="material-symbols-outlined align-middle text-gray-500"
                        >
                            keyboard_arrow_up
                        </span>
                        <span v-if="key == orderBy && 'DESC' == order" 
                            @click="() => { $emit('changeOrder', {orderBy: key, order: 'ASC'}) }"
                            class="material-symbols-outlined align-middle text-gray-500"
                        >
                            keyboard_arrow_down
                        </span>
                        <span v-if="key != orderBy" class="material-symbols-outlined align-middle text-gray-300"
                            @click="() => { $emit('changeOrder', {orderBy: key, order: 'ASC'}) }"
                        >
                            swap_vert
                        </span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" 
            :key="item[uniqueField]"
                class="border-b bg-gray-50 hover:bg-blue-50"
            >
                <td class="w-12">
                    <input class="block mx-auto"
                        type="checkbox"
                        :checked="selected.includes(item[uniqueField])"
                        @change="({target}) => { toggleSelection(target.checked, item[uniqueField]) }">
                </td>

                <td v-for="{key} in columns"
                    :key="item[uniqueField] + '-' + key"
                    class="text-sm text-center px-2 py-3"
                >
                    {{ item[key] }}
                </td>
            </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="8">
              <div class="flex">
                <div class="w-1/3 pl-4 py-2 text-sm">
                  Per page 
                  <select @change="(e) => {$emit('changePageSize', e)}" class="border mr-4">
                    <option v-for="option in perPageOptions" :key="option" :value="option" :selected="option == perPage">
                      {{ option }}
                    </option>
                  </select>
                  Showing {{ startIndex + 1 }} - {{ endIndex + 1 }} of {{ total }} records
                </div>
                <div class="w-1/3 p-2 text-sm flex justify-center">
                  <span v-if="selected.length">{{ selected.length }} selected</span>
                </div>
                <div class="w-1/3 p-1 flex justify-end">
                  <AnchorLink 
                    :to="previousLink?.link ?? '/404'"
                    :disabled="previousLink == null"
                    :class="{
                      'text-center rounded pt-1 min-w-8 h-8 px-1 border' : true,
                      'bg-gray-100 hover:border-purple-600 hover:text-purple-600': previousLink != null,  
                      'bg-gray-200': previousLink == null  
                    }"
                  >
                  <span class="material-symbols-outlined">chevron_left</span>

                  </AnchorLink>
                  <AnchorLink
                    v-for="link in links"
                    :key="link.label"
                    :to="link.link"
                    :disabled="link.is_current_page"
                    :class="{
                      'text-center rounded pt-1 min-w-8 h-8 px-1 ml-2 border' : true,
                      'bg-purple-600 text-white font-bold' : link.is_current_page,
                      'bg-gray-100 hover:border-purple-600 hover:text-purple-600' : !link.is_current_page,
                    }"
                  >
                    {{ link.label }}
                  </AnchorLink>
                  <AnchorLink 
                    :to="nextLink?.link ?? '/404'"
                    :disabled="nextLink == null"
                    :class="{
                      'text-center rounded pt-1 min-w-8 h-8 px-1 ml-2 border' : true,
                      'bg-gray-100 hover:border-purple-600 hover:text-purple-600': nextLink != null,
                      'bg-gray-200': nextLink == null
                    }"
                  >
                    <span class="material-symbols-outlined">chevron_right</span>
                  </AnchorLink>
                </div>
              </div>
            </td>
          </tr>
        </tfoot>
    </table>
</template>

<script>
import AnchorLink from '@/components/AnchorLink.vue';

export default {

    components: {
        AnchorLink
    },

    emits: ['changePageSize', 'changeOrder'],

    props: {
        columns: Array,
        items: Array,
        links: Array,
        uniqueField: String,
        perPage: Number,
        total: Number,
        orderBy: String,
        order: String,
        page: Number,
        currentPerPage: Number,
    },

    data() {
        return {
            selected: [],
        }
    },

    computed: {
        allChecked () {
            if (this.items) {
                return this.items.every(item => this.selected.includes(item[this.uniqueField]))
            }
            return false
        },

        previousLink () {
            const all = this.links

            if (all) {
                const index = all.findIndex(({is_current_page}) => is_current_page)

                if (index > 0) {
                    return this.links[index-1]
                }
            }

            return null
        },

        nextLink () {
            const all = this.links

            if (all) {
                const index = all.findIndex(({is_current_page}) => is_current_page)

                if (index < (this.links.length - 1)) {
                    return this.links[index+1]
                }
            }

            return null
        },

        startIndex () {
            return (this.page - 1) * this.perPage
        },

        endIndex () {
            return (this.page * this.perPage) - 1
        },

        perPageOptions () {
            let options = [10, 25, 50, 100, 250, 500, 1000]

            if (! options.includes(this.perPage)) {
                options.push(this.perPage)
                options.sort((a,b) => a - b)
            }

            return options
        }
    },

    methods: {
        toggleSelection(select, value) {
            if (select) {
                this.selected.push(value)
            } else {
                const idx = this.selected.findIndex(elem => elem == value)
                this.selected.splice(idx, 1)
            }
        },

        toggleSelectAll(select) {
            const things = new Set(this.selected)
            
            if (select) {
                this.items.forEach(item => things.add(item[this.uniqueField]))
            } else {
                this.items.forEach(item => things.delete(item[this.uniqueField]))
            }

            this.selected = [...things]
        }
    }
}
</script>