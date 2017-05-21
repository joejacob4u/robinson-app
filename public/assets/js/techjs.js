$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


         function deluser(id){
          var id=id;
          $('#delete_id').val(id);
          $('#modaldelete').modal('toggle');

         }

         function showuser(id){
          var id=id;
            $.ajax({
               type:'GET',
               url:'/accounts/'+id,
               success:function(data){
                  //$("#edit_name").val(data.name);
                  //document.getElementById('edit_name').value="adsfsf";


                  $('#show_id').val(id);
                  $('#show_name').html(data.name);
                  $('#show_email').html(data.email);
                  $('#modalShow').modal('toggle');


               }
            });
         }


         function edituser(id){
          var id=id;
          $('#edit_id').val(id);
            $.ajax({
               type:'GET',
               url:'/accounts/'+id,
               success:function(data){
                  //$("#edit_name").val(data.name);
                  //document.getElementById('edit_name').value="adsfsf";


                  $('#show_id').val(id);
                  $('#edit_name').val(data.name);
                  $('#edit_email').val(data.email);
                  $('#modalEdit').modal('toggle');


               }
            });
         }



         function page(did,pid){
          var did=did
          var pid=pid;
         // $('#edit_id').val(id);
         saveUserState('seen');

            $.ajax({
               type:'GET',
               url:'/read/document-'+pid+'/pages/'+pid,
               success:function(data){
                   console.log(data);
                   stopRecording();
                 console.log(data.doc_page_content);
                  $('#page').html(data.doc_page_content);
                  $('#doc_id').val(data.doc_id);
                  $('#doc_page_no').val(data.doc_page_no);



               }
            });
         }



      $(function() {
        $('.lipages').on('click', function() {
            $('.lipages').removeClass('active');
            $(this).addClass('active');
        });
      });
