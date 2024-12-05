<script setup>
import NavLink from "../Components/NavLink.vue"; // Import NavLink component
import Footer from "../Components/Footer.vue"; // Import Footer component
import { usePage, Link } from "@inertiajs/vue3"; // Import Link for Inertia routing
import { computed, ref } from "vue";

const page = usePage();

// Compute merchant information from Inertia's shared props
const merchant = computed(() => page.props.auth?.merchant);

const show = ref(false); // State for controlling dropdown visibility
</script>

<template>
  <!-- Overlay -->
  <div v-show="show" @click="show = false" class="fixed inset-0 z-40"></div>

  <!-- Header -->
  <header class="bg-slate-800 text-white">
    <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">
      <!-- Merchant Home Link -->
      <NavLink routeName="merchant.home">Merchant Home</NavLink>
     
      <!-- Authenticated Merchant -->
      <div v-if="merchant" class="flex items-center gap-4">
      
        <!-- Display Profile Name -->
        <div class="flex items-center gap-2">
          <p class="text-sm font-semibold">{{ merchant.owner_name }}</p>
        </div>

        <!-- Dropdown for Authenticated Merchant -->
        <div class="relative">
          <div
            @click="show = !show"
            class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-slate-700 cursor-pointer"
            :class="{ 'bg-slate-700': show }"
          >
            <i class="fa-solid fa-angle-down"></i>
          </div>

          <!-- Merchant Dropdown Menu -->
          <div
            v-show="show"
            @click="show = false"
            class="absolute z-50 top-16 right-0 bg-slate-800 text-white rounded-lg border-slate-300 border overflow-hidden w-40"
          >
            <Link
              class="block w-full px-6 py-3 hover:bg-slate-700 text-left"
              :href="route('merchant.dashboard')"
            >
              Dashboard
            </Link>
            <Link
              class="block w-full px-6 py-3 hover:bg-slate-700 text-left"
              :href="route('merchant.logout')"
              method="post"
              as="button"
              >
              
              Logout
            </Link>
          </div>
        </div>
      </div>

      <!-- Guest Links -->
      <div v-else class="flex items-center gap-4">
        <NavLink
          routeName="merchant.register"
          componentName="Auth/Merchant/Register"
        >
          Register
        </NavLink>
        <NavLink
          routeName="merchant.login"
          componentName="Auth/Merchant/Login"
        >
          Login
        </NavLink>
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main class="p-6">
    <slot />
    <div v-if="!merchant">
    <Footer />
    
    </div>
  </main>
</template>

<style scoped>
/* Add custom styles if necessary */
</style>
