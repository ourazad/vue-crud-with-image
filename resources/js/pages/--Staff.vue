<template>
    <div class="flex items-center justify-center h-screen">
      <div class="w-1/3">
        <form @submit.prevent="submit">
          <div class="mb-4">
            <input
              type="file"
              @change="onFileChange"
              class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
            />
          </div>
          <button class="px-6 py-1.5 text-white bg-blue-600" type="submit">
            Button
          </button>
        </form>
      </div>
    </div>
  </template>

<script>
// import axios from 'axios';

export default {
  setup() {
    const onFileChange = (e) => {
      image.value = e.target.files[0];
    };
    const submit = async () => {
      if (!image.value) {
        alert('please fill the filed');
      } else {
        const formdata = new FormData();
        formdata.append('image', image.value);
        await axios.post(
          'http://127.0.0.1:8000/api/staff_save',
          formdata
        ).then(() => {
          router.push({
            name: 'name',
          });
        })
        .catch((error) => {
          console.log(error);
        });
      }
    };

    return {submit,onFileChange};
  },
};
</script>
