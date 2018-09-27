<script type="text/x-template" id="FileInput">
    <div>
        <div class="input-group">
            <input type="text" readonly :value="getFilesName(files)" class="form-control" placeholder="Carga un objeto">
            {{--<input type="text" readonly :value="getFilesName()" class="form-control" placeholder="Sube el objeto">--}}
            <span class="input-group-btn">
                <button v-if="files.length" class="btn btn-default" type="button" @click="clear()">
                    <i class="fas fa-ban text-white"></i>
                </button>
                <button class="btn btn-default" type="button" @click="showFilePicker">
                    <i class="fas fa-paperclip text-white"></i>
                </button>
            </span>
        </div>
        <input type="file" ref="file" id="uploadFile" class="d-none" :accept="mimTypes" @change="onChange" :multiple="multiple">
    </div>
</script>
<script>
    Vue.component('file-input', {
        template: '#FileInput',
        props:['value', 'mimTypes', 'multiple'],
        data () {
            return {
                files:[],
                types:[],
                errorArchivo: null
            }
        },
        watch: {
            value (val) {
                this.files = val
            }
        },
        mounted(){
            this.types = this.mimTypes.split(',')
        },
        methods: {
            showFilePicker() {
                this.$refs.file.click();
            },
            onChange(e) {
                let files = Array.from(e.target.files);
                if (files.length) {
                    let filesValido = [];
                    files.forEach((file) => {
                        if (file !== undefined) {
                            if (this.types.find(type => type === file.type)) {
                                if (file.name.length <= 50) {
                                    filesValido.push(file)
                                } else {
                                    this.errorArchivo = 'El nombre del archivo que desea cargar es muy largo. Longitud permitida => 50 caracteres.';
                                    toastr.error(this.errorArchivo)
                                }
                            } else {
                                this.errorArchivo = 'No se admite el formato del archivo.';
                                toastr.error(this.errorArchivo)
                            }
                        } else {
                            this.errorArchivo = 'El archivo no es un archivo válido.';
                            toastr.error(this.errorArchivo)
                        }
                    });
                    this.$emit('input', filesValido);
                }
            },
            clear () {
                this.files = [];
                this.$emit('input', this.files);
                document.getElementById('uploadFile').value = '';
            },

            getFilesName(files) {
                let filesName = [];
                if (files.length > 0) { for (let file of  files) { filesName.push(file.name); } }
                return filesName.join(", ");
            },
            // let selectedFiles = e.target.files;
            // console.log(filesName);
            // destroy: function (e) {
            // var extension = file.name.split('.').pop();
            // console.log(extension)
            //     var app = this;
            //     this.onChange(e)
            //     // console.log(this.getFilesName())
            // },
            // props:['id','value', 'labelon', 'labeloff', 'disabled', 'type','classcontent'],
        }
    });
</script>