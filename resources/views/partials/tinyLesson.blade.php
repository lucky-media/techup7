@push('styles')
<script src="https://cdn.tiny.cloud/1/5qv3svvxrwpsb73doi9u71fu6hbeg7cofai1w5snueebquuj/tinymce/5/tinymce.min.js"></script>
  <script>
  tinymce.init({
        selector: '#body',
        plugins: 'link image preview anchor codesample wordcount autoresize',
        toolbar: 'undo redo | formatselect bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample wordcount image preview',
        menubar: false,
        width : "100%",
        automatic_uploads: true,
        image_dimensions: false,
        image_description: false,
        images_upload_url: '/lessons/image/upload',
        file_picker_types: 'image',
        
        /* and here's our custom image picker*/
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
            Note: In modern browsers input[type="file"] is functional without
            even adding it to the DOM, but that might not be the case in some older
            or quirky browsers like IE, so you might want to add it to the DOM
            just in case, and visually hide it. And do not forget do remove it
            once you do not need it anymore.
            */

            input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                /*
                Note: Now we need to register the blob in TinyMCEs image blob
                registry. In the next release this part hopefully won't be
                necessary, as we are looking to handle it internally.
                */
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
            };

            input.click();
        }
    });
</script>
@endpush