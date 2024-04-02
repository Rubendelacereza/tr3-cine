<template>
  <div class="movie-details">
    <h1 class="title">{{ pelicula.titulo }}</h1>
    <img :src="pelicula.imagen_url" :alt="pelicula.titulo" class="movie-image" />
    <div class="session-selection">
      <label for="session-select" class="label">Selecciona una sesión:</label>
      <select id="session-select" v-model="selectedSession" @change="obtenerButacas" class="select">
        <option v-for="sesion in sesiones" :key="sesion.id" :value="sesion.id" class="option">{{ sesion.fecha }}</option>
      </select>
    </div>
    <div class="butacas-container">
      <button
        v-for="butaca in butacas"
        :key="butaca.id"
        class="butaca-button"
        :class="{ 'butaca-seleccionada': butacasSeleccionadas.has(butaca.id), 'butaca-ocupada': butaca.ocupado }"
        @click="reservarButaca(butaca)"
      >
        <img :src="butaca.imagen_url" class="butaca-image" />
      </button>
    </div>
    <button @click="guardarButacas" class="guardar-button">Guardar</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pelicula: {},
      sesiones: [],
      selectedSession: null,
      butacas: [],
      butacasSeleccionadas: new Set(), // Conjunto para almacenar butacas seleccionadas
    };
  },
  async mounted() {
    await this.obtenerPelicula();
    await this.obtenerSesiones();
  },
  methods: {
    async obtenerPelicula() {
      try {
        const res = await fetch(`http://127.0.0.1:8000/api/peliculas/${this.$route.params.id}`);
        this.pelicula = await res.json();
      } catch (error) {
        console.error('Error al obtener la película', error);
      }
    },
    async obtenerSesiones() {
      try {
        const res = await fetch(`http://127.0.0.1:8000/api/sesiones/${this.$route.params.id}`);
        this.sesiones = await res.json();
      } catch (error) {
        console.error('Error al obtener las sesiones', error);
      }
    },
    async obtenerButacas() {
      try {
        const res = await fetch(`http://127.0.0.1:8000/api/sesiones/${this.selectedSession}/butacas`);
        let butacas = await res.json();
        // Modificar la ruta de la imagen para todas las butacas
        butacas = butacas.map(butaca => {
          return {
            ...butaca,
            imagen_url: 'https://cdn-icons-png.flaticon.com/512/24/24868.png'
          };
        });
        this.butacas = butacas;
      } catch (error) {
        console.error('Error al obtener las butacas', error);
      }
    },
    reservarButaca(butaca) {
      if (!butaca.ocupado) {
        if (this.butacasSeleccionadas.has(butaca.id)) {
          this.butacasSeleccionadas.delete(butaca.id); // Si ya está seleccionada, deseleccionarla
        } else {
          this.butacasSeleccionadas.add(butaca.id); // Si no está seleccionada, agregarla al conjunto
        }
      } else {
        console.log('La butaca ya está ocupada');
      }
    },
    async guardarButacas() {
      try {
        // Cambiar el estado de ocupado de las butacas seleccionadas
        const promises = Array.from(this.butacasSeleccionadas).map(async butacaId => {
          await fetch(`http://127.0.0.1:8000/api/butacas/${butacaId}`, {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ ocupado: 1 }), // Cambiar el estado de ocupado a 1
          });
        });
        await Promise.all(promises);
        
        // Redirigir al usuario a listadoPeliculas.vue
        this.$router.push('/listadoPeliculas');
      } catch (error) {
        console.error('Error al guardar las butacas', error);
      }
    },
  },
};
</script>

<style scoped>
.movie-details {
  padding: 20px;
  text-align: center;
}

.title {
  margin-bottom: 20px;
  font-size: 2.5em;
  color: #333;
}

.movie-image {
  width: 300px;
  height: auto;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.session-selection {
  margin-bottom: 20px;
}

.label {
  font-size: 1.2em;
  margin-right: 10px;
}

.select {
  padding: 10px;
  border-radius: 5px;
  border: 2px solid #333;
  font-size: 1em;
  background-color: #f8f8f8;
}
.button {
  background-color: transparent;
}

.option {
  font-size: 1em;
}

.butacas-container {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

.butaca-button {
  border: none;
  margin: 5px;
  padding: 0;
  cursor: pointer;
  background-color: transparent;
}

.butaca-image {
  width: 50px;
  height: 50px;
}

.butaca-seleccionada {
  background-color: #6bd454;
}

.butaca-ocupada {
  background-color: #ff4f4f;
}

.guardar-button {
  margin-top: 20px;
  padding: 10px 20px;
  font-size: 1.2em;
  background-color: #6bd454;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.guardar-button:hover {
  background-color: #4a9d2f;
}
</style>
