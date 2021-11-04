<template xmlns:sv-bind="http://www.w3.org/1999/xhtml">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="variants bg-white">
                    <h5 class="red-title top">VARIANTS</h5>
                    <table class="col-12 float-down">
                        <th>
                            <img class="product-count" src="assets/1.png"/>
                            <span>{{ resultCount }}x</span>
                            <span class="simple">CoreProduct®</span>
                        </th>
                        <th class="text-right">
                            <a class="red-title" id="change" href="add"
                            >Change</a>
                        </th>
                    </table>
                    <div class="line-left"></div>
                    <table class="col-12 float-down">
                        <tr v-for="item in list" v-bind:key="item.id">
                            <th class="d-flex">
                                <img class="product-photo" src="assets/2.png"/>
                                <div class="d-flex align-items-center bit-up">1x <span
                                    class="simple bit-right">{{ item.name }}</span></div>
                            </th>
                            <th class="price text-right">
                                <div class="bit-up">${{ item.price }}</div>
                            </th>
                        </tr>
                    </table>
                    <div class="d-flex justify-content-end">
                    <a class="btn btn-primary ">SAVE CHANGES</a>
                    </div>
                </div>
                <form
                    class="needs-validation bg-white position-relative"
                    @submit.prevent="storeCheckout"
                    method="post"
                    @keydown="clearError"
                    novalidate="novalidate"
                >
                    <h5 class="red-title bottom">PAYMENT AND SHIPPING</h5>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="method-desc">
                                <h5>Customer information</h5>
                                <p>Fields marked as (*) are required.</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="fname-input">
                            <input
                                type="text"
                                class="form-control"
                                id="firstName"
                                name="fname"
                                v-model="formData.fname"
                                placeholder="*First name"
                                value=""
                                required
                                :class="hasError('fname') ? 'is-invalid' : ''"
                            />

                        </div>
                        <div class="lname-input">
                            <input
                                type="text"
                                class="form-control"
                                id="lastName"
                                name="lname"
                                v-model="formData.lname"
                                placeholder="*Last name"
                                value=""
                                required
                                :class="hasError('lname') ? 'is-invalid' : ''"
                            />

                        </div>
                    </div>

                    <div class="">
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="*Email"
                            v-model="formData.email"
                            required
                            :class="hasError('email') ? 'is-invalid' : ''"
                        />

                    </div>

                    <div class="">
                        <label for="address" class="address"
                        >Shipping Address</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="address"
                            name="address"
                            placeholder="*Address"
                            v-model="formData.address"
                            required
                            :class="hasError('address') ? 'is-invalid' : ''"
                        />

                    </div>
                    <div class="">
                        <input
                            type="text"
                            class="form-control"
                            id="city"
                            name="city"
                            placeholder="*City"
                            v-model="formData.city"
                            :class="hasError('city') ? 'is-invalid' : ''"
                        />

                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="country-input position-relative">
                            <img src="assets/ChevronDown.png">
                            <span>*Country</span>
                            <select
                                class="country d-block custom-select"
                                name="country"
                                id="country"
                                v-model="formData.country"
                                required
                                :class="hasError('country') ? 'is-invalid' : ''"
                            >
                                <option selected>Select</option>
                                <option>United States</option>
                            </select>

                        </div>
                        <div class="state-input position-relative">
                            <img src="assets/ChevronDown.png">
                            <span>*Region/State</span>
                            <select
                                :class="hasError('state') ? 'is-invalid' : ''"
                                class="state d-block custom-select"
                                name="state"
                                id="state"
                                v-model="formData.state"
                                required
                            >
                                <option selected>Select</option>
                                <option>California</option>
                            </select>

                        </div>
                        <div class="zip-input">
                            <input
                                :class="hasError('zip') ? 'is-invalid' : ''"
                                type="text"
                                class="form-control"
                                id="zip"
                                name="zip"
                                placeholder="*Postal code"
                                v-model="formData.zip"
                                required
                            />

                        </div>
                    </div>

                    <div class="method-desc bottom">
                        <h5>Payment Method</h5>
                        <p>
                            <img src="assets/CheckOVal.png"/>All Transactions
                            are secure and encrypted
                        </p>
                    </div>

                    <div
                        class="accordion"
                        id="accordionPanelsStayOpenExample"
                        @keydown="clearError"
                    >
                        <div class="accordion-item">
                            <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                            >
                                <button
                                    class="accordion-button position-relative"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne"
                                    aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne"
                                >
                                    <div class="radio">
                                        <input id="yes" type="radio" name="s">
                                    </div>
                                    Credit Card
                                    <img
                                        class="position-absolute"
                                        src="assets/security.png"
                                        style="right: 12px"
                                    />
                                </button>
                            </h2>
                            <div
                                id="panelsStayOpen-collapseOne"
                                class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingOne"
                            >
                                <div class="accordion-body">
                                    <div class="cc-number">
                                        <input
                                            :class="
                                                    hasError('cc_number')
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                            type="text"
                                            class="form-control"
                                            id="cc-number"
                                            name="cc-number"
                                            placeholder="Card number"
                                            required
                                            v-model="formData.cc_number"
                                        />

                                    </div>
                                    <div class="d-flex">
                                        <div class="expiration-input">
                                            <input
                                                :class="
                                                    hasError('cc_expiration')
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                                type="text"
                                                class="form-control"
                                                id="cc-expiration"
                                                v-model="formData.cc_expiration"
                                                placeholder="MM/YY"
                                                required
                                            />

                                        </div>
                                        <div class="cvv-input position-relative">
                                            <input
                                                :class="
                                                        hasError('cvv')
                                                            ? 'is-invalid'
                                                            : ''
                                                    "
                                                type="text"
                                                class="form-control"
                                                id="cc-cvv"
                                                v-model="formData.cvv"
                                                placeholder="CVV"
                                                required
                                            />
                                            <img src="assets/infoOutline.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button
                        class="btn btn-primary btn-lg btn-block"
                        type="submit"
                        :disabled="hasAnyErrors"
                    >
                        COMPLETE ORDER
                    </button>
                    <div
                        class="contact-form-success alert alert-success mt-4"
                        v-if="success"
                    >
                        <strong>Success!</strong> Your checkout has been
                        initiated!
                    </div>

                    <div
                        class="contact-form-success alert alert-danger mt-4"
                        v-if="error"
                    >
                        <strong>Error!</strong> There was an error
                    </div>
                    <div class="security d-flex justify-content-center gap-1">
                        <img src="/assets/NortonSecure.png"/>
                        <img src="/assets/VeriSign.png"/>
                        <img src="/assets/McAfee.png"/>
                        <img src="/assets/Comodo.png"/>
                    </div>
                </form>
            </div>

            <div class="col-md-5 bg-white">
                <div class="right-info">
                    <table class="col-12 float-down">
                        <tr>
                            <th>
                                <img class="product-count-right" src="assets/1.png"/>
                                <span class="count-top">{{ resultCount }}x</span><span
                                class="simple-right">CoreProduct®</span>
                            </th>
                            <th>
                                <div class="d-flex justify-content-end">
                                    <span class="price-top">${{ total }}</span>
                                </div>
                            </th>
                        </tr>
                    </table>
                    <div class="line"></div>
                    <table class="col-12">
                        <tr>
                            <th class="total">Total:</th>
                            <th>
                                <div class="d-flex justify-content-end">
                                    <span class="price-big">${{ total }}</span>
                                </div>
                            </th>
                        </tr>
                    </table>
                    <div class="return-box">
                        <div class="d-flex align-items-center return-text">
                            <img class="return-img" src="assets/Return.png"/>
                            <p>60-day fit guarantee</p>
                        </div>
                        <p>
                            Either it doesn’t fit or simply you don’t like it You
                            can return it within 60 days for a full refund. No
                            questions asked.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";

