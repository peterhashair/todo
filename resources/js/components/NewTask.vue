<template>
    <div class="card">
        <div class="card-header">Your Todo List</div>
        <div class="card-body">
            <div>
                <ul class="list-group" v-for="task in tasks">
                    <li class="list-group-item">
                        {{ task.title }}<br>
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
        data() {
            return {
                tasks: []
            }
        },
        mounted() {
            axios.get('/home/tasks', {
                params: {
                    status: "New"
                }
            }).then((response) => {
                this.tasks = response.data;
            });
        }
    }
</script>
