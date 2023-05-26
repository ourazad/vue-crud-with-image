import {createWebHistory, createRouter} from 'vue-router';
import home from './pages/Home.vue';
import student from './pages/Student.vue';
import teacher from './pages/Teacher.vue';
import staff from './pages/Staff.vue';
import file_upload from './pages/FileUploadComponent.vue';


const routes = [
    {   
        path: '/',
        name: 'Home',
        component: home,
    },
    {   
        path: '/student',
        name: 'Student',
        component: student,
    },
    {   
        path: '/teacher',
        name: 'Teacher',
        component: teacher,
    },
    {   
        path: '/staff',
        name: 'Staff',
        component: staff,
    },
    {   
        path: '/file_upload',
        name: 'File_Upload',
        component: file_upload,
    },
    // path: '/pathname',
    // name: 'Navbar a link er jonno',
    // component: import er sathe connection,
    
];


const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;