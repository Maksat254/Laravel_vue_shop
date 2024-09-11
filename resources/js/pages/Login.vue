<template>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <h2 class="mb-4">Вход</h2>
            <form @submit.prevent="login">
                <div class="mb-3">
                    <label for="loginName" class="form-label">Name</label>
                    <input id="loginName" v-model="name" type="name" class="form-control" placeholder="Введите name" required>
                </div>
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email</label>
                    <input id="loginEmail" v-model="email" type="email" class="form-control" placeholder="Введите email" required>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Пароль</label>
                    <input id="loginPassword" v-model="password" type="password" class="form-control" placeholder="Введите пароль" required>
                </div>
                <div class="mb-3">
                    <input id="rememberMe" type="checkbox" v-model="remember" />
                    <label for="rememberMe" class="form-label">Запомнить меня</label>
                </div>
                <button type="submit" class="btn btn-success w-100">Войти</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const email = ref('');
const password = ref('');
const remember = ref(false);

const login = async () => {
    try {
        const response = await axios.post('/api/login', {
            email: email.value,
            password: password.value,
            remember: remember.value
        });
        localStorage.setItem('token', response.data.access_token);
        alert('Вход выполнен');
    } catch (error) {
        console.error('Ошибка входа:', error.response?.data?.message || error.message);
        alert('Ошибка входа. Проверьте введенные данные.');
    }
};
</script>
