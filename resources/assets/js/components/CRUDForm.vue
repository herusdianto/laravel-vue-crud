<template>
    <form @submit.prevent="submit" novalidate v-cloak>
        <div class="row">
            <div class="col-md-6 text-center">
                <image-input :image-src="imageSrc"></image-input>

                <div class="mrg-top-1em text-danger" v-for="error of errors['avatar']">
                    {{ error }}
                </div>
            </div>

            <div class="col-md-6">
                <div
                    class="form-group"
                    :class="{ 'has-error': errors['name'] }">
                    <label class="control-label" for="name">
                        Name
                    </label>

                    <input
                        v-model="student.name"
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Name...">

                    <span class="help-block" v-for="error of errors['name']">
                        {{ error }}
                    </span>
                </div>

                <div
                    class="form-group"
                    :class="{ 'has-error': errors['email'] }">
                    <label class="control-label" for="email">
                        Email
                    </label>

                    <input
                        v-model="student.email"
                        type="email"
                        class="form-control"
                        id="email"
                        placeholder="Email...">

                    <span class="help-block" v-for="error of errors['email']">
                        {{ error }}
                    </span>
                </div>

                <div
                    class="form-group"
                    :class="{ 'has-error': errors['birth_date'] }">
                    <label class="control-label">
                        Birth Date
                    </label>

                    <datepicker
                        :value.sync="student.birth_date"
                        format="yyyy-MM-dd"
                        width="100%"
                        placeholder="Birth Date"
                        readonly>
                    </datepicker>

                    <span class="help-block" v-for="error of errors['birth_date']">
                        {{ error }}
                    </span>
                </div>
            </div>
        </div>

        <div class="row mrg-top-1em">
            <div class="col-md-12 text-center">
                <button class="btn btn-primary">
                    <i class="glyphicon glyphicon-save"></i>
                    Save
                </button>
            </div>
        </div>
    </form>

    <notify :alert="alert"></notify>
</template>

<script>
    export default {
        props: {
            student: {
                type: Object,
                required: true
            },
        },
        created() {
            if(! this.student.birth_date) {
                this.student.birth_date = moment().format('YYYY-MM-DD')
            }
        },
        data() {
            return {
                alert: {
                    show: false,
                    type: null,
                    title: null,
                    message: null,
                },
                errors: {}
            }
        },
        computed: {
            imageSrc() {
                if(this.student.avatar instanceof File === false) {
                    if(this.student.avatar !== undefined) {
                        let avatar = this.student.avatar;

                        if(! avatar) {
                            avatar = 'default.png';
                        }

                        return '/storage/avatars/' + avatar;
                    }
                }
            }
        },
        methods: {
            submit() {
                let formData = new FormData();

                if(this.student.avatar instanceof File) {
                    formData.set('avatar', this.student.avatar);
                }

                formData.set('name', this.student.name);
                formData.set('email', this.student.email);
                formData.set('birth_date', this.student.birth_date);

                this.$dispatch('submitted', formData);
            }
        },
        events: {
            'avatarUpdated'(imageFile) {
                this.student.avatar = imageFile;
            },
            'formErrors'(errors) {
                this.errors = errors;
            },
            'showAlert'(alert) {
                this.alert = alert;

                this.$broadcast('notify', this.alert);

                this.errors = {};
            },
        },
    }
</script>
