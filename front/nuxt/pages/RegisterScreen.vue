<template>
    <div class="container">
      <h1>Registro de Usuario</h1>
      <form @submit.prevent="registerUser">
        <!-- Campos del formulario -->
        <input type="text" v-model="form.nombre" placeholder="Nombre" required>
        <input type="text" v-model="form.apellido" placeholder="Apellido" required>
        <input type="tel" v-model="form.telefono" placeholder="Teléfono" required>
        <input type="email" v-model="form.correo" name="correo" placeholder="Correo electrónico" required>
    <input type="password" v-model="form.contraseña" name="contraseña" placeholder="Contraseña" required>
    <button type="submit">Registrarse</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          nombre: '',
          apellido: '',
          telefono: '',
          email: '',
          password: ''
        }
      };
    },
    methods: {
      async registerUser() {
        try {
          const response = await fetch('/api/register', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(this.form),
          });
          if (response.ok) {
            alert('Usuario registrado con éxito');
            // Redireccionar a otra página después del registro si es necesario
          } else {
            const data = await response.json();
            alert('Error al registrar: ' + data.message);
          }
        } catch (error) {
          console.error('Error al registrar usuario:', error);
          alert('Error al registrar usuario. Consulta la consola para más detalles.');
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
  /* Estilos adicionales para el formulario */
  </style>
  