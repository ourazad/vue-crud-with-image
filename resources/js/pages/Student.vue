<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="save">
                    <div class="form-group">
                        <input type="text" v-model="student.name" class="form-control" placeholder="student name">
                    </div>
                    <div class="form-group">
                        <input type="text" v-model="student.address" class="form-control" placeholder="student Address">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <h1>Studnt page</h1>

                <table class="table table-dark my-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="student in myresult" v-bind:key="student.id">
                            <td>{{ student.id }}</td>
                            <td>{{ student.name }}</td>
                            <td>{{ student.address }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" @click="edit(student)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="remove(student)">Delete</button>
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
            myresult: {},
            student: {
                id: '',
                name: '',
                address: '',
            }
        }
    },
    created() {
        this.StudentLoad();
    },
    methods: {

        StudentLoad() {
            var index = "http://127.0.0.1:8000/api/students";
            axios.get(index)
                .then(
                    ({ data }) => {
                        console.log('student list:', data);
                        this.myresult = data;
                    }
                );
        },

        save() {
            if (this.student.id == '') {
                this.saveData();
            }
            else {
                this.updateData();
            }
        },
        saveData() {
            axios.post("http://127.0.0.1:8000/api/save", this.student)
                .then(
                    ({ data }) => {
                        alert("saved !");
                        this.StudentLoad();
                    }
                )
        },
        edit(student) {
            this.student = student;
        },
        updateData() {
            var update = 'http://127.0.0.1:8000/api/update/' + this.student.id;
            axios.put(update, this.student)
                .then(
                    ({ data }) => {
                        this.student.name = '';
                        this.student.address = '',
                            this.id = ''
                        alert("Updated !");
                        this.StudentLoad();
                    }
                )
        },
        remove(student) {
            var destroy = `http://127.0.0.1:8000/api/delete/${student.id}`;
            //var destroy = `http://127.0.0.1:8000/api/delete/' + this.student.id;

            axios.delete(destroy);
            alert("Deleted !");
            this.StudentLoad();
        }
    }
}
</script>