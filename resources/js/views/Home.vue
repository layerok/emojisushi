<template>
    <div :style="([ 'home', 'notFound'].indexOf($route.name) > -1) ? {backgroundImage: 'url(/img/bg.jpg)'} : ''">
        <sumoist-header v-if="!([ 'home', 'notFound'].indexOf($route.name) > -1)"></sumoist-header>
            <div v-if="(['home'].indexOf($route.name) > -1)" class="flex flex-column justify-center items-center vh-100 ph3">
                <h1 class="tc all-right">Выберите ресторан</h1>
                <div  class="w-100 mw6 flex flex-column flex-row-ns items-center justify-between tc">
                    <div @click="handleClick(spot)" v-for="spot in $store.state.spots" class="bg-animate hover-bg-red pointer pa3 bg-dark-red w-100 w-40-ns mb3 h4 br2 ba b--dark-red flex justify-center items-center ">
                        <a class="f3 tc white link" >{{ spot.name }}</a>
                    </div>
                    @foreache
                </div>

            </div>
            <router-view></router-view>
        <sumoist-footer v-if="!(['home', 'notFound'].indexOf($route.name) > -1)"></sumoist-footer>
    </div>


</template>

<script>
    export default {
        props:[],
        data(){
            return {

            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            handleClick(item){
                this.$store.commit('setCurrentSpot', item );
                this.$store.commit('clearCart');
                this.$router.push({name: 'spot', params: { spot: item.slug}});
            },
            fetchData() {
                this.error = this.users = null;
                this.loading = true;
                axios
                    .get('/api/spots/get')
                    .then(response => {

                        this.$store.commit('loadSpots', response.data);


                    }).catch(error => {
                    this.error = error.response.data.message || error.message;
                });
            }
        }
    }
</script>
