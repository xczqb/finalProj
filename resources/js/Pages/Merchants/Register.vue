<script setup>
import Container from '../../Components/Container.vue'
import Title from '../../Components/Title.vue'
import TextLink from '../../Components/TextLink.vue'
import InputField from '../../Components/InputField.vue'
import PrimaryBtn from '../../Components/PrimaryBtn.vue'
import ErrorMessages from '../../Components/ErrorMessages.vue'
import { Head } from "@inertiajs/vue3"; // Import Head from Inertia.js




import { ref } from "vue";

import { useForm } from "@inertiajs/vue3";

const form = useForm({
    business_name: "",
    owner_name: "",
    email: "",
    phone: "",
    business_type: "",
    province: "",
    city: "",
    description: "",
    business_registration: null,
    owner_id: null,
    password: "",
    password_confirmation: "",
    agree_terms: false,
});

const provinces = ref([]); // Make provinces reactive
const cities = ref([]); // Make cities reactive

const fetchProvinces = async () => {
    const caragaRegionCode = "160000000";
    try {
        const response = await fetch(
            `https://psgc.gitlab.io/api/regions/${caragaRegionCode}/provinces/`
        );
        const data = await response.json();
        provinces.value = data.sort((a, b) => a.name.localeCompare(b.name)); // Update the reactive ref
    } catch (error) {
        console.error("Error fetching provinces:", error);
    }
};

const fetchCities = async () => {
    if (!form.province) return;
    try {
        const response = await fetch(
            `https://psgc.gitlab.io/api/provinces/${form.province}/cities-municipalities/`
        );
        const data = await response.json();
        cities.value = data.sort((a, b) => a.name.localeCompare(b.name)); // Update the reactive ref
    } catch (error) {
        console.error("Error fetching cities:", error);
    }
};

const handleFileUpload = (field, event) => {
    form[field] = event.target.files[0]; // Assign the selected file to the form field
};


const submit = () => {
  const password = form.password.trim();  // Trim spaces from password
  const confirmPassword = form.password_confirmation.trim();  // Trim spaces from password_confirmation

  if (password !== confirmPassword) {
    alert('Passwords do not match');
    return;  // Stop submission
  }
  
  form.post(route('merchant.register'), {
  onFinish: () => form.reset('password', 'password_confirmation'),
  onError: (errors) => {
    console.log("Form Errors:", errors);  // Log the full error response
  }
});

}




fetchProvinces(); // Fetch provinces on component mount


</script>



<template>
  <div class="merchant-signup">
    <div class="container">
      <h1 class="title">Merchant Signup</h1>
      <ErrorMessages :errors="form.errors"/>
      <form @submit.prevent="submit">
  <!-- Basic Information Section -->
  
  <div class="form-section">
    <h2>Basic Information</h2>
    <div class="form-group">
      <label>Business Name (required):</label>
      <input v-model="form.business_name" type="text" placeholder="Enter the official name of your business" required />
    </div>
    <div class="form-group">
      <label>Owner's Full Name (required):</label>
      <input v-model="form.owner_name" type="text" placeholder="Enter your full name as the business owner or representative" required />
    </div>
    <div class="form-group">
      <label>Email Address (required):</label>
      <input v-model="form.email" type="email" placeholder="Used for account login and communication" required />
    </div>
    <div class="form-group">
      <label>Phone Number (required):</label>
      <input v-model="form.phone" type="tel" placeholder="Enter your phone number" required />
    </div>
  </div>

  <!-- Business Details Section -->
  <div class="form-section">
    <h2>Business Details</h2>
    <div class="form-group">
      <label>Business Type (required):</label>
      <select v-model="form.business_type" required>
        <option value="" disabled>Select business type</option>
        <option>Hotel</option>
        <option>Resort</option>
        <option>Tourist Spot</option>
      </select>
    </div>
    <div class="form-group">
      <label>Location (Province) (required):</label>
      <select id="province" v-model="form.province" @change="fetchCities" required>
        <option value="" disabled>Select a Province</option>
        <option v-for="province in provinces" :key="province.code" :value="province.code">
          {{ province.name }}
        </option>
      </select>
    </div>
    <div class="form-group" v-if="form.province">
      <label>Location (City/Municipality) (required):</label>
      <select id="city" v-model="form.city" required>
        <option value="" disabled>Select a City/Municipality</option>
        <option v-for="city in cities" :key="city.code" :value="city.code">
          {{ city.name }}
        </option>
      </select>
    </div>
    <div class="form-group">
      <label>Business Description (optional):</label>
      <textarea v-model="form.description" maxlength="300" placeholder="Maximum of 300 characters"></textarea>
    </div>
  </div>

  <!-- Upload Documents Section -->
  <div class="form-section">
    <h2>Upload Documents</h2>
    <div class="form-group">
      <label>Business Registration (required):</label>
      <input type="file" @change="handleFileUpload('business_registration', $event)" required />
    </div>
    <div class="form-group">
      <label>Valid ID of Owner/Representative (required):</label>
      <input type="file" @change="handleFileUpload('owner_id', $event)" required />
    </div>
  </div>

  <!-- Account Details Section -->
  <div class="form-section">
    <h2>Account Details</h2>
    
    <div class="form-group">
      <label>Create Password (required):</label>
      <input v-model="form.password" type="password" placeholder="Create a password" required />
    </div>
    <div class="form-group">
      <label>Confirm Password (required):</label>
      <input v-model="form.password_confirmation" type="password" placeholder="Confirm your password" required />

    </div>
  </div>

  <!-- Terms and Conditions -->
  <div class="form-group terms">
    <input v-model="form.agree_terms" type="checkbox" required />
    <label>
      I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a> of TriptoCARAGA.
    </label>
  </div>

  <!-- Submit Button -->
  <button type="submit" class="submit-button">Submit</button>
</form>

  
    </div>
  </div>
</template>


<style scoped>
/* General Styles */
body {
  font-family: Arial, sans-serif;
  background-color: #f9f9f9;
  margin: 0;
  padding: 0;
}

.merchant-signup {
  background-color: #ffffff;
  max-width: 1100px;
  margin: 40px auto;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.container {
  display: flex;
  flex-direction: column;
  gap: 40px;
}

/* Header */
.title {
  text-align: center;
  font-size: 30px;
  font-weight: bold;
  color: #00c200;
  margin-bottom: 20px;
}

/* Form Layout */
form {
  display: grid;
  grid-template-columns: 1fr 1fr; /* Two columns */
  gap: 40px;
}

/* Form Sections */
.form-section {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Form Group */
.form-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

label {
  font-weight: bold;
  font-size: 14px;
  color: #333;
}

input,
select,
textarea {
  width: 100%;
  padding: 12px;
  font-size: 14px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

textarea {
  resize: vertical;
  height: 80px;
}

/* File Upload */
input[type="file"] {
  padding: 15px;
  border: 1px dashed #ccc;
  background-color: #f7f7f7;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
}

input[type="file"]:hover {
  border-color: #00c200;
}

/* Terms and Submit Button */
.terms {
  grid-column: span 2; /* Span across both columns */
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.terms input {
  margin-right: 10px;
}

.terms a {
  color: #00c200;
  text-decoration: none;
}

.terms a:hover {
  text-decoration: underline;
}

.submit-button {
  grid-column: span 2; /* Center across the form */
  width: 50%;
  margin: 20px auto;
  padding: 15px;
  font-size: 16px;
  background-color: #00c200;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-transform: uppercase;
  text-align: center;
}

.submit-button:hover {
  background-color: #009900;
}

</style>

