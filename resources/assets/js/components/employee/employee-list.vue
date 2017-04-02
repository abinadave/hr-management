<template>
    <div class="col-lg-12" style="margin-top: 20px">
     <input v-model="search" type="text" class="form-control" placeholder="search for employees" style="width: 220px; border-radius: 25px">
        <select v-model="sortByActive" class="form-control pull-right" style="width: 200px; margin-top: -20px">
            <option :value="2">All</option>
            <option :value="1">Active</option>
            <option :value="0">None- qActive</option>
        </select>
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Salary Grade</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th width="1"></th>
                    <th width="1"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="person in filterEmployees">
                    <td>{{ getName(person) }}</td>
                    <td>{{ getEmail(person) }}</td>
                    <td>{{ person.phone }}</td>
                    <td>{{ person.address1 }}</td>
                    <td>{{ getRole(person.role) }}</td>
                    <td>{{ getSalGrade(person) }}</td>
                    <td>{{ person.date_of_joining }}</td>
                    <td>{{ person.date_of_leaving }}</td>
                    <td>{{ activeOrNot(person) }}</td>
                    <td><a style="cursor: pointer" @click="editPerson(person)"><i class="fa fa-edit">edit</i></a></td>
                    <td><a @click="removePerson(person)"><i class="fa fa-remove">delete</i></a></td>
                </tr>
            </tbody>
        </table>
                
    </div>
</template>

<script>

    import accounting from 'accounting'
    export default {
        props: {
            users: { 
                type: Array 
            },
            employees: { 
                type: Array 
            },
            roles: {
                type: Array
            },
            salaryGrades: {
                type: Array
            }
        },
        data(){
            return {
                search: '',
                sortByActive: 2,
            }
        },
        watch: {
            'sortByActive': function(newVal){
                let self = this;
                let resource = self.$resource('employee/sort/by/active{/id}');
                resource.get({
                    id: newVal
                }).then((resp) => {
                    if (resp.status === 200) {
                       let json = resp.body;
                       self.employees = json.employees;
                    }
                })
            }
        },
        computed: {
            filterEmployees(){
                let self = this;
                let value = self.search.toLowerCase();
                let cloneCopy = self.employees;
                let rsUsers = [], user = {};
                let rsRoles = [], role = {};
                return cloneCopy.filter(function(index) {
                    rsUsers = _.filter(self.users, {id: index.user_id});
                    rsRoles = _.filter(self.roles, {id: Number(index.role)});
                    if (rsUsers.length) {
                        user = (rsUsers.length > 0) ? rsUsers[0] : { name: '-', email: '-' };
                        role = (rsRoles.length > 0) ? rsRoles[0] : { name: 'unknown role' };
                        return user.email.toLowerCase().indexOf(value) !== -1 ||
                               user.name.toLowerCase().indexOf(value) !== -1 ||
                               index.phone.toLowerCase().indexOf(value) !== -1 ||
                               index.address1.toLowerCase().indexOf(value) !== -1 ||
                               index.address2.toLowerCase().indexOf(value) !== -1 ||
                               role.name.toLowerCase().indexOf(value) !== -1;
                    }
                });
            }
        },
        methods: {
            getSalGrade(emp){
                let self = this;
                let rs = _.filter(self.salaryGrades, {emp_id: emp.id});
                if (rs.length) {
                    let sal = rs[0];
                    return accounting.formatNumber(sal.value);
                }
            },
            editPerson(json){
                let self = this;
                self.$emit('editemployee', json);
            },
            getRole(i){
                let self = this;
                let rs = _.filter(self.roles, {id: Number(i)});
                if (rs.length) {
                    return rs[0].name;
                }
            },
            removePerson(person){
                let self = this;
                console.log(person);
            },
            activeOrNot(person){
                let self = this;
                if (person.status === 1) {
                    return 'Active';
                }else {
                    return 'Unactive'
                }
            },
            getName(emp){
                let self = this;
                let rs = _.filter(self.users, {id: emp.user_id});
                if (rs.length) {
                    return rs[0].name;
                }
            },
            getEmail(emp){
                let self = this;
                let rs = _.filter(self.users, {id: emp.user_id});
                if (rs.length) {
                    return rs[0].email;
                }
            },
        },
        mounted() {
            console.log('Role-list.vue mounted.');
        }
    }
</script>
