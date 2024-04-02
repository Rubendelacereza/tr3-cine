<template>
  <div class="container">
    <header class="header">
      <h1 class="header-title">CINE</h1>
      <nav class="header-nav">
        <ul class="header-nav-list">
          <li class="header-nav-item"><a href="#" class="header-nav-link">Inicio</a></li>
          <li class="header-nav-item"><a href="#" class="header-nav-link">Películas</a></li>
          <li class="header-nav-item"><a href="#" class="header-nav-link">Contacto</a></li>
        </ul>
      </nav>
    </header>
    <h1 class="title">Listado de Películas</h1>
    <div class="category-filter">
      <label for="category-select" class="category-label">Filtrar por Categoría:</label>
      <select id="category-select" v-model="selectedCategory" class="category-select">
        <option value="">Todas las categorías</option>
        <option v-for="category in categories" :key="category">{{ category }}</option>
      </select>
    </div>
    <div class="movies-grid">
      <div class="movie-card" v-for="pelicula in filteredPeliculas" :key="pelicula.id">
        <img :src="pelicula.imagen_url" :alt="pelicula.titulo" class="movie-image" @click="mostrarDetallesPelicula(pelicula)" />
        <div class="movie-info">
          <h2 class="movie-title">{{ pelicula.titulo }}</h2>
          <p class="movie-duration">Duración: {{ pelicula.duracion }} min</p>
          <p class="movie-rating">Clasificación: {{ pelicula.clasificacion }}</p>
          <nuxt-link :to="`/ComprarEntradas/${pelicula.id}`" class="buy-ticket-button">Comprar Entradas</nuxt-link>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="modal-background">
      <div class="modal">
        <span class="close" @click="cerrarDetallesPelicula">&times;</span>
        <div class="modal-left">
          <h2 class="modal-title">{{ peliculaSeleccionada.titulo }}</h2>
          <img :src="peliculaSeleccionada.imagen_url" :alt="peliculaSeleccionada.titulo" class="modal-image" />
          <p class="modal-synopsis">{{ peliculaSeleccionada.sinopsis }}</p>
        </div>
        <div class="modal-right">
          <iframe width="100%" height="100%" :src="peliculaSeleccionada.trailer_url" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="auth-buttons">
      <nuxt-link to="/RegisterScreen" class="auth-button">Registro</nuxt-link>
      <nuxt-link to="/LoginScreen" class="auth-button">Iniciar Sesión</nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      peliculas: [],
      selectedCategory: '',
      peliculaSeleccionada: null,
      showModal: false
    };
  },
  computed: {
    filteredPeliculas() {
      return this.selectedCategory ? this.peliculas.filter(pelicula => pelicula.categoria === this.selectedCategory) : this.peliculas;
    },
    categories() {
      return [...new Set(this.peliculas.map(pelicula => pelicula.categoria))];
    }
  },
  methods: {
    async obtenerPeliculas() {
      try {
        const res = await fetch('http://127.0.0.1:8000/api/peliculas');
        this.peliculas = await res.json();
      } catch (error) {
        console.error('Error al obtener las películas', error);
      }
    },
    mostrarDetallesPelicula(pelicula) {
      this.peliculaSeleccionada = pelicula;
      this.showModal = true;
    },
    cerrarDetallesPelicula() {
      this.showModal = false;
    }
  },
  mounted() {
    this.obtenerPeliculas();
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

.header-nav-list {
  list-style: none;
  padding: 0;
  display: flex;
}

.header-nav-item {
  margin-right: 20px;
}

.header-nav-link {
  color: #ffffff;
  text-decoration: none;
  font-size: 1.2em;
}

.title {
  text-align: center;
  margin-bottom: 20px;
  font-size: 2.5em;
  color: #ff4081;
}

.category-filter {
  text-align: center;
  margin-bottom: 20px;
}

.category-label {
  font-size: 1.2em;
  color: #0e1634;
  margin-right: 10px;
}

.category-select {
  padding: 10px;
  font-size: 1em;
  border: 2px solid #ff4081;
  border-radius: 5px;
  background-color: transparent;
  color: #0e1634;
}

.movies-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 20px;
}

.movie-card {
  border-radius: 10px;
  overflow: hidden;
  background-color: #0e1634;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  transition: transform 0.3s ease;
}

.movie-card:hover {
  transform: scale(1.05);
}

.movie-image {
  width: 100%;
  height: 300px;
  object-fit: cover;
  cursor: pointer;
}

.movie-info {
  padding: 20px;
}

.movie-title {
  margin: 0;
  font-size: 1.5em;
  font-weight: bold;
  color: #ffffff;
}

.movie-duration,
.movie-rating {
  margin: 10px 0;
  color: #ff4081;
}

.buy-ticket-button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #ff4081;
  color: #ffffff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.buy-ticket-button:hover {
  background-color: #ff0055;
}

.auth-buttons {
  text-align: center;
  margin-top: 20px;
}

.auth-button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #ff4081;
  color: #ffffff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
  margin-right: 10px;
}

.auth-button:hover {
  background-color: #ff0055;
}

/* Modal */
.modal-background {
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal {
  background-color: #fefefe;
  padding: 20px;
  border-radius: 10px;
  max-width: 80%;
  max-height: 80%;
  overflow: auto;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
}

.modal-left {
  float: left;
  width: 50%;
}

.modal-right {
  float: right;
  width: 50%;
}

.modal-title {
  margin-top: 0;
  font-size: 1.2em;
  color: #333;
}

.modal-image {
  width: 50%;
  height: auto;
}

.modal-synopsis {
  font-size: 1em;
  color: #333;
}

iframe {
  width: 100%;
  height: 100%;
}

/* Hide scrollbar */
.modal::-webkit-scrollbar {
  display: none;
}

.modal {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
</style>
