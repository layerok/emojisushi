import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

const Hello = () => import('./views/Hello')
const Home = () =>  import('./views/Home')
const UsersIndex = () =>  import('./views/UsersIndex')
const UsersEdit = () =>  import('./views/UsersEdit')
const CategoriesShow = () =>  import('./views/CategoriesShow')
const Checkout = () =>  import('./views/Checkout')
const SpotIndex = () =>  import('./views/SpotIndex')
const NotFound = () =>  import('./views/notFound')
const ThankYou = () =>  import('./views/Thankyou')




export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            children: [
                {
                    path: '/:spot',
                    name: 'spot',
                    component: SpotIndex,
                    props: true
                },
                {
                    path: '/:spot/categories/:slug',
                    name: 'categories.show',
                    component: CategoriesShow,
                    props: true
                },
                {
                    path: '/:spot/checkout',
                    name: 'checkout',
                    component: Checkout,
                    props: true,
                },
                {
                    path: '/:spot/thankyou',
                    name: 'thankyou',
                    component: ThankYou
                }
            ],

        },
        {
            path: '*',
            name: 'notFound',
            component: NotFound
        }



    ],
});
