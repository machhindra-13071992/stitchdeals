@extends('layouts.blank')

@section('content')
    <div class="cls-content-sm panel">
        <div class="panel-body">
            <h1 class="h3">{{ translate('Reset Password') }}</h1>
            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                <p class="pad-btm">{{translate('Enter your email address and new password and confirm password.')}} </p>
                <form method="POST" action="{{ route('password.update.phone') }}">
                    @csrf
                    
                        
                    <div class="form-group">
                        
                        @if(isset($phone))
                        <input id="otp" type="text" class="form-control" name="otp"  required placeholder="{{ translate('Enter OTP') }}">
                        <input id="phone" type="hidden" name="phone" value="{{ $phone }}">
                        @else
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ translate('Email') }}" required autofocus>
                        @endif
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ translate('New Password') }}" required>
    
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ translate('Confirm Password') }}" required>
                    </div>
    
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            {{ translate('Reset Password') }}
                        </button>
                    </div>
                </form>
            @else
                <p class="pad-btm">{{translate('Enter your email address and new password and confirm password.')}} </p>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
    
                    <input type="hidden" name="token" value="{{ $token }}">
                        
                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ translate('Email') }}" required autofocus>
    
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ translate('New Password') }}" required>
    
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ translate('Confirm Password') }}" required>
                    </div>
    
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            {{ translate('Reset Password') }}
                        </button>
                    </div>
                </form>
            
            @endif
            
        </div>
    </div>
@endsection
