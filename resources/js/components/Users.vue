<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Phone</th>
                                <th>Facebook</th>
                                <th>Department</th>
                                <th></th>
                            </tr>
                            <tr v-for="user in users.data" :key="user.id">

                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.type | upText}}</td>
                                <td>{{user.created_at | myDate}}</td>

                                <td>
                                    <a href="#" @click="editModal(user)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteUser(user.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>

                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email"
                                       placeholder="Email Address"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="sex" v-model="form.sex" id="sex" class="form-control" :class="{ 'is-invalid': form.errors.has('sex') }">
                                    <option value="">Sex</option>
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                                <has-error :form="form" field="sex"></has-error>
                            </div>


                            <div class="form-group">
                                <select name="permission" v-model="form.permission" id="permission" class="form-control" :class="{ 'is-invalid': form.errors.has('permission') }">
                                    <option value="">Select User Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                                <has-error :form="form" field="permission"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="department" v-model="form.department" id="department" class="form-control" :class="{ 'is-invalid': form.errors.has('department') }">
                                    <option value="">Select Department</option>
                                    <option value="1">Accountant</option>
                                    <option value="2">Nomal</option>
                                </select>
                                <has-error :form="form" field="permission"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.password1" type="password" name="password" id="password1"
                                       placeholder="Enter Password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password1') }">
                                <has-error :form="form" v-model="form.password1" field="password"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.password2" type="password2" name="password2" id="password2"
                                       placeholder="Enter Confirm Password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password2') }">
                                <has-error :form="form" v-model="form.password2" field="password2"></has-error>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="file"  multiple ref="files" @change="updateProfile" name="image" class="form-input">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                users: {},
                form: new Form({
                    name: '',
                    facebook: '',
                    zalo: '',
                    birtday: '',
                    email: '',
                    password1: '',
                    password2: '',
                    permission: '',
                    sex: '',
                    department: '',
                    image: null
                })
            }
        },
        methods: {
            createUser(){
                console.log(this.image);
                this.$Progress.start();
                this.form.post('api/admin/create_account')
            },
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            updateUser() {
                this.$Progress.start();
                this.form.put('api/user/' + this.form.id)
                    .then(() => {
                        // success
                        $('#addNew').modal('hide');
                        swal(
                            'Updated!',
                            'Information has been updated.',
                            'success'
                        )
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                let limit = 0;
                reader.onloadend = (file) => {

                    this.form.image = reader.result;
                }
                reader.readAsDataURL(file);
            },
            editModal(user) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal() {
                jQuery.noConflict();
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            }
        }
    }
</script>
