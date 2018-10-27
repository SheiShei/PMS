<template>
    <div class="mybox">
        <div class="mybox-head userlist row">
            <div class="ul-item col-md-6">
                <h6><strong>USERS LIST</strong></h6> 
            </div>
            <div class="ul-item pull-right col-md-6">
                <div class="input-group">
                    <div class="form-group is-empty">
                        <input type="text" class="form-control" v-model="tableData.search" placeholder="Search Table" @input="search()">
                    </div>
                    <div class="input-group-addon">
                        <span class="fa fa-search"></span>                
                    </div>
                </div>             
            </div>       
        </div>
        <div class="mybox-body white-white-bg">
            <div class="table-responsive" style="max-height: 28vh; overflow:auto">
            <main-table :columns="columns" class="table table-bordered table-brands">
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                            <td>{{user.id}}</td>
                            <td>{{user.name}}</td>
                            <td><a href="#">{{user.email}}</a></td>
                            <td>{{user.created_at}}</td>
                            <td class="td-actions text-right">
                                 <button type="button" rel="tooltip" class="btn btn-success btn-fab-mini btn-simple btn-xs" data-original-title="" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                 <button type="button" rel="tooltip" class="btn btn-danger btn-fab-mini btn-simple btn-xs" data-original-title="" title="Archive">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                            </td>
                    </tr>
                    
                </tbody>
            </main-table>
        </div>
        </div>
        <div class="mybox-footer userlist-ft">
            <main-pagination :pagination="pagination"
                        @prev="getUsers(pagination.prevPageUrl)"
                        @next="getUsers(pagination.nextPageUrl)">
        </main-pagination>
        </div>
    </div>
</template>

<script>
import Table from './Table.vue';
import Pagination from './Pagination.vue';

export default {
    components: {
        mainTable : Table,
        mainPagination : Pagination
    },
    created() {
        this.getUsers();
    },
    data() {
        let columns = [
            {label: 'ID', name: 'id' },
            {label: 'Name', name: 'name' },
            {label: 'Email', name: 'email'},
            {label: 'Date Created', name: 'created_at'},
            {label: 'Actions', name: 'actions'},
        ];

        return {
            users: [],
            columns: columns,
            tableData: {
                draw: 0,
                search: '',
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            }
        }
    },
    methods: {
        getUsers(url = '/data') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.users = data.data.data;
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        search: _.debounce(function (e) {
            this.getUsers()
        }, 700),
    }
     
}
</script>

<style lang="scss" scoped>
</style>
