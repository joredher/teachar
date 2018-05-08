<template>
    <div>
        <div v-for="objeto in tema.bd_objeto" >
            <a-scene id="scene">
            <!--<a-scene id="scene" embedded arjs='sourceType: webcam;'   background="color: red">-->
                <a-assets>
                    <a-asset-item id="obj1" :src="'/storage/'+objeto.modelo" ></a-asset-item>
                    <a-asset-item id="mtl1" :src="'/storage/'+objeto.material" ></a-asset-item>
                    <!--<a-asset-item id="mtl" :src="" ></a-asset-item>-->
                </a-assets>
                <a-sky color="#DDDDDD"></a-sky>
                <a-light type="directional" color="#FFF" intensity="0.5" position="-1 1 2"></a-light>
                <a-light type="ambient" color="#FFF"></a-light>
                <a-camera position="0 1 -1" cursor-visible="true" cursor-scale="2" cursor-color="#0095DD" cursor-opacity="0.5"></a-camera>
                <a-obj-model src="#obj1" mtl="#mtl1" position="-0.5 1.10 -2" rotation="0 180 0">
                    <a-animation attribute="rotation" from="20 0 0" to="20 360 0" direction="alternate" dur="4000" repeat="indefinite" easing="ease"></a-animation>
                </a-obj-model>
                <!--<a-marker type="pattern" preset='hiro'>-->
                <!--<a-marker type="pattern" preset='custom' patternUrl="/imagenes/path/pattern-marker.patt" url="/imagenes/path/pattern-marker.patt">-->
                <!--<a-box position="-1 0.5 -3" rotation="0 45 0" color="#4CC3D9"></a-box>-->
                <!--<a-sphere position="0 1.25 -5" radius="1.25" color="#EF2D5E"></a-sphere>-->
                <!--<a-cylinder position="1 0.75 -3" radius="0.5" height="1.5" color="#FFC65D"></a-cylinder>-->
                <!--<a-plane position="0 0 -4" rotation="-90 0 0" width="4" height="4" color="#7BC8A4"></a-plane>-->
                <!--<a-sky color="#ECECEC"></a-sky>-->
                <!--&lt;!&ndash;<a-marker v-for="marker in markers" :key="marker.id" type="pattern" preset='custom' v-bind:patternUrl="marker.url" v-bind:url="marker.url">&ndash;&gt;-->
                <!--</a-marker>-->
                <!--<a-entity camera></a-entity>-->
                <!--<a-marker type="pattern" preset='hiro'>-->
                <!--<a-marker type="pattern" preset='custom'-->
                          <!--patternUrl="/imagenes/path/pattern-marker.patt"-->
                          <!--url="/imagenes/path/pattern-marker.patt">-->
                <!--<a-marker preset="hiro">-->
                    <!---->
                    <!--&lt;!&ndash;<a-entity obj-model="obj: #obj; mtl: #mtl" position='0 0.5 0'></a-entity>&ndash;&gt;-->
                    <!--&lt;!&ndash;<a-box position='0 0.5 0' material='color: black;'></a-box>&ndash;&gt;-->
                <!--</a-marker>-->
                <!--<a-entity camera></a-entity>-->
            </a-scene>
        </div>
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