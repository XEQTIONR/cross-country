<template>
    <div class="h-screen  bg-gray-200">
        <ul>
            <li @click="toggle"
                class="flex p-3 m-3 justify-start items-center"
            >
                <icon
                    class="mx-2 my-6 text-2xl font-bold"
                    icon="menu"
                />
                <span v-show="hover" :class="['text-xl font-bold whitespace-nowrap ml-2', 'animate']">Cross Country</span>
            </li>
        </ul>
        <ul :class="['transition',  hover ? 'transition-hover' : 'transition-before']"

        >
            <li
                class="flex flex-row justify-start items-center p-3 mx-3 my-5 rounded hover:bg-white"
                v-for="item in listItems"
            >
                <inertia-link :href="route(item.route)"
                    class="flex items-center flex-nowrap overflow-x-hidden"
                >
                    <icon
                        class="mx-2 text-lg"
                        :icon="item.icon_class"
                    />
                    <span v-show="hover" :class="['text-xl whitespace-nowrap ml-2', 'animate']">{{item.title}}</span>
                </inertia-link>
            </li>
        </ul>
    </div>
</template>

<script>
import Icon from "@/Components/Icon";
import {InertiaLink} from "@inertiajs/inertia-vue3/src";
export default {
    components: {
        Icon,
        InertiaLink,
    },
    props: {
        items : {
            type : Object,
            default : {}
        }
    },

    data() {
        return {
            hover : false,
        }
    },
    computed: {
        listItems(){
            return Object.values(this.items).sort((first, second) => first.order - second.order);
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
            this.hover = !this.hover;
            this.setCookie('navOpen', this.hover ? 'true' : 'false');
        },

    },

    mounted() {
        this.hover = this.getCookie('navOpen') === 'true'
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

    .transition-hover {
        width : 300px;
    }

    .animate {
        animation: animate;
        animation-duration: .5s;
        /*width: 100%;*/
        opacity: 1;
    }

    @keyframes animate {
        from {opacity: 0}
        to {opacity: 1}
    }
</style>
