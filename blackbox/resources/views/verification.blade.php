@extends('layouts.email')
@push('custom_css')

<style>
    @media (max-width: 800px) {
        .logobinari img{
            width: 100px;
        }
    }

    @media (min-width: 801px) {
    .card{
            margin: 0 auto;
            width: 40%;
        }
    }
</style>

@section('content')
<div class="container fluid">
    <div class="mt-2 row">
        <div class="col-12" style="margin: 0 auto">
            <div class="card">

                <div class="card-body text-center">

                    <div class="col-12 text-center logobinari">
                        <img src="{{asset('assets/img/pandora.png')}}" class="mb-2" alt="logo" width="200">
                    </div>

                    <div class="card-text mt-2">
                        {{-- <h4 class="text-white card-title">Hola, {{Auth::user()->name}} --}}
                            <h4 class="text-white card-title">Hola, {{Auth::user()->firstname}}
                        </h4>
                    </div>
                    <h5 class="card-text mt-2">
                        Acabamos de enviar un código de 6 digitos a tu correo.
                        <br><br>
                        Revisa e ingresalo en el recuadro aqui debajo para poder ingresar a nuestro sistema
                        <br><br><br>
                    </h5>

                     <form action="{{ route('verify-account', Auth::user() )}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="text" class="form-control" name="code"
                                style="color: white; font-weight:bold; background-color: #011E0C;"
                                >

                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <h5 class="card-text mt-2">
                            <button
                                type="submit"
                                style="background-color: #28C76F;color: #ffffff;padding: 10px 15px;border-radius: 5px; font-weight: 600; line-height: 26px;">
                                Acceder a tu cuenta
                            </button>
                        </h5>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
