<template>
    <div class="container">
        <div>

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Officials table</span></a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Create Official</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Trashed Official</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Positions</a></li></ul>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
               
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <form-official></form-official>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
               
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
               
            </div>
          </div>

        </div>
    </div>
</template>

<script>
    import CompCreateOfficial from './create-official.vue'
    
    export default {
        mounted() {
            
        },
        data(){
            return {

            }
        },
        methods: {
      
        },
        components: {
           'form-official': CompCreateOfficial
        }
    }
</script>
