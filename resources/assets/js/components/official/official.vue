<template>
    <div class="container">
        <div>
        <h3 class="pull-right text-warning">Officials Management</h3>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">List of Officials<span class="badge">{{ officials.length }}</span></span></a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add new Official</a></li>
           
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Positions</a></li></ul>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
               <official-list @editperson="updatePersonChild" :salary-grades="salary_grades" :positions="positions" :users="users" :officials="officials"></official-list>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <form-official @officialcreated="createOfficial" :positions="positions"></form-official>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
               
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
               <create-position @positioncreated="createPosition"></create-position>
               <!-- <position-list></position-list> -->
            </div>
          </div>

        </div>
        <modal-edit :form="formModal" :positions="positions" :users="users"></modal-edit>
    </div>
</template>

<script>

    import CompOfficialList   from './official-list.vue'
    import CompCreateOfficial from './create-official.vue'
    import CompFormPositions  from './position/create-position.vue'
    import CompModalEdit      from './comp_modwal_edit_official.vue'

    export default {
        mounted() {
            this.fetchData();
            this.fetchSalaryGrades();
        },
        data(){
            return {
                positions: [], officials: [], users: [],
                salary_grades: [],
                formModal: {
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
            createOfficial(json){
                let self = this;
                console.log(json);
            },
            updatePersonChild(person){
                let self = this;
                $('#modal-edit-official').modal('show');
                let rsUser = _.filter(self.users, { id: person.user_id});
                let rsSalGrades = _.filter(self.salary_grades, { emp_id: person.user_id});
                self.formModal = person;
                self.formModal.name = rsUser[0].name;
                self.formModal.email = rsUser[0].email;
                self.formModal.salary_grade = rsSalGrades[0].value;
            },
            fetchSalaryGrades(){
                let self = this;
                self.$http.get('/salary/grade').then((resp) => {
                    if (resp.status === 200) {
                        let json = resp.body;
                        self.salary_grades = json.salary_grades;
                    }
                }, (resp) => {
                    console.log(resp);
                });
            },
            createPosition(position){
                let self = this;
               self.positions.unshift(position);
            },
            fetchData(){
                let self = this;
                self.$http.get('/official/management').then((resp) => {
                    if (resp.status === 200) {
                        let json = resp.body;
                        self.positions = json.positions;
                        self.users = json.users;
                        self.officials = json.officials;
                    }
                }, (resp) => {
                    console.log(resp);
                })
            }
        },
        components: {
           'official-list': CompOfficialList,
           'form-official': CompCreateOfficial,
           'create-position': CompFormPositions,
           'modal-edit': CompModalEdit
        }
    }
</script>
