  <template>
    <div class="administrar-sesiones">
      <h2 class="title">Gestión de Sesiones</h2>
      <div class="button-container">
        <button @click="mostrarFormulario" class="button">Insertar Sesión</button>
        <button @click="mostrarSesiones" class="button">Mostrar Sesiones</button>
      </div>

      <!-- Formulario de inserción de sesiones -->
      <form v-if="mostrarInsertar" @submit.prevent="insertarSesion" class="form-container">
        <div class="form-group">
          <label for="fecha" class="label">Fecha:</label>
          <input type="date" id="fecha" v-model="fecha" required class="input">
        </div>
        <div class="form-group">
          <label for="hora" class="label">Hora:</label>
          <input type="time" id="hora" v-model="hora" required class="input">
        </div>
        <div class="form-group">
          <label for="pelicula" class="label">Película:</label>
          <select id="pelicula" v-model="peliculaSeleccionada" required class="input">
            <option v-for="pelicula in peliculas" :key="pelicula.id" :value="pelicula.id">{{ pelicula.titulo }}</option>
          </select>
        </div>
        <button type="submit" class="submit-button">Insertar Sesión</button>
      </form>

      <!-- Lista de sesiones -->
      <div v-if="mostrarListaSesiones" class="sesiones-container">
      <div v-for="sesion in sesiones" :key="sesion.id" class="sesion">
        <div class="session-info">
          <span class="bold">Fecha:</span> {{ sesion.fecha }}<br>
          <span class="bold">Hora:</span> {{ sesion.hora }}<br>
          <span v-if="sesion.pelicula" class="bold">Título de la película:</span> {{ sesion.pelicula.titulo }}<br>
          <img v-if="sesion.pelicula" :src="sesion.pelicula.imagen_url" alt="Imagen de la película" class="pelicula-imagen">
        </div>
      </div>
    </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        fecha: '',
        hora: '',
        peliculaSeleccionada: null,
        peliculas: [],
        sesiones: [],
        mostrarInsertar: false,
        mostrarListaSesiones: false
      };
    },
    methods: {
      async insertarSesion() {
        try {
          const response = await fetch('http://localhost:8000/api/sesiones', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              fecha: this.fecha,
              hora: this.hora,
              id_pelicula: this.peliculaSeleccionada
            })
          });

          if (response.ok) {
            await this.obtenerSesiones();
            this.mostrarInsertar = false;
          } else {
            console.error('Error al insertar la sesión:', response.statusText);
          }
        } catch (error) {
          console.error('Error al insertar la sesión:', error);
        }
      },
      async obtenerPeliculas() {
        try {
          const response = await fetch('http://localhost:8000/api/peliculas');
          if (response.ok) {
            this.peliculas = await response.json();
          } else {
            console.error('Error al obtener las películas:', response.statusText);
          }
        } catch (error) {
          console.error('Error al obtener las películas:', error);
        }
      },
      async obtenerSesiones() {
        try {
          const response = await fetch('http://localhost:8000/api/sesiones');
          if (response.ok) {
            this.sesiones = await response.json();
            this.mostrarListaSesiones = true;
            this.mostrarInsertar = false;
          } else {
            console.error('Error al obtener las sesiones:', response.statusText);
          }
        } catch (error) {
          console.error('Error al obtener las sesiones:', error);
        }
      },
      mostrarFormulario() {
        this.mostrarInsertar = true;
        this.mostrarListaSesiones = false;
      },
      async mostrarSesiones() {
        await this.obtenerSesiones();
        this.mostrarInsertar = false;
      }
    },
    mounted() {
      this.obtenerPeliculas();
    }
  };
  </script>

  <style scoped>
  .administrar-sesiones {
    max-width: 800px;
    margin: 0 auto;
  }

  .title {
    font-size: 24px;
    margin-bottom: 20px;
  }

  .button-container {
    margin-bottom: 20px;
  }

  .button {
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 10px;
  }

  .button:hover {
    background-color: #2980b9;
  }

  .form-container {
    margin-bottom: 20px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .label {
    display: block;
    font-weight: bold;
  }

  .input {
    width: calc(100% - 16px);
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  .submit-button {
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .submit-button:hover {
    background-color: #2980b9;
  }

  .sesiones-container {
    margin-top: 20px;
  }

  .sesion {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
  }

  .bold {
    font-weight: bold;
  }

  .session-info {
    margin-bottom: 10px;
  }

  .pelicula-imagen {
    max-width: 200px;
  }
  </style>
