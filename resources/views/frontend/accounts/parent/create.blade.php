@extends('layouts.app_home')
@section('content')

  <div class="container page-content">
      <div class="row">
        <div class="col">
          <div class="widget">
            <div class="table-responsive">


             <div class="mix col-sm-3 page2 page3 margin30">
                    <div class="item-img-wrap ">
                        <
                        <div class="item-img-overlay">
                            <a href="#" class="show-image">

                                <span></span>
                            </a>
                        </div>
                    </div> 
                </div>

 <div class="image">
                  <img src="img/Cover/profile-cover.jpg" class="show-in-modal" alt="people">
                </div>


              <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-user darkorange"></i></span>
                                          <input type="text" class="form-control" placeholder="Username">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon bg-blue bordered-blue"><i class="fa fa-envelope-o"></i></span>
                                          <input type="text" class="form-control" placeholder="Email Address">

            </div>
            <ul class="pagination pull-right">
            <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
            </ul>
            </div>
        </div>
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body text-centers">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


@endsection