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


 // var interval = undefined;


function getNext() {

   var pid=$("#doc_page_no").val();
   var did=$("#doc_id").val();
   var user=$("#user").val();

   var pid=parseInt(pid);

   var next = pid+1;

    console.log(next);


    //var st=status(did,pid,user);

   //str=JSON.stringify(st);

   //alert(st);
   
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
                  $('#doc_page_no').val(data.doc_page_no);

                }



               }
            });


}

function getPrev() {
   var pid=$("#doc_page_no").val();
   var did=$("#doc_id").val();

   var pid=parseInt(pid);

   var prev = pid-1;


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
                  $('#doc_page_no').val(data.doc_page_no);

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

                  return data;
              


               }
            });
         }