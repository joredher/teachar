<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.1.1/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.1.1/cropper.min.css">
<script type="text/x-template" id="imagenCrop">
    <div width="100%">
        <div class="card p-0">
            <div class="card-body">
                <div class="card-block">
                    <div :class="rowClass">
                        <img :id="target?target:'croppimage'" :src="DfltImg" alt="" :height="height" style="max-width: 100%;">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center" v-if="preview">
                        <label class="mt-3 text-bold" for="">Vista Preliminar</label>
                        <div class="img-preview preview-lg" :class="classPreview" style="overflow:hidden; width: 144px; height: 144px; margin: 0 auto;">
                            <img src="" alt="" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <label class="btn btn btn-outline-info" :for="target?target+'input':'input-foto'" title="Upload image file" style="margin-bottom: 0px">
                    <input type="file" class="sr-only" :id="target?target+'input':'input-foto'" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="Cargar imagen desde disco duro">
                        <i class="fas fa-upload"> </i> Cargar foto
                    </span>
                </label>
                <button type="button" class="btn btn-outline-danger" id="clear" @click="destroy"><i class="fas fa-sync"></i></button>

            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('vcropp',{
        template: '#imagenCrop',
        data: function () {
            return {
                ready:false,
                default:true,
                options: {
                    viewMode: 1,
                    aspectRatio: this.ratio?this.ratio: '',
                    autoCropArea: 0.65,
                    minContainerWidth:this.minWidth?this.minWidth: 521,
                    minContainerHeight:this.minHeight?this.minHeight: 240,
                    restore: false,
                    zoomOnWheel: true,
                    preview: '.img-preview',
                }

            }
        },
        props:['minWidth', 'minHeight','height', 'ratio','defaultImg','preview', 'previewRounded','target'],
        computed: {
            DfltImg: function () {
                if(this.defaultImg){

                    return this.defaultImg
                }
                return '/imagenes/default-avatar.png'
            },

            rowClass: function () {
                if(!this.preview){
                    return 'col-lg-12'
                }
                return 'col-lg-8'
            },

            classPreview: function () {
                if(this.previewRounded){
                    return 'rounded-circle'
                }
            }
        },
        methods:{
            getImage: function () {
                var app = this;
                if(this.default){
                    console.log('default');
                    return
                }
                return $('#'+(app.target?app.target:'croppimage')).cropper('getCroppedCanvas',{width:160}).toDataURL('image/png')
            },

            destroy:function () {
                var app = this;
                this.default = true
                $('#'+(app.target?app.target:'croppimage')).cropper('destroy').attr('src', '/imagenes/default-avatar.png').cropper(this.options);
            },

            setImage: function (image) {
                console.log('setImage');
                var app = this;
                app.default=false;
                $('#'+(app.target?app.target:'croppimage')).cropper('destroy').attr('src', image).cropper(this.options);
            },

            loadCrop: function () {

            }
        },
        mounted() {
            var vcrop = this;
            var URL = window.URL || window.webkitURL;
            var $inputImage = $("#"+(vcrop.target?vcrop.target+'input':'input-foto'));
            var $image = $('#'+(vcrop.target?vcrop.target:'croppimage'));
            var uploadedImageURL;




            $image.on({
                ready:function () {
                    vcrop.ready = true
                },

            }).cropper(this.options);

            if (URL) {
                $inputImage.change(function () {
                    var files = this.files;
                    var file;

                    if (!$image.data('cropper')) {
                        return;
                    }

                    if (files && files.length) {
                        file = files[0];

                        if (/^image\/\w+$/.test(file.type)) {
                            uploadedImageType = file.type;

                            if (uploadedImageURL) {
                                URL.revokeObjectURL(uploadedImageURL);
                            }

                            uploadedImageURL = URL.createObjectURL(file);
                            $image.cropper('destroy').attr('src', uploadedImageURL).cropper(vcrop.options);
                            vcrop.default = false;

                            $inputImage.val('');
                        } else {
                            window.alert('Please choose an image file.');
                        }
                    }
                });
            } else {
                $inputImage.prop('disabled', true).parent().addClass('disabled');
            }


        }
    })
</script>