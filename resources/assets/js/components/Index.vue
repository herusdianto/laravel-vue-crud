<template>
    <div class="row" v-cloak>
        <div class="col-md-7">
            <div class="form-inline form-group">
                <label>Search:</label>

                <input
                    v-model="search"
                    class="form-control"
                    debounce="500"
                >
            </div>
        </div>

        <div class="col-md-5">
            <div class="dropdown form-inline pull-right">
                <label>Per Page:</label>

                <select class="form-control" v-model="perPage">
                    <option value=10>10</option>
                    <option value=25>25</option>
                    <option value=50>50</option>
                    <option value=75>75</option>
                    <option value=100>100</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive" v-cloak>
        <vuetable
                :api-url="url"
                :pagination-path="paginationPath"
                :per-page="perPage"
                :fields="fields"
                :sort-order="sortOrder"
                :table-class="tableClass"
                :ascending-icon="ascendingIcon"
                :descending-icon="descendingIcon"
                :item-actions="itemActions"
                :append-params="appendParams"
                :wrapper-class="wrapperClass"
                :table-wrapper="tableWrapper"
                :loading-class="loadingClass"
        ></vuetable>
    </div>

    <div class="text-center" v-cloak>
        <button class="btn btn-default" v-link="{ name: 'create' }">
            <i class="glyphicon glyphicon-plus"></i>
            Create
        </button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: '/api/students',
                paginationPath: '',
                search: '',
                perPage: 10,
                fields: [
                    {
                        name: '__checkbox',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                    {
                        title: 'Index',
                        name: '__sequence',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                    {
                        title: 'Avatar',
                        name: 'avatar',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                    {
                        title: 'Name',
                        name: 'name',
                        sortField: 'name',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                    {
                        title: 'Email',
                        name: 'email',
                        sortField: 'email',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                    {
                        title: 'Birth Date',
                        name: 'birth_date',
                        sortField: 'birth_date',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                    {
                        title: 'Actions',
                        name: '__component:actions',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                ],
                sortOrder: [
                    {
                        field: 'name',
                        direction: 'asc'
                    }
                ],
                tableClass: 'table table-bordered table-hover',
                ascendingIcon: 'glyphicon glyphicon-chevron-up',
                descendingIcon: 'glyphicon glyphicon-chevron-down',
                appendParams: [],
                wrapperClass: 'vuetable-wrapper ',
                tableWrapper: '.vuetable-wrapper'
            }
        },
        watch: {
            'search'(newValue, oldValue) {
                this.setFilter()
            },
            'perPage'(newValue, oldValue) {
                this.$broadcast('vuetable:refresh')
            },
        },
        methods: {
            /**
             * Other functions
             */
            setFilter() {
                this.appendParams = [
                    'search=' + this.search
                ];

                this.$nextTick(function () {
                    this.$broadcast('vuetable:refresh')
                })
            },
            resetFilter() {
                this.search = '';

                this.setFilter()
            },
            preg_quote(str) {
                return (str + '').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, "\\$1");
            },
            highlight(needle, haystack) {
                return haystack.replace(
                    new RegExp('(' + this.preg_quote(needle) + ')', 'ig'),
                    '<span class="highlight">$1</span>'
                )
            },
            paginationConfig(componentName) {
                this.$broadcast('vuetable-pagination:set-options', {
                    wrapperClass: 'pagination pull-right',
                    icons: {
                        first: '',
                        prev: '',
                        next: '',
                        last: ''
                    },
                    activeClass: 'active',
                    linkClass: 'btn btn-default',
                    pageClass: 'btn btn-default'
                })
            }
        },
        events: {
            'vuetable:load-success'(response) {
                let data = response.data.data;

                if (this.search !== '') {
                    for (let n in data) {
                        data[n].name = this.highlight(this.search, data[n].name)
                        data[n].email = this.highlight(this.search, data[n].email)
                    }
                }
            },
            'vuetable:load-error'(response) {
                if (response.status == 400) {
                    console.error('Something\'s Wrong!', response.data.message, 'error')
                } else {
                    console.error('Oops', E_SERVER_ERROR, 'error')
                }
            },
            'showData'(rowData) {
                this.$route.router.go({name: 'show', params: {studentId: rowData.id}})
            },
            'editData'(rowData) {
                console.log('editData', rowData)
            },
            'deleteData'(rowData) {
                console.log('deleteData', rowData)
            },
        }
    }
</script>
