<template>

<div id="outerPanel" :class="outerPanelClasses"
    @click="close"
>
<div id="innerPanel" :class="innerPanelClasses"
    @click="(e) => { e.stopPropagation() }"
>
    <slot />
</div>
</div>

</template>

<script>

export default {
    props: {
        open: Boolean,
        side: String,  // L R
    },

    emits: [ 'close' ],

    computed: {
        defaultClasses() {
            if (this.side == 'R') 
                return 'h-screen w-96 bg-slate-400 transition ease-in-out absolute top-0 left-0'
            return 'h-screen w-96 bg-slate-400 transition ease-in-out absolute top-0 right-0'
        },
        openClass() { 
            return 'translate-x-0'
        },
        closedClass() {
            if (this.side == 'R') 
                return 'translate-x-96' 
            return '-translate-x-96' 
        },
        outerPanelClasses() {
            return "w-screen h-screen absolute bg-black bg-opacity-50 hidden"
        },
        innerPanelClasses() {
            if (this.side == 'R') 
                return "h-screen w-96 bg-white transition ease-in-out absolute top-0 right-0 translate-x-96 border-r-2"
            return "h-screen w-96 bg-white transition ease-in-out absolute top-0 left-0 -translate-x-96 border-l-2"
        }
    },

    methods: {
        close() {
            this.$emit('close')
        },
    },

    watch: {
        open(n) {
            if (n) {
                document.querySelector("#outerPanel").classList.remove('hidden')
                window.setTimeout(() => { 
                    document.querySelector("#innerPanel").classList.remove(this.closedClass) 
                    document.querySelector("#innerPanel").classList.add(this.openClass)
                }, 150)
            } else {
                document.querySelector("#innerPanel").classList.remove(this.openClass) 
                document.querySelector("#innerPanel").classList.add(this.closedClass)
                window.setTimeout(() => { 
                    document.querySelector("#outerPanel").classList.add('hidden')
                }, 150)
            }
            
        },

    }
}

</script>