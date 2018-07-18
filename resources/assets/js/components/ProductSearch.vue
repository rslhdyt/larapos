<template>
    <div class="input-group mb-3">
        <input id="search-box" type="text" class="form-control" placeholder="Search product..."
            autocomplete="off"
            v-model="query"
            @keydown.down="down"
            @keydown.up="up"
            @keydown.enter="hit"
            @keydown.esc="reset"
            @input="update"/>
            <!-- @blur="reset" -->

        <ul v-show="hasItems" class="list-group" style="position: absolute;top: 45px;width: calc(100% - 158px);">
            <a href="#" v-for="(item, $item) in items" :key="$item" :class="activeClass($item)" @mousedown="hit" @mousemove="setActive($item)" v-text="item.name" class="list-group-item list-group-item-action"></a>
        </ul>

        <div class="input-group-append">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#productModal">Advance Search</button>
        </div>

        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Search Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Barcode</th>
                                <th>Unit Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, key) in products.data" :key="key" v-if="products.data.length">
                                <td>{{ key + 1 }}</td>
                                <td>{{ product.name }}</td>
                                <td>{{ product.barcode }}</td>
                                <td>{{ product.unit_price | currency }}</td>
                                <td>{{ product.stock.quantity }} {{ product.uom.abbreviation }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" v-on:click="onHit(product)">Select</button>
                                </td>
                            </tr>
                        
                            <tr class="table-info" v-else>
                                <td colspan="5" align="center">Products empty or not found.</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueTypeahead from 'vue-typeahead'

Vue.prototype.$http = axios

export default {
    extends: VueTypeahead,
    data () {
        return {
            // The source url
            // (required)
            src: '/api/products/search',

            // The data that would be sent by request
            // (optional)
            data: {
                status: 'active'
            },

            // Limit the number of items which is shown at the list
            // (optional)
            limit: 5,

            // The minimum character length needed before triggering
            // (optional)
            minChars: 3,

            // Highlight the first item in the list
            // (optional)
            selectFirst: true,

            // Override the default value (`q`) of query parameter name
            // Use a falsy value for RESTful query
            // (optional)
            queryParamName: 'q',

            products: [],
        }
    },
    methods: {
        // The callback function which is triggered when the user hits on an item
        // (required)
        onHit (item) {
            this.$bus.$emit('productSelected', {
                product: item
            })

            this.reset()
        },

        // The callback function which is triggered when the response data are received
        // (optional)
        prepareResponseData (data) {
            return _.map(data, d => {
                return d
            })
        },

        activeClass (index) {
            return {
                'active': this.current === index
            }
        }
    },
    mounted() {
        const that = this

        document.getElementById('search-box').focus()

        axios.get('/api/products').then(res => {
            that.products = res.data
        });
    }
}
</script>