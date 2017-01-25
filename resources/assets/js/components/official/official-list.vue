<template>
    <div class="col-lg-12" style="margin-top: 20px">
     
     <input v-model="search" type="text" class="form-control" placeholder="Search for officials" style="width: 220px; border-radius: 25px">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Location Assigned</th>
                    <th>Position {{ positions.length }}</th>
                    <th>Date of Joining</th>
                    <th>Status</th>
                    <th width="1"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="person in filterOfficials">
                    <td>{{ getName(person) }}</td>
                    <td>{{ getEmail(person) }}</td>
                    <td>{{ person.phone }}</td>
                    <td>{{ person.address1 }}</td>
                    <td>{{ person.location }}</td>
                    <td>{{ getPosition(person.position) }}</td>
                    <td>{{ person.date_of_joining }}</td>
                    <td>{{ activeOrNot(person) }}</td>
                    <td><a @click="removePerson(person)"><i class="fa fa-remove"></i></a></td>
                </tr>
            </tbody>
        </table>
                
    </div>
</template>

<script>
    import _ from 'lodash'
    export default {
        props: {
            users: { 
                type: Array 
            },
            officials: { 
                type: Array 
            },
            positions: {
                type: Array
            }
        },
        data(){
            return {
                search: ''
            }
        },
        computed: {
            filterOfficials(){
                let self = this;
                let value = self.search.toLowerCase();
                let cloneCopy = self.officials;
                let rsUsers = [], user = {};
                let rsPositions = [], position = {};
                return cloneCopy.filter(function(index) {
                    rsUsers = _.filter(self.users, {id: index.user_id});
                    rsPositions = _.filter(self.positions, {id: Number(index.position)});
                    if (rsUsers.length) {
                        user = (rsUsers.length > 0) ? rsUsers[0] : { name: '-', email: '-' };
                        position = (rsPositions.length > 0) ? rsPositions[0] : { name: 'unknown role' };
                        return user.email.toLowerCase().indexOf(value) !== -1 ||
                               user.name.toLowerCase().indexOf(value) !== -1 ||
                               index.phone.toLowerCase().indexOf(value) !== -1 ||
                               index.address1.toLowerCase().indexOf(value) !== -1 ||
                               index.address2.toLowerCase().indexOf(value) !== -1 ||
                               index.location.toLowerCase().indexOf(value) !== -1 ||
                               position.name.toLowerCase().indexOf(value) !== -1;
                    }
                });
            }
        },
        methods: {
            getPosition(i){
                let self = this;
                let rs = _.filter(self.positions, {id: Number(i)});
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
            console.log('Official-list.vue mounted.');
        }
    }
</script>
