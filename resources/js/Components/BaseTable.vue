<template>
    <table>
        <thead>
        <tr>
            <th
                v-for="header in headers"
                v-text="header"
            />
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in rows">
            <td v-for="header in headers" v-text="item[header]"></td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {

    props: {
        headers : {
            type: Array,
            default: [],
        },
        rows: {
            type: Array,
            default: [],
        }
    },
}
</script>

<style scoped>

</style>
