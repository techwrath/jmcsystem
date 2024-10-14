@extends('layouts.app')
@extends('dashboard.layout.script')
@extends('dashboard.layout.css')

@section('content')
<div class="d-flex justify-content-center align-items-center h-100">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-white">

                <div class="card-body">
                  <h6 class="text-muted">Sign In</h6>
                  <h5 class="text-danger">JMC Merchandising System</h5>
                  <br>
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <div class="row mb-3">
                          
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class ="form-group row mb-3">
                          <div class="col-md-12">
                            {!! captcha_image_html('ContactCaptcha') !!}
                            <br>
                            <input type="captcha" class="form-control @error('password') is-invalid @enderror" name="CaptchaCode" id="CaptchaCode" placeholder="Enter Captcha" required style="text-transform: none;">
                            @if($errors->has('CaptchaCode'))
                            <span class="help-block">
                              <strong>{{ $errors->first('CaptchaCode')}}</strong>

                            </span>
                            @endif
                          </div>
                        </div>
                        

                        <div class="d-flex justify-content-between align-items-center">
                          <!-- Checkbox -->
                          <div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                            <label class="form-check-label" for="form2Example3">
                              Remember me
                            </label>
                          </div>

                          <div class="form-check mb-0">
                          <a href="{{route('forgotPassword')}}" class="text-body">Forgot password?</a>
                        </div>
    
                        </div>
                        <br>
                        <br>
                        <div class="row mb-4">
                        <div class="col-md-12">
                          <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger text-white btn-block mb-4">
                                      {{ __('SignIn') }}
                          </button>
                        </div>
                        </div>
                        <div class="d-flex float-right">
                          <!-- Checkbox -->
                          
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
