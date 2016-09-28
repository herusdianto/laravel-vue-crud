<template>
    <div class="panel panel-default" v-cloak>
        <div class="panel-body">
            <legend>Create Student</legend>

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
        data() {
            return {
                url: '/api/students',
                student: {
                    avatar: '',
                    name: '',
                    email: '',
                    birth_date: '',
                }
            }
        },
        events: {
            'submitted'(student) {
                this.submit(student);
            },
        },
        methods: {
            submit(formData) {
                this.$http.post(this.url, formData)
                    .then(response => {

                        this.$route.router.go({ name:'index' });

                    }).catch(response => {
                        let errors = response.body;

                        this.$broadcast('formErrors', errors);
                    });
            }
        }
    }
</script>
