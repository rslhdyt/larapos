<template>
    <div class="row mb-5">
        <div class="col-md-8 col-sm-12">
            <div class="card mb-3">
                <div class="card-header">Receiving Items</div>
                <div class="card-body p-0">
                    <product-search class="p-2"></product-search>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Product</th>
                                    <th width="20%">Quantity</th>
                                    <th width="20%">Price</th>
                                    <th width="10%" align="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, key) in items" :key="key">
                                    <td>{{ key + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>
                                        <input v-validate="'required|numeric'" :data-vv-name="'quantity at row ' + (key + 1)" v-model="item.quantity" type="number" :class="{ 'form-control': true, 'form-control-sm': true, 'is-invalid': errors.has('quantity at row ' + (key + 1)) }">
                                        <div class="invalid-feedback">{{ errors.first('quantity at row ' + (key + 1)) }}</div>
                                    </td>
                                    <td>
                                        <input v-validate="'required'" :data-vv-name="'price at row ' + (key + 1)" v-model="item.price" type="text" :class="{ 'form-control': true, 'form-control-sm': true, 'is-invalid': errors.has('price at row ' + (key + 1)) }">
                                        <div class="invalid-feedback">{{ errors.first('price at row ' + (key + 1)) }}</div>
                                    </td>
                                    <td align="center">
                                        <button v-on:click="deleteItem(item)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr v-show="!items.length" class="table-info">
                                    <td colspan="5" align="center">Receiving items empty.</td>
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
                <div class="card-header">Receiving Data</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Supplier *</label>
                        <select v-validate="'required'" data-vv-name="supplier" v-model="form.supplier_id" :class="{'form-control' : true, 'is-invalid' : errors.has('supplier')}">
                            <option :value="null">-- Choose --</option>
                            <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{ supplier.name }}</option>
                        </select>
                        <div class="invalid-feedback">{{ errors.first('supplier') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea v-model="form.comments" class="form-control"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-primary" @click.prevent="validateForm">Save</button>
                    <a href="/" class="btn btn-link">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductSearch from './ProductSearch.vue'

export default {
    // props: ['receiving'],
    components: {
        ProductSearch
    },
    data() {
        return {
            form: {
                supplier_id: null
            },
            items: [],
            suppliers: [],
        }
    },
    methods: {
        addItem (item) {
            let ids = _.map(this.items, 'id')

            if (!_.includes(ids, item.id)) {
                this.$set(item, 'product_id', item.id)
                this.$set(item, 'quantity', 1)

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
                supplier_id: null
            }
            this.items = []
        },
        validateForm () {
            const that = this

            this.$validator.validateAll().then((result) => {
                if (result) {
                    that.store()
                }
            });
        },

        // main action
        store () {
            const that = this

            let formRequest = this.form
            formRequest.items = this.items

            axios.post('/api/receivings', formRequest).then(res => {
                that.$swal({
                    title: 'Success!',
                    text: res.data.message,
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                }).then(swalRes => {
                    window.location = '/receivings'
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

        axios.get('/api/suppliers/search').then(res => {
            that.suppliers = res.data
        })
    }
}
</script>
