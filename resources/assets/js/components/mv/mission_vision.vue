<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>
                    <div class="panel-body">
                        <label>
                            Mission
                            <textarea v-model="form.mission" style="margin: 0px; width: 586px; height: 124px;" class="form-control">
                                
                            </textarea>
                        </label><br>
                         <label>
                            Vission
                            <textarea v-model="form.vision" style="margin: 0px; width: 586px; height: 124px;" class="form-control">
                                
                            </textarea>
                        </label>
                        <hr>
                        <button class="btn btn-success" @click="SaveMv">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import alertify from 'alertify.js'
    export default {
        mounted() {
            console.log('Component mounted.');
            this.fetchMv();
        },
        data(){
            return {
                form : {
                    mission: '',
                    vision: ''
                },
                objectMv: {
                    mission: '',
                    vision: ''
                }
            }
        },
        methods: {
            fetchMv(){
                let self = this;
                self.$http.get('/mission/vision').then((resp) => {
                    let json = resp.body;
                    if (json.length) {
                        let model = _.first(json);
                        self.objectMv = model;
                        self.form.mission = model.mission;
                        self.form.vision = model.vision;
                    }
                }, (resp) => {
                    console.log(resp);
                });
            },
            SaveMv(){
                let self = this;
                self.$http.post('/mission/vision', self.form).then((resp) => {
                    let json = resp.body;
                    if(json.id){
                        alertify.alert('You have successfully changed the Mission Vission!');
                    }
                }, (resp) => {
                    console.log(resp);
                });
            }
        }
    }
</script>
