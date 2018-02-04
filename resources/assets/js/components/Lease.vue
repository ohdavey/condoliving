<script>
    export default {
        props: ['tenants'],
        data() {
            return {
                newTenant: true,
            }
        },
        computed: {

        },
        methods: {
            newTenantCheck() {
                console.log('New');
                this.newTenant = true;
            },
            existingTenantCheck() {
                console.log('Existing');
                this.newTenant = false;
            },
        }
    }
</script>