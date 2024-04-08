import { defineStore } from 'pinia';

export const useMoviesStore = defineStore({
  id: 'movies',
  state: () => ({
    movies: [],
  }),
  actions: {
    async fetchMovies() {
      try {
        // Aquí se simula una llamada a una API para obtener películas
        const response = await fetch('http://ejemplo.com/api/movies');
        const data = await response.json();
        this.movies = data.movies; // Actualiza el estado con las películas obtenidas
      } catch (error) {
        console.error('Error al obtener las películas:', error);
      }
    },
    // Otras acciones relacionadas con las películas
  },
});
