<template>
  <div class="container">
    <h1 class="title">Listado de Películas</h1>
    <div class="category-filter">
      <select v-model="selectedCategory">
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
    <nuxt-link to="/RegisterScreen" class="Register-button">Register</nuxt-link>
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
}

.title {
  text-align: center;
  margin-bottom: 2em;
}

.movies-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 1em;
}

.movie-card {
  border: 1px solid #ccc;
  border-radius: 10px;
  overflow: hidden;
}

.movie-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.movie-info {
  padding: 1em;
}

.movie-title {
  margin: 0;
  font-size: 1.2em;
  font-weight: bold;
}

.movie-duration,
.movie-rating {
  margin: 0.5em 0;
}

.buy-ticket-button {
  display: inline-block;
  margin-top: 1em;
  padding: 0.5em 1em;
  background-color: #007BFF;
  color: white;
  text-decoration: none;
  border-radius: 5px;
}

.buy-ticket-button:hover {
  background-color: #0056b3;
}
</style>
