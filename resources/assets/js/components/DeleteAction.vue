<template>
    <a v-on:click="doDelete"><slot></slot></a>
</template>

<script>
export default {
    name: 'delete-action',
    props: ['action'],
    data() {
        return {};
    },
    methods: {
        doDelete() {
            const that = this;

            // Use sweetalret2
            this.$swal({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((swalRes) => {
                if (swalRes.value) {
                    axios.delete(that.action).then(result => {
                        that.$swal({
                            title: 'Deleted!',
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

