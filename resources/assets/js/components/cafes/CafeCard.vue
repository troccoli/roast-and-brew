<template>
    <div class="large-3 medium-4 small-6 cell cafe-card-container" v-show="show">
        <router-link :to="{ name: 'cafe', params: { id: cafe.id} }">
            <div class="cafe-card">
                <span class="title">{{ cafe.name }}</span>
                <span class="address">
                    <span class="street">{{ cafe.address }}</span>
                    <span class="city">{{ cafe.city }}</span>
                    <span class="state">{{ cafe.state }}</span>
                    <span class="zip">{{ cafe.zip }}</span>
                </span>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default {
        props: ['cafe'],

        data() {
            return {
                show: true
            }
        },
    }
</script>

<style scoped>

</style>