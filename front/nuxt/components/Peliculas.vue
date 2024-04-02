<template>
  <div>
    <h1>{{ pelicula.titulo }}</h1>
    <img :src="pelicula.imagen_url" :alt="pelicula.titulo" class="pelicula-image" />
    <p>Duración: {{ pelicula.duracion }}</p>
    <p>Clasificación: {{ pelicula.clasificacion }}</p>
    <!-- Aquí se añade el reproductor de video de YouTube -->
    <div class="trailer-container" v-if="pelicula.trailer_url">
      <iframe width="560" height="315" :src="getEmbeddedUrl(pelicula.trailer_url)" frameborder="0" allowfullscreen></iframe>
    </div>
    <NuxtLink to="/listadoPeliculas" class="back-link">← Volver al listado de películas</NuxtLink>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pelicula: {},
      apiKey: 'AIzaSyBOPgTvNZxSll6zizXqEsD56G9cHGbuVm8',
    };
  },
  async mounted() {
    const peliculaId = this.$route.params.id;
    try {
      const res = await fetch(`http://127.0.0.1:8000/api/peliculas/${peliculaId}`);
      this.pelicula = await res.json();
    } catch (error) {
      console.error('Error al obtener la película', error);
    }
  },
  methods: {
    // Método para obtener la URL embebida del trailer de YouTube
    getEmbeddedUrl(url) {
      const videoId = this.getVideoId(url);
      return `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    },
    // Método para obtener el ID del video de YouTube desde la URL
    getVideoId(url) {
      // Comprueba si la URL es válida y extrae el ID del video
      // Ejemplo de función para extraer el ID del video de YouTube
      // Debes implementar tu propia lógica para extraer el ID del video de la URL
      // Aquí se proporciona un ejemplo básico
      const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
      const match = url.match(regExp);
      if (match && match[2].length === 11) {
        return match[2];
      } else {
        console.error('URL de video de YouTube no válida');
        return null;
      }
    },
  },
};
</script>

<style scoped>
.pelicula-image {
  width: 100%;
  max-width: 400px;
  height: auto;
}

.trailer-container {
  margin-top: 20px;
}
</style>
