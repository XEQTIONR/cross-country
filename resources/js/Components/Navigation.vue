<template>
    <div class="h-screen  bg-gray-200">
        <ul :class="['transition',  navIsOpen ? 'transition-after' : 'transition-before']">
            <li @click="toggle"
                class="flex my-3 ml-2 items-center justify-start cursor-pointer"
            >
                <tooltip
                    :text="navIsOpen ? 'Collapse' : 'Expand'"
                    :class="['ml-2 my-6 p-3 hover:bg-white']"
                >

                        <icon
                            class="rounded-md text-2xl"
                            icon="menu"
                        />

                </tooltip>
                <transition name="fade">
                    <span
                        v-show="navIsOpen"
                        class="flex items-center text-xl font-bold whitespace-nowrap"
                    >
                        <icon
                            class="rounded-md text-5xl mx-1"
                            icon="crosscountry"
                        />
                    </span>
                </transition>
            </li>
        </ul>
        <ul :class="['transition',  navIsOpen ? 'transition-after' : 'transition-before']">
            <li
                :class="['flex flex-row justify-start items-center p-3 mx-3 my-5 rounded-md',
                 currentRoute === item.route ? 'bg-black text-white' : 'hover:bg-white'] "
                v-for="item in listItems"
            >
                <tooltip
                    :text="item.title"
                    :show="!navIsOpen"
                >
                    <inertia-link
                        :href="route(item.route)"
                        class="flex items-center flex-nowrap overflow-x-hidden"
                    >
                        <icon
                            :class="['mx-1.5 my-1 text-xl', {'text-white' : currentRoute === item.route}]"
                            :icon="item.icon_class"
                        />
                        <transition name="fade">
                            <span
                                v-show="navIsOpen"
                                class="text-lg whitespace-nowrap ml-2"
                            >
                                {{item.title}}
                            </span>
                        </transition>
                    </inertia-link>
                </tooltip>
            </li>
        </ul>
        <ul :class="['transition absolute bottom-3 mb-6',  navIsOpen ? 'transition-after' : 'transition-before']">
            <li class="flex my-3 mx-3 items-center justify-start cursor-pointer hover:bg-white rounded-md">
                <tooltip
                    text="Log Out"
                    :show="!navIsOpen"
                    class="px-4 py-3"
                >
                    <icon
                        class="text-2xl font-bold rounded-md "
                        icon="exit"
                    />
                </tooltip>
                <transition name="fade">
                    <span
                        v-show="navIsOpen"
                        class="text-md font-bold whitespace-nowrap "
                    >
                        Log Out
                    </span>
                </transition>
            </li>
        </ul>
    </div>
</template>

<script>
import Icon from "@/Components/Icon";
import Tooltip from "@/Components/ToolTip";
import {InertiaLink} from "@inertiajs/inertia-vue3/src";
export default {
    components: {
        Icon,
        InertiaLink,
        Tooltip,
    },
    props: {
        items : {
            type : Object,
            default : {}
        }
    },

    data() {
        return {
            navIsOpen : false,
        }
    },
    computed: {
        listItems(){
            return Object.values(this.items).sort((first, second) => first.order - second.order);
        },

        currentRoute() {
            return this.route().current();
        }
    },

    methods: {
        setCookie(cName, cValue, expDays) {
            let date = new Date();
            date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
        },

        getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        },

        toggle() {
            this.navIsOpen = !this.navIsOpen;
            this.setCookie('navOpen', this.navIsOpen ? 'true' : 'false');
        },

    },

    mounted() {
        this.navIsOpen = this.getCookie('navOpen') === 'true'
    }
}
</script>

<style scoped>

    .transition {
        transition: width .5s;
    }

    .transition-before {
        width : 5rem;
    }

    .transition-after{
        width : 250px;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
