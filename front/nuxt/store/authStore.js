import { defineStore } from 'pinia';

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => ({
    user: null,
    isAuthenticated: false,
  }),
  actions: {
    async loginUser(credentials) {
      try {
        // Aquí se simula una llamada a una API para autenticar al usuario
        const response = await fetch('http://ejemplo.com/api/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(credentials),
        });
        if (response.ok) {
          const userData = await response.json();
          this.user = userData.user; // Actualiza el estado con los datos del usuario
          this.isAuthenticated = true; // Indica que el usuario está autenticado
          return true; // Indica que el inicio de sesión fue exitoso
        } else {
          const errorData = await response.json();
          throw new Error(errorData.message); // Lanza un error con el mensaje de error recibido
        }
      } catch (error) {
        console.error('Error al iniciar sesión:', error);
        throw error; // Relanza el error para que pueda ser manejado por el componente que llama a esta acción
      }
    },
    // Otras acciones relacionadas con la autenticación
  },
});
