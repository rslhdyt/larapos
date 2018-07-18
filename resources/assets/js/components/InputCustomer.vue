<template>
    <div class="input-group mb-3">
        <input id="search-box" type="text" class="form-control" placeholder="Search customer..."
            autocomplete="off"
            v-model="query"
            @keydown.down="down"
            @keydown.up="up"
            @keydown.enter="hit"
            @keydown.esc="reset"
            @input="update"/>
            <!-- @blur="reset" -->

        <ul v-show="hasItems" class="list-group" style="position: absolute;top: 38px;width: calc(100% - 158px);">
            <a href="#" v-for="(item, $item) in items" :key="$item" :class="activeClass($item)" @mousedown="hit" @mousemove="setActive($item)" v-text="item.name" class="list-group-item list-group-item-action"></a>
        </ul>

        <div class="input-group-append">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#customerModal"><i class="fa fa-plus"></i> Create</button>
        </div>

        <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customerModalLabel">Create New Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form-create-customer ref="formCustomerComponent"></form-create-customer>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="cancelCustomer">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="storeCustomer">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueTypeahead from 'vue-typeahead'
import FormCreateCustomer from './FormCreateCustomer.vue'

Vue.prototype.$http = axios

export default {
    extends: VueTypeahead,
    components: { FormCreateCustomer },
    data () {
        return {
            // The source url
            // (required)
            src: '/api/customers/search',

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
            queryParamName: 'q'
        }
    },
    methods: {
        // The callback function which is triggered when the user hits on an item
        // (required)
        onHit (item) {
            this.$bus.$emit('customerSelected', {
                customer: item
            })

            this.reset()

            this.query = item.name
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
        },
        cancelCustomer () {
            this.$bus.$emit('clearFormCreateCustomer');
        },
        storeCustomer () {
            this.$bus.$emit('saveFormCreateCustomer');
        }
    },
    mounted () {
        this.$bus.$on('customerCreated', event => {
            this.onHit(event.customer)

            $('#customerModal').modal('hide');
        })

        this.$bus.$on('inputCustomerCleared', event => {
            this.reset()
        })
    }
}
</script>