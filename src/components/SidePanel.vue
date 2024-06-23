<template>

<div id="outerPanel" class="w-screen h-screen absolute bg-black bg-opacity-50 hidden"
    @click="close"
>
<div id="innerPanel" class="h-screen w-96 bg-white transition ease-in-out absolute top-0 right-0 translate-x-96 border-l-2"
    @click="(e) => { e.stopPropagation() }"
>
    <slot />
</div>
</div>

</template>

<script>

export default {
    props: {
        open: Boolean
    },

    emits: [ 'close' ],

    data() {
        return {
            defaultClasses: 'h-screen w-96 bg-slate-400 transition ease-in-out absolute top-0 right-0',
            openClass: 'translate-x-0',
            closedClass: 'translate-x-96',
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