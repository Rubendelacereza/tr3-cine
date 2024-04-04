<template>
  <div class="container">
    <header class="header">
      <h1 class="header-title">Administrar Películas</h1>
    </header>
    <div class="buttons">
      <button @click="mostrarFormularioInsertar" class="button insert-button">Insertar Película</button>
      <button @click="obtenerPeliculas" class="button show-button">Mostrar Películas</button>
    </div>
    <div v-if="mostrarForm">
      <!-- Formulario de inserción de película -->
      <form @submit.prevent="insertarPelicula" class="form">
        <input type="text" v-model="nuevaPelicula.titulo" placeholder="Título" required>
        <input type="text" v-model="nuevaPelicula.imagen_url" placeholder="URL de la imagen" required>
        <input type="number" v-model="nuevaPelicula.duracion" placeholder="Duración (minutos)" required>
        <div class="rating">
          <label for="rating">Clasificación:</label>
          <div class="stars">
            <span v-for="star in 5" :key="star" @click="seleccionarClasificacion(star)" :class="{ 'selected': star <= nuevaPelicula.clasificacion }">&#9733;</span>
          </div>
          <input type="hidden" v-model="nuevaPelicula.clasificacion">
        </div>
        <input type="text" v-model="nuevaPelicula.categoria" placeholder="Categoría" required>
        <textarea v-model="nuevaPelicula.sinopsis" placeholder="Sinopsis" required></textarea>
        <input type="text" v-model="nuevaPelicula.trailer_url" placeholder="URL del tráiler" required>
        <div class="form-buttons">
          <button type="submit">Insertar</button>
          <button type="button" @click="cancelarInsercion">Cancelar</button>
        </div>
      </form>
    </div>
    <div v-else>
      <!-- Lista de películas -->
      <ul v-if="peliculas.length > 0" class="movie-list">
        <li v-for="pelicula in peliculas" :key="pelicula.id" class="movie-item">
          <img :src="pelicula.imagen_url" :alt="pelicula.titulo" class="movie-image">
          <div class="movie-info">
            <h3 class="movie-title">{{ pelicula.titulo }}</h3>
            <p class="movie-details">Duración: {{ pelicula.duracion }} minutos</p>
            <p class="movie-details">Clasificación: {{ pelicula.clasificacion }}</p>
            <p class="movie-details">Categoría: {{ pelicula.categoria }}</p>
            <p class="movie-synopsis">{{ pelicula.sinopsis }}</p>
            <div class="movie-actions">
              <a :href="pelicula.trailer_url" target="_blank" class="trailer-link">Ver tráiler</a>
              <button @click="eliminarPelicula(pelicula.id)" class="delete-button">Eliminar</button>
            </div>
          </div>
        </li>
      </ul>
      <p v-else>No hay películas disponibles.</p>
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
    seleccionarClasificacion(valor) {
      this.nuevaPelicula.clasificacion = valor;
    },
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
          clasificacion: '',
          categoria: '',
          sinopsis: '',
          trailer_url: ''
        };
        alert('Película insertada correctamente');
        this.mostrarForm = false; // Ocultar el formulario después de la inserción
        await this.obtenerPeliculas(); // Actualizar la lista de películas después de la inserción
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
    },
    cancelarInsercion() {
      this.mostrarForm = false;
      this.nuevaPelicula = {
        titulo: '',
        imagen_url: '',
        duracion: 0,
        clasificacion: '',
        categoria: '',
        sinopsis: '',
        trailer_url: ''
      };
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
  padding: 10px 20px;
  background-color: #ff4081;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.form {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.form input,
.form select,
.form textarea {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.form-buttons {
  grid-column: span 2;
  display: flex;
  justify-content: space-between;
}

.movie-list {
  list-style: none;
  padding: 0;
}

.movie-item {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.movie-image {
  width: 120px;
  margin-right: 20px;
}

.movie-title {
  margin: 0;
  font-size: 1.5em;
}

.movie-details {
  margin: 5px 0;
}

.movie-synopsis {
  margin-top: 10px;
}

.trailer-link {
  padding: 5px 10px;
  background-color: #ff4081;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
}

.delete-button {
  padding: 5px 10px;
  background-color: #ff0000;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.stars {
  display: inline-block;
  font-size: 24px;
}
.stars span {
  cursor: pointer;
  color: #ddd; /* Color de estrellas no seleccionadas */
}
.stars .selected {
  color: #ffd700; /* Color de estrellas seleccionadas */
}
</style>
