<template>
    <div class="row mb-5">
        <div class="col-md-8 col-sm-12">
            <div class="card mb-3">
                <div class="card-header">Sales Items</div>
                <div class="card-body p-0">
                    <product-search class="p-2"></product-search>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Product</th>
                                    <th width="14%">Price</th>
                                    <th width="7%">Quantity</th>
                                    <th width="10%">Discount</th>
                                    <th width="16%">Subtotal</th>
                                    <th width="5%" align="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <sales-item v-for="(item, key) in items" :index="key" :key="item.product_id" :item="item"></sales-item>
                                <tr v-show="!items.length" class="table-info">
                                    <td colspan="7" align="center">Sales items empty.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">
                    Total Item : {{ items.length }}
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card mb-3">
                <div class="card-header">Sales Data</div>
                <div class="card-body pb-0">
                    <div class="form-group">
                        <label for="name">Customer *</label>
                        <input-customer></input-customer>
                    </div>

                    <div class="form-group row" v-show="(form.amountDue < 0 || items.length != 0)">
                        <div class="col-6">
                            <label>Total</label>
                            <h4 class="text-success form-control-plaintext">{{ totalAmount | currency }}</h4>
                        </div>
                        <div class="col-6">
                            <label>Amount Due</label>
                            <h4 class="text-warning form-control-plaintext">{{ amountDue | currency }}</h4>
                        </div>
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="(salesPayment, key) in salesPayments" :key="key"><i class="fa fa-trash-o text-danger mr-2" @click="deletePayment(key)"></i> {{ salesPayment.paymentMethod.name }} <span class="pull-right">{{ salesPayment.amount | currency }}</span></li>
                </ul>

                <div class="card-body">
                    <div class="form-group" v-show="items.length > 0">
                        <label for="name">Payment Methods *</label>
                        <div class="input-group mb-3">
                            <input v-validate="'numeric'" data-vv-name="amount" type="text" v-model="payment.amount" :class="{'form-control' : true, 'is-invalid' : errors.has('amount')}">
                            <div class="invalid-feedback">{{ errors.first('amount') }}</div>
                            <select v-validate="'required'" data-vv-name="paymentMethod" v-model="payment.paymentMethod" :class="{'form-control' : true, 'is-invalid' : errors.has('paymentMethod')}">
                                <option v-for="paymentMethod in paymentMethods" :key="paymentMethod.id" :value="paymentMethod">{{ paymentMethod.name }}</option>
                            </select>
                            <div class="invalid-feedback">{{ errors.first('paymentMethod') }}</div>
                        </div>

                        <button class="btn btn-dark btn-block" type="button" v-on:click="addPayment">Add Payment</button>
                    </div>

                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea v-model="form.comments" class="form-control"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" @click.prevent="validateForm" :disabled="(amountDue > 0 || items.length == 0)">Finish Sales</button>
                    <a href="/" class="btn btn-link btn-block">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductSearch from './ProductSearch.vue'
import SalesItem from './SalesItem.vue'
import InputCustomer from './InputCustomer.vue'

export default {
    components: {
        InputCustomer,
        ProductSearch,
        SalesItem
    },
    data () {
        return {
            payment: {},
            form: {
                customer_id: null
            },
            paymentMethods: [],
            items: [],
            customers: [],
            salesPayments: [],
            payment: {}
        }
    },
    computed: {
        totalPayment () {
            return _.sumBy(this.salesPayments, 'amount')
        },
        totalAmount: function(){
            return _.sumBy(this.items, 'subtotal_unit_price')
        },
        amountDue: function() {
            return this.totalAmount - this.totalPayment
        }
    },
    methods: {
        addItem (item) {
            let ids = _.map(this.items, 'id')

            if (!_.includes(ids, item.id)) {
                this.$set(item, 'quantity', 1)
                this.$set(item, 'discount', 0)
                this.$set(item, 'subtotal_unit_price', (item.unit_price * item.quantity))
                this.$set(item, 'cost_of_goods_sold', 0)

                this.items.push(item)
            } else {
                let index = _.findIndex(this.items, function(i) {
                    return i.id == item.id
                })

                let currentProduct = this.items[index]

                currentProduct.quantity = currentProduct.quantity + 1
            }
        },
        removeItem (item) {
            let index = _.findIndex(this.items, function(i) {
                return i.id == item.id
            })

            let currentProduct = this.items[index]

            if (currentProduct.quantity - 1 == 0) {
                this.deleteItem(currentProduct)
            } else {
                currentProduct.quantity = currentProduct.quantity - 1
            }
        },
        deleteItem (item) {
            let index = _.findIndex(this.items, function(i) {
                return i.id == item.id
            })

            this.items.splice(index, 1)
        },
        clearForm () {
            this.form = {
                customer_id: null
            }
            this.items = []
            this.salesPayments = []

            this.$bus.$emit('inputCustomerCleared')
        },
        validateForm () {
            const that = this

            this.$validator.validateAll().then((result) => {
                if (result) {
                    that.store()
                }
            });
        },

        addPayment () {
            let ids = _.map(this.salesPayments, 'paymentMethod.id')
            let payment = this.payment;

            if (!_.includes(ids, payment.paymentMethod.id)) {
                this.salesPayments.push({
                    amount: parseFloat(payment.amount),
                    paymentMethod: payment.paymentMethod
                })
            } else {
                let index = _.findIndex(this.salesPayments, function(i) {
                    return i.paymentMethod.id == payment.paymentMethod.id
                })

                let currentSalesPayment = this.salesPayments[index]

                currentSalesPayment.amount += parseFloat(payment.amount)
            }

            payment.amount = null
        },
        deletePayment (key) {
            this.salesPayments.splice(key, 1)
        },

        // main action
        store () {
            const that = this

            let formRequest = this.form
            formRequest.items = _.map(this.items, (item) => {
                return {
                    product_id: item.id,
                    price: item.unit_price,
                    discount: item.discount,
                    quantity: item.quantity
                }
            })
            formRequest.payments = _.map(this.salesPayments, (payment) => {
                return {
                    amount: payment.amount,
                    payment_method_id: payment.paymentMethod.id
                }
            })

            axios.post('/api/sales', formRequest).then(res => {
                that.$swal({
                    title: 'Success!',
                    text: res.data.message,
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                }).then(swalRes => {
                });

                that.clearForm()
            })
        }
    },
    mounted() {
        const that = this

        this.$bus.$on('productSelected', event => {
            let item = event.product
            
            if (item) {
                this.addItem(item)
            }
        })

        this.$bus.$on('customerSelected', event => {
            let customer = event.customer
            
            if (customer) {
                this.form.customer_id = customer.id
            }
        })

        axios.get('/api/customers/search').then(res => {
            that.customers = res.data
        })

        axios.get('/api/payment-methods/all').then(res => {
            that.paymentMethods = res.data

            // select first payment
            this.payment.paymentMethod = that.paymentMethods[0]
        })
    }
}
</script>
