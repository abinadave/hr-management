<template>
	
        <div class="col-lg-3">
        	<form @submit.prevent="saveRole()">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    Default Panel
	                </div>
	                <div class="panel-body">
	                	
                   		<label>Role: 
							<input v-model="role" type="text" class="form-control" />
						</label>
					
	                </div>
	                <div class="panel-footer">
	                    <button :disabled="whileSaving" type="submit" class="btn btn-primary">Save Role</button>	
	                </div>
	            </div>
            </form>
        </div>
	               
		
</template>

<script>
    export default {
        mounted() {
            console.log('Role-form.vue mounted.');
        },
        data(){
        	return {
        		role: '',
        		whileSaving: false
        	}
        },
        methods: {
        	saveRole(){
        		let self = this;
        		self.whileSaving = true;
        		self.$http.post('/role',{
        			name: self.role
        		}).then((resp) => {
        			self.whileSaving = false;
        			if (resp.status === 200) {
        				let role = resp.body;
        				if (role.id) {
        					self.role = '';
                            self.$parent.$emit('rolecreated', role);
        				}
        			}
        		}, (resp) => {
        			self.whileSaving = false;
        			console.log(resp);
        		});
        	}
        }
    }
</script>
