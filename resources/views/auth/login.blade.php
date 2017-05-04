 @extends('layouts.ui_login_app')
 @section('content')
 <div class="parallax filter-black">
          <div class="parallax-image"></div>             
          <div class="small-info">
            <div class="col-sm-10 col-sm-push-1 col-md-6 col-md-push-3 col-lg-6 col-lg-push-3">
              <div class="card-group animated flipInX">
                <div class="card">
                  <div class="card-block">
                    <div class="center">
                      <h4 class="m-b-0"><span class="icon-text">Login</span></h4>
                      <p class="text-muted">Access your account</p>
                      
                    </div>
                    <form role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                      <div class="form-group">
                     
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email Address">
                         @if ($errors->has('email'))
                                    <span class="help-block">
                                        <font color="red"><strong>{{ $errors->first('email') }}</strong></font>
                                    </span>
                                @endif
                      </div>
                      <div class="form-group">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                        
                        <a href="#" class="pull-xs-right">
                          <small>Forgot?</small>
                        </a>
                        <div class="clearfix"></div>
                      </div>
                      <div class="center">
                        
                         
                        <input type="submit" name="login" id="login" class="btn btn-azure" value="Login" />
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card">
                  <div class="card-block center">
                    <h4 class="m-b-0">
                      <span class="icon-text">Sign Up</span>
                    </h4>
                    <p class="text-muted">Create a new account</p>
                    <form role="form" method="POST" action="{{ route('register') }}">
                       {{ csrf_field() }}
                      <div class="form-group">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Full Name">
                        @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                      </div>
                      <div class="form-group">
                        <input id="emailid" type="email" class="form-control" name="emailid" value="{{ old('emailid') }}" required placeholder="Email">
                        @if ($errors->has('emailid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emailid') }}</strong> 
                                    </span>
                                @endif
                      </div>
                      <div class="form-group">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                        @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                      </div>
                      <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                      </div>
                      <button type="submit" class="btn btn-azure">Register</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
@endsection