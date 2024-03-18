<template>
  <div class="container">
    <h1 class="title">Detalles de la Película</h1>
    <div class="movie-info">
      <h2>{{ pelicula.titulo }}</h2>
      <p>{{ pelicula.descripcion }}</p>
      <p>Duración: {{ pelicula.duracion }}</p>
      <p>Clasificación: {{ pelicula.clasificacion }}</p>
    </div>
    <div v-if="sesiones.length > 0">
      <h2>Sesiones</h2>
      <ul>
        <li v-for="sesion in sesiones" :key="sesion.id">
          <p>Fecha: {{ sesion.fecha }}</p>
          <p>Hora: {{ sesion.hora }}</p>
        </li>
      </ul>
    </div>
    <div v-else>
      <p>No hay sesiones disponibles para esta película.</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pelicula: {},
      sesiones: []
    };
  },
  async mounted() {
    const peliculaId = this.$route.params.id;
    try {
      const peliculaRes = await fetch(`http://127.0.0.1:8000/api/peliculas/${peliculaId}`);
      this.pelicula = await peliculaRes.json();
      
      const sesionesRes = await fetch(`http://127.0.0.1:8000/api/sesiones/${peliculaId}`);
      this.sesiones = await sesionesRes.json();
    } catch (error) {
      console.error('Error al obtener la película y sus sesiones', error);
    }
  }
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
.movie-info {
  margin-bottom: 2em;
}
</style>
