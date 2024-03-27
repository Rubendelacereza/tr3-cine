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
      <select v-model="selectedCategory" class="category-select">
        <option value="">Todas las categorías</option>
        <option v-for="category in categories" :key="category">{{ category }}</option>
      </select>
    </div>
    <div class="movies-grid">
      <div class="movie-card" v-for="pelicula in filteredPeliculas" :key="pelicula.id">
        <img :src="pelicula.imagen_url" :alt="pelicula.titulo" class="movie-image" />
        <div class="movie-info">
          <h2 class="movie-title">{{ pelicula.titulo }}</h2>
          <p class="movie-duration">Duración: {{ pelicula.duracion }}</p>
          <p class="movie-rating">Clasificación: {{ pelicula.clasificacion }}</p>
          <nuxt-link :to="`/ComprarEntradas/${pelicula.id}`" class="buy-ticket-button">Comprar Entradas</nuxt-link>
        </div>
      </div>
    </div>
    <nuxt-link to="/RegisterScreen" class="register-button">Register</nuxt-link>
    <nuxt-link to="/LoginScreen" class="login-button">Login</nuxt-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      peliculas: [],
      selectedCategory: '',
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
  async mounted() {
    try {
      const res = await fetch('http://127.0.0.1:8000/api/peliculas');
      this.peliculas = await res.json();
    } catch (error) {
      console.error('Error al obtener las películas', error);
    }
  },
};
</script>

<style scoped>
.container {
  width: 80%;
  margin: auto;
  background-color: #1a1a1a;
}

.header {
  background-color: #FF4081;
  padding: 1em;
}

.header-title {
  margin: 0;
  font-size: 2em;
  color: white;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.header-nav {
  margin-top: 1em;
}

.header-nav-list {
  list-style: none;
  padding: 0;
  display: flex;
  justify-content: center;
}

.header-nav-item {
  margin: 0 1em;
}

.header-nav-link {
  color: white;
  text-decoration: none;
  font-size: 1.2em;
}

.title {
  text-align: center;
  margin-bottom: 2em;
  font-size: 2.5em;
  color: #FF4081;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.category-filter {
  text-align: center;
  margin-bottom: 2em;
}

.category-select {
  padding: 0.5em 1em;
  font-size: 1em;
  border: 2px solid #FF4081;
  border-radius: 5px;
  background-color: transparent;
  color: #FF4081;
}

.movies-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 2em;
}

.movie-card {
  border: 2px solid #FF4081;
  border-radius: 10px;
  overflow: hidden;
  background-color: #000;
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
}

.movie-info {
  padding: 1em;
  background-color: #000;
}

.movie-title {
  margin: 0;
  font-size: 1.5em;
  font-weight: bold;
  color: #FF4081;
}

.movie-duration,
.movie-rating {
  margin: 0.5em 0;
  color: #FF4081;
}

.buy-ticket-button {
  display: inline-block;
  margin-top: 1em;
  padding: 0.5em 1em;
  background-color: #FF4081;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.buy-ticket-button:hover {
  background-color: #FF0055;
}

.register-button,
.login-button {
  display: inline-block;
  margin-top: 1em;
  padding: 0.5em 1em;
  background-color: #FF4081;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.register-button:hover,
.login-button:hover {
  background-color: #FF0055;
}
</style>
