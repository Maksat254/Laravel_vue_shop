<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
            </div>
        </nav>

        <div>
            <h2>Add comment</h2>
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" v-model="form.comments"></textarea>
                    <button type="submit" class="btn btn-primary">Add comment</button>
                </div>
            </form>
        </div>

        <div v-if="product">
            <h2>Product Details</h2>
            <table class="table">
                <tr>
                    <td><strong>Name:</strong></td>
                    <td><strong>{{ product.name }}</strong></td>

                </tr>
                <tr>
                    <td><strong>Price:</strong></td>
                    <td><strong>{{ product.price }}</strong></td>
                </tr>
                <tr>
                    <td><strong>Description:</strong></td>
                    <td><strong>{{ product.description }}</strong></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import { useRoute } from "vue-router";
import axios from "axios";
import { onMounted, ref } from "vue";

export default {
    setup() {
        const route = useRoute();
        const product = ref(null);

        onMounted(async () => {
            try {
                const res = await axios.get(`/api/products/detail/${route.params.id}`);
                product.value = res.data;
                console.log(res.data)
            } catch (error) {
                console.error("Failed to fetch product details:", error);
            }
        });

        const form = ref({
            comments: ''
        });

        const submitForm = async () => {
            try {
                await axios.post(`/api/products/${route.params.id}/comments`, form.value);
                form.value.comments = '';
                alert('Comment added successfully!');
            } catch (error) {
                console.error("Failed to submit comment:", error);
            }
        };

        return {
            product,
            form,
            submitForm
        };
    }
};
</script>

<style scoped>
</style>
