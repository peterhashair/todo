<template>
    <div class="card">
        <div class="card-header">Completed Task</div>
        <div class="card-body">

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
            axios.get('/task').then((response) => {
                this.tasks = response.data;
            });
        }
    }
</script>
