<template>
    <div class="reserva" v-if="reserva">
      <h1 class="reserva-title">Ticket de Reserva</h1>
      <div class="resumen">
        <p v-if="pelicula"><strong>Película:</strong> {{ pelicula.titulo }}</p>
        <p v-if="sesion"><strong>Sesión:</strong> {{ formatearFechaHora(sesion.fecha, sesion.hora) }}</p>
        <p><strong>Butacas:</strong></p>
        <ul>
          <li v-for="butaca in butacas" :key="butaca.id">{{ butaca.nombre }}</li>
        </ul>
        <p><strong>Total a pagar:</strong> {{ calcularTotalAPagar() }}</p>
      </div>
      <router-link to="/listadoPeliculas" class="volver-button">Volver al listado de películas</router-link>
    </div>
    <div v-else>
      <p>ID de reserva no válido</p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        pelicula: {},
        sesion: {},
        butacas: [],
        reserva: null, // Variable para almacenar la reserva
      };
    },
    async mounted() {
      await this.obtenerReserva();
    },
    methods: {
      async obtenerReserva() {
        try {
          const res = await fetch(`http://127.0.0.1:8000/api/reservas/${this.$route.params.id}`);
          const data = await res.json();
  
          // Verificar si se obtuvo una reserva válida
          if (data && !data.message) {
            this.reserva = data; // Asignar los datos de la reserva
            this.pelicula = data.pelicula;
            this.sesion = data.sesion;
            this.butacas = data.butacas;
          } else {
            console.error('ID de reserva no válido');
          }
        } catch (error) {
          console.error('Error al obtener la reserva', error);
        }
      },
      formatearFechaHora(fecha, hora) {
        // Implementa la lógica para formatear la fecha y hora según tu preferencia
      },
      calcularTotalAPagar() {
        // Implementa la lógica para calcular el total a pagar
      }
    }
  };
  </script>
  
  <style scoped>
  .reserva {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    animation: entrada 0.5s ease forwards;
  }
  
  .reserva-title {
    text-align: center;
  }
  
  .resumen {
    margin-top: 20px;
  }
  
  .resumen p {
    margin-bottom: 10px;
  }
  
  .resumen ul {
    list-style-type: none;
    padding-left: 0;
  }
  
  .resumen ul li {
    margin-left: 20px;
  }
  
  .volver-button {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #6bd454;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }
  
  .volver-button:hover {
    background-color: #4a9d2f;
  }
  
  @keyframes entrada {
    from {
      opacity: 0;
      transform: translateY(-50px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  </style>
  