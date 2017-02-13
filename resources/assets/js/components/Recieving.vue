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
                            <th width="100">Price</th>
                            <th width="10">Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(cartItem, index) in cart">
                            <td>{{ index + 1 }}</td>
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
                            <larapos-autocomplete src="/api/suppliers" placeholder="Search supplier" :select="selectSupplier"></larapos-autocomplete>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Comments</label>
                            <textarea class="form-control" v-model="form.comments"></textarea>
                        </div>

                        <button class="btn btn-primary btn-block" type="button" @click.prevent="createReceiving">Save</button>
                        <input class="btn btn-default btn-block" type="reset" value="Reset"/>
                    </form>
                </div>
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
            cart: [],
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
            return this.cart.reduce((prev, item) => {
                return prev + (item.price * item.quantity)
            }, 0)
        },
    },

    methods: {
        autocompleteSelect(data) {
            let ids = _.map(this.cart, 'id')

            if (!_.includes(ids, data.id)) {
                data.adjustment = data.quantity
                this.cart.push(data)
            } else {
                let index = _.findIndex(this.cart, cart)

                this.cart[index].quantity = this.cart[index].quantity + 1
            }
        },

        selectSupplier(data) {
            this.form.supplier = data
        },

        fetchData() {
            this.$http.get('/api/suppliers').then((suppliers) => {
                this.$set('suppliers', suppliers.body)
            })
        },

        createReceiving() {
            if (confirm('this process cannot be undone'))
            {
                this.$http.post('/api/receivings', {
                    supplier_id: this.form.supplier.id,
                    comments: this.form.comments,
                    items: _.map(this.cart, (cart) => {
                        return {
                            product_id: cart.id,
                            quantity: cart.quantity,
                            price: cart.price
                        }
                    })
                }).then((response) => {
                    this.cart = []
                    this.form.comments = null
                    this.form.supplier = {}

                    $.notify('Receivings created', {
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