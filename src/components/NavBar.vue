<template>
    <div 
        :class="[
            'min-h-screen transition transition-all border-r flex flex-col items-stretch pt-1  sticky top-0',
            open ? 'min-w-60' : 'min-w-16'
        ]"
    >
        <div class="w-full flex items-center sticky top-1">
            <button 
                class="border hover:border-red-400 hover:text-red-400  rounded mx-3"
                @click="toggle"
            >
                <span class="material-symbols-rounded px-1.5 pt-1.5 pb-1 align-text-bottom">
                    menu
                </span>
            </button>
            <span :class="[
                'transition text-nowrap font-bold',
                open ? 'w-full' : 'w-0 opacity-0'
            ]">Cross Country</span>
        </div>
        <hr class="my-2 w-full sticky top-12" />

        <div class="sticky top-14">
        <AnchorLink
            v-for="{label, link, icon} in links" 
            :class="[
                'w-full flex items-center mb-3 py-1',
                open && !isActive(link) ? 'hover:bg-red-300 hover:text-white' : '',
            ]"
            :key="link"
            :to="link"
        >
            <div  class="border border-transparent ml-3 flex items-center">
                <span :class="[
                    'material-symbols-rounded px-1.5 py-1.5 align-text-bottom rounded ',
                    isActive(link) 
                        ? 'bg-red-400 text-white shadow-lg'
                        : !open ? ' hover:text-red-400' : '',
                ]">
                    {{ icon }}
                </span>
                <span :class="['ml-2', isActive(link) ? 'text-red-400' : '']" v-if="open"> {{ label }} </span>
            </div>
        </AnchorLink>
        </div>
    </div>
</template>

<script>

import AnchorLink from '@/components/AnchorLink.vue'

export default {
    components : { AnchorLink },

    data() {

        let d = document.cookie.split("; ").find((x) => x == 'NAV-OPEN=true')

        return {
            open: d != undefined,
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
            // https://stackoverflow.com/questions/26349052/why-would-setting-document-cookie-not-work-in-chrome
            this.open = ! this.open
            const cookies = document.cookie.split("; ")
            const navOpen = cookies.find((x) => x.startsWith('NAV-OPEN=true'))

            if (this.open) {
                if (navOpen == undefined) {
                   document.cookie = 'NAV-OPEN=true'
                }
            } else {
                if (navOpen != undefined) {
                    document.cookie = 'NAV-OPEN='
                }
            }
        },

        isActive(link) {
            return link == window.location.pathname
        }
    }
}

</script>