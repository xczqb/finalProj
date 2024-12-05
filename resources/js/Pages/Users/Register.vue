<script setup>
import Container from '../../Components/Container.vue'
import Title from '../../Components/Title.vue'
import TextLink from '../../Components/TextLink.vue'
import InputField from '../../Components/InputField.vue'
import PrimaryBtn from '../../Components/PrimaryBtn.vue'
import ErrorMessages from '../../Components/ErrorMessages.vue'
import { Head } from "@inertiajs/vue3"; // Import Head from Inertia.js


import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name:"",
    email:"",
    password:"",
    password_confirmation:"",

});

const submit = () => {
    form.post(route('user.register'), {
        onFinish: () => form.reset('password', "password_confirmation")
    })
}

</script>


<template>
    <Head title="- Register"/>
    
    
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Register a new Account</Title>
            <p>Already have an account? <TextLink routeName="user.login" label="Login" /></p>
        </div>

        <!-- Error Messages -->
        <ErrorMessages :errors="form.errors"/>
        <form @submit.prevent="submit" class="space-y-7">
            <InputField label="Name" icon="user" v-model="form.name"/>
            <InputField label="Email" icon="envelope" v-model="form.email"/>
            <InputField label="Password" type="password" icon="key" v-model="form.password"/>
            <InputField label="ConfirmPassword" type="password" icon="key" v-model="form.password_confirmation"/>

            <p class="text-slate-500 text-sm dark:text-slate-400">
                By creating an account, you agree to our Terms of
                Service and Policy.
            </p>
            <PrimaryBtn :disabled="form.processing">Register</PrimaryBtn>
        </form>
    </Container>
</template>

