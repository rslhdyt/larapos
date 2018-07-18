<template>
    <form>
        <div class="form-group">
            <label for="name">Name *</label>
            <input v-model="form.name" type="text" class="form-control" id="name" placeholder="Customer name">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="email">Email *</label>
            <input v-model="form.email" type="text" class="form-control" id="email" placeholder="Customer email">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input v-model="form.phone" type="text" class="form-control" id="phone" placeholder="Customer phone number">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="address">Adress</label>
            <input v-model="form.address" type="text" class="form-control" id="address" placeholder="Customer address">
            <div class="invalid-feedback"></div>
        </div>
    </form>
</template>

<script>
export default {
    data () {
        return {
            form: {
                name: null,
                email: null,
                phone: null,
                address: null,
            }
        }
    },
    methods: {
        store () {
            const that = this

            axios.post('/api/customers', this.form).then(res => {
                that.$bus.$emit('customerCreated', {
                    customer: res.data
                })

                that.clearForm()
            });
        },
        clearForm () {
            this.form = {
                name: null,
                email: null,
                phone: null,
                address: null,
            }
        }
    },
    mounted () {
        this.$bus.$on('saveFormCreateCustomer', event => {
            this.store()
        })

        this.$bus.$on('clearFormCreateCustomer', event => {
            this.clearForm()
        });
    }
}
</script>
