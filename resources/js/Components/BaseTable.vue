<template>
    <div class="w-full min-h-full overflow-scroll no-scrollbar">
        <table>
            <thead>
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
                        ? item[label].toFixed(2)
                        : item[label]"
                />
            </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td
                        v-for="(label, index) in Object.keys(labels)"
                        :class="['px-4 py-5',
                            {'text-right': textRight.find(e => e === label) !== undefined}]"
                    >
                        <span
                            v-if="totals.find(e => e === label) !== undefined"
                            class="text-right"
                        >
                            {{ sum(label) }}
                        </span>
                    </td>
                </tr>
            </tfoot>
    </table>
    </div>
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
            type: Array,
            default: [],
        },
    },
    methods: {
        sum(key) {
            let sum = 0
            for(let i = 0; i < this.rows.length; i++) {
                sum += parseFloat(this.rows[i][key]);
            }

            return sum.toFixed(2);
        }
    }
}
</script>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>
