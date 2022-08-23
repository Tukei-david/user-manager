<template>
  <div>
    <div class="card mt-3" v-if="active.dashboard">
        <div class="card-body">
            <h3>
                Manage Users
                <button 
                    class="btn btn-outline-success btn-sm float-right" 
                    style="float: right;"
                    @click="setActive('createUser')">
                    &plus;
                    <i class="fas fas-plus"></i>
                    User
                </button>
            </h3>
            <div 
                class="alert-success alert" role="alert"
                v-if="success_message !== null">
                {{ success_message }}
            </div>

            <PagePaginator
                v-if="results !== null"
                v-bind:results="results"
                v-on:get-page="getPage"
            ></PagePaginator>

            <PaginatorDetails
                v-if="results !== null"
                v-bind:results="results"
            ></PaginatorDetails>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Since</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody v-if="results !== null">
                    <tr v-for="user in results.data" :key="user.id">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.user_since}}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-warning">
                                    Edit
                                    <!-- <i class="fas fa-edit"></i> -->
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <PagePaginator
                v-if="results !== null"
                v-bind:results="results"
                v-on:get-page="getPage"
            ></PagePaginator>
        </div>
    </div>

    <CreateUser
        v-if="active.createUser"
        v-on:view-dashboard="setActive('dashboard')"
        v-on:created-user="flashSuccessAndReload($event)"
    >

    </CreateUser>
  </div>
</template>

<script>

    import PagePaginator from "../utilities/paginating/PagePaginator.vue"
    import PaginatorDetails from "../utilities/paginating/PaginatorDetails.vue"
    import CreateUser from "./CreateUser.vue"

    export default {
        components: {
            PagePaginator,
            PaginatorDetails,
            CreateUser,
        },
        mounted() {
            this.getUsers()
        },
        data() {
            return {
                results: null,
                active: {
                    dashboard: true,
                    createUser: false
                },
                params: {
                    page: 1
                },
                success_message: null,
            }
        },
        methods: {
            getUsers: function() {
                axios.get('/data/users', {params: this.params}).then(response => {
                    this.results = response.data.results
                });
            },
            getPage: function(event) {
                this.params.page = event
                window.scrollTo(0, 0) // Scroll to the top of the page
                this.getUsers()
            },
            setActive: function(component) {
                Object.keys(this.active).forEach(key => this.active[key] = false)
                this.active[component] = true
            },
            flashSuccessAndReload: function(event) {
                this.setActive('dashboard')
                this.success_message = event
                this.getUsers()
            }
        }
    }

</script>