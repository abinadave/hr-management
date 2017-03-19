<template>
    <div class="col-md-7"><br>
        <div class="panel panel-default">
            <div class="panel-heading">
                Default Panel
            </div>
            <div class="panel-body">
                <label>Name:
                  <input v-model="form.name" type="text" class="form-control fullname">
                </label>
                <label>Email:
                  <input v-model="form.email" type="email" class="form-control">
                </label>
                <label>Password:
                  <input v-model="form.password" type="password" class="form-control">
                </label>
                <label>Position:
                   <select style="width: 180px;" class="form-control" v-model="form.position">
                      <option>Select for position</option>
                      <option v-bind:value="position.id" v-for="position in positions">
                         {{ position.name }}
                      </option>
                   </select>
                </label>
                <label>Salary Grade:
                  <input v-model="form.salary_grade" type="number" class="form-control">
                </label>
                 <label>Phone #:
                  <input v-model="form.phone" type="text" class="form-control">
                </label>
                <label>Current Address:
                  <input v-model="form.address1" type="text" class="form-control">
                </label>
                 <label>Hometown:
                  <input v-model="form.address2" type="text" class="form-control">
                </label>
                <label>Date of Joining:
                  <input v-model="form.date_of_joining" style="width: 180px;" type="date" class="form-control">
                </label>
                <label>Date of Leaving:
                  <input v-model="form.date_of_leaving" style="width: 180px;" type="date" class="form-control">
                </label>
                <label>Date of Birth:
                  <input v-model="form.dob" style="width: 180px;" type="date" class="form-control">
                </label>
                 <label>City / Municipality:
                  <input v-model="form.city" type="text" class="form-control">
                </label>
                <label>Location (assigned):
                  <input v-model="form.location" type="text" class="form-control">
                </label>
                 <label>Status:
                    <select style="width: 180px;" class="form-control" v-model="form.status">
                      <option value="1">Active</option>
                      <option value="0">None Active</option>
                   </select>
                </label><hr>
                <button :disabled="whileSaving" @click="saveOfficial"  class="btn btn-primary btn-block">Save Official</button>
            </div>
            <div class="panel-footer">

            </div>
        </div>
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
        props: {
            positions: {
                type: Array
            }
        },
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
                    position: '',
                    location: '',
                    salary_grade: 0
                }
            }
        },
      
        methods: {
            saveOfficial(){
                let self = this;
                console.log(self.positions.length);
                self.whileSaving = true;
                self.$http.post('/official', self.form).then((resp) => {
                    self.whileSaving = false;
                    if (resp.status === 200) {
                        let json = resp.body;
                        self.clearForm();
                        self.$emit('officialcreated', json);
                        alert('Official successfully saved.');
                    }
                }, (resp) => {
                    self.whileSaving = false;
                    console.log(resp);
                });
            },
            clearForm(){
                let self = this;
                self.form.name = '';
                self.form.dob = '';
                self.form.city = '';
                self.form.phone = '';
                self.form.email = '';
                self.form.password = '';
                self.form.address1 = '';
                self.form.address2 = '';
                self.form.location = '';
                self.form.date_of_joining = '';
                self.form.date_of_leaving = '';
                self.form.status = '';
                self.form.position = '';
                $('input.fullname').focus();
            },
        },
        mounted() {
            console.log('Create-official.vue Mounted!');
        }
    }
</script>
