<template>
    <div class="container">
    <br>
        <form-role></form-role>
        <role-list :roles="roles"></role-list>
    </div>
</template>

<script>
    import CompFormRole from './create-role.vue'
    import CompRoleList from './role-list.vue'
    export default {
        props: {
            roles:{
                type: Array
            }
        },
        mounted() {
            console.log('Employee vue mounted.');
        },
        methods: {
           
        },
        components: {
            'form-role': CompFormRole,
            'role-list': CompRoleList
        }
    }
</script>
