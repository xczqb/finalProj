<script setup>
import NavLink from "../Components/NavLink.vue"; // Import NavLink component
import Footer from "../Components/Footer.vue"; // Import Footer component
import { usePage, Link } from "@inertiajs/vue3"; // Import Link for Inertia routing
import { computed, ref } from "vue";

const page = usePage();

// Compute user information from Inertia's shared props
const user = computed(() => page.props.auth?.user);

const show = ref(false); // State for controlling dropdown visibility
</script>

<template>
  <!-- Overlay -->
  <div v-show="show" @click="show = false" class="fixed inset-0 z-40"></div>

  <!-- Header -->
  <header class="bg-slate-800 text-white">
    <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">
      <!-- User Home Link -->
      <NavLink routeName="user.home" componentName="Users/Home">
        User Home
      </NavLink>
     
      <!-- Authenticated User -->
      <div v-if="user" class="flex items-center gap-4">
      
        <!-- Display Profile Name -->
        <div class="flex items-center gap-2">
          <p class="text-sm font-semibold">{{ user.name }}</p>
        </div>

        <!-- Dropdown for Authenticated User -->
        <div class="relative">
          <div
            @click="show = !show"
            class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-slate-700 cursor-pointer"
            :class="{ 'bg-slate-700': show }"
          >
            <i class="fa-solid fa-angle-down"></i>
          </div>

          <!-- User Dropdown Menu -->
          <div
            v-show="show"
            @click="show = false"
            class="absolute z-50 top-16 right-0 bg-slate-800 text-white rounded-lg border-slate-300 border overflow-hidden w-40"
          >
            <Link
              class="block w-full px-6 py-3 hover:bg-slate-700 text-left"
              :href="route('user.dashboard')"
            >
              Dashboard
            </Link>
            <Link
                class="block w-full px-6 py-3 hover:bg-slate-700 text-left"
                :href="route('user.logout')"
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
          routeName="user.register"
          componentName="Users/Register"
        >
          Register
        </NavLink>
        <NavLink
          routeName="user.login"
          componentName="Users/Login"
          
        >
          Login
        </NavLink>
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main class="p-6">
    <slot />
    <Footer />
  </main>
</template>
