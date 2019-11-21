<!-- Vue component -->
<template>
    <div>
        <multiselect
            v-model="value"
            :options="options"
            :multiple="true"
            label="name"
            value="id"
            name="assign"
        >
        </multiselect>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    // register globally
    Vue.component('multiselect', Multiselect)

    export default {
        props: ['users'],
        // OR register locally
        components: {Multiselect},
        data() {
            return {
                value: null,
                options: []
            }
        },
        mounted() {
            this.options = JSON.parse(this.users);
            console.log(this.options);
        },
    }
</script>

<!-- New step!
     Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
