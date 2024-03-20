<template>
  <div class="container">
    <h1>Registro de Usuario</h1>
    <form @submit.prevent="registerUser" class="form">
      <!-- Campos del formulario -->
      <input type="text" v-model="form.nombre" placeholder="Nombre" required class="form-input">
      <input type="text" v-model="form.apellido" placeholder="Apellido" required class="form-input">
      <input type="text" v-model="form.telefono" placeholder="Teléfono" required class="form-input">
      <input type="email" v-model="form.correo" placeholder="Correo electrónico" required class="form-input">
      <input type="password" v-model="form.contraseña" placeholder="Contraseña" required class="form-input">
      <button type="submit" class="btn">Registrarse</button>
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
        correo: '',
        contraseña: ''
      }
    };
  },
  methods: {
    async registerUser() {
      try {
        const response = await fetch('http://localhost:8000/api/register', {
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
