<template>
    <div class="col-md-8"><br>
        <div class="panel panel-default">
            <div class="panel-heading">
                Default Panel
            </div>
            <div class="panel-body">
                <label>Name:
                  <input type="text" class="form-control">
                </label>
                <label>Email:
                  <input type="email" class="form-control">
                </label>
                <label>Password:
                  <input type="password" class="form-control">
                </label>
            </div>
            <div class="panel-footer">
                Panel Footer
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
        data(){
            return {
                
            }
        },
        props: {
           
        },
        methods: {
            
        },
        mounted() {
            console.log('Create-official.vue Mounted!');
        }
    }
</script>
