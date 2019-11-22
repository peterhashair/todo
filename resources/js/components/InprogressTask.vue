<template>
    <div class="card">
        <div class="card-header">In progress Task</div>
        <div class="card-body">
            <ul class="list-group" v-for="task in tasks">
                <li class="list-group-item">{{ task.title }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: []
            }
        },
        mounted() {
            axios.get('/home/tasks', {
                params: {
                    status: "In Progress"
                }
            }).then((response) => {
                this.tasks = response.data;
            });
        }
    }
</script>
