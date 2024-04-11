<template>
<div class="movie-details">
  <div class="left-section">
    <h1 class="title">{{ pelicula.titulo }}</h1>
    <img :src="pelicula.imagen_url" :alt="pelicula.titulo" class="movie-image" />
    <div class="session-selection">
      <label for="session-select" class="label">Selecciona una sesión:</label>
      <select id="session-select" v-model="selectedSession" @change="obtenerButacas" class="select">
        <option v-for="sesion in sesiones" :key="sesion.id" :value="sesion.id" class="option">{{ sesion.fecha }} - {{ sesion.hora }}</option>
      </select>
    </div>
  </div>
  <div class="right-section">
    <div v-if="butacas.length > 0" class="butacas-container">
      <div class="fila-butacas" v-for="(fila, index) in filas" :key="index">
        <button
          v-for="butaca in fila"
          :key="butaca.id"
          class="butaca-button"
          :class="{ 'butaca-seleccionada': butacasSeleccionadas.has(butaca.id), 'butaca-ocupada': butaca.ocupado }"
          @click="reservarButaca(butaca)"
        >
          <img :src="butaca.imagen_url" class="butaca-image" />
          <span v-if="butaca.precio > 0" class="precio-butaca">({{ butaca.precio }})</span>
        </button>
      </div>
    </div>
  </div>
  <div v-if="reservaConfirmada" class="resumen-reserva">
    <h2>Resumen de la reserva</h2>
    <p><strong>Película:</strong> {{ pelicula.titulo }}</p>
    <p><strong>Sesión:</strong> {{ sesionSeleccionada.fecha }} - {{ sesionSeleccionada.hora }}</p>
    <p><strong>Butacas seleccionadas:</strong></p>
    <ul>
      <li v-for="butacaId in butacasSeleccionadas" :key="butacaId">{{ butacaId }}</li>
    </ul>
    <p><strong>Total a pagar:</strong> {{ calcularTotalAPagar() }}</p>
    <nuxt-link @click="confirmarYRedirigir" class="guardar-button">Comprar Entradas</nuxt-link>
  </div>
  <button v-if="!reservaConfirmada" @click="confirmarReserva" class="guardar-button">Confirmar Reserva</button>
