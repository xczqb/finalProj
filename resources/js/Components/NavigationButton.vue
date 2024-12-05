<template>
    <button @click="$inertia.visit(route)" class="btn-nav">
      {{ label }}
    </button>
  </template>
  
  <script>
  export const NavigationButton = {
    props: {
      route: {
        type: String,
        required: true,
      },
      label: {
        type: String,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  .btn-nav {
    padding: 10px 20px;
    background-color: #e67e22;
    color: #fff;
    border: none;
    cursor: pointer;
  }
  </style>
  