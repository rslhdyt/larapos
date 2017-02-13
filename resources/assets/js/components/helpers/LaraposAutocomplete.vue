<template>
    <div class="form-group">
        <label class="control-label" v-show="label">{{ label }}</label>
        <input type="text" class="form-control" :placeholder="placeholder" v-model="query" 
            @keydown.enter="enter"
            @keydown.down="down"
            @keydown.up="up"
            @input="change">

        <ul class="list-group" v-show="showList">
            <a href="#" class="list-group-item" v-for="(result, index) in results" :class="{'active' : isActive(index)}" @click="resultClick(index)">{{ result.name }}</a>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['label', 'src', 'placeholder', 'select'],
    data() {
        return {
            current: 0,
            open: false,
            query: '',
            results: [],
        }
    },
    methods: {
        up() {
            if(this.current > 0)
                this.current--
        },
        down() {
            if(this.current < this.results.length - 1)
                this.current++
        },
        enter() {
            let result = this.results[this.current]

            this.query = result.name
            this.open = false

            this.select ? this.select(result) : null
        },
        resultClick(index) {
            let result = this.results[index]
            
            this.query = result.name
            this.open = false

            this.select ? this.select(result) : null
        },
        change() {
            if (this.open == false) {
                this.open = true
                this.current = 0
            }

            this.$http.get(this.src, {
                params : {
                    q: this.query
                }
            }).then(function(results) {
                this.results = results.body.data;
            })
        },
        isActive(index) {
            return index === this.current
        }
    },
    computed: {
        showList() {
            return this.query !== "" && this.results.length != 0 && this.open === true
        }
    }
}
</script>