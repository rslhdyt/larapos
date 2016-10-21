`<template>
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
                        <th width="10">Quantity</th>
                        <th width="10">Adjustment</th>
                        <th width="10">Diff</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cartItem in cart">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ cartItem.name }}</td>
                        <td>{{ cartItem.quantity }}</td>
                        <td><input type="number" v-model="cartItem.adjustment" class="form-control"></td>
                        <td>{{ cartItem.adjustment - cartItem.quantity }}</td>
                        <td>
                            <button class="btn btn-danger btn-xs pull-right" v-on:click="deleteItemFromCart(cartItem)">delete</button>
                        </td>
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
                        <label class="control-label">Comments</label>
                        <textarea class="form-control" v-model="form.comments"></textarea>
                    </div>

                    <button class="btn btn-primary btn-block" type="button" v-on:click="createAdjustment">Save</button>
                    <input class="btn btn-default btn-block" type="reset" value="Reset"/>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import VueTypeahead from 'vue-typeahead'

export default {
    extends: VueTypeahead, 

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
            form : {
                comments: null
            }
        }
    },

    computed: {
        cartCount() {
            return this.cart.length;
        }
    },

    methods: {
        // The callback function which is triggered when the user hits on an item
        // (required)
        onHit (item) {
            var cart = Vue.util.extend({}, item);
            var ids = _.map(this.cart, 'id');

            if (!_.includes(ids, cart.id)) {
                cart.adjustment = cart.quantity;
                this.cart.push(cart);
            }
        },

        deleteItemFromCart: function(item) {
            this.cart.$remove(item);
        },

        createAdjustment() {
            if (confirm('this process cannot be undone'))
            {
                this.$http.post('/api/adjustments', {
                    comments: this.form.comments,
                    items: _.map(this.cart, function(cart){
                        return {
                            product_id: cart.id,
                            adjustment: cart.adjustment,
                            diff: (cart.adjustment - cart.quantity),
                        }
                    })
                }).then(function(response) {
                    this.$set('cart', []);
                    this.form.comments = null;

                    $.notify('Adjustment created', {
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