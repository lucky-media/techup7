{{-- These tinyMCE settings are for the body of lessons. We can also upload images --}}

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
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
        images_upload_url: "{{ route('lessons.upload') }}",
        file_picker_types: 'image',
        
        // This function manages the image upload. It connects with the uploadImage function at the LessonController
        images_upload_handler: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', "{{ route('lessons.upload') }}");
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
               json = JSON.parse(xhr.responseText);

               if (!json || typeof json.location != 'string') {
                   failure('Invalid JSON: ' + xhr.responseText);
                   return;
               }
               success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       }
    });
</script>
@endpush