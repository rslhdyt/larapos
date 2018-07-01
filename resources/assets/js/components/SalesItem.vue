<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.unit_price | currency }}</td>
        <td>
            <input v-validate="'required|numeric'" :data-vv-name="'quantity at row ' + rowNumber" v-model="item.quantity" type="number" :class="{ 'form-control': true, 'form-control-sm': true, 'is-invalid': errors.has('quantity at row ' + rowNumber) }">
            <div class="invalid-feedback">{{ errors.first('quantity at row ' + rowNumber) }}</div>
        </td>
        <td>
            <input v-validate="'decimal'" :data-vv-name="'discount at row ' + rowNumber" v-model="item.discount" type="number" step="0.01" min="1" max="100" :class="{ 'form-control': true, 'form-control-sm': true, 'is-invalid': errors.has('discount at row ' + rowNumber) }">
            <div class="invalid-feedback">{{ errors.first('discount at row ' + rowNumber) }}</div>
        </td>
        <td>{{ subtotalPrice | currency }}</td>
        <td align="center">
            <button v-on:click="deleteItem(item)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['index', 'item'],
    data () {
        return {
        }
    },
    computed: {
        rowNumber () {
            return this.index + 1;
        },
        bruttoPrice () {
            let item = this.item

            return item.quantity * item.unit_price
        },
        discountPrice () {
            let item = this.item

            return (item.quantity * item.unit_price) * (item.discount / 100)
        },
        subtotalPrice () {
            let item = this.item

            return this.bruttoPrice - this.discountPrice
        },
        costOfGoodsSold () {
            let item = this.item

            return item.unit_price - this.discountPrice
        }
    },
    methods: {
        addItem (item) {
            item.quantity = item.quantity + 1
        },
        removeItem (item) {
            if (item.quantity - 1 == 0) {
                this.confirmDelete = true
            } else {
                item.quantity = item.quantity - 1
            }
        },
        deleteItem (item) {
            let index = _.findIndex(this.$parent.items, function(i) {
                return i.id == item.id
            })

            this.$parent.items.splice(index, 1)
        },
        toggleDelete() {
            this.confirmDelete = (this.confirmDelete) ? false : true
        }
    },
    watch: {
        subtotalPrice () {
            this.item.subtotal_unit_price = this.subtotalPrice
        },
        costOfGoodsSold () {
            this.item.cost_of_goods_sold = this.costOfGoodsSold
        }
    }
}
</script>