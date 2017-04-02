<template>
    <!-- Modal -->
    <div class="modal fade" id="modal-edit-emp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <form @submit.prevent="submitForm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Update Employee</h4>
          </div>
          <div class="modal-body">
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        </form>
      </div>
    </div>
</template>

<script>
    import accounting from 'accounting'
    export default {
        mounted() {
            console.log('Component mounted.');
        },
        props: {
            positions: {
                type: Array
            },
            users: {
                type: Array
            },
            form: {
                type: Object
            },
            salaryGrades: {
                type: Array
            }
        },
        methods: {
            submitForm(){
                let self = this;
                console.log(self)
            },
            getSalGrade(emp){
                let self = this;
                let rs = _.filter(self.salaryGrades, {emp_id: emp.id});
                if (rs.length) {
                    let sal = rs[0];
                    return accounting.formatNumber(sal.value);
                }
            },
        },
        data(){
            return {
                
            }
        },
        watch: {
            'form': function(newVal){
                let self = this;
                let rs = _.filter(self.users, {id: newVal.user_id});
                let roleId = newVal.role;
                if (self.positions.length) {
                    let rsRole = _.filter(self.positions, {id: Number(newVal.role)});
                    if (rsRole.length) {
                        let role = rsRole[0];
                        self.form.position = role.id;
                    }
                }
                if (rs.length) {
                    let user = rs[0];
                    $.each(user, function(index, val) {
                         self.form[index] = val;
                    });
                }
                let empId = Number(newVal.id);
                self.salaryGrades.forEach(function(model) {
                     console.log('current_id: ' + newVal.id + ' === ' + model.emp_id)
                });
            }
        }
    }
</script>
