<template>
    <div class="patio-butacas">
        <div v-for="fila in butacas" :key="fila.id" class="fila">
            <div v-for="asiento in fila.butacas" :key="asiento.id" class="asiento"
                 :class="{ vip: asiento.vip, ocupado: asiento.ocupado }" @click="seleccionarAsiento(asiento)">
                <img :src="getButacaImage(asiento)" :alt="'Asiento ' + (asiento.vip ? 'VIP' : 'Normal')" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['butacas'],
    methods: {
        seleccionarAsiento(asiento) {
            if (!asiento.ocupado) {
                this.$emit('asientoSeleccionado', asiento);
            }
        },
        getButacaImage(asiento) {
            return asiento.ocupado ? '/img/butaca-ocupada.png' : '/img/butaca-libre.png';
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
}

.asiento img {
    width: 50px;
}

.asiento.vip {
    border: 2px solid gold;
}

.asiento.ocupado {
    border: 2px solid red;
}
</style>
