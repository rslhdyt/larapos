<template>
    <a v-on:click="doRestore"><slot></slot></a>
</template>

<script>
export default {
    name: 'restore-action',
    props: ['action'],
    data() {
        return {};
    },
    methods: {
        doRestore() {
            const that = this;

            // Use sweetalret2
            this.$swal({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((swalRes) => {
                if (swalRes.value) {
                    axios.put(that.action).then(result => {
                        that.$swal({
                            title: 'Restored!',
                            text: result.data.message,
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(swarRes => {
                            location.reload();
                        });
                    });
                }
            });
        }
    }
}
</script>

