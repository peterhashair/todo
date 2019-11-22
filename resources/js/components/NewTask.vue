<template>
    <div class="card">
        <div class="card-header">Your Todo List</div>
        <div class="card-body">
            <div>
                <ul class="list-group" v-for="task in tasks">
                    <li class="list-group-item">
                        <a v-bind:href="'task/'+task.id">{{ task.title }}</a><br>
                        <span>{{ task.updated_at }}</span><br>
                        {{ task.body }}
                        <br>
                        <button v-on:click="changeStatus(task.id,'In Progress')" class="btn btn-info">Set In Progress
                        </button>
                        <button v-on:click="changeStatus(task.id,'Completed')" class="btn btn-success">Set Completed
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tasks'],
        mounted() {
            this.getTask();
        },
        methods: {
            getTask() {
                this.$emit('gettask', 'New');

            },
            changeStatus(id, status) {
                this.$emit('changestatus', id, status);
            }
        }
    }
</script>
