<template>
  <div>
    <div class="card mt-3">
        <div class="card-body">
            <h3>
              <button 
                  class="btn btn-outline-primary mr-3 btn-sm" 
                  style="float: right;"
                  @click="$emit('view-dashboard')">
                  <!-- <i class="fas fas-chevron-left"></i> -->
                  &lt;
                  Back
              </button>
              Create New User.
            </h3>

            <hr>

            <div class="alert alert-warning" role="alert" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors" :key="error">
                  {{ error }}
                </li>
              </ul>
            </div>

            <form action="#">
              <div class="form-group row mb-3">
                <label for="" class="col-3">Name</label>
                <div class="col-9">
                  <input type="text" class="form-control" v-model="data.name">
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="" class="col-3">Email</label>
                <div class="col-9">
                  <input type="email" class="form-control" v-model="data.email">
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="" class="col-3">Role</label>
                <div class="col-9">
                  <select class="form-control" v-model="data.role">
                    <option :value="'user'">User</option>
                    <option :value="'admin'">Admin</option>
                  </select>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="" class="col-3">Password</label>
                <div class="col-9">
                  <input type="password" class="form-control" v-model="data.password" placeholder="Must contain lower and uppercase letter, letter and a special character">
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="" class="col-3">Confirm Password</label>
                <div class="col-9">
                  <input type="password" class="form-control" v-model="data.confirm_password">
                </div>
              </div>

              <button class="btn btn-primary" @click.prevent="storeUser">
                Create User
              </button>
            </form>
        </div>
    </div>
  </div>
</template>


<script>


  export default {
    data() {
      return {
        data: {
          name: '',
          email: '',
          role: 'user',
          password: '',
          confirm_password: '',
        },
        errors: []
      }
    },
    methods: {
      storeUser: function() {
        this.errors = []
        axios.post('/data/users', {
          name: this.data.name,
          email: this.data.email,
          role: this.data.role,
          password: this.data.password,
          confirm_password: this.data.confirm_password,
        }).then(response => {
          console.log(response.data)
          // this.emit('created-user', 'Succefully created user: ' + response.data.user.name + '| email: ' + response.data.user.email )
        }).catch(errors =>{
          if(errors.response.status === 422) {
            this.flashErrors(errors.response.data.errors)
          }
          if(errors.response.status === 403) {
            this.errors = ["Your not authorize to create users"]
          }
        })
      },
      flashErrors: function(errors) {
        for(const [key, value] of Object.entries(errors)) {
          for(let item in value) {
            this.errors.push(value[item])
          }
        }
      }
    }
  }

</script>