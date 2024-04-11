<template>
  <div class="admin-container">
    <aside class="sidebar">
      <div class="user-profile">
        <img src="https://purepng.com/public/uploads/large/purepng.com-avataravatarjames-camerons-avatarscience-fiction-filmherosactors-1701528521646rbihs.png" alt="Avatar" class="avatar">
        <div class="user-info">
          <h2>Administrador</h2>
          <p>Nombre de usuario: admin</p>
        </div>
      </div>
      <nav class="main-menu">
        <ul>
          <li><nuxt-link to="/AdministrarPeliculas">Gestión de Películas</nuxt-link></li>
          <li><nuxt-link to="/AdministrarSesiones">Gestión de Sesiones</nuxt-link></li>
        </ul>
      </nav>
    </aside>
    <div class="main-content">
      <header class="admin-header">
        <h1>Panel de Administrador</h1>
        <div class="user-info">
          <span>Bienvenido, Administrador</span>
          <div class="logout-button">
            <button @click="logout">Cerrar sesión</button>
          </div>
        </div>
      </header>
      <div class="additional-content">
        <div class="statistics">
          <h2>Estadísticas</h2>
          <!-- Aquí podrías mostrar estadísticas relevantes -->
          <p>Películas en cartelera: 10</p>
          <p>Salas disponibles: 5</p>
          <!-- Puedes agregar más estadísticas según sea necesario -->
        </div>
        <div class="news">
          <h2>Últimas Noticias</h2>
          <!-- Aquí podrías mostrar noticias o actualizaciones -->
          <p>No hay noticias actualmente.</p>
        </div>
        <div class="search-box">
          <h2>Búsqueda</h2>
          <!-- Aquí puedes agregar un cuadro de búsqueda -->
          <input type="text" placeholder="Buscar...">
          <!-- Puedes agregar funcionalidad de búsqueda con Vue.js -->
        </div>
        <div class="recent-actions">
          <h2>Acciones Recientes</h2>
          <!-- Aquí podrías mostrar un historial de acciones -->
          <p>No hay acciones recientes.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Admin',
  methods: {
    logout() {
      // Lógica para cerrar sesión
      console.log('Sesión cerrada');
    }
  }
}
</script>

<style scoped>
.admin-container {
  display: flex;
  max-width: 1200px;
  margin: 150px auto;
  padding: 20px;
}

.sidebar {
  width: 250px;
  background-color: #f0f0f0;
  padding: 20px;
}

.user-profile {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.user-profile .avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 10px;
}

.user-info h2 {
  margin: 0;
  font-size: 18px;
}

.main-content {
  flex: 1;
  padding: 0 20px;
}

.admin-header {
  text-align: center;
  margin-bottom: 20px;
}

.admin-header h1 {
  margin: 0;
  font-size: 28px;
}

.user-info {
  display: flex;
  align-items: center;
  justify-content: center;
}

.logout-button {
  margin-left: auto;
}

.additional-content {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}

.statistics,
.news,
.search-box,
.recent-actions {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
}

.statistics h2,
.news h2,
.search-box h2,
.recent-actions h2 {
  margin-top: 0;
}

.main-menu ul {
  list-style: none;
  padding: 0;
}

.main-menu li {
  margin-bottom: 10px;
}

.main-menu a {
  text-decoration: none;
  color: #333;
  font-size: 16px;
}

.main-menu a:hover {
  color: #3498db;
}

.square-button {
  width: 100%;
  padding: 20px;
  border: 2px solid #3498db;
  background-color: #fff;
  color: #3498db;
  font-size: 18px;
  font-weight: bold;
  border-radius: 10px;
  transition: background-color 0.3s, color 0.3s;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.square-button:hover {
  background-color: #3498db;
  color: #fff;
}
</style>
