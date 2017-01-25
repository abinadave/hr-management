<template>
	
        <div class="col-lg-3" style="margin-top: 10px">
        	<form @submit.prevent="saveRole()">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    Create Officials Position
	                </div>
	                <div class="panel-body">
	                	
                   		<label>Role: 
							<input v-model="position" type="text" class="form-control" />
						</label>
					
	                </div>
	                <div class="panel-footer">
	                    <button :disabled="whileSaving" type="submit" class="btn btn-primary">Save Position</button>	
	                </div>
	            </div>
            </form>
        </div>
		
</template>

<script>
    export default {
        mounted() {
            console.log('Position-form.vue mounted.');
        },
        data(){
        	return {
        		position: '',
        		whileSaving: false
        	}
        },
        methods: {
        	saveRole(){
        		let self = this;
        		self.whileSaving = true;
                console.log(self.position)
        		self.$http.post('/position',{
        			name: self.position
        		}).then((resp) => {
        			self.whileSaving = false;
        			if (resp.status === 200) {
        				let position = resp.body;
        				if (position.id) {
        					self.position = '';
                            self.$emit('positioncreated', position);
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
