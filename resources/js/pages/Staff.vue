<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <form @submit.prevent="formSubmit" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" v-model="staff.name" class="form-control"
                            placeholder="staff name">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" @change="onChange"
                            placeholder="staff name">
                    </div>
                    <button class="btn btn-primary btn-block">Add</button>
                </form>
                <h1>Staff page</h1>

                <table class="table table-dark my-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Staff Name</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="staff in result" v-bind:key="staff.id">
                            <td>{{ staff.id }}</td>
                            <td>{{ staff.name }}</td>
                            <td>{{ staff.image }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" @click="edit(staff)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="remove(staff)">Delete</button>
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
            result: {},
            staff: {
                id: '',
                name: '',
                iamge: '',
            }
        }
    },
    created() {
        this.StaffLoad();
    },
    methods: {

        StaffLoad() {
            var index = "http://127.0.0.1:8000/api/staffs";
            axios.get(index)
                .then(
                    ({ data }) => {
                        console.log(data);
                        this.result = data;
                    }
                );
        },
        onChange(e) {
            console.log(e.target.files[0]);
            // this.file = e.target.files[0];
            // this.staff.image = e.target.files[0]
        },


        formSubmit(e) {
            // e.preventDefault();
            // let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData();
            data.append('image', this.image);
            axios.post("http://127.0.0.1:8000/api/staff_save", data, config)

                .then(function (res) {
                    existingObj.success = res.data.success;
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
        },
        save() {
            if (this.staff.id == '') {
                this.saveData();
            }
            else {
                this.updateData();
            }
        },
        saveData() {
            const data = new FormData()
            data.append('file', this.file)

            axios.post("http://127.0.0.1:8000/api/staff_save", data)
                .then(
                    ({ data }) => {
                        alert("saved !");
                        this.StaffLoad();
                    }
                )
        },

        edit(staff) {
            this.staff = staff;
        },
        updateData() {
            var update = 'http://127.0.0.1:8000/api/staff_update/' + this.staff.id;
            axios.put(update, this.staff)
                .then(
                    ({ data }) => {
                        this.staff.name = '';
                        this.staff.iamge = '',
                            this.id = ''
                        alert("Updated !");
                        this.StaffLoad();
                    }
                )
        },
        remove(staff) {
            var destroy = `http://127.0.0.1:8000/api/staff_delete/${staff.id}`;
            //var destroy = `http://127.0.0.1:8000/api/delete/' + this.staff.id;

            axios.delete(destroy);
            alert("Deleted !");
            this.StaffLoad();
        }
    }
}
</script>