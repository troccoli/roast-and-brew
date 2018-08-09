<template>
    <div id="home">
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <loader v-show="cafesLoadStatus == 1" :width="100" :height="100"></loader>
                <cafe-card v-for="cafe in cafes" :key="cafe.id" :cafe="cafe"></cafe-card>
            </div>
        </div>
    </div>

    <!--<div id="home">-->
        <!--<span v-show="cafesLoadStatus == 1">Loading</span>-->
        <!--<span v-show="cafesLoadStatus == 2">Cafes loaded successfully!</span>-->
        <!--<span v-show="cafesLoadStatus == 3">Cafes loaded unsuccessfully!</span>-->

        <!--<ul>-->
            <!--<li v-for="cafe in cafes">{{ cafe.name }}</li>-->
        <!--</ul>-->
    <!--</div>-->
</template>

<script>
    import CafeCard from '../components/cafes/CafeCard';
    import Loader from '../components/global/Loader';

    export default {
        components: {
            Loader,
            CafeCard
        },

        created() {
            this.$store.dispatch('loadCafes');
        },

        computed: {
            cafesLoadStatus() {
                return this.$store.getters.getCafesLoadStatus;
            },
            cafes() {
                return this.$store.getters.getCafes;
            }
        }
    }
</script>

<style scoped>

</style>