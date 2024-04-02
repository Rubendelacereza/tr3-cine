<template>
    <div class="movie-card" @click="showDetails">
      <img :src="pelicula.imagen_url" :alt="pelicula.titulo" class="movie-image" />
      <div v-if="showPanel" class="movie-details-panel">
        <div class="panel-left">
          <img :src="pelicula.imagen_pequena_url" :alt="pelicula.titulo" class="movie-thumbnail" />
          <p class="movie-sinopsis">{{ pelicula.sinopsis }}</p>
        </div>
        <div class="panel-right">
          <iframe width="100%" height="auto" :src="pelicula.trailer_url" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      pelicula: Object
    },
    data() {
      return {
        showPanel: false
      };
    },
    methods: {
      showDetails() {
        this.showPanel = true;
      }
    }
  };
  </script>
  
  <style scoped>
  /* Estilos para el panel de detalles */
  .movie-details-panel {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .panel-left {
    flex: 1;
    padding: 20px;
  }
  
  .panel-right {
    flex: 1;
    padding: 20px;
  }
  
  .movie-thumbnail {
    width: 100px;
    height: auto;
  }
  
  .movie-sinopsis {
    color: #fff;
  }
  
  .movie-card {
    border-radius: 10px;
    overflow: hidden;
    background-color: #0e1634;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease;
    cursor: pointer;
    position: relative;
  }
  
  .movie-card:hover {
    transform: scale(1.05);
  }
  
  .movie-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
  }
  </style>
  