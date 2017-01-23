<template>
    <div class="col-lg-7">
        <form @submit.prevent="saveRole()">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of roles {{ roles.length }}
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Role name</th>
                                <th>Employees</th>
                                <th width="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(role, index) in roles">
                                <td>{{ role.name }}</td>
                                <td>0</td>
                                <td><a style="cursor: pointer;" @click="removeRole(index)"><i class="fa fa-remove"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </form>
    </div>
</template>

<script>
   
    export default {
        props: {
            roles: {
                type: Array
            }
        },
        mounted() {
            console.log('Role-list.vue mounted.');
        },
        methods: {
            removeRole(index){
                let self = this;
                self.$parent.$emit('removerole', index);
            }
        }
    }
</script>
