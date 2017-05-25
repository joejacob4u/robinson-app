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
          
         // $('#edit_id').val(id);
         

            $.ajax({
               type:'GET',
               url:'/read/document-'+did+'/pages/'+pid,
               success:function(data){
                   console.log(data);
                   stopRecording();
                 console.log(data.doc_page_content);
                  $('#page').html(data.doc_page_content);
                  $('#doc_id').val(data.doc_id);
                  $('#page_no').html(data.doc_page_no);
                  $('#doc_page_no').val(data.doc_page_no);

                  stopRecording();
                  saveUserState('seen');



               }
            });
         }



      $(function() {
        $('.lipages').on('click', function() {
            $('.lipages').removeClass('active');
            $(this).addClass('active');
        });
      });


 // var interval = undefined;


function getNext() {

   var pid=$("#doc_page_no").val();
   var did=$("#doc_id").val();
   var user=$("#user").val();

   var pid=parseInt(pid);
  console.log(pid);

   var next = pid+1;

    console.log(next);


   
    $.ajax({
               type:'GET',
               url:'/read/document-'+did+'/pages/'+next,
               success:function(data){


                if(data.status=='none'){
                  $('#myModalLabel').html("Sorry No More Pages")


                  $("#modalShow").modal("toggle");
                }
                else{

                   $("#page_"+pid).removeClass('active');
                   $("#page_"+next).addClass('active');


                  console.log(data);
                 // stopRecording();
                  console.log(data.doc_page_content);
                  $('#page').html(data.doc_page_content);
                  $('#doc_id').val(data.doc_id);
                  $('#page_no').html(data.doc_page_no);
                  $('#doc_page_no').val(next);

                  stopRecording();
                 

                }



               }
            });


}

function getPrev() {
   var pid=$("#doc_page_no").val();
   var did=$("#doc_id").val();




   var pid=parseInt(pid);

   console.log(pid);

   var prev = pid-1;

    console.log(prev);


    $.ajax({
               type:'GET',
               url:'/read/document-'+did+'/pages/'+prev,
               success:function(data){


                if(data.status=='none'){
                  $('#myModalLabel').html("Sorry No More Pages")

                  $("#modalShow").modal("toggle");
                }

                else{


                  $("#page_"+pid).removeClass('active');
                   $("#page_"+prev).addClass('active');

                   console.log(data);
                 // stopRecording();
                  console.log(data.doc_page_content);
                  $('#page').html(data.doc_page_content);
                  $('#doc_id').val(data.doc_id);
                  $('#doc_page_no').val(prev);
                  $('#page_no').html(data.doc_page_no);


                  stopRecording();

                }


                 



               }
            });
}

function status(did,pid,user){
          
             $.ajax({
               type:'GET',
               url:'/read-status/'+user+'/'+did+'/'+pid,
               success:function(data){
                  //$("#edit_name").val(data.name);
                  //document.getElementById('edit_name').value="adsfsf";

                  return data.status;
              


               }
            });
         }