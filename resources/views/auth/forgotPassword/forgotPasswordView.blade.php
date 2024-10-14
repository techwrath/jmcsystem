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
                    <p>Send Your Email Address to Admin</p>
                  <br>
                    @if ($errors->any())
                     <div class="row mb-3">
                        <div class="col-md-12 alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                                {{ $errors->first() }}
                        </div>
                      </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="GET" action="{{ route('sendMail') }}" id="loginForm">
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
    
                        <br>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger text-white btn-block">
                                            {{ __('SUBMIT') }}
                                </button>
                            </div>
                        </div>
                       
                          
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
