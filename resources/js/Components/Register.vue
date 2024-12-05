<script setup>
import Container from '../../../Components/User/Container.vue'
import Title from '../../../Components/User/Title.vue'
import TextLink from '../../../Components/User/TextLink.vue'
import InputField from '../../../Components/User/InputField.vue'
import PrimaryBtn from '../../../Components/User/PrimaryBtn.vue'
import ErrorMessages from '../../../Components/User/ErrorMessages.vue'

import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name:"",
    email:"",
    password:"",
    password_confirmation:"",

});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', "password_confirmation")
    })
}

</script>


<template>
    <Head title="- Register"/>
    
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Register a new Account</Title>
            <p>Already have an account? <TextLink routeName="login" label="Login" /></p>
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

