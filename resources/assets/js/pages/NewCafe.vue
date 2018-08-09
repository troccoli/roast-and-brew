<template>
    <div class="page">
        <form>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="large-12 medium-12 small-12 cell">
                        <label>Name
                            <input type="text" placeholder="Cafe name" v-model="name">
                            <span class="validation"
                                  v-show="!validations.name.is_valid">{{ validations.name.text }}</span>
                        </label>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>Address
                            <input type="text" placeholder="Address" v-model="address">
                            <span class="validation" v-show="!validations.address.is_valid">{{ validations.address.text }}</span>
                        </label>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>City
                            <input type="text" placeholder="City" v-model="city">
                            <span class="validation"
                                  v-show="!validations.city.is_valid">{{ validations.city.text }}</span>
                        </label>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>State
                            <input type="text" placeholder="State" v-model="state">
                            <span class="validation"
                                  v-show="!validations.state.is_valid">{{ validations.state.text }}</span>
                        </label>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>Zip
                            <input type="text" placeholder="Zip" v-model="zip">
                            <span class="validation"
                                  v-show="!validations.zip.is_valid">{{ validations.zip.text }}</span>
                        </label>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <a class="button" v-on:click="submitNewCafe()">Add Cafe</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name       : '',
                address    : '',
                city       : '',
                state      : '',
                zip        : '',
                validations: {
                    name   : {
                        is_valid: true,
                        text    : ''
                    },
                    address: {
                        is_valid: true,
                        text    : ''
                    },
                    city   : {
                        is_valid: true,
                        text    : ''
                    },
                    state  : {
                        is_valid: true,
                        text    : ''
                    },
                    zip    : {
                        is_valid: true,
                        text    : ''
                    }
                }
            }
        },
        methods: {
            validateNewCafe() {
                let validNewCafeForm = true;

                if (this.name.trim() == '') {
                    validNewCafeForm = false;
                    this.validations.name.is_valid = false;
                    this.validations.name.text = 'Please enter a name for the new cafe!';
                } else {
                    this.validations.name.is_valid = true;
                    this.validations.name.text = '';
                }

                if (this.address.trim() == '') {
                    validNewCafeForm = false;
                    this.validations.address.is_valid = false;
                    this.validations.address.text = 'Please enter an address for the new cafe!';
                } else {
                    this.validations.address.is_valid = true;
                    this.validations.address.text = '';
                }

                if (this.city.trim() == '') {
                    validNewCafeForm = false;
                    this.validations.city.is_valid = false;
                    this.validations.city.text = 'Please enter a city for the new cafe!';
                } else {
                    this.validations.city.is_valid = true;
                    this.validations.city.text = '';
                }

                if (this.state.trim() == '') {
                    validNewCafeForm = false;
                    this.validations.state.is_valid = false;
                    this.validations.state.text = 'Please enter a state for the new cafe!';
                } else {
                    this.validations.state.is_valid = true;
                    this.validations.state.text = '';
                }

                if (this.zip.trim() == '' || !this.zip.match(/(^\d{5}$)/)) {
                    validNewCafeForm = false;
                    this.validations.zip.is_valid = false;
                    this.validations.zip.text = 'Please enter a valid zip code for the new cafe!';
                } else {
                    this.validations.zip.is_valid = true;
                    this.validations.zip.text = '';
                }

                return validNewCafeForm;
            },

            submitNewCafe() {
                if (this.validateNewCafe()) {
                    this.$store.dispatch('addCafe', {
                        name   : this.name,
                        address: this.address,
                        city   : this.city,
                        state  : this.state,
                        zip    : this.zip
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>