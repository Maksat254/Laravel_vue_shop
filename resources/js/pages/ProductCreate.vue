<template>
    <div class="container mt-5">
        <router-link to="/" class="btn bg-light" type="submit">Главная</router-link>
        <h2>Add New Product</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" v-model="form.name" />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" v-model="form.description"></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control" id="price" v-model="form.price" />
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" class="form-select" v-model="form.category">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import axios from 'axios';

const form = ref({
    name: '',
    description: '',
    price: '',
    category_id: ''
});

const successMessage = ref('');

const submitForm = async () => {

    console.log(form)
    try {
        const response = await axios.post(
            'http://127.0.0.1:8000/api/products/add', form.value);
        console.log(response);


        successMessage.value = 'Product added successfully!';
        form.value = { name: '', description: '', price: '', category_id: '' };
    } catch (error) {
        console.error('An error occurred:', error);
    }
};
</script>


<style scoped>

</style>
