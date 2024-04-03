<template>
    <div class="container">
      <header class="header">
        <h1 class="header-title">Administrar Películas</h1>
      </header>
      <div class="buttons">
        <button @click="mostrarFormularioInsertar">Insertar Película</button>
        <button @click="obtenerPeliculas">Mostrar Películas</button>
      </div>
      <div v-if="mostrarForm">
        <!-- Formulario de inserción de película -->
        <form @submit.prevent="insertarPelicula">
          <input type="text" v-model="nuevaPelicula.titulo" placeholder="Título">
          <input type="text" v-model="nuevaPelicula.imagen_url" placeholder="URL de la imagen">
          <input type="number" v-model="nuevaPelicula.duracion" placeholder="Duración">
          <input type="number" v-model="nuevaPelicula.clasificacion" placeholder="Clasificación">
          <input type="text" v-model="nuevaPelicula.categoria" placeholder="Categoría">
          <textarea v-model="nuevaPelicula.sinopsis" placeholder="Sinopsis"></textarea>
          <input type="text" v-model="nuevaPelicula.trailer_url" placeholder="URL del tráiler">
          <button type="submit">Insertar</button>
        </form>
      </div>
      <div v-else>
        <!-- Lista de películas -->
        <ul>
          <li v-for="pelicula in peliculas" :key="pelicula.id">
            {{ pelicula.titulo }} - <button @click="eliminarPelicula(pelicula.id)">Eliminar</button>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        peliculas: [],
        mostrarForm: false,
        nuevaPelicula: {
          titulo: '',
          imagen_url: '',
          duracion: 0,
          clasificacion: 0,
          categoria: '',
          sinopsis: '',
          trailer_url: ''
        }
      };
    },
    methods: {
      async insertarPelicula() {
        try {
          // Realizar una petición POST para insertar la nueva película
          await fetch('http://localhost:8000/api/peliculas', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(this.nuevaPelicula)
          });
          // Limpiar el formulario y mostrar un mensaje de éxito
          this.nuevaPelicula = {
            titulo: '',
            imagen_url: '',
            duracion: 0,
            clasificacion: 0,
            categoria: '',
            sinopsis: '',
            trailer_url: ''
          };
          alert('Película insertada correctamente');
        } catch (error) {
          console.error('Error al insertar la película:', error);
          alert('Error al insertar la película');
        }
      },
      async obtenerPeliculas() {
        try {
          // Realizar una petición GET para obtener todas las películas
          const res = await fetch('http://localhost:8000/api/peliculas');
          this.peliculas = await res.json();
        } catch (error) {
          console.error('Error al obtener las películas:', error);
          alert('Error al obtener las películas');
        }
      },
      async eliminarPelicula(id) {
        try {
          // Realizar una petición DELETE para eliminar la película
          await fetch(`http://localhost:8000/api/peliculas/${id}`, {
            method: 'DELETE'
          });
          // Actualizar la lista de películas después de eliminar
          await this.obtenerPeliculas();
          alert('Película eliminada correctamente');
        } catch (error) {
          console.error('Error al eliminar la película:', error);
          alert('Error al eliminar la película');
        }
      },
      mostrarFormularioInsertar() {
        this.mostrarForm = true;
      }
    }
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
  }
  
  .header {
    background-color: #0e1634;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .header-title {
    margin: 0;
    font-size: 2.5em;
    color: #ffffff;
  }
  
  .buttons {
    margin-bottom: 20px;
  }
  
  .buttons button {
    margin-right: 10px;
    padding: 5px 10px;
    background-color: #ff4081;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  ul {
    list-style: none;
    padding: 0;
  }
  
  li {
    margin-bottom: 10px;
  }
  
  li button {
    padding: 3px 6px;
    background-color: #ff4081;
    color: #ffffff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
  </style>
  