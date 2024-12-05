<template>
    <button @click="$inertia.visit(route)" class="btn-register">
      Register
    </button>
  </template>
  
  <script>
  export const RegisterButton = {
    props: {
      route: {
        type: String,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  .btn-register {
    padding: 10px 20px;
    background-color: #2ecc71;
    color: #fff;
    border: none;
    cursor: pointer;
  }
  </style>
  