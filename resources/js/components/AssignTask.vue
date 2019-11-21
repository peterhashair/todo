<!-- Vue component -->
<template>
    <div>
        <input type="hidden" name="assign" :value="assign">
        <multiselect
            v-model="value"
            :options="options"
            :multiple="true"
            label="name"
            track-by="name"
            @input="onChange"
            @remove="onRemove"
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
                assign: [],
                value: null,
                options: []
            }
        },
        mounted() {
            this.options = JSON.parse(this.users);
        },
        methods: {
            onChange: function (value) {
                for (let i = 0; i < value.length; i++) {
                    this.assign[i] = value[i].id;
                }

            },
            onRemove: function (option) {
                this.assign.splice(option.id, 1);
            }
        }
    }
</script>

<!-- New step!
     Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
