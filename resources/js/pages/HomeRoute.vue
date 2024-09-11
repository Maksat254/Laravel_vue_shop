<template>
    <div>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <router-link to="/" class="btn bg-light" type="submit">Главная</router-link>
                        <router-link class="nav-link" to="/create">Добавить продукт</router-link>
                        <router-link class="nav-link" to="/cart">Корзина</router-link>
                    </div>
                </div>
                <ul class="navbar-nav ms-auto p-2">
                    <li class="nav-item mx-2">
                        <router-link to="/register" class="btn bg-light" type="submit">Register</router-link>
                        <router-link to="/login" class="btn bg-light" type="submit">войти</router-link>
                    </li>
                </ul>
                <nav class="navbar bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand">Поиск продукта</a>
                        <form class="d-flex" role="search" @submit.prevent="performSearch">
                            <input
                                class="form-control me-2"
                                type="search"
                                placeholder="Введите название товара"
                                aria-label="Search"
                                v-model="searchQuery"
                            />
                            <button class="btn btn-outline-success" type="submit">Поиск</button>
                        </form>
                    </div>
                </nav>
            </div>
        </nav>
        <div class="container mt-4">
            <h2>Продукты</h2>
            <table class="table">
                <tr>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Описание</th>
                    <th></th>
                </tr>
                    <tr v-for="product in products?.data">
                        <td>{{product.name}}</td>
                        <td>{{product.price}}</td>
                        <td>{{product.description}}</td>
                        <td>
                            <button class="btn btn-success m-1" @click.prevent="addProductToCart(product.id)">Добавить в корзину</button>
                            <button class="btn btn-danger " @click.prevent="deleteProduct(product.id)">Удалить</button>
                            <router-link class="btn btn-warning text-wrap m-1" :to="'/product/detale/' + product.id">Подробнee</router-link>
                            <router-link class="btn btn-warning text-wrap" to="/orders">Заказать</router-link>
                        </td>
                    </tr>
                <ul class="pagination justify-content-center mt-4">
                    <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
                        <button class="page-link" @click.prevent="getValue(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
                            <i class="bi bi-arrow-left-circle"></i> Предыдущий
                        </button>
                    </li>
                    <li class="page-item" :class="{ disabled: !pagination.next_page_url }">
                        <button class="page-link" @click.prevent="getValue(pagination.next_page_url)" :disabled="!pagination.next_page_url">
                            Следующий <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </li>
                </ul>
            </table>
            <div>
                <div v-if="user">
                    <p>{{ user.name }}!</p>
                </div>
                <div v-else>
                    <p>Вы не вошли в систему.</p>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>

import axios from "axios";
import { ref, computed, onMounted } from "vue";

const response = ref();
const products = ref();
const searchQuery = ref("");
const pagination = ref({});
const token = localStorage.getItem('token')


const user = ref();

const fetchUser = async () => {
    try {
        const response = await axios.get('/api/user', {
            headers:{
                Authorization: `Bearer ${token}`
            }
        });
        user.value = response.data;
    } catch (error) {
        console.error('Ошибка при получении данных пользователя:', error);
    }
};

onMounted(() => {
    fetchUser();
});



const getValue = async (url = "/api/products") => {
    try {
        products.value = (await axios.get(url)).data;
        pagination.value ={
            prev_page_url:products.value.links.prev,
            next_page_url:products.value.links.next,
        }
    } catch (error) {
        console.log(error);
    }
};
const deleteProduct = async (id) => {
    if (confirm("Вы уверены, что хотите удалить продукт?")) {
        try {
            await axios.delete(`/api/products/${id}`);
            alert("Продукт успешно удален");
            await getValue();
        } catch (error) {
            console.error("Ошибка при удалении продукта:", error);
        }
    }
};


onMounted(async () => {
    await getValue();
})



const filteredProducts = computed(() =>
    products.value.filter(product =>
        product.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
);


const addProductToCart = async (id) => {
    await axios.post(`/api/cart/add`, {'product_id': id, 'quantity': id}, {
        headers: {
            Authorization: 'Bearer ' +  localStorage.getItem('token')
        }
    }).then(async () => {
        products.value = (await axios.get("/api/products")).data.data;
    });


}





</script>

<style scoped>

</style>
