<template>
    <el-container>
        <el-header>
            <el-tag>Search for houses</el-tag>
        </el-header>
        <el-container style="border: 1px solid #eee">
            <el-aside>
                <el-form ref="form" :model="form" style="max-width: 300px" label-width="80px">
                    <el-form-item label="Name">
                        <el-input
                                style="max-width:180px"
                                v-model="form.name"
                                placeholder="Enter name"
                                :maxlength="50"
                                clearable>
                        </el-input>
                    </el-form-item>
                    <el-form-item label="Price">
                        <el-input-number
                                style="max-width:90px"
                                v-model="form.price_from"
                                placeholder="From"
                                :controls="false"
                                :min="1">
                        </el-input-number>
                        <el-input-number
                                style="max-width:90px"
                                v-model="form.price_to"
                                placeholder="To"
                                :controls="false"
                                :min="1">
                        </el-input-number>
                    </el-form-item>

                    <el-form-item label="Bedrooms">
                        <el-input-number v-model="form.bedrooms" :min="1" :max="10"></el-input-number>
                    </el-form-item>

                    <el-form-item label="Bathrooms">
                        <el-input-number v-model="form.bathrooms" :min="1" :max="10"></el-input-number>
                    </el-form-item>

                    <el-form-item label="Storeys">
                        <el-input-number v-model="form.storeys" :min="1" :max="10"></el-input-number>
                    </el-form-item>

                    <el-form-item label="Garages">
                        <el-input-number v-model="form.garages" :min="1" :max="10"></el-input-number>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="submit">Apply</el-button>
                    </el-form-item>
                </el-form>
            </el-aside>

            <el-container>
                <el-main>
                    <div style="min-height:50px" v-loading="loading">
                        <div v-show="result">
                            <el-table v-if="searchData.length" :data="searchData">
                                <el-table-column prop="name" label="Name"></el-table-column>
                                <el-table-column prop="bedrooms" label="Bedrooms"></el-table-column>
                                <el-table-column prop="bathrooms" label="Bathrooms"></el-table-column>
                                <el-table-column prop="storeys" label="Storeys"></el-table-column>
                                <el-table-column prop="garages" label="Garages"></el-table-column>
                                <el-table-column prop="price" label="Price"></el-table-column>
                            </el-table>
                            <el-alert v-else title="No matches found" :closable="false"></el-alert>
                        </div>
                    </div>
                </el-main>
            </el-container>
        </el-container>
    </el-container>
</template>

<script>
    export default {
        name: 'SearchForm',
        axios: axios,
        data() {
            return {
                loading: false,
                form: {
                    name: '',
                    bedrooms: undefined,
                    bathrooms: undefined,
                    storeys: undefined,
                    garages: undefined,
                    price_from: undefined,
                    price_to: undefined,
                },
                searchData: [],
                result: false
            }
        },

        methods: {
            getAxiosGetParams() {
                let form = {};
                for (let itemName in this.form) {
                    if (this.form[itemName] !== undefined && this.form[itemName] !== '') {
                        form[itemName] = this.form[itemName];
                    }
                }

                return new URLSearchParams(form);
            },

            submit() {
                this.loading = true;
                this.result = false;
                const params = this.getAxiosGetParams();

                axios.get('/api/apartments', {params})
                    .then(response => {
                        this.searchData = response.data.data;
                        this.loading = false;
                        this.result = true;
                        this.reportContainer = true;
                    })
                    .catch(error => {
                        this.loading = false;
                        this.result = false;
                        console.log(error);
                    });
            }
        },

        mounted() {
            this.submit();
        }
    }
</script>

<style scoped>
    .el-tag {
        padding-left: 40px;
        padding-right: 40px;
        font-size: medium
    }

    .el-aside {
        padding-top: 20px;
        min-width: 200px;
        background-color: rgb(238, 241, 246);
    }
</style>