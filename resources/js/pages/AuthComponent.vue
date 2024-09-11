<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Регистрация</h2>
                <form @submit.prevent="register">
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input id="name" v-model="name" type="text" class="form-control" placeholder="Введите ваше имя" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" v-model="email" type="email" class="form-control" placeholder="Введите email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input id="password" v-model="password" type="password" class="form-control" placeholder="Введите пароль" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                        <input id="password_confirmation" v-model="password_confirmation" type="password" class="form-control" placeholder="Повторите пароль" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import axios from 'axios';

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');

const register = async () => {
    try {
        await axios.post('/api/register', {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value
        });
        alert('Регистрация успешна');
    } catch (error) {
        if (error.response) {
            alert(error.response.data.message);
        } else {
            console.log(error);
        }
    }
};



</script>
