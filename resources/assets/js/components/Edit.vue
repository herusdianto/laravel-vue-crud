<template>
    <div class="panel panel-default" v-cloak>
        <div class="panel-body">
            <legend>Edit Student</legend>

            <crud-form :student="student"></crud-form>

            <div class="text-center mrg-top-1em">
                <button class="btn btn-default" v-link="{ name: 'index' }">
                    <i class="glyphicon glyphicon-chevron-left"></i>
                    Back
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$http.get('/api/students/' + this.studentId)
                .then(response => {
                    this.student = response.data;
                })
                .catch(response => {
                    let alert = {
                        show: true,
                        type: 'danger',
                        title: 'Error',
                        message: response.statusText
                    };

                    this.$broadcast('showAlert', alert);
                });
        },
        data() {
            return {
                studentId: this.$route.params.studentId,
                url: '/api/students/',
                student: {},
            }
        },
        events: {
            'submitted'(student) {
                this.submit(student);
            },
        },
        methods: {
            submit(formData) {
                formData.set('_method', 'PUT');

                let url = this.url + this.studentId;

                this.$http.post(url, formData)
                    .then(response => {
                        let alert = {
                            show: true,
                            type: 'success',
                            title: 'Success',
                            message: 'Student successfully updated.'
                        };

                        this.$broadcast('showAlert', alert);
                    }).catch(response => {
                        let errors = response.body;

                        this.$broadcast('formErrors', errors);
                    });
            }
        }
    }
</script>
