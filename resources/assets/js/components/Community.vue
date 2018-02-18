<script>
    export default {
        props: {
            community: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                editing: false,
                form: {},
                name: this.community.name,
                description: this.community.description,
                address: this.community.address,
                city: this.community.city,
                state: this.community.state,
                postcode: this.community.postcode,
                country: this.community.country,
            };
        },
        computed: {
        },
        created () {
            this.reset();
        },
        mounted () {
            console.log(this.community);
        },
        methods: {
            update() {
                axios.post('/community/' + this.community.id, {
                    name: this.name,
                    description: this.description,
                    address: this.address,
                    city: this.city,
                    state: this.state,
                    postcode: this.postcode,
                    country: this.country,
                }).then(response => {
                    flash('Your thread has been updated.', 'success');
                    this.editing = false;
                }).catch(error => {
                    flash(error.response.data, 'danger');
                });
            },
            reset() {
                flash("No changes were applied.", 'warning');
                this.editing = false;
            },
            destroy() {
                axios.delete('/community/' + this.id);
                this.$emit('community', this.id);
            },
        }
    }
</script>