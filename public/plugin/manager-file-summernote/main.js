$(document).ready(function () {
    const _prefix = '/admin/filemanager';
    // Define function to open filemanager window
    var lfm = function (options, cb) {
        var route_prefix = (options && options.prefix) ? options.prefix : _prefix;
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function (context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<i class="note-icon-picture"></i> ',
            tooltip: 'Insert image with filemanager',
            click: function () {

                lfm({ type: 'image', prefix: _prefix }, function (lfmItems, path) {
                    lfmItems.forEach(function (lfmItem) {
                        context.invoke('insertImage', lfmItem.url);
                    });
                });

            }
        });
        return button.render();
    };
    var downFileButton = function (context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<i class="fa fa-download"/> File Download',
            tooltip: 'Button',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                context.invoke('editor.insertText', '[button-download]');
            }
        });

        return button.render();   // return button as jquery object
    }

    var callOpenFile = function (options) {
        var button = $("#fileManager");
        $("#fileManager").click(function() {
            var route_prefix = (options && options.prefix) ? options.prefix : _prefix;
            var target_input = document.getElementById(button.data('input'));
            var target_preview = document.getElementById(button.data('preview'));
            var target_file = button.data('file');
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    return item.url;
                }).join(',');

                // set the value of the desired input to image url
                target_input.value = file_path;
                target_input.dispatchEvent(new Event('change'));

                // clear previous preview
                target_preview.innerHtml = '';

                // set or change the preview image src
                items.forEach(function (item) {
                    // target_preview.setAttribute('src', item.url);
                    let checkFileUrl = checkURL(item.url);
                    if (checkFileUrl) {
                        target_preview.setAttribute('src', item.url);
                    } else {
                        target_preview.setAttribute('src', target_file);
                    }
                    target_preview.classList.add('d-block');
                });

                // trigger change event
            };
        });
    };
    callOpenFile({ prefix: _prefix, type: 'file' })
    function checkURL(url) {
        return (url.match(/\.(jpeg|jpg|gif|png)$/) != null);
    }
    $('.summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['fontsize', ['fontsize']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
            ['popovers', ['lfm']],
            ['insert', ['link', 'lfm', 'hr', 'fileDownload']],

        ],
        buttons: {
            lfm: LFMButton,
            fileDownload: downFileButton
        },
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
        }
    });
});
