<template>
    <div class="flex justify-end items-center text-xl">
        <icon icon="search" class="relative left-8 text-gray-500"/>
        <input
            class="float-right pl-9 rounded"
            v-model="query"
            type="text"
            :placeholder="placeholder"
        />
    </div>
</template>

<script>
import Icon from "@/Components/Icon";
export default {
    components: {Icon},
    props: {
        initQuery : {
            type: String,
            default: ''
        },
        placeholder : {
            type: String,
            default : 'Search'
        }
    },

    data() {
        return {
            query : '',
        }
    },

    mounted() {
        if (this.query !== this.initQuery) {
            this.query = this.initQuery;
        }
    }
}
</script>

<style scoped>
    input::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        --tw-text-opacity: 1;   color: rgba(0, 85, 99, var(--tw-text-opacity));
    }
</style>
