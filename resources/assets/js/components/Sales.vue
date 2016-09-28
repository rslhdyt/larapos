<template>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">List Item</div>
            <div class="panel-body">
                <div class="row">
                    <!--
                    <div class="col-md-2">
                        <div class="list-group">
                            <a href="#" v-for="category in categories" class="list-group-item list-group-item-info" v-on:click="setSearchItemKey(category.id)" track-by="$index" >{{ category.name }}</a>
                        </div>
                    </div>
                    -->
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Search for..." v-model="searchProductQuery.q" v-on:keyup="searchProduct">
                        <br />
                        <div class="row">
                            <div v-for="item in items" track-by="id" class="col-md-4">
                                <div class="thumbnail" v-on:click="storeItemToCart(item)">
                                    <div class="caption">
                                        <h4>{{ item.name }}</h4>
                                        <p>Price : {{ item.price }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Cart</div>
            <ul class="list-group cart-item">
                <li class="list-group-item list-group-item-warning" v-show="!cartCount">Cart item is empty</li>
                <li class="list-group-item" v-for="cartItem in cart" track-by="id" v-on:click="decreaseCartQty(cartItem)">
                    {{ cartItem.name }}
                    <span class="pull-right">
                        ({{ cartItem.price }} x {{ cartItem.quantity }})
                        <i class="glyphicon glyphicon-remove cart-item-action" v-on:click="deleteItemFromCart(cartItem)"></i>
                    </span>
                    <!-- <button class="pull-right" v-on:click="deleteItemFromCart(cartItem)">-</button> -->
                </li>
            </ul>
            <div class="panel-footer">
                Total Item:
                <span class="pull-right">
                    {{ cartCount }}
                    <i class="glyphicon glyphicon-refresh cart-item-action" v-on:click="clearCart()"></i>
                </span>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <label class="control-label">Total Amount</label>
                        <h2 class="form-control-static text-warning">{{ totalPrice }}</h2>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="totalPayment">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" :disabled="(amountDue > 0 || cartCount == 0)" v-on:click="createSale">Finish Sale</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        ready() {
            this.fetchData();
        },

        data() {
            return {
                items: [],
                cart: [],
                categories: [],
                totalPayment: null,
                searchProductQuery: {
                    limit : 2,
                    q: null
                }
            }
        },

        computed: {
            cartCount: function(){
                return this.cart.length;
            },
            totalPrice: function(){
                return this.cart.reduce(function(prev, item){
                    return prev + (item.price * item.quantity); 
                }, 0);
            },
            amountDue: function() {
                return this.totalPrice - this.totalPayment;
            }
        },

        methods: {
            storeItemToCart: function(item) {
                var cart = Vue.util.extend({}, item);
                var ids = _.map(this.cart, 'id');

                if (!_.includes(ids, cart.id)) {
                    cart.quantity = 1;
                    this.cart.push(cart);
                } else {
                    var index = _.findIndex(this.cart, cart);
                    this.cart[index].quantity = this.cart[index].quantity + 1;
                }
            },

            decreaseCartQty: function(item) {
                var index = _.findIndex(this.cart, item);

                if (this.cart[index].quantity - 1 == 0) {
                    this.deleteItemFromCart(item);
                } else {
                    this.cart[index].quantity = this.cart[index].quantity - 1;
                }
            },

            deleteItemFromCart: function(item) {
                this.cart.$remove(item);
            },

            clearCart: function() {
                if (confirm('are you sure?')) {
                    $.notify('Cart items deleted', {
                        type: 'success',
                        placement: {
                            from: 'bottom'
                        }
                    });

                    this.$set('cart', []);
                }
            },

            fetchData: function() {
                // fetch data items
                this.$http.get('/api/products').then(function(items) {
                    this.$set('items', items.json());
                }, function(error) {
                    console.log(error);
                });

                // fetch data categories
                // this.$http.get('categories.json').then(function(categories) {
                //     this.$set('categories', categories.body);
                // }, function(error) {
                //     console.log(error);
                // });
            },

            searchProduct: function(direct) {
                var qLength = this.searchProductQuery.q.length;

                if (this.searchProductQuery.limit <= qLength || qLength == 0)
                {
                    // set delay
                    setTimeout(function() {
                        this.$http.get('/api/products', {
                            params : {
                                q: this.searchProductQuery.q
                            }
                        }).then(function(items) {
                            this.$set('items', items.json());
                        }, function(error) {
                            console.log(error);
                        });
                    }.bind(this), 2000);
                }
            },

            createSale: function() {
                if (confirm('this process cannot be undone'))
                {
                    this.$http.post('/api/sales', {
                        cashier_id: 1,
                        customer_id: 1,
                        items: _.map(this.cart, function(cart){
                            return {
                                product_id: cart.id,
                                quantity: cart.quantity,
                                price: cart.price
                            }
                        })
                    }).then(function(response) {
                        this.$set('cart', []);
                        this.totalPayment = null;

                        $.notify('Sales created', {
                            type: 'success',
                            placement: {
                                from: 'bottom'
                            }
                        });
                    }, function(error) {
                        $.notify('Create sales failed', {
                            type: 'danger',
                            placement: {
                                from: 'bottom'
                            }
                        });
                    });
                }
            }
        }
    }
</script>
