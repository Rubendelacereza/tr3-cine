<template>
    <div class="administrar-sesiones">
      <h2>Gestión de Sesiones</h2>
      <button @click="mostrarFormulario">Insertar Sesión</button>
      <button @click="obtenerSesiones">Mostrar Sesiones</button>
  
      <!-- Formulario de inserción de sesiones -->
      <form v-if="mostrarInsertar" @submit.prevent="insertarSesion">
        <div class="form-group">
          <label for="fecha">Fecha:</label>
          <input type="date" id="fecha" v-model="fecha" required>
        </div>
        <div class="form-group">
          <label for="hora">Hora:</label>
          <input type="time" id="hora" v-model="hora" required>
        </div>
        <div class="form-group">
          <label for="pelicula">Película:</label>
          <select id="pelicula" v-model="peliculaSeleccionada" required>
            <option v-for="pelicula in peliculas" :key="pelicula.id" :value="pelicula.id">{{ pelicula.titulo }}</option>
          </select>
        </div>
        <button type="submit">Insertar Sesión</button>
      </form>
  
      <!-- Lista de sesiones -->
      <div v-if="mostrarSesiones">
        <h3>Sesiones:</h3>
        <div v-for="sesion in sesiones" :key="sesion.id" class="sesion">
          <div>Fecha: {{ sesion.fecha }}</div>
          <div>Hora: {{ sesion.hora }}</div>
          <div v-if="sesion.pelicula"> <!-- Agregar esta condición -->
            <div>Título de la película: {{ sesion.pelicula.titulo }}</div>
            <img :src="sesion.pelicula.imagen_url" alt="Imagen de la película" style="max-width: 200px;">
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        fecha: '',
        hora: '',
        peliculaSeleccionada: null,
        peliculas: [],
        sesiones: [],
        mostrarInsertar: false,
        mostrarSesiones: false
      };
    },
    methods: {
      async insertarSesion() {
        // Lógica para insertar la sesión
        console.log('Fecha:', this.fecha);
        console.log('Hora:', this.hora);
        console.log('ID de la película seleccionada:', this.peliculaSeleccionada);
      },
      async obtenerPeliculas() {
        try {
          const response = await fetch('http://localhost:8000/api/peliculas');
          if (response.ok) {
            this.peliculas = await response.json();
          } else {
            console.error('Error al obtener las películas:', response.statusText);
          }
        } catch (error) {
          console.error('Error al obtener las películas:', error);
        }
      },
      async obtenerSesiones() {
        try {
          const response = await fetch('http://localhost:8000/api/sesiones');
          if (response.ok) {
            this.sesiones = await response.json();
            console.log('Sesiones obtenidas:', this.sesiones); // Agregar este console.log
          } else {
            console.error('Error al obtener las sesiones:', response.statusText);
          }
        } catch (error) {
          console.error('Error al obtener las sesiones:', error);
        }
      },
      mostrarFormulario() {
        this.mostrarInsertar = !this.mostrarInsertar;
        this.mostrarSesiones = false; // Ocultar la lista de sesiones
      },
      async mostrarSesiones() {
        await this.obtenerSesiones(); // Obtener las sesiones al mostrar
        this.mostrarSesiones = true;
        this.mostrarInsertar = false; // Ocultar el formulario de inserción
      }
    },
    mounted() {
      this.obtenerPeliculas(); // Obtener las películas al cargar el componente
    }
  };
  </script>
  
  <style scoped>
  .administrar-sesiones {
    max-width: 600px;
    margin: 0 auto;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    font-weight: bold;
  }
  
  input[type="date"],
  input[type="time"],
  select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  
  button {
    margin-right: 10px;
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #2980b9;
  }
  
  .sesion {
    margin-top: 20px;
    border: 1px solid #ccc;
    padding: 10px;
  }
  </style>
  