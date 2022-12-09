import tinymce from "tinymce";

$(function () {
    let textEditorInit = function(className, fullView) {
        if ($('textarea' + className).length > 0) {
            tinymce.init({
                selector: 'textarea' + className,
                //height: 300,
                content_style: "body { font-size: 0.85rem; color: #495057; }",
                menubar: fullView,
                statusbar: fullView,
                automatic_uploads: true,

                images_upload_handler: function (blobInfo, success, failure) {
                    let maxSize = 700,
                        url = '../../mediafile/load',
                        fileSize = blobInfo.blob().size / 1000,
                        fileName = blobInfo.filename(),
                        token = $('meta[name="csrf-token"]').attr('content');

                    if (fileSize > maxSize) {
                        failure('Image is too large (' + fileSize  + '). Maximum image size is:' + maxSize + ' kB.');
                    } else {
                        let data = new FormData();
                        data.append('file', blobInfo.blob(), fileName);
                        data.append('name', fileName.replace(/\.[^/.]+$/, ''));
                        data.append('visible', 1);
                        data.append('parent_id', '');
                        data.append('_token', token);

                        axios.post(url, data, {headers: {'X-CSRF-TOKEN': token}})
                            .then(function (result) {
                                success(result.data.location);
                            })
                            .catch(function (error) {
                                failure('HTTP Error: ' + error.message);
                            });
                    }
                },

                plugins: [
                    'advlist autolink link image  lists charmap print preview hr anchor pagebreak spellchecker',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'save table contextmenu directionality emoticons template paste textcolor autoresize',
                ],

                toolbar: 'insertfile undo redo' +
                    ' | cut copy paste pastetext' +
                    ' | print code preview fullscreen' +
                    ' | bold italic' +
                    ' | alignleft aligncenter alignright alignjustify' +
                    ' | bullist numlist outdent indent' +
                    ' | link image media table' +
                    ' | forecolor backcolor' +
                    ' | emoticons' +
                    ' | styleselect'
            });
        }
    };

    textEditorInit('.form-control-full-editor', true);
    textEditorInit('.form-control-editor', false);
});
