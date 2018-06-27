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
            <button class="btn btn-primary" type="button">Advance Search</button>
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
            queryParamName: 'q'
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
        document.getElementById('search-box').focus()
    }
}
</script>