@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
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
          <svg
            viewbox="0 0 139 95"
            version="1.1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            height="28"
          >
            <defs>
              <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                <stop stop-color="#000000" offset="0%"></stop>
                <stop stop-color="#FFFFFF" offset="100%"></stop>
              </lineargradient>
              <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                <stop stop-color="#FFFFFF" offset="100%"></stop>
              </lineargradient>
            </defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                <g id="Group" transform="translate(400.000000, 178.000000)">
                  <path
                    class="text-primary"
                    id="Path"
                    d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                    style="fill: currentColor"
                  ></path>
                  <path
                    id="Path1"
                    d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                    fill="url(#linearGradient-1)"
                    opacity="0.2"
                  ></path>
                  <polygon
                    id="Path-2"
                    fill="#000000"
                    opacity="0.049999997"
                    points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"
                  ></polygon>
                  <polygon
                    id="Path-21"
                    fill="#000000"
                    opacity="0.099999994"
                    points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"
                  ></polygon>
                  <polygon
                    id="Path-3"
                    fill="url(#linearGradient-2)"
                    opacity="0.099999994"
                    points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"
                  ></polygon>
                </g>
              </g>
            </g>
          </svg>
          <h2 class="brand-text text-primary ms-1">Vuexy</h2>
        </a>

        <h4 class="card-title mb-1">Adventure starts here 🚀</h4>
        <p class="card-text mb-2">Make your app management easy and fun!</p>

        <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
          @csrf

          {{-- Campo de Referido --}}
          @if ( request()->referred_id != null )
            <input type="hidden" name="referred_id" value="{{request()->referred_id}}">
          @else
            <input type="hidden" name="referred_id" value="1">
          @endif
          
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
              required
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
              required
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
                required
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
              required
            />
            @error('phone')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
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
              required
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

          <div class="mb1">
            <label for="wallet" class="form-label">Billetera USDT TRC20</label>
            <input 
              id="wallet" 
              type="text" 
              class="form-control @error('wallet') is-invalid @enderror"
              name="wallet" 
              value="{{ old('wallet') }}" 
              required 
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
                required
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
                required
              />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
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
          <div class="text-center mb-2">
            {!! htmlFormSnippet([
              "theme" => "light",
              "size" => "normal",
              "tabindex" => "3",
              "callback" => "callbackFunction",
              "expired-callback" => "expiredCallbackFunction",
              "error-callback" => "errorCallbackFunction",
            ]) !!}
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
