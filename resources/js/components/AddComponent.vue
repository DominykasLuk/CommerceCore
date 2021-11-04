<template xmlns:sv-bind="http://www.w3.org/1999/xhtml">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="variants bg-white">
                    <h5 class="red-title top">VARIANTS</h5>
                    <table class="col-12 float-down">
                        <th>
                            <img class="mr-3" src="assets/1.png" /><strong
                        >{{ resultCount }}x </strong
                        ><span class="simple">CoreProducts</span>
                        </th>
                        <th class="float-right">
                            <a class="red-title" id="change" href="/"
                            >Back</a
                            >
                        </th>
                    </table>
                    <div class="line-left"></div>
                    <table class="col-12 float-down">
                        <tr v-for="item in list" v-bind:key="item.id">
                            <th>
                                <img class="mr-3" src="assets/2.png" /><strong
                            >1x</strong
                            ><span class="simple">{{ item.name }}</span>
                            </th>
                            <th class="">${{ item.price }}</th>
                            <th class="d-flex justify-content-end">
                                <button
                                    id="delete"
                                    class="delete btn btn-primary btn-sm"
                                    v-on:click="deleteProduct(item.id)"
                                >
                                    DELETE
                                </button>
                            </th>
                        </tr>
                    </table>
                </div>
                <form class="d-flex flex-column add-form" @submit.stop.prevent="addProduct" method="post" >
                    <input class="my-3" placeholder="Product Name" type="text" name="productName" v-model="formData.name">
                    <input placeholder="Price" type="text" name="price" v-model="formData.price">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
export default {
    data() {
        return {
            list: [],
            success: false,
            error: false,
            errors: {},
            formData: {
                name: null,
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
        }

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
        addProduct() {
            axios.post('/api/products/', this.formData)
               .then((resp) => {
                    this.getData();
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
