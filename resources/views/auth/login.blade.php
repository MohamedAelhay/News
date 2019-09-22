@extends('app')

@section('title', 'Login')
@section('reCaptcha')
    {!! htmlScriptTagJsApi(/* $formId - INVISIBLE version only */) !!}
@endsection
@section('body', 'class=gray-bg')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">IN+</h1>
            </div>
            <h3>Welcome to IN+</h3>
            <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" method="POST" action={{ route('login') }}>
                @csrf
                <div class="form-group">
                    <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Username/Phone" required="">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required="">
                </div>
                <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                @if($reCaptcha)
                    {!! htmlFormSnippet() !!}
                @endif
                @error('g-recaptcha-response')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <button type="submit" class="btn btn-primary block full-width m-b">{{ __('Login') }}</button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <small>{{ __('Forgot Password?') }}</small>
                    </a>
                @endif
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href={{ route('register') }}>Create an account</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>
@endsection
