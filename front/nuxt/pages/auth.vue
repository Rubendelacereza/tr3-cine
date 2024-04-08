<template>
    <div class="container">
      <h1 v-if="isLoginScreen" class="title">Iniciar sesión</h1>
      <h1 v-else>Registro de Usuario</h1>
      <form @submit.prevent="handleSubmit" class="form">
        <!-- Campos del formulario -->
        <template v-if="isLoginScreen">
          <div class="form-group">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" id="correo" v-model="form.correo" required class="form-input">
          </div>
          <div class="form-group">
            <label for="contraseña" class="form-label">Contraseña</label>
            <input type="password" id="contraseña" v-model="form.contraseña" required class="form-input">
          </div>
          <button type="submit" class="btn">Iniciar sesión</button>
        </template>
        <template v-else>
          <input type="text" v-model="form.nombre" placeholder="Nombre" required class="form-input">
          <input type="text" v-model="form.apellido" placeholder="Apellido" required class="form-input">
          <input type="text" v-model="form.telefono" placeholder="Teléfono" required class="form-input">
          <input type="email" v-model="form.correo" placeholder="Correo electrónico" required class="form-input">
          <input type="password" v-model="form.contraseña" placeholder="Contraseña" required class="form-input">
          <button type="submit" class="btn">Registrarse</button>
        </template>
      </form>
    </div>
  </template>
  
  <script>
  import { defineComponent, ref } from 'vue';
  import { useRouter } from 'vue-router';
  import { useAuthStore } from '../stores/auth';
  
  export default defineComponent({
    setup() {
      const router = useRouter();
      const authStore = useAuthStore();
      const isLoginScreen = ref(true);
      const form = ref({
        nombre: '',
        apellido: '',
        telefono: '',
        correo: '',
        contraseña: ''
      });
  
      const handleSubmit = async () => {
        try {
          let response;
          if (isLoginScreen.value) {
            response = await fetch('http://localhost:8000/api/login', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify(form.value),
            });
          } else {
            response = await fetch('http://localhost:8000/api/register', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify(form.value),
            });
          }
          if (response.ok) {
            if (isLoginScreen.value) {
              alert('Inicio de sesión exitoso');
              await router.push('/listado');
            } else {
              alert('Usuario registrado con éxito');
            }
          } else {
            const data = await response.json();
            alert('Error: ' + data.message);
          }
        } catch (error) {
          console.error('Error:', error);
          alert('Error. Consulta la consola para más detalles.');
        }
      };
  
      const toggleForm = () => {
        isLoginScreen.value = !isLoginScreen.value;
      };
  
      return {
        isLoginScreen,
        form,
        handleSubmit,
        toggleForm
      };
    }
  });
  </script>
  
  <style scoped>
  .container {
    max-width: 400px;
    margin: 0 auto;
  }
  
  .title {
    color: #000;
    text-align: center;
  }
  
  .form {
    padding: 20px;
    border: 1px solid #000;
    border-radius: 5px;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-label {
    display: block;
    margin-bottom: 5px;
    color: #000;
  }
  
  .form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #000;
    border-radius: 5px;
  }
  
  .btn {
    background-color: #FF4081;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .btn:hover {
    background-color: #FF0056;
  }
  </style>
  ../stores/authStore../store/auth