</div>

  <!-- Rectángulo encima de las butacas -->
  <div class="rectangulo">
    <div class="texto-pantalla">PANTALLA</div>
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
      butacasSeleccionadas: new Set(),
      reservaConfirmada: false // Bandera para verificar si la reserva ha sido confirmada
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
        const res = await fetch(`http://127.0.0.1:8000/api/sesiones/pelicula/${this.$route.params.id}`);
        this.sesiones = await res.json();
      } catch (error) {
        console.error('Error al obtener las sesiones', error);
      }
    },
    async obtenerButacas() {
      try {
        // Obtener las butacas para la sesión seleccionada
        const res = await fetch(`http://127.0.0.1:8000/api/sesiones/${this.selectedSession}/butacas`);
        const butacas = await res.json();

        // Asignar las butacas obtenidas
        this.butacas = butacas.map(butaca => {
          // Asegurarse de que el precio sea un número decimal
          const precio = parseFloat(butaca.precio); // Convertir el precio a decimal
          if (!isNaN(precio)) {
            return {
              ...butaca,
              imagen_url: 'https://cdn-icons-png.flaticon.com/512/24/24868.png', // Establecer la imagen URL
              precio: precio.toFixed(2) // Redondear el precio a 2 decimales
            };
          } else {
            console.error(`El precio de la butaca ${butaca.id} no es un número decimal.`);
            // Si el precio no es un número válido, establecerlo en cero
            return {
              ...butaca,
              imagen_url: 'https://cdn-icons-png.flaticon.com/512/24/24868.png',
              precio: '0.00'
            };
          }
        });
      } catch (error) {
        console.error('Error al obtener las butacas', error);
      }
    },
    reservarButaca(butaca) {
      if (!butaca.ocupado) {
        if (this.butacasSeleccionadas.has(butaca.id)) {
          this.butacasSeleccionadas.delete(butaca.id);
        } else {
          this.butacasSeleccionadas.add(butaca.id);
        }
      } else {
        console.log('La butaca ya está ocupada');
      }
    },
    calcularTotalAPagar() {
      let total = 0;
      for (const butacaId of this.butacasSeleccionadas) {
        const butaca = this.butacas.find(butaca => butaca.id === butacaId);
        if (butaca && typeof butaca.precio === 'string') {
          total += parseFloat(butaca.precio); // Convertir el precio a decimal y sumarlo
        } else {
          console.error(`El precio de la butaca ${butacaId} no es un número.`);
        }
      }
      // Verificar si se pudo calcular el total correctamente
      if (isNaN(total)) {
        console.error('Error al calcular el total.');
        return 'Error';
      }
      return total.toFixed(2); // Redondear el total a 2 decimales
    },
    async guardarButacas() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/reservas', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            butacasSeleccionadas: Array.from(this.butacasSeleccionadas),
            sesionId: this.selectedSession,
            userId: 1, // Aquí debes proporcionar el ID del usuario autenticado
          }),
        });
        if (response.ok) {
          this.reservaConfirmada = true;
        } else {
          console.error('Error al guardar las butacas');
        }
      } catch (error) {
        console.error('Error al guardar las butacas', error);
      }
    },
    confirmarReserva() {
      // Aquí podrías enviar los datos de la reserva al backend para su procesamiento
      // Una vez que la reserva haya sido confirmada por el backend, establece la bandera reservaConfirmada en true
      // Esto mostrará el resumen de la reserva y ocultará el botón para confirmar la reserva nuevamente
      this.reservaConfirmada = true;
    },
    async confirmarYRedirigir() {
      await this.guardarButacas(); // Guardar las butacas
      // Redirigir al usuario a la página de reserva
      this.$router.push('/listadoPeliculas');
    },
  },
  computed: {
    filas() {
      const filas = [];
      for (let i = 0; i < this.butacas.length; i += 5) {
        filas.push(this.butacas.slice(i, i + 5));
      }
      return filas;
    },
    sesionSeleccionada() {
      return this.sesiones.find(sesion => sesion.id === this.selectedSession);
    }
  }
};
</script>

<style scoped>
  .movie-details {
    display: flex;
    flex-direction: row;
    padding: 20px;
    position: relative;
  }

  .rectangulo {
    position: absolute;
    top: 20%; /* Ajusta esta posición según tu diseño */
    left: 57%; /* Ajusta esta posición según tu diseño */
    width: 285px; /* Ajusta el ancho del rectángulo */
    height: 100px; /* Ajusta la altura del rectángulo */
    background-color: #f8f8f8;
    border: 1px solid black; /* Añade borde de color negro */
    z-index: 1; /* Asegura que esté encima de las butacas */
    display: flex;
    justify-content: center; /* Centra horizontalmente */
    align-items: center; /* Centra verticalmente */
    animation: fadeIn 1s ease-out; /* Agrega efecto de animación */
  }

  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }

  .texto-pantalla {
    font-size: 1.5em;
  }

  .left-section {
    margin-top: 5%;
    margin-left: 30%;
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Alinea los elementos a la izquierda */
  }

  .right-section {
    margin-top: 15%;
    margin-left: 10%;
    display: flex;
    flex-direction: column;
    align-items: flex-end; /* Alinea los elementos a la derecha */
  }

  .title {
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

  .butacas-container {
    display: flex;
    flex-direction: column;
  }

  .fila-butacas {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
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
    padding: 10px 20px;
    font-size: 1.2em;
    background-color: #6bd454;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: auto;
  }

  .guardar-button:hover {
    background-color: #4a9d2f;
  }

  .resumen-reserva {
    margin-top: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f8f8f8;
  }
</style>
