<template>
    <div class="container">
        <div>
        <h3 class="pull-right text-info">Employee Management</h3>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">List of Employee<span class="badge">{{ employees.length }}</span></a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add new Employee</a></li>
            <!-- <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Trashed Employee</a></li> -->
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Role</a></li></ul>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <employee-list @editemployee="showModalEmp" :salary-grades="salary_grades" :roles="roles" :users="users" :employees="employees"></employee-list>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <create-employee :roles="roles" @employeecreated="createEmp"></create-employee>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
                <!-- <trashed-employee></trashed-employee> -->
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
                <role-management :roles="roles" v-on:rolecreated="createRole" v-on:removerole="removeRole"></role-management>
            </div>
          </div>

        </div>
        <edit-employee :salary-grades="salary_grades" :users="users" :positions="roles" :form="modalEmployee"></edit-employee>
    </div>
</template>

<script>

    import CompCreateEmployee from './create-employee.vue'
    import CompRoleManagement from './role/role.vue'
    import CompEmpList        from './employee-list.vue'
    import CompEditEmp        from './edit-employee.vue'

    export default {
        mounted() {
            this.fetchData();
            this.fetchSalaryGrades();
        },
        data(){
            return {
                employees: [], users: [], roles: [],
                modalEmployee: {},
                salary_grades: []
            }
        },
        methods: {
            fetchSalaryGrades(){
                let self = this;
                self.$http.get('/salary/grade').then((resp) => {
                    let json = resp.body;
                    self.salary_grades = json.salary_grades;
                }, (resp) => {
                    console.log(resp);
                });
            },
            showModalEmp(emp){
                let self = this;
                self.modalEmployee = emp;
                $('#modal-edit-emp').modal('show');

            },
            removeRole(index){
                let self = this;
                let role = self.roles[index];
                let ok = confirm('Are you sure ?');
                if (ok) {
                    let resource = this.$resource('role{/id}');
                    resource.delete({id: role.id}).then((resp) => {
                        if (resp.status === 200) {
                            let json = resp.body;
                            if (json.employee_with_role > 0) {
                                alert('Warning!, can\'t delete this role with existing employee assigned');
                            }else {
                                self.roles.splice(index, 1);
                            }
                        }
                    }, (resp) => {
                        console.log(resp);
                    });
                }
            },
            createEmp(json){
                let self = this;
                self.employees.unshift(json.employee);
                self.users.unshift(json.user);
            },
            createRole(role){
                let self = this;
                self.roles.unshift(role);
            },
            fetchData(){
                let self = this;
                self.$http.get('/employee/management').then((resp) => {
                    if (resp.status === 200) {
                        let json = resp.body;
                        $.each(json, function(index, val) {
                            self[index] = val;
                        });
                        console.log(self.employees.length)
                    }
                }, (resp) => {
                    console.log(resp);
                });
            }
        },
        components: {
            'create-employee': CompCreateEmployee,
            'role-management': CompRoleManagement,
            'employee-list': CompEmpList,
            'edit-employee': CompEditEmp
        }
    }
</script>
