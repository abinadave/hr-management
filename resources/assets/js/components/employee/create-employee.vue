<template>
    <div class="col-md-8"><br>
        <form>
            <label>
               Fullname:
               <input v-model="form.name" type="text" class="form-control" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               Date of Birth:
               <input v-model="form.dob" type="date" class="form-control dates" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               City:
               <input v-model="form.city" type="text" class="form-control" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               Phone:
               <input v-model="form.phone" type="text" class="form-control" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               Email:
               <input v-model="form.email" type="text" class="form-control" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               Password:
               <input v-model="form.password" type="password" class="form-control" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               Address 1:
               <input v-model="form.address1" type="text" class="form-control address1" />
            </label>&nbsp;&nbsp;&nbsp;

            <label>
               Address 2:
               <input v-model="form.address2" type="text" class="form-control address2" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               From:
               <input v-model="form.date_of_joining" type="date" class="form-control dates" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               To:
               <input v-model="form.date_of_leaving" type="date" class="form-control dates" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               Status:
               <select v-model="form.status" style="width: 179px" class="form-control">Status
                  <option>Active</option>
                  <option>Not Active</option>
               </select>
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               Salary Grade
               <input v-model="form.salary_grade" type="text" class="form-control" />
            </label>&nbsp;&nbsp;&nbsp;
            <label>
               Role:
               <select v-model="form.role" style="width: 179px" class="form-control">Status
                  <option>Select</option>
                  <option v-bind:value="role.id" v-for="role in roles">{{ role.name }}</option>
               </select>
            </label>&nbsp;&nbsp;&nbsp;<hr>
            <button :disabled="whileSaving" @click.prevent="saveEmployee" style="width: 78%;" class="btn btn-block btn-success">Save Employee</button>

        </form>
    </div>
</template>

<style type="text/css">
   .dates {
      width: 180px;
   }
   .address1, .address2 {
      width: 277px;
   }
</style>

<script>
    export default {
        data(){
            return {
                whileSaving: false,
                form: {
                    name: '',
                    dob: '',
                    city: '',
                    phone: '',
                    email: '',
                    password: '',
                    address1: '',
                    address2: '',
                    date_of_joining: '',
                    date_of_leaving: '',
                    status: '',
                    role: '',
                    salary_grade: 0
                }
            }
        },
        props: {
            roles: {
                type: Array
            },
            salaryGrades: {
                type: Array
            }
        },
        methods: {
            clearForm(){
                let self = this;
                self.form.name = '';
                self.form.dob = '';
                self.form.city = '';
                self.form.phone = '';
                self.form.email = '';
                self.form.password = '';
                self.form.address1 = '';
                self.form.date_of_joining = '';
                self.form.date_of_leaving = '';
                self.form.status = '';
                self.form.role = '';
            },
            saveEmployee(){
                let self = this;
                self.whileSaving = true;
                self.$http.post('/user/employee', self.form).then((resp) => {
                    if (resp.status === 200) {
                        let json = resp.body;
                        self.$emit('employeecreated', json);
                        self.clearForm();
                        self.whileSaving = false;
                    }
                }, (resp) => {
                    self.whileSaving = false;
                    console.log(resp);
                });
            }
        },
        mounted() {
            console.log('Create-employee.vue Mounted!');
        }
    }
</script>
