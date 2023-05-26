<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Teacher Page</h1>
                <form @submit.prevent="save">
                    <div class="form-group">
                        <input type="text" v-model="teacher.name" class="form-control" placeholder="student name">
                    </div>
                    <div class="form-group">
                        <input type="text" v-model="teacher.address" class="form-control" placeholder="student Address">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <hr class="mt-5">
                <table class="table table-dark my-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Teacher Name</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="teacher in result" v-bind:key="teacher.id">
                            <td>{{ teacher.id }}</td>
                            <td>{{ teacher.name }}</td>
                            <td>{{ teacher.address }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" @click="edit(teacher)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="remove(teacher)">Delete</button>
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
            teacher: {
                id: '',
                name: '',
                address: '',
            }
        }
    },
    created() {
        this.TeacherLoad();
    },
    methods: {
        TeacherLoad() {
            var index = "http://127.0.0.1:8000/api/teachers";
            axios.get(index)
                .then(
                    ({ data }) => {
                        console.log(data);
                        this.result = data;
                    }
                );
        },
        save() {
            if (this.teacher.id == '') {
                this.saveData();
            }
            else {
                this.updateData();
            }
        },
        saveData() {
            axios.post("http://127.0.0.1:8000/api/teachers_save", this.teacher)
                .then(
                    ({ data }) => {
                        alert("saved !");
                        this.TeacherLoad();
                    }
                )
        },
        edit(teacher) {
            this.teacher = teacher;
        },

        updateData() {
            var update = 'http://127.0.0.1:8000/api/teachers_update/' + this.teacher.id;
            axios.put(update, this.teacher)
                .then(
                    ({ data }) => {
                        this.teacher.name = '';
                        this.teacher.address = '',
                            this.id = ''
                        alert("Updated !");
                        this.TeacherLoad();
                    }
                )
        },

        remove(teacher) {
            var destroy = `http://127.0.0.1:8000/api/teachers_delete/${teacher.id}`;
            //var destroy = `http://127.0.0.1:8000/api/delete/' + this.teacher.id;

            axios.delete(destroy);
            alert("Deleted !");
            this.TeacherLoad();
        },
    }
}
</script>