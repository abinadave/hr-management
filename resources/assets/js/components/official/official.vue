<template>
    <div class="container">
        <div>
        <h3 class="pull-right text-warning">Officials Management</h3>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Officials table <span class="badge">{{ officials.length }}</span></span></a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Create Official</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Trashed Official</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Positions</a></li></ul>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
               <official-list :positions="positions" :users="users" :officials="officials"></official-list>
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
    </div>
</template>

<script>
    import CompOfficialList   from './official-list.vue'
    import CompCreateOfficial from './create-official.vue'
    import CompFormPositions  from './position/create-position.vue'

    export default {
        mounted() {
            this.fetchData();
        },
        data(){
            return {
                positions: [], officials: [], users: []
            }
        },
        methods: {
            createOfficial(json){
                let self = this;
                
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
           'create-position': CompFormPositions
        }
    }
</script>
