@extends('layouts.app_home')
@section('content')

 


<!-- Begin page content -->

 

    <div class="container page-content"> 



      <div class="row">

      <div class="row">

      <div class="span2" style="margin-left: 450px;">
      <ul class="nav nav-pills">
                           
      <a href="#" class="btn btn-info" role="button">Read <span class="fa fa-microphone"></span></a>
      <a href="#" class="btn btn-danger" role="button">Stop <span class="fa fa-stop"></span></a>
                                    
      </ul>    
     </div>
                                
       </div>
       </div> 
       </br>

        <div class="col-md-4 bg-white">

          <div class=" row border-bottom padding-sm" style="height: 40px;overflow-y:auto">
          Pages
          </div> 
          <!-- member list -->
          <ul class="friend-list">
          {{-- <li class="active">
            <a href="#" class="clearfix">
              <img src="img/Friends/guy-1.jpg" alt="" class="img-circle">
              <div class="friend-name"> 
                <strong>Page Number:</strong>
              </div>
              <div class="last-message text-muted">Hello, Are you there?</div>
              <small class="time text-muted">Just now</small> 
              <small class="chat-alert label label-danger">1</small>
            </a>
          </li> --}}
          @foreach($pages as $data)
          
          <li class="lipages">
              <a href="#" onclick="page({{$data->doc_id}},{{$data->id}})" class="clearfix">
              <div class="friend-name"> 
                <strong>Page Number : {{$data->doc_page_no}}</strong>
              </div>
              <div class="last-message text-muted">Tags : {{$data->tags}}</div>
          
         
            </a>
          </li>   

          @endforeach              
          </ul>
        </div>

        <!--=========================================================-->
        <!-- selected chat -->
        <div class="col-md-8 bg-white ">
          <div class="chat-message" style="max-height: 600px;overflow-y:auto ">
            <ul class="chat">

                <li class="right clearfix">

                  <div class="chat-body clearfix">
                    <div class="header">
                      <strong class="primary-font">Page Number</strong>
                      
                    </div>
                    <p id='page'>
                    Page Content here
                    </p>
                  </div>
                </li>




          </div>
           
        </div>        
      </div>
    </div>
  





@endsection


