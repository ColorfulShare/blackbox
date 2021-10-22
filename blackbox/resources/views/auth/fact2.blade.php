@extends('layouts/contentLayoutMaster')

<style>
    html{
        overflow: hidden;
    }
</style>

@section('content')
<div class="card">
    <div class="card-content">
        <div class="card-body card-dashboard">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 px-xl-2">
                    <h2 class="card-title fw-bold mb-1">Verificar 2Fact</h2>
                    <form class="auth-login-form mt-2" action="{{ route('2fact.post') }}" method="POST">
                        @csrf
                        @if (!empty($urlQr))
                        <div class="mb-1 text-center">
                            <img src="{{$urlQr}}" alt="codigo qr google" class="d-inline">
                        </div>
                        @endif
                        <div class="mb-1">
                            <label class="form-label" for="username">Codigo 2Fact</label>
                            <input class="form-control border border-warning rounded-0" id="username" type="text" required name="code"
                                placeholder="000000" aria-describedby="username" autofocus="" tabindex="1" />
                        </div>    
                        <button class="btn btn-primary w-100 rounded-0 mt-2" type="submit" tabindex="4">Verificar</button>
                    </form>
                    {{-- <p class="text-center mt-2"><span>¿Nuevo en la plataforma?</span><a
                            href="{{ route('register') }}"><span>&nbsp;<b>Crea una cuenta</b></span></a></p> --}}
                </div>
                <div class="col-12 col-sm-8 col-md-6 col-lg-7 px-xl-2">
                    <h2>Agregue seguridad adicional a su cuenta mediante la autenticación de dos factores.</h2>

                    @if (!$user->activar_2fact)
            
                        <div class="mt-4 max-w-xl text-sm text-gray-600">
                            <p class="font-semibold">
                                {{ __('La autenticación de dos factores ahora está deshabilitada. Escanee el siguiente código QR usando la aplicación de Google authenticator de su teléfono.') }}
                            </p>
                        </div>
                    @endif
                    @if ($user->activar_2fact)
                    <p class="font-semibold">{{ __('Ha habilitado la autenticación de dos factores.') }}</p>
                    @else
                    <p class="font-semibold">{{ __('No ha habilitado la autenticación de dos factores.') }}</p>
                    @endif

                    <div class="mt-1 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ __('Cuando la autenticación de dos factores está habilitada, se le solicitará un token aleatorio seguro durante la autenticación. Puede recuperar este token de la aplicación Google Authenticator de su teléfono.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
     
@endsection

@push('page_js')
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })

</script>
@endpush
