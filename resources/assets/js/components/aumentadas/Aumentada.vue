<template>
    <div>
        <a-scene id="scene" embedded arjs='sourceType: webcam;'>
            <!--<a-marker type="pattern" preset='hiro'>-->
            <!--&lt;!&ndash;<a-marker type="pattern" preset='custom' patternUrl="/imagenes/path/pattern-marker.patt" url="/imagenes/path/pattern-marker.patt">&ndash;&gt;-->
                <!--<a-box position="-1 0.5 -3" rotation="0 45 0" color="#4CC3D9"></a-box>-->
                <!--<a-sphere position="0 1.25 -5" radius="1.25" color="#EF2D5E"></a-sphere>-->
                <!--<a-cylinder position="1 0.75 -3" radius="0.5" height="1.5" color="#FFC65D"></a-cylinder>-->
                <!--<a-plane position="0 0 -4" rotation="-90 0 0" width="4" height="4" color="#7BC8A4"></a-plane>-->
                <!--<a-sky color="#ECECEC"></a-sky>-->
            <!--&lt;!&ndash;<a-marker v-for="marker in markers" :key="marker.id" type="pattern" preset='custom' v-bind:patternUrl="marker.url" v-bind:url="marker.url">&ndash;&gt;-->
            <!--</a-marker>-->
            <!--<a-entity camera></a-entity>-->
            <a-marker preset="hiro">
                <a-box position='0 0.5 0' material='color: black;'></a-box>
            </a-marker>
            <a-entity camera></a-entity>
        </a-scene>
    </div>
</template>

<script>

    // import 'aframe'

    export default {
        name: "aumentadas",
        props:['tema'],
        data: function () {
            return {
                // markers: [
                //     {
                //         id: 1,
                //         roomName: 'Mahabodhi',
                //         url: '/imagenes/path/pattern-marker.patt',
                //         status: 'Available',
                //         info: 'for next 30 mins',
                //         color: '#4B77BE',
                //     },
                // ]
                // coloress: ['bg-success', 'bg-dark', 'bg-danger','bg-info'],
            }
        },
    }
</script>

<style scoped>

</style>