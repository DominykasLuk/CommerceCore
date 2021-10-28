<template xmlns:sv-bind="http://www.w3.org/1999/xhtml">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 p-5">
                <h5 class="red-title">VARIANTS</h5>
                <div class="variants bg-white p-3 rounded my-1">
                    <table class="col-12 float-down">
                        <th><img class="mr-3" src="assets/1.png"><strong>{{ resultCount }}x </strong><span
                            class="simple">CoreProducts</span></th>
                        <th class="float-right"><a class="red-title" id="change" href="#">Change</a></th>
                    </table>
                    <hr class="line">
                    <table class="col-12 float-down">
                        <tr v-for="item in list" v-bind:key="item.id">
                            <th><img class="mr-3" src="assets/2.png"><strong>1x</strong><span
                                class="simple">{{ item.name }}</span></th>
                            <th class="float-right">${{ item.price }}</th>
                            <th>
<!--                                <button id="delete" class="delete btn btn-primary" v-on:click="deleteProduct(item.id)">-->
<!--                                    DELETE-->
<!--                                </button>-->
                            </th>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">SAVE CHANGES</button>
                    </div>
                </div>

                <h5 class="red-title mt-4">PAYMENT AND SHIPPING</h5>
                <form class="needs-validation p-3 bg-white rounded my-1" method="post" @keydown="clearError" @submit.prevent="storeCheckout"
                      novalidate>

                    <div class="contact-form-success alert alert-success mt-4" v-if="success">
                        <strong>Success!</strong> Your checkout has been initiated!
                    </div>

                    <div class="contact-form-success alert alert-danger mt-4" v-if="error">
                        <strong>Error!</strong> There was an error
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="method-desc">
                                <h5>Customer information</h5>
                                <p>Fields marked as (*) are required.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control" id="firstName" name="fname" v-model="formData.fname"
                                   placeholder="*First name" value=""
                                   required
                                   :class="hasError('fname') ? 'is-invalid' : ''">
                            <div
                                v-if="hasError('fname')"
                                class="invalid-feedback">
                                {{ getError('fname')}}

                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control" id="lastName" name="lname" v-model="formData.lname"
                                   placeholder="*Last name" value=""
                                   required
                                   :class="hasError('lname') ? 'is-invalid' : ''">
                            <div
                                v-if="hasError('lname')"
                                class="invalid-feedback">
                        {{ getError('lname')}}

                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="*Email"
                               v-model="formData.email"
                               required
                               :class="hasError('email') ? 'is-invalid' : ''">
                        <div
                            v-if="hasError('email')"
                            class="invalid-feedback">
                              {{ getError('email')}}

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="address">Shipping Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="*Address"
                               v-model="formData.address"
                               required
                               :class="hasError('address') ? 'is-invalid' : ''">
                        <div
                            v-if="hasError('address')"
                            class="invalid-feedback">
                          {{ getError('address')}}

                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="city" name="city" placeholder="*City"
                               v-model="formData.city"
                               :class="hasError('city') ? 'is-invalid' : ''">
                        <div
                            v-if="hasError('city')"
                            class="invalid-feedback">
                              {{ getError('city')}}

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <span>*Country</span>
                            <select class="custom-select country d-block w-100" name="country" id="country"
                                    v-model="formData.country"
                                    required
                                    :class="hasError('country') ? 'is-invalid' : ''">

                                <option class="option" value=""></option>
                                <option>United States</option>
                            </select>
                            <div
                                v-if="hasError('country')"
                                class="invalid-feedback">
                                {{ getError('country')}}

                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <span>*State</span>
                            <select :class="hasError('state') ? 'is-invalid' : ''"
                                    class="custom-select state d-block w-100" name="state" id="state"
                                    v-model="formData.state" required>
                                <option class="option" value=""></option>
                                <option>California</option>
                            </select>
                            <div
                                v-if="hasError('state')"
                                class="invalid-feedback">
                                    {{ getError('state')}}

                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <input :class="hasError('zip') ? 'is-invalid' : ''" type="text" class="form-control "
                                   id="zip" name="zip" placeholder="*Postal code" v-model="formData.zip"
                                   required>
                            <div
                                v-if="hasError('zip')"
                                class="invalid-feedback">
                               {{ getError('zip')}}

                            </div>
                        </div>
                    </div>

                    <div class="method-desc">
                        <h5>Payment Method</h5>
                        <p><img src="assets/CheckOVal.png">All Transactions are secure and encrypted</p>
                    </div>

                    <div class="accordion" id="accordionPanelsStayOpenExample" @keydown="clearError">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button
                                    class="accordion-button position-relative" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                    <input type="radio" class="radio-button">
                                    Credit Card
                                    <img class="position-absolute" src="assets/security.png" style="right: 10px">
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse "
                                 aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-sm-12 mb-3">
                                            <input
                                                :class="hasError('cc_number') ? 'is-invalid' : ''"
                                                type="text" class="form-control" id="cc-number" name="cc-number"
                                                   placeholder="Card number" required v-model="formData.cc_number">
                                            <div
                                                v-if="hasError('cc_number')"
                                                class="invalid-feedback">
                                                {{ errors['cc_number'][0] }}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 mb-3">
                                            <input
                                                :class="hasError('cc_expiration') ? 'is-invalid' : ''"
                                                type="text" class="form-control" id="cc-expiration"
                                                   v-model="formData.cc_expiration"
                                                   placeholder="MM/YY" required>
                                            <div
                                                v-if="hasError('cc_expiration')"
                                                class="invalid-feedback">

                                                {{ errors['cc_expiration'][0] }}

                                            </div>
                                        </div>
                                        <div class="col-sm-3 mb-3">
                                            <div class="position-relative">
                                                <input
                                                    :class="hasError('cvv') ? 'is-invalid' : ''"

                                                    type="text" class="form-control" id="cc-cvv"
                                                       v-model="formData.cvv"
                                                       placeholder="CVV"
                                                       required>
                                                <div
                                                    v-if="hasError('cvv')"
                                                    class="invalid-feedback">

                                                    {{ errors['cvv'][0] }}

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block my-3" type="submit">COMPLETE ORDER</button>
                    <div class="d-flex justify-content-center">
                        <img src="/assets/NortonSecure.png">
                        <img src="/assets/VeriSign.png">
                        <img src="/assets/McAfee.png">
                        <img src="/assets/Comodo.png">
                    </div>
                </form>
            </div>


            <div class="col-md-5 bg-white p-5 pt-5">
                <table class="col-12 float-down">
                    <tr>
                        <th><img class="mr-3" src="assets/1.png"><strong>{{ resultCount }}x </strong><span
                            class="simple">CoreProducts</span></th>
                        <th class="float-right"><strong>${{ total }}</strong></th>
                    </tr>
                </table>
                <hr class="line">
                <table class="col-12">
                    <tr>
                        <th class="total">Total:</th>
                        <th class="float-right">
                            <span class="usd">USD</span>
                            <strong class="price">${{ total }}</strong>
                        </th>
                    </tr>
                </table>
                <div class="border d-flex justify-content-center align-content-center flex-column p-4 rounded mt-3">
                    <div class="d-flex align-items-center"><img src="assets/Return.png"><strong class="ml-2">60-day fit
                        guarantee</strong></div>
                    <p>Either it doesn’t fit or simply you don’t like it You can return it within 60 days for a full
                        refund. No questions asked.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)
