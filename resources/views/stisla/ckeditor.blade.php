<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
   var konten = document.getElementById("visi");
     CKEDITOR.replace(konten,{
     language:'en-gb'
   });
   CKEDITOR.config.allowedContent = true;
</script>
<script>
    var konten = document.getElementById("misi");
      CKEDITOR.replace(konten,{
      language:'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
 </script>
