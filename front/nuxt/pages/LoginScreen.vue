<template>
    <div class="container">
      <h1>Iniciar sesión</h1>
      <form @submit.prevent="loginUser" class="form">
        <!-- Campos del formulario -->
        <input type="email" v-model="form.correo" placeholder="Correo electrónico" required class="form-input">
        <input type="password" v-model="form.contraseña" placeholder="Contraseña" required class="form-input">
        <button type="submit" class="btn">Iniciar sesión</button>
      </form>
    </div>
  </template>
  
  <script>
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
            alert('Inicio de sesión exitoso');
            // Redireccionar a la página de listado
            await this.$router.push('/listado');
          } else {
            const data = await response.json();
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
  
  .form {
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .form-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .btn:hover {
    background-color: #0056b3;
  }
  </style>
  