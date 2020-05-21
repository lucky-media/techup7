@push('styles')
<script src="https://cdn.tiny.cloud/1/5qv3svvxrwpsb73doi9u71fu6hbeg7cofai1w5snueebquuj/tinymce/5/tinymce.min.js"></script>

<script type="text/javascript">
  tinymce.init({
    selector: '#body',
    plugins: 'link preview anchor codesample wordcount autoresize',
    toolbar: 'undo redo | formatselect bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample wordcount image preview',
    menubar: false
  });
  </script>
@endpush