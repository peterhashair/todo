<template>
    <div class="card">
        <div class="card-header">Your Todo List</div>
        <div class="card-body">
            <div>
                <ul class="list-group" v-for="task in ctasks">
                    <li class="list-group-item">
                        <a v-bind:href="'task/'+task.id">{{ task.title }}</a><br>
                        <span>{{ task.updated_at }}</span><br>
                        {{ task.body }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ctasks'],
        mounted() {
            this.getTask();
        },
        methods: {
            getTask() {
                this.$emit('gettask', 'Completed');
            }
        }
    }
</script>
