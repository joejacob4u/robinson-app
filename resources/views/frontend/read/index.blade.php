@extends('layouts.app_home')
@section('content')





    <!-- Begin page content -->
    <div class="container page-content ">
      <div class="row">
        <div class="col-md-3">
          <div class="ibox float-e-margins">
              <div class="ibox-content">
                  <div class="file-manager">
                      <div class="hr-line-dashed"></div>
                      
                      <div class="hr-line-dashed"></div>
              
                      <ul class="folder-list" style="padding: 0">
                          <li><a href="#"><i class="fa fa-book"></i> Books</a></li>
                          <li><a href="/read/documents"><i class="fa fa-file"></i> Documents</a></li>

                      </ul>
                      <div class="clearfix"></div>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-md-9 animated fadeInRight">
          <div class="row">
              <div class="col-md-12">

                 @foreach($documents as $data) 


                  <div class="file-box">
                      <div class="file">
                          <a href="/read/document-{{$data->id}}/pages">
                              <span class="corner"></span>

                              <div class="image">
                                  <img alt="image" class="img-responsive" src="/files/documents/cover/{{$data->doc_cover}}">
                              </div>
                              <div class="file-name">
                                  {{$data->doc_name}}
                                  <br>
                                  <small>Author: {{$data->doc_author}}</small>
                                  <br>
                                  <small>Publish Date: {{date('F j,Y',strtotime($data->publish_date))}}</small>
                              </div>
                          </a>

                      </div>
                  </div>


                  @endforeach
    
                  </div>

                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  





@endsection


