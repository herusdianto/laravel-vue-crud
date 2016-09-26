<template>
    <div class="btn-group" role="group" aria-label="Actions">
        <button type="button" class="btn btn-primary btn-xs" @click="showData(rowData)">
            <i class="glyphicon glyphicon-eye-open"></i>
        </button>
        <button type="button" class="btn btn-warning btn-xs" @click="editData(rowData)">
            <i class="glyphicon glyphicon-pencil"></i>
        </button>
        <button type="button" class="btn btn-danger btn-xs" @click="deleteData(rowData)">
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
            showData: function(rowData) {
                this.$dispatch('showData', rowData);
            },
            editData: function(rowData) {
                this.$dispatch('editData', rowData);
            },
            deleteData: function(rowData) {
                this.$dispatch('deleteData', rowData);
            },
        }
    }
</script>
