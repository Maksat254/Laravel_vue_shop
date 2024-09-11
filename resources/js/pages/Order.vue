<template>
    <div class="container mt-5">
        <h2>Оформить заказ</h2>
        <form @submit.prevent="submitOrder">
            <div class="mb-3">
                <label for="address" class="form-label">Адрес доставки</label>
                <input v-model="address" type="text" class="form-control" id="address" placeholder="Введите ваш адрес" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Город</label>
                <input v-model="city" type="text" class="form-control" id="city" placeholder="Введите ваш город" required>
            </div>

            <div class="mb-3">
                <label for="postal_code" class="form-label">Почтовый индекс</label>
                <input v-model="postal_code" type="text" class="form-control" id="postal_code" placeholder="Введите почтовый индекс" required>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Страна</label>
                <input v-model="country" type="text" class="form-control" id="country" placeholder="Введите страну" required>
            </div>

            <div class="card-container glowing-effect">
                <div class="credit-card">
                    <div class="card-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa Logo" />
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b7/MasterCard_Logo.svg" alt="MasterCard Logo" />
                    </div>
                </div>


                <!-- Форма для ввода данных карты -->
                <form class="card-form">
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Номер карты</label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="Введите номер карты" />
                    </div>
                    <div class="mb-3">
                        <label for="cardHolder" class="form-label">Имя владельца</label>
                        <input type="text" class="form-control" id="cardHolder" placeholder="Введите имя владельца" />
                    </div>
                    <div class="mb-3">
                        <label for="expiryDate" class="form-label">Срок действия</label>
                        <input type="text" class="form-control" id="expiryDate" placeholder="ММ/ГГ" />
                    </div>
                    <div class="mb-3">
                        <label for="cvc" class="form-label">CVC</label>
                        <input type="text" class="form-control" id="cvc" placeholder="Введите CVC" />
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Оплатить</button>
                </form>
            </div>
        </form>
    </div>

</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const address = ref('');
const city = ref('');
const postal_code = ref('');
const country = ref('');
const card_number = ref('');
const card_expiry = ref('');
const card_cvc = ref('');

const submitOrder = async () => {
    try {
        const response = await axios.post('/api/orders', {
            address: address.value,
            city: city.value,
            postal_code: postal_code.value,
            country: country.value,
            payment_method: 'card',
            card_number: card_number.value,
            card_expiry: card_expiry.value,
            card_cvc: card_cvc.value,
        });
        alert('Заказ успешно оформлен!');
    } catch (error) {
        console.error('Ошибка при оформлении заказа:', error);
    }
};
</script>

<style scoped>
.container {
    max-width: 600px;
}
</style>
