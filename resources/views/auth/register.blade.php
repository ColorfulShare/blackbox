@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
<style>
  .auth-wrapper.auth-v1 .auth-inner {
      max-width: 700px;
  }
</style>
@endsection

@php
  $referred = null;
@endphp
@if ( request()->referred_id != null )
@php
  $referred = DB::table('users')
  ->select('firstname' , 'lastname')
  ->where('ID', '=', request()->referred_id)
  ->first();
@endphp
@endif

@section('content')

<div class="card-header">

  @if (!empty($referred))
    <h6 class="text-center col-12">Registro Referido por {{$referred->firstname}} {{$referred->lastname}}</h6>
  @endif
</div>
<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Register v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="#" class="brand-logo">
          <img src="{{asset('img/logo/blackbox.png')}}" style="width: 150px;">
          
        </a>
        <h2 class="brand-text text-primary ms-1 text-center">Registrar</h2>
        <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
          @csrf

          {{-- Campo de Referido --}}
          @if ( request()->referred_id != null )
            <input type="hidden" name="referred_id" value="{{request()->referred_id}}">
          @else
            <input type="hidden" name="referred_id" value="1">
          @endif
            <div class="row">
              <div class="col-12 col-sm-6 ">
                <div class="mb-1">
                  <label for="firstname" class="form-label">Nombre</label>
                  <input
                  type="text"
                    class="form-control @error('firstname') is-invalid @enderror"
                    id="firstname"
                    name="firstname"
                    placeholder="Nombre"
                    aria-describedby="firstname"
                    tabindex="1"
                    autofocus
                    value="{{ old('firstname') }}"

                  />
                  @error('firstname')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="lastname" class="form-label">Apellido</label>
                <input
                  type="text"
                  class="form-control @error('lastname') is-invalid @enderror"
                  id="lastname"
                  name="lastname"
                  placeholder="Apellido"
                  aria-describedby="lastname"
                  tabindex="1"
                  autofocus
                  value="{{ old('lastname') }}"

                  />
                  @error('lastname')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="username" class="form-label">Usuario</label>
                  <input
                    type="text"
                    class="form-control @error('username') is-invalid @enderror"
                    id="username"
                    name="username"
                    placeholder="Usuario"
                    aria-describedby="username"
                    tabindex="1"
                    autofocus
                    value="{{ old('username') }}"

                  />
                  @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="phone" class="form-label">Teléfono</label>
                  <input
                    type="text"
                    class="form-control @error('phone') is-invalid @enderror"
                    id="phone"
                    name="phone"
                    placeholder="Teléfono"
                    aria-describedby="phone"
                    tabindex="1"
                    autofocus
                    value="{{ old('phone') }}"

                  />
                  @error('phone')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="mb-1">
                  <label for="countrie_id" class="form-label">País</label>
                  <select
                    name="countrie_id"
                    id="	countrie_id"
                    class="form-control @error('countrie_id') is-invalid @enderror"
                    required
                    data-toggle="select"
                  >
                      <option value="">Elegir pais</option>
                      @foreach(App\Models\Countrie::all() as $countrie)
                      <option value="{{$countrie->id}}">{{$countrie->name}}</option>
                      @endforeach
                  </select>
                  @error('countrie_id')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

              </div>
              <div class="col-12 col-sm-6">

                <div class="mb-1">
                  <label for="email" class="form-label">Correo Electrónico</label>
                  <input
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    placeholder="Correo Electronico"
                    aria-describedby="email"
                    tabindex="2"
                    value="{{ old('email') }}"

                  />
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="mb-1">
                  <label for="email-confirm" class="form-label">Confirmar Correo Electrónico</label>
                  <input
                    type="email"
                    class="form-control @error('email-confirm') is-invalid @enderror"
                    id="email-confirm"
                    name="email-confirm"
                    placeholder="Confirmar Correo Electrónico"
                    aria-describedby="email-confirm"
                    tabindex="2"
                    autocomplete="email"
                    required
                  />
                  @error('email-confirm')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="mb1">
                  <label for="wallet" class="form-label">Billetera USDT TRC20</label>
                  <input
                    id="wallet"
                    type="text"
                    class="form-control @error('wallet') is-invalid @enderror"
                    name="wallet"
                    value="{{ old('wallet') }}"

                    autocomplete="wallet"
                    autofocus
                    placeholder="Billetera USDT TRC20"
                  />

                  @error('wallet')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>


                <div class="mb-1">
                  <label for="password" class="form-label">Contraseña</label>

                  <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                    <input
                      type="password"
                      class="form-control form-control-merge @error('password') is-invalid @enderror"
                      id="password"
                      name="password"
                      placeholder="Ingrese una contraseña"
                      aria-describedby="password"
                      tabindex="3"

                      autocomplete="password"
                    />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="mb-1">
                  <label for="password-confirm" class="form-label">Confirme su contraseña</label>

                  <div class="input-group input-group-merge form-password-toggle">
                    <input
                      type="password"
                      class="form-control form-control-merge"
                      id="password-confirm"
                      name="password_confirmation"
                      placeholder="Confirme su contraseña"
                      aria-describedby="password-confirm"
                      tabindex="3"

                    />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                </div>

              </div>

              <div class="row justify-content-md-center">
                <div class="col-12 col-md-6 text-center mb-2">
                  {!! htmlFormSnippet([
                    "theme" => "dark",
                    "size" => "normal",
                    "tabindex" => "3",
                    "callback" => "callbackFunction",
                    "expired-callback" => "expiredCallbackFunction",
                    "error-callback" => "errorCallbackFunction",
                  ]) !!}
                </div>
              </div>         

              <div class=" mb-1">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="terms"
                    tabindex="4"
                    name="terms"
                  />
                  <label class="form-check-label" for="terms">
                    Acepto los <a href="#">Términos y Condiciones</a>
                  </label>
                  @error('terms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

            </div>
          <button type="submit" class="btn btn-primary w-100" tabindex="5">Registrarme</button>
        </form>

        <p class="text-center mt-2">
          <span>¿Ya tienes una cuenta?</span>
          @if (Route::has('login'))
          <a href="{{ route('login') }}">
            <span>Inicia sesión</span>
          </a>
          @endif
        </p>

        <div class="divider my-2">
          <div class="divider-text">or</div>
        </div>

        <div class="auth-footer-btn d-flex justify-content-center">
          <a href="#" class="btn btn-facebook">
            <i data-feather="facebook"></i>
          </a>
          <a href="#" class="btn btn-twitter white">
            <i data-feather="twitter"></i>
          </a>
          <a href="#" class="btn btn-google">
            <i data-feather="mail"></i>
          </a>
          <a href="#" class="btn btn-github">
            <i data-feather="github"></i>
          </a>
        </div>
      </div>
    </div>
    <!-- /Register v1 -->
  </div>
</div>
@endsection
