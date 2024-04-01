<template>
  <div class="movie-details">
    <h1>{{ pelicula.titulo }}</h1>
    <img :src="pelicula.imagen_url" :alt="pelicula.titulo" class="movie-image" />
    <div class="session-selection">
      <label for="session-select">Selecciona una sesión:</label>
      <select id="session-select" v-model="selectedSession" @change="obtenerButacas">
        <option v-for="sesion in sesiones" :key="sesion.id" :value="sesion.id">{{ sesion.fecha }}</option>
      </select>
    </div>
    <div class="butacas-container">
      <button
        v-for="butaca in butacas"
        :key="butaca.id"
        class="butaca-button"
        :class="{ 'butaca-seleccionada': butacaSeleccionada === butaca.id, 'butaca-ocupada': butaca.ocupado }"
        @click="reservarButaca(butaca)"
      >
        <img :src="butaca.imagen_url" class="butaca-image" />
      </button>
    </div>
    <button @click="guardarReservas">Guardar</button>
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
      butacaSeleccionada: null,
      reservas: [],
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
            imagen_url: 'https://w7.pngwing.com/pngs/302/121/png-transparent-cinema-seat-chair-seat.png'
          };
        });
        this.butacas = butacas;
      } catch (error) {
        console.error('Error al obtener las butacas', error);
      }
    },
    reservarButaca(butaca) {
      if (!butaca.ocupado) {
        this.butacaSeleccionada = butaca.id;
        this.reservas.push(butaca.id);
      } else {
        console.log('La butaca ya está ocupada');
      }
    },
    async guardarReservas() {
      try {
        const res = await fetch('http://127.0.0.1:8000/api/reservas', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            usuario_id: 1, // Debes reemplazar con el ID del usuario actual
            sesion_id: this.selectedSession,
            butacas: this.reservas,
          }),
        });
        const data = await res.json();
        console.log('Reservas guardadas:', data);
      } catch (error) {
        console.error('Error al guardar las reservas', error);
      }
    },
  },
};
</script>

<style scoped>
.movie-details {
  padding: 20px;
}

.movie-image {
  width: 300px;
  height: auto;
}

.session-selection {
  margin-bottom: 20px;
}

#session-select {
  padding: 5px;
}

.butacas-container {
  display: flex;
  flex-wrap: wrap;
}

.butaca-button {
  border: none;
  background: none;
  margin: 5px;
  padding: 0;
  cursor: pointer;
}

.butaca-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.butaca-seleccionada {
  background-color: green;
}

.butaca-ocupada {
  background-color: red;
}
</style>
