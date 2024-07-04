<template>
    <div 
        :class="[
            'min-h-screen transition transition-all border-r flex flex-col items-stretch pt-1',
            open ? 'min-w-60' : 'min-w-16'
        ]"
    >
        <div class="w-full flex items-center sticky top-0">
            <button 
                class="border hover:border-gray-400 text-gray-600 rounded mx-3"
                @click="toggle"
            >
                <span class="material-symbols-outlined px-1.5 pt-1.5 pb-1 align-text-bottom">
                    menu
                </span>
            </button>
            <span :class="[
                'font-bold transition text-nowrap',
                open ? 'w-full' : 'w-0 opacity-0'
            ]">Cross Country</span>
        </div>
        <hr class="my-2 w-full sticky top-11" />

        <div class="sticky top-12">
        <div
            v-for="{label, link, icon} in links" 
            :class="[
                'w-full flex items-center mb-3',
                open ? 'hover:bg-gray-300' : '',
            ]"
            :key="link"
        >
            <AnchorLink :to="link" class="border border-transparent ml-3">
                <span :class="[
                    'material-symbols-outlined px-1.5 py-1.5 align-text-bottom rounded',
                    !open ? 'hover:bg-gray-300' : '',
                ]">
                    {{ icon }}
                </span>
            </AnchorLink>
            <span class="ml-2" v-if="open"> {{ label }} </span>
        </div>
        </div>
    </div>
</template>

<script>

import AnchorLink from '@/components/AnchorLink.vue'

export default {
    components : { AnchorLink },

    data() {
        return {
            open: false,
            links: [
                { label: "LCs", link: "/lcs", icon: "account_balance", },
                { label: "Consignments", link: "/consignments", icon: "anchor", },
                { label: "Containers", link: "/containers", icon: "package_2", },
                { label: "Stock", link: "/stock", icon: "widgets", },
                { label: "Customers", link: "/customers", icon: "badge", },
                { label: "Orders", link: "/orders", icon: "receipt_long", },
                { label: "Products", link: "/products", icon: "screen_record", },
                { label: "Payments", link: "/payments", icon: "payments", },
            ],
        }
    },

    methods: {
        toggle() {
            this.open = ! this.open
        }
    }
}

</script>