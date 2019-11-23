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
        props: ['users', 'selectvalue'],
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
            if (this.selectvalue != "") {
                this.value = JSON.parse(this.selectvalue);
                this.onChange(this.value);
            }
        },
        methods: {
            onChange: function (value) {
                for (let i = 0; i < value.length; i++) {
                    this.assign[i] = value[i].id;
                }

            },
            onRemove: function (option) {
                for (let i = 0; i < this.assign.length; i++) {
                    if (this.assign[i] == option.id) {
                        console.log(i);
                        this.assign.splice(i, 1);
                        break;
                    }
                }

            }
        }
    }
</script>

<!-- New step!
     Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
