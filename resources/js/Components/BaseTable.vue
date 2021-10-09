<template>
    <table class="w-full">
        <thead class="sticky bg-white">
        <tr>
            <th
                class="text-left font-normal text-sm px-4 py-2 whitespace-nowrap"
                v-for="label in Object.values(labels)"
                v-text="label"
            />
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="item in rows"
            class="h-auto"
        >
            <td
                v-for="(label, index) in Object.keys(labels)"
                :class="['text-left px-4 py-5 whitespace-nowrap border-b',
                    index === 0 ?'font-bold text-gray-600': 'text-gray-500',
                    {'text-right': textRight.find(e => e === label) !== undefined}
                ]"
                v-text="textRight.find(e => e === label) !== undefined
                    ? item[label] ? item[label].toFixed(2) : 0
                    : item[label]"
            />
        </tr>
        </tbody>
        <tfoot class="sticky bg-white">
            <tr>
                <td
                    v-for="label in Object.keys(labels)"
                    :class="['px-4 py-5',
                        {'text-right': textRight.find(e => e === label) !== undefined}
                        ]"
                >
                    <span
                        v-if="totals[label] !== undefined"
                        class="text-right"
                        v-text="parseFloat(totals[label]).toFixed(2)"
                    >
                    </span>
                </td>
            </tr>
        </tfoot>
    </table>
</template>

<script>
export default {

    props: {
        labels: {
            type: Object,
            default: {}
        },
        rows: {
            type: Array,
            default: [],
        },
        textRight: {
            type: Array,
            default: [],
        },
        totals: {
            type: Object,
            default: {},
        },
    },
    methods: {
        //Could use later
        // sum(key) {
        //     let sum = 0
        //     for(let i = 0; i < this.rows.length; i++) {
        //         sum += parseFloat(this.rows[i][key]);
        //     }
        //
        //     return sum.toFixed(2);
        // }
    }
}
</script>

<style scoped>

table thead {
    inset-block-start: 0; /* "top" */
}
table tfoot {
    inset-block-end: 0; /* "bottom" */
}
</style>
