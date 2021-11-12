@extends('layouts/fullLayoutMaster')

@section('title', 'Reset Password')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Reset Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="javascript:void(0);" class="brand-logo">
          <img src="{{asset('img/logo/blackbox.png')}}" style="width: 200px;">
        </a>

        <h4 class="card-title mb-1 text-center">Recuperar contraseña</h4>
        <p class="card-text mb-2">Su nueva contraseña debe ser diferente de las contraseñas utilizadas anteriormente</p>

        <form class="auth-reset-password-form mt-2" method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="mb-1">
            <input type="hidden" class="form-control id="email" name="email" placeholder="john@example.com" aria-describedby="email" tabindex="1" autofocus value="{{ $email ?? old('email') }}" />
     
          </div>

          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label for="reset-password-new">New Password</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
              <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="reset-password-new" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-new" tabindex="2" autofocus />
               <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label for="reset-password-confirm">Confirm Password</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input type="password" class="form-control form-control-merge" id="reset-password-confirm" name="password_confirmation" autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-confirm" tabindex="3" />
               <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100" tabindex="4">Set New Password</button>
        </form>

        <p class="text-center mt-2">
          @if (Route::has('login'))
          <a href="{{ route('login') }}">
            <i data-feather="chevron-left"></i> Back to login
          </a>
          @endif
        </p>
      </div>
    </div>
    <!-- /Reset Password v1 -->
  </div>
</div>
@endsection
