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