export default {
    data() {
        return {
            list: null,
            success: false,
            error: false,
            errors: {},
            formData: {
                fname: null,
                lname: null,
                email: null,
                address: null,
                city: null,
                country: null,
                state: null,
                zip: null,
                cc_number: null,
                cc_expiration: null,
                cvv: null,
                price:null
            }
        }
    },
    computed: {
        resultCount() {
            return this.list && this.list.length
        },
        total() {
            let total = 0;
            this.list.forEach(el => {
                total += el.price;
            })
            return total;
        },
        hasAnyErrors(){
            return Object.keys(this.errors).length > 0;
        }

    },
    methods: {
        getData() {
            Vue.axios.get('http://localhost:8000/api/products')
                .then((resp) => {
                    this.list = resp.data;
                    console.warn(resp.data)
                })
        },
        deleteProduct(id) {
            this.axios.delete("http://127.0.0.1:8000/api/products/" + id).then((resp) => {
                this.getData();
            })
        },
        storeCheckout() {
            axios.post('/api/checkout/', this.formData)
                .then((res) => {
                    this.onSuccess(res.data.message)
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        this.setErrors(error.response.data.errors)
                    } else {
                        this.onFailure(error.response.data.message)
                    }
                })
        },

        onSuccess(message) {
            this.success = true;
        },

        onFailure(message) {
            this.error = true;
        },
        setErrors(errors) {
            this.errors = errors;
        },
        hasError(fieldName) {
            return (fieldName in this.errors);
        },
        getError(fieldName){
            return this.errors[fieldName][0];
        },
        clearError(event){
            Vue.delete(this.errors, event.target.name);
        }

    },
    mounted() {
        this.getData()
    }

}
</script>
