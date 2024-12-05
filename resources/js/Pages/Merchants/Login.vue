<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("merchant.login"), {
    onError: (errors) => {
      console.error("Login Errors:", errors);
    },
  });
};
</script>

<template>
  <div class="merchant-login">
    <div class="container">
      <h1 class="title">Merchant Login</h1>
      <form @submit.prevent="submit">
        <div class="form-group">
          <label>Email Address (required):</label>
          <input
            v-model="form.email"
            type="email"
            placeholder="Enter your email"
            required
          />
        </div>
        <div class="form-group">
          <label>Password (required):</label>
          <input
            v-model="form.password"
            type="password"
            placeholder="Enter your password"
            required
          />
        </div>
        <div class="form-group">
          <input v-model="form.remember" type="checkbox" />
          <label>Remember me</label>
        </div>
        <button type="submit" class="submit-button">Login</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
/* Similar styling as the signup page */
.container {
  max-width: 500px;
  margin: auto;
  padding: 20px;
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.title {
  text-align: center;
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}
.form-group {
  margin-bottom: 20px;
}
label {
  display: block;
  font-weight: bold;
  margin-bottom: 8px;
}
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ddd;
  border-radius: 4px;
}
.submit-button {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  background-color: #00c200;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.submit-button:hover {
  background-color: #009900;
}
</style>
