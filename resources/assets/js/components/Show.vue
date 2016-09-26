<template v-cloak>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="" alt="" class="img-thumbnail img-responsive">
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
        <button class="btn btn-default btn-sm" v-link="{ path: '/' }">
            &laquo; Back
        </button>
    </div>
</template>

<script>
    export default {
        created() {
            this.$http.get('/api/students/' + this.$route.params.studentId)
                .then(response => {
                    this.student = response.data
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
