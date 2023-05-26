<template>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Staff Page</h1>
            <form @submit.prevent="save">
                    <div class="form-group">
                        <input type="text" v-model="staff.name" class="form-control" placeholder="Staff name">
                    </div>
                    <div class="form-group">
                        <input type="text" v-model="staff.image" class="form-control" placeholder="Staff name">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

                <hr class="mt-5">
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
                image: '',
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

        save() {
            if (this.staff.id == '') {
                this.saveData();
            }
            else {
                this.updateData();
            }
        },
        saveData() {
            axios.post("http://127.0.0.1:8000/api/save", this.staff)

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
            var update = 'http://127.0.0.1:8000/api/update/' + this.staff.id;
            axios.put(update, this.staff)
                .then(
                    ({ data }) => {
                        this.staff.name = '';
                        this.staff.image = '',
                            this.id = ''
                        alert("Updated !");
                        this.StaffLoad();
                    }
                )
        },

        remove(staff) {
            var destroy = `http://127.0.0.1:8000/api/delete/${staff.id}`;
            //var destroy = `http://127.0.0.1:8000/api/delete/' + this.staff.id;

            axios.delete(destroy);
            alert("Deleted !");
            this.StaffLoad();
        },
    }
}
</script>