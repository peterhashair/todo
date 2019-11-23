<template>
    <div class="card">
        <div class="card-header">In Progress</div>
        <div class="card-body">
            <div v-for="(task,index) in ptasks">
                <div class="card">
                    <div class="card-header"><a v-bind:href="'task/'+task.id">{{ task.title }}</a>
                        <button style="float:right" class="btn btn-danger" v-on:click="deleteTask(task.id,index)">
                            Delete
                        </button>
                    </div>
                    <div class="card-body">
                        <span>{{ task.updated_at }}</span>
                        <br>
                        {{ task.body }}
                    </div>
                    <div class="card-footer">
                        <button v-on:click="changeStatus(task.id,index,'New')" class="btn btn-danger">Back To New
                        </button>
                        <button v-on:click="changeStatus(task.id,index,'Completed')" class="btn btn-success">Set Completed
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ptasks'],
        mounted() {
            this.getTask();
        },
        methods: {
            getTask() {
                this.$emit('gettask', 'In Progress');
            },
            changeStatus(id, index, status) {
                this.$emit('changestatus', id, index, status, 2);
            },
            deleteTask(id, index) {
                this.$emit('deletetask', id, index, 2);
            }

        }
    }
</script>
