<script type="text/x-template" id="FileInput">
    <div>
        <div class="input-group">
            <input type="text" readonly :value="getFilesName()" class="form-control" placeholder="Carga un objeto">
            {{--<input type="text" readonly :value="getFilesName()" class="form-control" placeholder="Sube el objeto">--}}
            <span class="input-group-btn">
                <button v-if="files.length" class="btn btn-default" type="button" @click="$emit('file-clear')">
                    <i class="fas fa-ban text-white"></i>
                </button>
                <button class="btn btn-default" type="button" @click="showFilePicker">
                    <i class="fas fa-paperclip text-white"></i>
                </button>
            </span>
        </div>
        <input type="file" ref="file" class="d-none" @change="onChange" multiple>
    </div>
</script>
<script>
    Vue.component('file-input', {
        template: '#FileInput',
        props:['files'],
        // props:['id','value', 'labelon', 'labeloff', 'disabled', 'type','classcontent'],
        data: function () {
            return {
                // files:[],
            }
        },
        methods: {
            showFilePicker() {
                this.$refs.file.click();
            },
            onChange(e) {
                // let selectedFiles = e.target.files;
                let files = e.target.files;
                this.$emit('file-change', files);

                // if (!selectedFiles.length) {
                //     return false;
                //     console.log("Hola");
                // }
                //
                // for (let i = 0; i < selectedFiles.length; i++) {
                //     this.files.push(selectedFiles[i]);
                // }
                //
                // console.log(this.files)
                // this.files = e.target.files;
                // this.files = e.target.files;
                // console.log(e.target.files)
            },

            getFilesName() {
                let filesName = [];

                if (this.files.length > 0) {
                    for (let file of  this.files) {
                        filesName.push(file.name);
                        // var extension = file.name.split('.').pop();
                        // console.log(extension)
                    }
                }
                // console.log(filesName);
                return filesName.join(", ");
            },

            // destroy: function (e) {
            //     var app = this;
            //     this.onChange(e)
            //     // console.log(this.getFilesName())
            // },
        },
        mounted(){
        }
    });
</script>