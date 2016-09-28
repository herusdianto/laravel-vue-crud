<template>
    <div class="btn-group-vertical" role="group" aria-label="Actions" v-cloak>
        <button
            type="button"
            class="btn btn-primary btn-xs"
            title="Show"
            @click="showData(rowData)">
            <i class="glyphicon glyphicon-eye-open"></i>
        </button>

        <button
            type="button"
            class="btn btn-warning btn-xs"
            title="Edit"
            @click="editData(rowData)">
            <i class="glyphicon glyphicon-pencil"></i>
        </button>

        <button
            type="button"
            class="btn btn-danger btn-xs"
            title="Update"
            @click="deleteData(rowData)">
            <i class="glyphicon glyphicon-trash"></i>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            rowData: {
                type: Object,
                required: true
            }
        },
        methods: {
            showData(rowData) {
                this.$dispatch('showData', rowData);
            },
            editData(rowData) {
                this.$dispatch('editData', rowData);
            },
            deleteData(rowData) {
                this.$dispatch('deleteData', rowData);
            },
        }
    }
</script>
