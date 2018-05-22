<script>
    import Validate from 'vee-validate';
    import moment from 'moment';
    Vue.use(Validate);
    export default {
        props: ['tenants'],
        data() {
            return {
                pid: this.pid,
                tenant: {
                    type: Object,
                    required: true
                },
                lease: {
                    tenant_id: '',
                    start_date: '',
                    end_date: '',
                    due_day: '',
                    monthly_rate: '',
                    deposit: '',
                    maintenance_fee: '',
                    late_fee: '',
                    amenities: '',
                    notes: '',
                },
                today: '',
                existingTenant: false,
                response: {
                    msg: "",
                    errors: [],
                    status: "",
                    action: "",
                },
                request: {
                    message: "",
                    errors: [],
                    status: ""
                },
            }
        },
        computed: {

        },
        create() {

        },
        mounted() {
            $("#tenant input").not("[name=pid]").prop("disabled", true);
            this.today = moment().format('YYYY-MM-DD');
        },

        methods: {
            validate: function () {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        let formContents = jQuery.extend(this.lease, this.tenant);
                        this.createLease(formContents);
                        return;
                    }
                });
            },
            createLease: function(formContents) {
                axios({
                    method: 'post',
                    responseType: 'json',
                    url: '/lease',
                    data: formContents
                }).then(response => {
                    self.$router.push('/lease' + response.data.lease);
                }).catch(error => {
                    this.request.message = error.response.data.message;
                    this.request.errors = error.response.data.errors;
                    this.request.status = 'error';
                    console.log(this.request.message);
                    console.log(this.request.errors);
                });
            },
            lookUpTenant: function() {
                if (!this.pid) return;
                axios.post('/tenants/lookup', {
                    pid: this.pid,
                }).then(response => {
                    if (response.data.status == 'success') {
                        this.tenant = response.data.tenant;
                        this.lease.tenant_id = this.tenant.id;
                        this.existingTenant = true;
                        $("#tenant input").not("[name=pid]").prop("disabled", false).prop("readonly", true);
                    } else {
                        this.existingTenant = false;
                    }
                    this.prepResponse(response.data.msg, response.data.status);
                }).catch(error => {
                    flash(error.response.data, 'danger');
                });
            },
            prepResponse: function(msg, status) {
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
            enableTenantInputs: function() {
                $("#tenant input").not("[name=pid]").prop("disabled", false).prop("readonly", false);
            },
        }
    }
</script>