Vue.use(VueAxios, axios);
export default {
    data() {
        return {
            list: [],
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
                price: null,
            },
        };
    },
    computed: {
        resultCount() {
            return this.list && this.list.length;
        },
        total() {
            let total = 0;
            this.list.forEach((el) => {
                total += el.price;
            });
            return total;
        },
        hasAnyErrors() {
            return Object.keys(this.errors).length > 0;
        },
    },
    watch: {
        total: {
            immediate: true,
            handler(value) {
                this.formData.price = value;
            },
        },
    },
    methods: {
        getData() {
            Vue.axios.get("http://localhost:8000/api/products").then((resp) => {
                this.list = resp.data;
                console.warn(resp.data);
            });
        },
        deleteProduct(id) {
            this.axios
                .delete("http://127.0.0.1:8000/api/products/" + id)
                .then((resp) => {
                    this.getData();
                });
        },
        storeCheckout() {
            axios
                .post("/api/checkout/", this.formData)
                .then((res) => {
                    this.onSuccess(res.data.message);
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        this.setErrors(error.response.data.errors);
                    } else {
                        this.onFailure(error.response.data.message);
                    }
                });
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
            return fieldName in this.errors;
        },
        getError(fieldName) {
            return this.errors[fieldName][0];
        },
        clearError(event) {
            this.errors = {};
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
