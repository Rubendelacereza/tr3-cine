<template>
    <div class="patio-butacas">
        <div v-for="fila in butacas" :key="fila.id" class="fila">
            <div v-for="asiento in fila.butacas" :key="asiento.id" class="asiento"
                 :class="{ vip: asiento.vip, seleccionada: asientoSeleccionada.includes(asiento.id), ocupado: asiento.ocupado }" @click="toggleSeleccion(asiento)">
                <!-- Eliminamos la imagen de las butacas -->
                {{ asiento.id }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['butacas', 'asientosSeleccionados'],
    methods: {
        toggleSeleccion(asiento) {
            if (!asiento.ocupado) {
                // Verificamos si el asiento ya está seleccionado
                if (this.asientosSeleccionados.includes(asiento.id)) {
                    // Si está seleccionado, lo quitamos de la lista de seleccionados
                    this.$emit('desseleccionarAsiento', asiento);
                } else {
                    // Si no está seleccionado, lo agregamos a la lista de seleccionados
                    this.$emit('seleccionarAsiento', asiento);
                }
            }
        },
    },
};
</script>

<style scoped>
.patio-butacas {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.fila {
    display: flex;
}

.asiento {
    margin: 5px;
    padding: 10px;
    border: 1px solid #ccc;
    cursor: pointer;
}

.asiento.vip {
    border: 2px solid gold;
}

.asiento.seleccionada {
    background-color: green;
}

.asiento.ocupado {
    background-color: red;
}
</style>
