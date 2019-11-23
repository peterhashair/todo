/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('new-task', require('./components/NewTask.vue').default);
Vue.component('inprogress-task', require('./components/InprogressTask.vue').default);
Vue.component('complete-task', require('./components/CompletedTask.vue').default);
Vue.component('assign-select', require('./components/AssignTask.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        tasks: [],
        ptasks: [],
        ctasks: []
    },
    methods: {
        getTask(status) {
            axios.get('/home/tasks', {
                params: {
                    status: status
                }
            }).then((response) => {
                if (status == "New") {
                    this.tasks = response.data;
                } else if (status == "In Progress") {
                    this.ptasks = response.data;
                } else if (status == "Completed") {
                    this.ctasks = response.data;
                } else {

                }
            });
        },
        changeStatus(id, index, status, list) {
            console.log(status);
            axios.put('/home/tasks/' + id, {
                    status: status
            }).then((response) => {
                if (status == 'New')
                    this.tasks.push(this.removeFromList(list,index));
                else if (status == "In Progress")
                    this.ptasks.push(this.removeFromList(list,index));
                else
                    this.ctasks.push(this.removeFromList(list,index));
                ;
            })
        },

        removeFromList(list,index) {
            let data = null;
            if (list == 1) {
                data = this.tasks[index];
                this.tasks.splice(index, 1);
            } else if (list == 2) {
                data = this.ptasks[index];
                this.ptasks.splice(index, 1);
            } else if (list == 3) {
                data = this.ctasks[index];
                this.ctasks.splice(index, 1);
            }
            return data;
        },
        // 1 = new 2 = in progress 3 = completed
        deleteTask(id, index, list) {
            axios.delete('/task/' + id).then((response) => {
                this.removeFromList(list,index);
            });
        }

    }
});
