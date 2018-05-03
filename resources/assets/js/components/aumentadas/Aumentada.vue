<template>
    <div>
        <div class="card">
            <h1>Hola MUNILLO</h1>
        </div>
    </div>
</template>

<script>
    export default {
        name: "aumentadas",
        props:['tema'],
        data: function () {
            return {
                coloress: ['bg-success', 'bg-dark', 'bg-danger','bg-info'],
            }
        },
    }
</script>

<style scoped>

</style>