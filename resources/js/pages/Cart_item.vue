<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const products = ref([]);

onMounted(async () => {
    await getProductFromCart();
});

const getProductFromCart = async () => {
    try {
        const response = await axios.get('/api/cart');
        products.value = response.data;
    } catch (error) {
        console.error("Ошибка при получении данных корзины:", error);
    }
};

const clearCart = async () => {
    try {
        await axios.post('/api/cart/clear');
        products.value = [];
        alert("Корзина очищена успешно");
    } catch (error) {
        console.error('Ошибка при очистке корзины:', error);
    }
};
</script>

<template>
    <div>
        <h2>Корзина</h2>
        <nav class="navbar navbar-expand-lg navbar-bran">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav p-2">
                        <li class="nav-item mx-2">
                            <router-link to="/" class="btn bg-light" type="submit">Главная</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Кол-во</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in products.data" :key="item.product.id">
                    <td>{{ item.product_name }}</td>
                    <td>{{ item.product.price }}</td>
                    <td>{{ item.product.category }}</td>
                    <td>{{ item.quantity }}</td>
                </tr>
                </tbody>
            </table>
            <button class="btn btn-primary" @click.prevent="clearCart">Очистить корзину</button>
        </div>
    </div>
</template>

<style scoped>
</style>
