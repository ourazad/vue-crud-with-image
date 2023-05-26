<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Laravel Vue JS File Upload Demo</div>
                    <div class="card-body">
                        <div v-if="success != ''" class="alert alert-success">
                            {{ success }}
                        </div>
                        <!-- <form @submit="formSubmit" enctype="multipart/form-data"> -->
                        <form @submit.prevent="save" enctype="multipart/form-data">
                            <input type="text" v-model="file_upload.name" name="name" class="form-control" placeholder="File Name">
                            <input type="file" class="form-control" v-on:change="onChange">
                            <button class="btn btn-primary btn-block">Upload</button>
                        </form>
                    </div>
                </div>
                <table class="table table-dark my-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="file_upload in result" v-bind:key="file_upload.id">
                            <td>{{ file_upload.id }}</td>
                            <td>{{ file_upload.name }}</td>
                            <!-- <td>{{ file_upload.path }}</td> // only path show -->
                            <td><img :src="file_upload.path" height="150" width="150"
                                    alt="Profile Image" /></td>
                                    
                            <td>
                                <button type="button" class="btn btn-warning" @click="edit(file_upload)">Edit</button>
                                <button type="button" class="btn btn-danger"
                                    @click="remove(file_upload)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            success: '',
            //fist a success message blank rakhar jonno blank declear
            result: {},
            file_upload: {
                id: '',
                name: '',
                file: '',
            }
        }
    },
    created() {
        this.FileUploadLoad();
    },
    methods: {
        FileUploadLoad() {
            var index = "http://127.0.0.1:8000/api/file_index";
            axios.get(index)
                .then(
                    ({ data }) => {
                        console.log(data);
                        this.result = data;
                    }
                );
        },

        onChange(e) {
            this.file = e.target.files[0];
        },

        save() {
            if (this.file_upload.id == '') {
                this.saveData();
            }
            else {
                this.updateData();
            }
        },
        
        saveData() {
            let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData();
            data.append('file', this.file);
            data.append('name', this.file_upload.name);

            axios.post('http://127.0.0.1:8000/api/file_save/', data, config)
                .then(({ data }) => {
                    alert("saved!");
                    existingObj.FileUploadLoad();
                })
                .then(function (res) {
                    existingObj.success = res.data.success;
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
        },
        edit(file_upload) {
            this.file_upload = file_upload;
        },
        updateData(e) {
           e.preventDefault();
            let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData();
            data.append('file', this.file);
            data.append('name', this.file_upload.name);
            // axios.post('/upload', data, config)
            axios.post('http://127.0.0.1:8000/api/file_upload/', data, config)
            .then(
                    ({ data }) => {
                        this.file_upload.name = '';
                        this.file_upload.file = '',
                            this.id = ''
                        alert("Updated !");
                        this.FileUploadLoad();
                    }
                )
                .then(function (res) {
                    existingObj.success = res.data.success;
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
        }
    }
}
</script>