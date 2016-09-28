<template>
    <div class="row">
        <div class="col-md-12">
            <img
                class="img-thumbnail img-reponsive image-preview"
                :src="imageSrc"
                :alt="imageName"
                :title="imageName">
        </div>
    </div>

    <div class="row mrg-top-1em">
        <div class="col-md-12">
            <div class="image-input btn btn-default">
                <span>
                    <i class="glyphicon glyphicon-camera"></i>
                    Change
                </span>

                <input @change="preview($event)" name="image" type="file" accept="image/*">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            imageSrc: {
                type: String,
                default: '/storage/avatars/default.png'
            },
        },
        data() {
            return {
                imageName: null
            }
        },
        methods: {
            preview(event) {
                let input = event.target;
                let files = input.files;

                if (files && files[0]) {
                    if(files[0].type.match('image.*')) {
                        let reader = new FileReader();

                        reader.onload = (e) => {
                            this.imageSrc = e.target.result;
                            this.imageName = files[0].name;
                        };

                        reader.readAsDataURL(files[0]);

                        this.$dispatch('avatarUpdated', files[0]);
                    }
                }
            }
        }
    }
</script>
