<script>
    export default {
        props: ['tenants'],
        data() {
            return {
                ssnumber: this.ssnumber,
                tenant: {
                    type: Object,
                    required: true
                },
                existingTenant: false,
                response: {
                    msg: "",
                    status: "",
                    action: "",
                },
            }
        },
        computed: {

        },
        create() {

        },
        mounted() {
            $("#tenant input").not("[name=ssnumber]").prop("disabled", true);
        },

        methods: {
            lookUpTenant() {
                if (!this.ssnumber) return;
                axios.post('/tenants/lookup', {
                    ssnumber: this.ssnumber,
                }).then(response => {
                    if (response.data.status == 'success') {
                        this.tenant = response.data.tenant;
                        this.existingTenant = true;
                        $("#tenant input").not("[name=ssnumber]").prop("disabled", false).prop("readonly", true);
                    } else {
                        this.existingTenant = false;
                    }
                    this.prepResponse(response.data.msg, response.data.status);
                }).catch(error => {
                    flash(error.response.data, 'danger');
                });
            },
            prepResponse(msg, status) {
                console.log(msg, status);
                if (status == 'success') {
                    this.response.msg = "A tenant was found, you may update the tenants information?";
                    this.response.action = "Update";
                    this.response.status = "alert-success";
                }
                else {
                    this.response.msg = "No match was found.";
                    this.response.action = "Create New Tenant";
                    this.response.status = "alert-warning";
                }
            },
            enableTenantInputs() {
                $("#tenant input").not("[name=ssnumber]").prop("disabled", false).prop("readonly", false);
            },
        }
    }
</script>