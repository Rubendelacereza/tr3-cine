<template>
  <div class="container">
    <h1 class="title">Iniciar sesión</h1>
    <form @submit.prevent="loginUser" class="form">
      <!-- Campos del formulario -->
      <div class="form-group">
        <label for="correo" class="form-label">Correo electrónico</label>
        <input type="email" id="correo" v-model="form.correo" required class="form-input">
      </div>
      <div class="form-group">
        <label for="contraseña" class="form-label">Contraseña</label>
        <input type="password" id="contraseña" v-model="form.contraseña" required class="form-input">
      </div>
      <button type="submit" class="btn">Iniciar sesión</button>
    </form>
  </div>
</template>

<script>
import { useStore } from '../store/index.js';
export default {
  data() {
    return {
      form: {
        correo: '',
        contraseña: ''
      }
    };
  },
  methods: {
    async loginUser() {
      try {
        const response = await fetch('http://localhost:8000/api/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.form),
        });
        if (response.ok) {
          const data = await response.json(); // Obtener los datos de la respuesta
          const store = useStore(); // Obtener la instancia de la tienda
          store.setUser(data); // Establecer el usuario en la tienda Vuex
          localStorage.setItem('user', JSON.stringify(data)); // Guardar el usuario en el almacenamiento local
          alert('Inicio de sesión exitoso');
          // Redireccionar a la página de listado
          await this.$router.push('/listadoPeliculas');
        } else {
          const data = await response.json(); // Obtener los datos de la respuesta
          alert('Error al iniciar sesión: ' + data.message);
        }
      } catch (error) {
        console.error('Error al iniciar sesión:', error);
        alert('Error al iniciar sesión. Consulta la consola para más detalles.');
      }
    }
  }
};
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
