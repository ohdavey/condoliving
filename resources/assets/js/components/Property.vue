<script>
    import moment from 'moment';
    export default {
        props: {
            property: {
                type: Object,
                required: true
            },
            community: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                editing: false,
                form: {},
                owner_id: this.property.owner_id,
                community_id: this.property.community_id,
                name: this.community.name,
                address: this.property.address,
                city: this.community.city,
                state: this.community.state,
                unit: this.property.unit,
                beds: this.property.beds,
                baths: this.property.baths,
                sqft: this.property.sqft,
                year_built: this.property.year_built,
                parking: this.property.parking,
                price: this.property.price,
                body: this.property.body,
                postcode: this.community.postcode,
                type: this.property.type,
                status: this.property.status,
                created_at: this.property.created_at,
                updated_at: this.property.updated_at,
            };
        },
        computed: {
            created_ago() {
                return moment(this.created_at).fromNow() + '...';
            },
            updated_ago() {
                return moment(this.updated_at).fromNow() + '...';
            }
        },
        created () {
            this.reset();
        },
        mounted () {
            console.log(this.city);
        },
        methods: {
            update() {
                axios.post('/community/' + this.property.community_id + '/property/' + this.property.id, {

                    address: this.address,
                    unit: parseFloat(this.unit),
                    beds: parseFloat(this.beds),
                    baths: parseFloat(this.baths),
                    sqft: parseFloat(this.sqft),
                    year_built: parseFloat(this.year_built),
                    parking: parseFloat(this.parking),
                    price: parseFloat(this.price),
                    body: this.body,
                    type: this.type,

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