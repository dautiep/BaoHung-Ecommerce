$(document).ready(function () {
    const route = $('#file_manager');
    const route_upload = route.data('route');
    const input_uploadFile = $('#attachment');
    const input_deleteFile = $('#deleteInput');
    const delete_file = $('.file-block');
    const _this = this;
    (function ($) {
        $.fn.checkFileType = function (options) {
            var defaults = {
                disableExtensions: [],
                success: function () { },
                error: function () { }
            };
            options = $.extend(defaults, options);

            return this.each(function () {
                $(this).on('change', function () {
                    const dt = new DataTransfer();
                    for (var i = 0; i < this.files.length; i++) {
                        let fileBloc = $('<span/>', { class: 'file-block' }),
                            fileName = $('<span/>', { class: 'name', text: this.files.item(i).name });
                        fileBloc.append('<span class="file-delete"><span>+</span></span>')
                            .append(fileName);
                        $("#filesList > #files-names").append(fileBloc);
                    };
                    // Ajout des fichiers dans l'objet DataTransfer
                    for (let file of this.files) {
                        dt.items.add(file);
                    }
                    // Mise à jour des fichiers de l'input file après ajout
                    this.files = dt.files;

                    // EventListener pour le bouton de suppression créé
                    $('span.file-delete').click(function () {
                        let name = $(this).next('span.name').text();
                        // Supprimer l'affichage du nom de fichier
                        $(this).parent().remove();
                        for (let i = 0; i < dt.items.length; i++) {
                            // Correspondance du fichier et du nom
                            if (name === dt.items[i].getAsFile().name) {
                                // Suppression du fichier dans l'objet DataTransfer
                                dt.items.remove(i);
                                continue;
                            }
                        }
                        // Mise à jour des fichiers de l'input file après suppression
                        document.getElementById('attachment').files = dt.files;
                    });
                    var value = $(this).val(),
                        file = value.toLowerCase(),
                        extension = file.substring(file.lastIndexOf('.') + 1);
                    if ($.inArray(extension, options.allowedExtensions) == -1) {
                        options.success();

                    } else {
                        options.error();
                        $(this).focus();
                    }

                });

            });
        };


    })(jQuery);
    function progressHandlingFunction(e) {
        if (e.lengthComputable) {
            //Log current progress
            console.log((e.loaded / e.total * 100) + '%');

            //Reset progress on complete
            if (e.loaded === e.total) {
                console.log("Upload finished.");
            }
        }
    }


    $('.summernote').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['link', ['link']],
            ['picture', ['picture']]
        ],
        popover: {
            image: [
                ['custom', ['imageAttributes']],
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
        },

        lang: 'en-US', // Change to your chosen language
        imageAttributes: {
            icon: '<i class="note-icon-pencil"/>',
            removeEmpty: false, // true = remove attributes | false = leave empty if present
            disableUpload: false // true = don't display Upload Options | Display Upload Options
        },
        callbacks: {
            onImageUpload: function (files) {
                for (let i = 0; i < files.length; i++) {
                    $.upload(files[i]);
                }
            },
        },
    });
    $.upload = function (file) {
        let data = new FormData();
        data.append("file", file);
        $.ajax({
            data: data,
            type: "POST",
            url: route_upload, //Your own back-end uploader
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () { //Handle progress upload
                let myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
                return myXhr;
            },
            success: function (reponse) {
                console.log(file.type);
                if (reponse.status === true) {
                    let listMimeImg = ['image/png', 'image/jpeg', 'image/webp', 'image/gif', 'image/svg'];
                    let listMimeAudio = ['audio/mpeg', 'audio/ogg'];
                    let listMimeVideo = ['video/mpeg', 'video/mp4', 'video/webm'];
                    let elem;

                    if (listMimeImg.indexOf(file.type) > -1) {
                        //Picture
                        $('.summernote').summernote('editor.insertImage', reponse.filename);
                        console.log(reponse.filename);
                    } else if (listMimeAudio.indexOf(file.type) > -1) {
                        //Audio
                        elem = document.createElement("audio");
                        elem.setAttribute("src", reponse.filename);
                        elem.setAttribute("controls", "controls");
                        elem.setAttribute("preload", "metadata");
                        $('.summernote').summernote('editor.insertNode', elem);
                    } else if (listMimeVideo.indexOf(file.type) > -1) {
                        //Video
                        elem = document.createElement("video");
                        elem.setAttribute("src", reponse.filename);
                        elem.setAttribute("controls", "controls");
                        elem.setAttribute("preload", "metadata");
                        $('.summernote').summernote('editor.insertNode', elem);
                    } else {
                        //Other file type
                        elem = document.createElement("a");
                        let linkText = document.createTextNode(file.name);
                        elem.appendChild(linkText);
                        elem.title = file.name;
                        elem.href = reponse.filename;
                        $('.summernote').summernote('editor.insertNode', elem);
                    }
                }
            },
            error: function (e) {
                toastr.warning("Vui lòng thử lại , tải lên lần lượt từng hình ảnh");
            },
        });
    }
    delete_file.on('click', function () {
        let data = $(this).data('url');
        if (data) {
            let inputDelete = JSON.parse(input_deleteFile.val());
            inputDelete.push(data);
            input_deleteFile.val(JSON.stringify(inputDelete));
        }
        $(this).remove();
    });

    input_uploadFile.checkFileType({
        disableExtensions: ['png', 'jpeg', 'webp', 'gif', 'svg'],
        success: function () {
            toastr.success("Chọn file thành công");
            $('#holder').removeClass('d-none');

        },
        error: function () {
            toastr.warning("File tải lên không hợp lệ vui lòng kiểm tra lại");
        }
    });


});
