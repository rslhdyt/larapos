<template>
    <div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">List Item</div>
                <div class="panel-body">            
                    <larapos-autocomplete src="/api/products" placeholder="Search product" :select="autocompleteSelect"></larapos-autocomplete>
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
                        <tr v-for="(cartItem, index) in cart">
                            <td>{{ index + 1 }}</td>
                            <td>{{ cartItem.name }}</td>
                            <td>{{ cartItem.quantity }}</td>
                            <td><input type="number" v-model="cartItem.adjustment" class="form-control"></td>
                            <td>{{ cartItem.adjustment - cartItem.quantity }}</td>
                            <td>
                                <button class="btn btn-danger btn-xs pull-right" v-on:click="deleteItemFromCart(index)">delete</button>
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
    </div>
</template>

<script>
export default {
    data () {
        return {
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
        autocompleteSelect(data) {
            let ids = _.map(this.cart, 'id')

            if (!_.includes(ids, data.id)) {
                data.adjustment = data.quantity
                this.cart.push(data)
            }
        },

        deleteItemFromCart(index) {
            this.cart.splice(index)
        },

        createAdjustment() {
            if (confirm('this process cannot be undone'))
            {
                this.$http.post('/api/adjustments', {
                    comments: this.form.comments,
                    items: _.map(this.cart, (cart) => {
                        return {
                            product_id: cart.id,
                            adjustment: cart.adjustment,
                            diff: (cart.adjustment - cart.quantity),
                        }
                    })
                }).then((response) => {
                    this.cart = []
                    this.form.comments = null

                    $.notify('Adjustment created', {
                        type: 'success',
                        placement: {
                            from: 'bottom'
                        }
                    })
                })
            }
        }
    }
}
</script>