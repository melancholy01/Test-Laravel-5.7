@extends('layouts.app')



@section('content')
<link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css" />

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
     <!-- <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
     <h1 style="padding:20px">Admin</h1>
    </div>

    <!-- Login Form -->
     <form method="POST" action="{{ route('login') }}">
         @csrf
     
      <input id="email" type="email" class="fadeIn second " name="email" value="{{ old('email') }}" required  placeholder="Email">
      @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
     
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

      <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

      <input type="submit" class="fadeIn fourth" value=" {{ __('Login') }}">    
      
                           
                            

    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
          @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a>
        @endif
    </div>

  </div>
</div>
@endsection