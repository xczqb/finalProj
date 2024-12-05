<template>
    <footer class="bg-lime-50 dark:bg-lime-100 text-slate-900 dark:text-slate-800 py-8">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="font-bold text-lg">About TriptoCaraga</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="hover:underline">About us</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg">Partnerships</h3>
                <ul class="mt-4 space-y-2">
                    <li><a :href="route('merchant.home')" class="hover:underline">Become a Merchant</a></li>
                    <li><a :href="route('user.home')" class="hover:underline">Login as User</a></li>
                    <!-- <li>
                        <a :href="route('merchant.register')" class="hover:underline">Merchant Sign up</a>
                    </li>
                    <li>
                        <a :href="route('merchant.login')" class="hover:underline">Merchant Log in</a>
                    </li> -->
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg">Terms of use</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="hover:underline">General terms of use</a></li>
                    <li><a href="#" class="hover:underline">Privacy policy</a></li>
                    <li><a href="#" class="hover:underline">Cookie policy</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-lime-400 text-center text-slate-900 dark:text-slate-800 py-4 mt-8">
            <p>2024 TriptoCARAGA | All rights reserved.</p>
        </div>
    </footer>
</template>

<script setup>
// No additional logic for now; static component
</script>

<style scoped>
footer {
    font-family: Arial, sans-serif;
}
</style>
