<template>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">List Item</div>
            <div class="panel-body">            
                <input type="text"
                    placeholder="Search Product..."
                    autocomplete="off"
                    v-model="query"
                    @keydown.down="down"
                    @keydown.up="up"
                    @keydown.enter="hit"
                    @keydown.esc="reset"
                    @blur="reset"
                    @input="update"
                    class="form-control"/>

                <!-- the list -->
                <div class="list-group" v-show="hasItems">
                    <a href="#" v-for="item in items" :class="activeClass($index)" class="list-group-item" @mousedown="hit" @mousemove="setActive($index)">{{ item.name }}</a>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th width="100">Price</th>
                        <th width="10">Quantity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cartItem in cart">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ cartItem.name }}</td>
                        <td><input type="text" v-model="cartItem.price" class="form-control"></td>
                        <td><input type="text" v-model="cartItem.quantity" class="form-control"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <label class="control-label">Total Amount</label>
                        <h2 class="form-control-static text-warning">{{ totalPrice }}</h2>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Supplier</label>
                        <select class="form-control" v-model="form.supplier">
                            <option value selected>-- Select Supplier --</option>
                            <option v-for="supplier in suppliers" v-bind:value="supplier">{{ supplier.name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Comments</label>
                        <textarea class="form-control" v-model="form.comments"></textarea>
                    </div>

                    <button class="btn btn-primary btn-block" type="button" v-on:click="createReceiving">Save</button>
                    <input class="btn btn-default btn-block" type="reset" value="Reset"/>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import VueTypeahead from 'vue-typeahead'

export default {
    extends: VueTypeahead, // vue@1.0.22+
    // mixins: [VueTypeahead], // vue@1.0.21-

    ready() {
        this.fetchData();
    },

    data () {
        return {
            // The source url
            // (required)
            src: '/api/products',

            // Limit the number of items which is shown at the list
            // (optional)
            limit: 5,

            // The minimum character length needed before triggering
            // (optional)
            minChars: 3,

            // Highlight the first item in the list
            // (optional)
            selectFirst: false,

            // Override the default value (`q`) of query parameter name
            // Use a falsy value for RESTful query
            // (optional)
            queryParamName: 'q',

            cart: [],
            suppliers: [],
            form : {
                supplier: {},
                comments: null
            }
        }
    },

    computed: {
        cartCount() {
            return this.cart.length;
        },
        totalPrice() {
            return this.cart.reduce(function(prev, item){
                return prev + (item.price * item.quantity); 
            }, 0);
        },
    },

    methods: {
        // The callback function which is triggered when the user hits on an item
        // (required)
        onHit (item) {
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

        update () {
            if (!this.query) {
                return this.reset()
            }

            if (this.minChars && this.query.length < this.minChars) {
                return
            }

            this.loading = true

            this.fetch().then((response) => {
                if (this.query) {
                    let data = response.data.data
                    data = this.prepareResponseData ? this.prepareResponseData(data) : data

                    this.items = this.limit ? data.slice(0, this.limit) : data
                    this.current = -1
                    this.loading = false

                    if (this.selectFirst) {
                        this.down()
                    }
                }
            })
        },

        fetchData() {
            this.$http.get('/api/suppliers').then(function(suppliers) {
                this.$set('suppliers', suppliers.body);
            }, function(error) {
                console.log(error);
            });
        },

        createReceiving() {
            if (confirm('this process cannot be undone'))
            {
                this.$http.post('/api/receivings', {
                    supplier_id: this.form.supplier.id,
                    comments: this.form.comments,
                    items: _.map(this.cart, function(cart){
                        return {
                            product_id: cart.id,
                            quantity: cart.quantity,
                            price: cart.price
                        }
                    })
                }).then(function(response) {
                    this.$set('cart', []);
                    this.form.comments = null;
                    this.form.supplier = {};

                    $.notify('Receivings created', {
                        type: 'success',
                        placement: {
                            from: 'bottom'
                        }
                    });
                }, function(error) {
                    
                });
            }
        }

    }
}
</script>