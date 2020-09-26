import Vue from 'vue';

/*let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');*/
let store = {
    state: {
        /*cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,*/
        cart: [],
        cartCount: 0,
        spots: null,
        currentSpot: null,
        thankYouPageVisible: false
    },
    mutations: {
        addToCart(state, item) {
            let found = state.cart.find(product => product.id == item.id);

            if (found) {
                found.quantity ++;
                found.totalPrice = found.quantity * parseFloat(found.price).toFixed(0);
            } else {
                state.cart.push(item);

                Vue.set(item, 'quantity', 1);
                Vue.set(item, 'totalPrice', parseFloat(item.price));
                Vue.set(item, 'image', item.image);
            }

            state.cartCount++;
            //this.commit('saveCart');
        },
        hideThankYouPage(state){
            state.thankYouPageVisible = false;
        },
        showThankYouPage(state){
            state.thankYouPageVisible = true;
        },
        loadSpots(state, items) {
            state.spots = items;
        },
        setCurrentSpot(state, item){

            state.currentSpot = item;
            this.commit('clearCart');
        },
        substractFromCart(state, item){
            let found = state.cart.find(product => product.id == item.id);

            if (found) {
                found.quantity --;
                if(found.quantity == 0){
                    state.cart = state.cart.filter((elem) => {
                        return found.id !== elem.id;
                    });
                }


                found.totalPrice = found.quantity * parseFloat(found.price);
                state.cartCount--;
                //this.commit('saveCart');
            }

        },
        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);

            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.quantity;

                state.cart.splice(index, 1);
            }
            //this.commit('saveCart');
        },
        clearCart(state){
            state.cart = [];
            state.cartCount = 0;
        }/*,
        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        }*/
    }
};



export default store;
