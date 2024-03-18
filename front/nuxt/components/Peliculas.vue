<!-- components/Peliculas.vue -->
<template>
  <div>
    <h1>Películas</h1>
    <ul>
      <li v-for="pelicula in peliculas" :key="pelicula.id">
        <NuxtLink :to="'/ComprarEntradas/' + pelicula.id">
          <h2>{{ pelicula.titulo }}</h2>
          <img :src="pelicula.imagen_url" :alt="pelicula.titulo" class="pelicula-image" />
          <p>{{ pelicula.duracion }}</p>
          <p>{{ pelicula.clasificacion }}</p>
        </NuxtLink>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      peliculas: [],
    };
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
