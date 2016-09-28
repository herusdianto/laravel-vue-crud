<template>
    <div class="panel panel-default" v-cloak>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <img :src="student.avatar" :alt="student.name" class="img-thumbnail img-responsive image-preview">
                </div>

                <div class="col-md-6">
                    <p>
                        <label>Name:</label>
                        {{ student.name }}
                    </p>

                    <p>
                        <label>Email:</label>
                        {{ student.email }}
                    </p>

                    <p>
                        <label>Birth Date:</label>
                        {{ student.birth_date }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <button class="btn btn-default" v-link="{ name: 'index' }">
            <i class="glyphicon glyphicon-chevron-left"></i>
            Back
        </button>
    </div>
</template>

<script>
    export default {
        created() {
            this.$http.get('/api/students/' + this.$route.params.studentId)
                .then(response => {
                    this.student = response.data;

                    if(! this.student.avatar) {
                        this.student.avatar = 'default.png';
                    }

                    this.student.avatar = '/storage/avatars/' + this.student.avatar;
                })
                .catch(response => {
                    console.error('Error: ' + response.statusText);
                });
        },
        data() {
            return {
                student: {}
            };
        }
    }
</script>
