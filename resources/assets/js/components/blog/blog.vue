<template>
    <div class="container">
            <div class="col-md-7">
                <div class="panel panel-default blog-panel">
                    <div class="panel-heading">Example Component</div>
                    <div class="panel-body">
                        <form name="yourformname">
                            <label>Blog Title
                                <input type="text" class="form-control" placeholder="Title-here">
                            </label><hr>
                            <input  name="photo" type="file" multiple><button class="btn btn-xs btn-info" @click.prevent="uploadTemporaryFiles">Uploads</button>
                            <temporary-files></temporary-files>
                            <!-- <br> -->
                            <label>
                                <textarea class="form-control" style="margin: 0px; width: 506px; height: 147px;">
                                    
                                </textarea>
                            </label><br>
                            <button @click.prevent="saveBlogPost" class="btn btn-success">Create Blog</button>
                        </form>
                    </div>
                </div>
            </div>
       
    </div>
    
</template>
<style>
    .blog-panel input {
        width: 400px;
    }
</style>
<script>
    import CompTempFiles from './temporary-files.vue'
    export default {

        mounted() {
            console.log('Blog.vue mounted.');
            // this.createUploader();
            this.fetchTempFiles();
        },
        data(){
            return {
                form: {
                    title: '',
                    body: ''
                }
            }
        },
        components: {
            'temporary-files': CompTempFiles
        },
        methods: {
            uploadTemporaryFiles(){
                // let self = this;
                var form = document.forms.namedItem("yourformname"); // high importance!, here you need change "yourformname" with the name of your form
                var formdata = new FormData(form); // high importance!
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "json", // or html if you want...
                    contentType: false, // high importance!
                    url: 'fileuploader', // you need change it.
                    data: formdata, // high importance!
                    processData: false, // high importance!
                    success: function (data) {
                        //do thing with data....
                        console.log(data)
                    },
                    timeout: 10000
                });
            },
            fetchTempFiles(){
                let self = this;
                console.log('fetching temporary files');
                self.$http.get('/temporary/files/blog').then((resp) => {
                    if (resp.status === 200) {
                        let json = resp.body;
                        console.log(json)
                    }
                })
            },
            saveBlogPost(){
                let self = this;
                self.$http.post('/post', self.form).then((resp) => {
                    console.log(resp);
                }, (resp) => {
                    console.log(resp);
                })
            }
        }
        
    }
</script>
