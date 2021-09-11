<template>
    <base-table :headers="headers" :rows="data" />
</template>

<script>

import BaseTable from '@/Components/BaseTable';

export default {
    components: {BaseTable},
    props: {
        customers : {
            type: Object,
            default: {}
        }
    },

    computed : {

        data() {
            return this.customers.data ?? false;
        },

        headers(){
            if (this.data.length) {
                return Object.keys(this.data[0]);
            }

            return [];
        }
    }

}
</script>

<style scoped>

</style>
