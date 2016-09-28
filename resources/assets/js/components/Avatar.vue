<template>
    <img
        :src="avatar"
        :alt="rowData.name"
        :title="rowData.name"
        class="img-thumbnail img-responsive avatar">
</template>

<script>
    export default {
        props: {
            rowData: {
                type: Object,
                required: true
            }
        },
        computed: {
            avatar() {
                if(! this.rowData.avatar) {
                    this.rowData.avatar = 'default.png';
                }

                return '/storage/avatars/' + this.rowData.avatar;
            },
        }
    }
</script>
